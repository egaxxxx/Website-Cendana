
DROP DATABASE IF EXISTS cendana_travel;
CREATE DATABASE cendana_travel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE cendana_travel;

-- TABEL: company_info
CREATE TABLE company_info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL DEFAULT 'Cv. Cendana Travel',
    whatsapp VARCHAR(20) NOT NULL DEFAULT '6285821841529',
    instagram VARCHAR(100) NOT NULL DEFAULT '@cendanatravel_official',
    email VARCHAR(100) NOT NULL DEFAULT 'info@cendanatravel.com',
    address TEXT NOT NULL,
    hours VARCHAR(255) NOT NULL DEFAULT 'Senin - Minggu: 08.00 - 22.00 WIB',
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO company_info (id, name, whatsapp, instagram, email, address, hours, description) VALUES
(1, 'Cv. Cendana Travel', '6285821841529', '@cendanatravel_official', 'info@cendanatravel.com', 
'Jl. Cendana No.8, Tlk. Lerong Ulu, Kec. Sungai Kunjang<br>Kota Samarinda, Kalimantan Timur 75127',
'Senin - Minggu: 08.00 - 22.00 WIB',
'Kami adalah penyedia layanan travel terpercaya dengan pengalaman lebih dari 10 tahun dalam melayani perjalanan Anda. Berawal dari lokasi sederhana di depan masjid, kini kami telah berkembang dengan kantor cabang di Jl. Cendana No.8, Tlk. Lerong Ulu, Kec. Sungai Kunjang, Kota Samarinda, Kalimantan Timur.');

-- TABEL: transport_types
CREATE TABLE transport_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type_key VARCHAR(50) NOT NULL UNIQUE,
    type_name VARCHAR(100) NOT NULL,
    icon_class VARCHAR(100) DEFAULT 'icon icon-plane',
    image_light VARCHAR(255) DEFAULT NULL,
    image_dark VARCHAR(255) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO transport_types (type_key, type_name, icon_class, image_light, image_dark, description, display_order) VALUES
('pesawat', 'Pesawat', 'icon icon-plane', 'JenisTransportasi/pesawatterang.png', 'JenisTransportasi/pesawatgelap.png', 'Transportasi udara yang cepat dan efisien untuk perjalanan jarak jauh', 1),
('kapal', 'Kapal', 'icon icon-ship', 'JenisTransportasi/kapalterang.png', 'JenisTransportasi/kapalgelap.png', 'Transportasi laut yang nyaman untuk perjalanan antar pulau dengan pemandangan indah', 2),
('bus', 'Bus', 'icon icon-bus', 'JenisTransportasi/busterang.png', 'JenisTransportasi/busgelap.png', 'Transportasi darat yang ekonomis dan terjangkau untuk perjalanan dalam kota dan antar kota', 3);

-- TABEL: transport_services
CREATE TABLE transport_services (
    id INT PRIMARY KEY AUTO_INCREMENT,
    transport_type VARCHAR(50) NOT NULL,
    name VARCHAR(255) NOT NULL,
    logo VARCHAR(255) DEFAULT NULL,
    route TEXT NOT NULL,
    price VARCHAR(100) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (transport_type) REFERENCES transport_types(type_key) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO transport_services (transport_type, name, logo, route, price, display_order) VALUES
('pesawat', 'Lion Air', 'pesawat/Lionair.png', 'Penerbangan domestik terpercaya', 'Rp 450.000 - Rp 850.000', 1),
('pesawat', 'Garuda Indonesia', 'pesawat/Garuda.png', 'Maskapai nasional Indonesia', 'Rp 500.000 - Rp 1.200.000', 2),
('pesawat', 'Batik Air', 'pesawat/Batik.png', 'Layanan premium dengan harga terjangkau', 'Rp 500.000 - Rp 950.000', 3),
('pesawat', 'Citilink', 'pesawat/Citilink.png', 'Low cost carrier terbaik', 'Rp 350.000 - Rp 650.000', 4),
('pesawat', 'Sriwijaya Air', 'pesawat/Sriwijaya.png', 'Jangkauan luas ke seluruh Indonesia', 'Rp 400.000 - Rp 750.000', 5),
('pesawat', 'Pelita Air', 'pesawat/Pelita.png', 'Penerbangan charter dan regular', 'Rp 380.000 - Rp 680.000', 6),
('pesawat', 'Royal Brunei', 'pesawat/RoyalBrunei.png', 'Penerbangan internasional ke Brunei', 'Rp 1.000.000 - Rp 1.800.000', 7),
('pesawat', 'Singapore Airlines', 'pesawat/Singapore.png', 'Premium airline ke Singapore', 'Rp 1.200.000 - Rp 2.500.000', 8),
('kapal', 'KM. Kelud', 'kapal/kapallaut.png', 'Kapal penumpang antar pulau', 'Rp 250.000 - Rp 450.000', 1),
('kapal', 'Speedboat Express', 'kapal/speedboat.png', 'Speedboat cepat dan nyaman', 'Rp 200.000 - Rp 350.000', 2),
('bus', 'Bus Pariwisata', 'bus/bus.png', 'Bus pariwisata dengan fasilitas lengkap', 'Rp 100.000 - Rp 250.000', 1);

-- TABEL: facilities
CREATE TABLE facilities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO facilities (name, description, image, display_order) VALUES
('Ruang Tunggu VIP', 'Ruang tunggu yang nyaman dengan AC, WiFi gratis, dan refreshment untuk kenyamanan Anda sebelum keberangkatan.', 'cendana/Screenshot 2025-10-28 014436.png', 1),
('Layanan Antar Jemput', 'Layanan antar jemput dari rumah ke terminal/bandara dengan kendaraan yang nyaman dan sopir berpengalaman.', 'cendana/Screenshot 2025-10-28 014729.png', 2),
('Customer Service 24/7', 'Tim customer service yang siap membantu Anda 24 jam sehari, 7 hari seminggu melalui WhatsApp dan telepon.', 'cendana/Screenshot 2025-10-28 014745.png', 3),
('Fasilitas Premium', 'Fasilitas premium dengan berbagai kemudahan untuk memberikan pengalaman perjalanan yang tak terlupakan.', 'cendana/Screenshot 2025-10-28 014806.png', 4),
('Layanan Konsultasi', 'Konsultasi perjalanan dengan tim ahli kami untuk merencanakan perjalanan impian Anda.', 'cendana/Screenshot 2025-10-28 014817.png', 5),
('Booking Online', 'Sistem booking online yang mudah dan cepat untuk kemudahan pemesanan tiket perjalanan Anda.', 'cendana/Screenshot 2025-10-28 014829.png', 6),
('Travel Insurance', 'Asuransi perjalanan komprehensif untuk melindungi Anda selama bepergian dengan tenang.', 'cendana/Screenshot 2025-10-28 014853.png', 7);

-- TABEL: admin_users
CREATE TABLE admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    last_login TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO admin_users (username, password, full_name, email) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@cendanatravel.com');

-- TABEL: admin_sessions
CREATE TABLE admin_sessions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    admin_id INT NOT NULL,
    session_token VARCHAR(255) NOT NULL UNIQUE,
    ip_address VARCHAR(45) DEFAULT NULL,
    user_agent TEXT DEFAULT NULL,
    expires_at TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES admin_users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- INDEXES
CREATE INDEX idx_transport_type ON transport_services(transport_type);
CREATE INDEX idx_is_active_services ON transport_services(is_active);
CREATE INDEX idx_is_active_facilities ON facilities(is_active);
CREATE INDEX idx_display_order_services ON transport_services(display_order);
CREATE INDEX idx_display_order_facilities ON facilities(display_order);
CREATE INDEX idx_session_token ON admin_sessions(session_token);
CREATE INDEX idx_expires_at ON admin_sessions(expires_at);
