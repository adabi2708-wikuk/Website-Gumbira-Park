 // server.js
import express from "express";
import mysql from "mysql2/promise";
import dotenv from "dotenv";
import cors from "cors";

dotenv.config();

const app = express();
app.use(cors());
app.use(express.json());
app.use(express.static("public")); // biar bisa akses login.html, admin.html, booking.html

// -------------------- DATABASE CONFIG --------------------
const dbConfig = {
  host: process.env.DB_HOST || "127.0.0.1",
  user: process.env.DB_USER || "root",
  password: process.env.DB_PASS || "",
  database: process.env.DB_NAME || "gumbira",
};

console.log("🔍 Database Config:", {
  host: dbConfig.host,
  user: dbConfig.user,
  password: dbConfig.password ? "✅ (terisi)" : "❌ (kosong)",
  database: dbConfig.database,
});

let pool;
try {
  pool = await mysql.createPool(dbConfig);
  const conn = await pool.getConnection();
  console.log("✅ Database connected successfully!");
  conn.release();
} catch (err) {
  console.error("❌ Database connection failed:", err.message);
  process.exit(1);
}

// -------------------- LOGIN ADMIN --------------------
app.post("/api/login", async (req, res) => {
  const { username, password } = req.body;
  if (!username || !password)
    return res
      .status(400)
      .json({ success: false, message: "Lengkapi username dan password." });

  try {
    const [rows] = await pool.query(
      "SELECT * FROM admins WHERE username=? AND password=?",
      [username, password]
    );
    if (rows.length > 0) {
      res.json({ success: true, message: "Login berhasil!" });
    } else {
      res
        .status(401)
        .json({ success: false, message: "Username atau password salah." });
    }
  } catch (err) {
    console.error("❌ /api/login error:", err.message);
    res.status(500).json({ success: false, message: "Server error (login)" });
  }
});

// -------------------- AREA & BOOKING API --------------------

// ✅ GET daftar area
app.get("/api/areas", async (req, res) => {
  try {
    console.log("📡 GET /api/areas called...");
    const [rows] = await pool.query(
      "SELECT id, slug, name, description, capacity, price_per_day FROM areas ORDER BY id"
    );
    res.json(rows);
  } catch (err) {
    console.error("❌ /api/areas error:", err.message);
    res.status(500).json({ error: "Server error (areas)" });
  }
});

// ✅ GET daftar tanggal booking di area tertentu
app.get("/api/bookings", async (req, res) => {
  try {
    const { area_id } = req.query;
    if (!area_id) return res.status(400).json({ error: "area_id required" });

    const [rows] = await pool.query(
      "SELECT date, status FROM bookings WHERE area_id=? ORDER BY date",
      [area_id]
    );
    res.json(rows);
  } catch (err) {
    console.error("❌ /api/bookings (GET) error:", err.message);
    res.status(500).json({ error: "Server error (bookings GET)" });
  }
});

// ✅ POST buat booking baru
app.post("/api/bookings", async (req, res) => {
  const { area_id, date, name, phone, email } = req.body;
  if (!area_id || !date || !name)
    return res.status(400).json({ error: "Lengkapi field wajib." });

  try {
    console.log("📩 Booking data received:", req.body);

    // Pastikan area valid
    const [areas] = await pool.query("SELECT * FROM areas WHERE id = ?", [
      area_id,
    ]);
    if (!areas.length)
      return res.status(404).json({ error: "Area tidak ditemukan." });

    const total = areas[0].price_per_day;
    let userId;

    // Simpan user (kalau belum ada)
    const [userExist] = await pool.query("SELECT id FROM users WHERE email=?", [
      email,
    ]);
    if (userExist.length) {
      userId = userExist[0].id;
    } else {
      const [userInsert] = await pool.query(
        "INSERT INTO users (name,email,phone) VALUES (?,?,?)",
        [name, email, phone]
      );
      userId = userInsert.insertId;
    }

    // Simpan booking baru
    const [result] = await pool.query(
      "INSERT INTO bookings (area_id,user_id,date,status,total_amount) VALUES (?,?,?,'pending',?)",
      [area_id, userId, date, total]
    );

    // QR dummy (belum QRIS nyata)
    const qr_url = `https://quickchart.io/qr?text=Booking-${result.insertId}-${total}&size=300`;

    res.json({
      bookingId: result.insertId,
      total_amount: total,
      qr_url,
      message: "Booking berhasil dibuat!",
    });
  } catch (err) {
    console.error("❌ /api/bookings (POST) error:", err.message);
    res.status(500).json({ error: "Server error (bookings POST)" });
  }
});

// -------------------- ADMIN DASHBOARD --------------------
app.get("/api/admin/bookings", async (req, res) => {
  try {
    const [rows] = await pool.query(`
      SELECT 
        b.id,
        u.name AS user_name,
        u.email,
        u.phone,
        a.name AS area_name,
        b.date,
        b.status,
        b.total_amount
      FROM bookings b
      JOIN users u ON b.user_id = u.id
      JOIN areas a ON b.area_id = a.id
      ORDER BY b.id DESC
    `);
    res.json(rows);
  } catch (err) {
    console.error("❌ /api/admin/bookings error:", err.message);
    res.status(500).json({ error: "Server error (admin bookings)" });
  }
});

// -------------------- RUN SERVER --------------------
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`🌐 Server running on http://localhost:${PORT}`);
});
