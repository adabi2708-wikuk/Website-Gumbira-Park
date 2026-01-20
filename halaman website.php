<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gumbira Park</title>

<style>
html {
  scroll-behavior: smooth;
}

body {
  font-family: 'Open Sans', sans-serif;
  margin: 0;
  background: linear-gradient(180deg, #e9f5ee, #ffffff);
  color: #2c3e33;
}

/* ================= HEADER ================= */
header {
  position: sticky;
  top: 0;
  background: #ffffff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 24px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  z-index: 1000;
}

.burger {
  font-size: 28px;
  cursor: pointer;
  color: #2E8B57;
  transition: transform 0.3s;
}

.burger:hover {
  transform: scale(1.1);
}

b4 {
  color: #2E8B57;
  font-size: 26px;
  font-weight: 800;
  letter-spacing: 1px;
}

.logo img {
  width: 55px;
}

/* ================= MENU ================= */
.menu {
  position: absolute;
  top: 70px;
  left: 15px;
  background: #ffffff;
  border-radius: 14px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
  display: none;
  flex-direction: column;
  overflow: hidden;
  min-width: 200px;
  animation: fadeIn 0.3s ease-in-out;
}

.menu a {
  text-decoration: none;
  color: #2E8B57;
  padding: 14px 20px;
  font-weight: 600;
  transition: all 0.3s;
}

.menu a:hover {
  background: linear-gradient(90deg, #2E8B57, #3cb371);
  color: #ffffff;
}

/* ================= CONTAINER ================= */
.container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 30px;
  padding: 60px 30px;
  max-width: 1200px;
  margin: auto;
}

/* ================= CARD ================= */
.card {
  background: #ffffff;
  border-radius: 20px;
  padding: 20px;
  text-align: center;
  box-shadow: 0 15px 40px rgba(0,0,0,0.1);
  transition: all 0.4s ease;
  position: relative;
  overflow: hidden;
}

.card::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, #2E8B57, #7ed6a2);
  opacity: 0;
  transition: opacity 0.4s;
  z-index: 0;
}

.card:hover::before {
  opacity: 0.08;
}

.card:hover {
  transform: translateY(-12px);
  box-shadow: 0 25px 55px rgba(46,139,87,0.3);
}

.card img {
  width: 100%;
  border-radius: 14px;
  margin-bottom: 15px;
  position: relative;
  z-index: 1;
}

.card h3 {
  font-size: 20px;
  color: #2E8B57;
  margin-bottom: 8px;
  position: relative;
  z-index: 1;
}

.card p {
  font-size: 14px;
  line-height: 1.6;
  color: #555;
  position: relative;
  z-index: 1;
}

/* ================= BUTTON ================= */
.btn {
  display: inline-block;
  margin-top: 14px;
  padding: 12px 22px;
  background: linear-gradient(135deg, #2E8B57, #3cb371);
  color: white;
  border-radius: 30px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s;
  position: relative;
  z-index: 1;
}

.btn:hover {
  background: linear-gradient(135deg, #256c47, #2E8B57);
  transform: scale(1.05);
  box-shadow: 0 10px 25px rgba(46,139,87,0.4);
}

/* ================= ANIMATION ================= */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ================= RESPONSIVE ================= */
@media (max-width: 720px) {
  b4 {
    font-size: 22px;
  }
}
</style>
</head>

<body>

<header>
  <div class="burger" onclick="toggleMenu()">☰</div>
  <b4>Gumbira Park</b4>
  <div class="logo">
    <img src="img/logo gumbira-01 (1).png" alt="Logo">
  </div>

  <nav id="menu" class="menu">
    <a href="index.html">🏡 Beranda</a>
    <a href="booking.html">📅 Booking</a>
    <a href="webvenue.php">🏟️ Sewa Venue</a>
    <a href="halaman2.html">🎡 Wahana</a>
    <a href="http://localhost:3000/login.html">🧭 Admin</a>
  </nav>
</header>

<div class="container">

  <div class="card">
    <img src="img/logo gumbira-01 (1).png" alt="Sewa Venue">
    <h3>Sewa Venue</h3>
    <p>Disewakan lahan Gumbira Park yang dapat menampung hingga ±5000 orang.</p>
    <a class="btn" href="webvenue.php">Lihat Detail</a>
  </div>

  <div class="card">
    <img src="img/logo gumbira-01 (1).png" alt="Acara Event">
    <h3>Acara & Event</h3>
    <p>Tempat ideal untuk bazar, konser, dan berbagai acara seru lainnya.</p>
    <a class="btn" href="halaman2.html">Lihat Detail</a>
  </div>

  <div class="card">
    <img src="img/logo gumbira-01 (1).png" alt="Mini Ground">
    <h3>Mini Ground</h3>
    <p>Cocok untuk kegiatan komunitas, olahraga ringan, atau gathering kecil.</p>
    <a class="btn" href="halaman3.html">Lihat Detail</a>
  </div>

  <div class="card">
    <img src="img/logo gumbira-01 (1).png" alt="Garden Zone">
    <h3>Garden Zone</h3>
    <p>Area taman hijau dengan spot foto yang indah dan suasana alami.</p>
    <a class="btn" href="halaman4.html">Lihat Detail</a>
  </div>

</div>

<script>
function toggleMenu() {
  const menu = document.getElementById('menu');
  menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
}
</script>

</body>
</html>
