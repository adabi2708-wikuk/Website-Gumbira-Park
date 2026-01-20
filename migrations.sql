-- migrations.sql
-- 1) Create tables
CREATE TABLE IF NOT EXISTS areas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(80) NOT NULL UNIQUE,
  name VARCHAR(150) NOT NULL,
  description TEXT,
  capacity INT DEFAULT 0,
  price_per_day DECIMAL(12,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(255),
  phone VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS bookings (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  area_id INT NOT NULL,
  user_id INT NULL,
  date DATE NOT NULL,
  status ENUM('pending','reserved','cancelled','paid') DEFAULT 'pending',
  total_amount DECIMAL(12,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY unique_area_date (area_id, date),
  FOREIGN KEY (area_id) REFERENCES areas(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS payments (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  booking_id BIGINT NOT NULL,
  provider VARCHAR(100) NOT NULL,
  provider_payment_id VARCHAR(200),
  amount DECIMAL(12,2) NOT NULL,
  currency VARCHAR(10) DEFAULT 'IDR',
  status ENUM('pending','success','failed','expired') DEFAULT 'pending',
  metadata JSON,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  name VARCHAR(150),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2) Seed sample areas
INSERT INTO areas (slug,name,description,capacity,price_per_day)
VALUES
('main-ground','Main Ground','Lapangan rumput luas, cocok untuk konser dan festival',5000,5000000.00),
('multifunction-ground','Multifunction Ground','Area paving fleksibel untuk bazar, konser kecil',500,2000000.00),
('mini-ground','Mini Ground','Lapangan kecil untuk gathering',500,1000000.00)
ON DUPLICATE KEY UPDATE name=VALUES(name);
