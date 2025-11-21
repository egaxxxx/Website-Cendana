<?php
require_once 'config/database.php';

function getCompanyInfo($conn) {
    $company = [];
    $stmt = $conn->prepare("SELECT * FROM company_info WHERE id = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $company = $result->fetch_assoc();
    }
    $stmt->close();
    return $company;
}

$companyInfoData = getCompanyInfo($conn);

if (empty($companyInfoData)) {
    $companyInfoData = [
        'name' => 'CV. Cendana Travel',
        'whatsapp' => '6285821841529',
        'instagram' => '@cendanatravel_official',
        'email' => 'info@cendanatravel.com',
        'address' => 'Jl. Cendana No.8, Tlk. Lerong Ulu, Kec. Sungai Kunjang<br>Kota Samarinda, Kalimantan Timur 75127',
        'hours' => 'Senin - Minggu: 08.00 - 22.00 WIB',
        'description' => 'Kami adalah penyedia layanan travel terpercaya dengan pengalaman lebih dari 10 tahun dalam melayani perjalanan Anda.'
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - <?php echo htmlspecialchars($companyInfoData['name']); ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="icons.css">
</head>
<body>
    <!-- Header Navigation -->
    <header>
        <div class="container header-container">
            <a href="index.php" class="logo"><?php echo htmlspecialchars($companyInfoData['name']); ?></a>
            
            <nav>
                <ul class="nav-menu">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="pemesanan.php">Pemesanan</a></li>
                    <li><a href="galeri.php">Galeri</a></li>
                    <li><a href="kontak.php" class="active">Kontak</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                </ul>
            </nav>
            
            <div class="header-controls">
                <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" class="wa-header-btn" target="_blank" title="Hubungi via WhatsApp">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="wa-icon">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.488"/>
                    </svg>
                    <span>WhatsApp</span>
                </a>
                <div class="mobile-menu" title="Menu">
                    <i class="icon icon-menu"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home" style="min-height: 500px; margin-top: 70px;">
        <div class="hero-overlay">
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title" style="font-size: 3rem;">
                        Hubungi Kami
                    </h1>
                    <p class="hero-description">
                        Kami siap membantu Anda dengan segala kebutuhan perjalanan. Hubungi kami melalui berbagai saluran komunikasi yang tersedia.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Information -->
                <article class="contact-info">
                    <div class="contact-item">
                        <div class="contact-item-icon">
                            <i class="icon icon-whatsapp"></i>
                        </div>
                        <div class="contact-item-content">
                            <h3>WhatsApp</h3>
                            <p>
                                <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>
                                </a>
                            </p>
                            <p class="text-small">Respon cepat & layanan 24/7</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-item-icon">
                            <i class="icon icon-email"></i>
                        </div>
                        <div class="contact-item-content">
                            <h3>Email</h3>
                            <p>
                                <a href="mailto:<?php echo htmlspecialchars($companyInfoData['email']); ?>">
                                    <?php echo htmlspecialchars($companyInfoData['email']); ?>
                                </a>
                            </p>
                            <p class="text-small">Hubungi kami melalui email</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-item-icon">
                            <i class="icon icon-location"></i>
                        </div>
                        <div class="contact-item-content">
                            <h3>Alamat</h3>
                            <p><?php echo $companyInfoData['address']; ?></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-item-icon">
                            <i class="icon icon-clock"></i>
                        </div>
                        <div class="contact-item-content">
                            <h3>Jam Operasional</h3>
                            <p><?php echo htmlspecialchars($companyInfoData['hours']); ?></p>
                        </div>
                    </div>
                </article>

                <!-- Contact Form -->
                <article class="contact-form">
                    <h2>Kirim Pesan</h2>
                    <form id="contactForm" onsubmit="handleContactForm(event)">
                        <div class="form-group">
                            <label for="name">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" id="name" name="name" required placeholder="Masukkan nama Anda">
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" id="email" name="email" required placeholder="Email Anda">
                        </div>

                        <div class="form-group">
                            <label for="subject">Subjek <span class="required">*</span></label>
                            <input type="text" id="subject" name="subject" required placeholder="Subjek pesan">
                        </div>

                        <div class="form-group">
                            <label for="message">Pesan <span class="required">*</span></label>
                            <textarea id="message" name="message" rows="5" required placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>

                        <button type="submit" class="btn-submit-form">
                            <i class="icon icon-send"></i> Kirim Pesan
                        </button>
                    </form>
                </article>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section style="background: var(--color-light-gray); padding: var(--spacing-3xl) 0;">
        <div class="container">
            <div class="section-header">
                <h2>Lokasi Kantor Kami</h2>
                <p>Kunjungi kantor kami untuk konsultasi langsung</p>
            </div>

            <div style="border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-lg);">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.8158906435345!2d117.1451!3d-0.5144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df68d1e0a0a0a0b%3A0x0!2sCendana%20Travel!5e0!3m2!1sid!2sid!4v1234567890" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="contact-faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Pertanyaan Umum</h2>
                <p>Jawaban untuk pertanyaan yang sering ditanyakan</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: var(--spacing-lg);">
                <div class="faq-item">
                    <button class="faq-item-header" onclick="toggleFaq(this)">
                        <span>Berapa jam layanan customer service?</span>
                        <i class="icon icon-chevron-down faq-item-icon"></i>
                    </button>
                    <div class="faq-item-content">
                        <p>Layanan customer service kami tersedia 24 jam, 7 hari seminggu. Anda dapat menghubungi kami kapan saja melalui WhatsApp atau email.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-item-header" onclick="toggleFaq(this)">
                        <span>Apakah ada biaya tambahan untuk konsultasi?</span>
                        <i class="icon icon-chevron-down faq-item-icon"></i>
                    </button>
                    <div class="faq-item-content">
                        <p>Konsultasi awal sepenuhnya gratis. Kami siap membantu menjawab semua pertanyaan Anda tanpa biaya tambahan apapun.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-item-header" onclick="toggleFaq(this)">
                        <span>Bagaimana cara memulai pemesanan?</span>
                        <i class="icon icon-chevron-down faq-item-icon"></i>
                    </button>
                    <div class="faq-item-content">
                        <p>Kunjungi halaman Pemesanan dan pilih jenis transportasi. Setelah itu klik "Pesan Sekarang" dan isi formulir. Kami akan segera merespons pesanan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section style="background: var(--color-primary); color: white; padding: var(--spacing-3xl) 0;">
        <div class="container" style="text-align: center;">
            <h2 style="color: white; margin-bottom: var(--spacing-lg);">Siap Memulai Perjalanan Anda?</h2>
            <p style="color: rgba(255, 255, 255, 0.9); margin-bottom: var(--spacing-2xl); font-size: 1.1rem;">
                Hubungi kami sekarang dan dapatkan penawaran terbaik untuk perjalanan Anda
            </p>
            <div style="display: flex; gap: var(--spacing-lg); justify-content: center; flex-wrap: wrap;">
                <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" class="btn-hero btn-hero-primary" target="_blank">
                    <i class="icon icon-whatsapp"></i> Chat via WhatsApp
                </a>
                <a href="pemesanan.php" class="btn-hero" style="background: rgba(255, 255, 255, 0.2); border: 2px solid white; color: white;">
                    Lihat Paket Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-premium">
        <div class="container">
            <!-- Main Grid: 4 Kolom -->
            <div class="footer-grid-premium">
                
                <!-- KOLOM 1: Tentang Kami -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Tentang Kami</h3>
                    <div class="footer-separator-premium"></div>
                    <p class="footer-text-premium">
                        <?php echo htmlspecialchars($companyInfoData['description']); ?>
                    </p>
                    <div class="footer-hours-box">
                        <p class="footer-label-premium">Jam Operasional:</p>
                        <p class="footer-text-premium">
                            <?php echo htmlspecialchars($companyInfoData['hours']); ?>
                        </p>
                    </div>
                </section>

                <!-- KOLOM 2: Menu Cepat -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Menu Cepat</h3>
                    <div class="footer-separator-premium"></div>
                    <ul class="footer-links-premium">
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="pemesanan.php">Pemesanan</a></li>
                        <li><a href="galeri.php">Galeri</a></li>
                        <li><a href="kontak.php">Kontak</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                    </ul>
                </section>

                <!-- KOLOM 3: Layanan Kami -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Layanan Kami</h3>
                    <div class="footer-separator-premium"></div>
                    <ul class="footer-links-premium">
                        <li><a href="#">Paket Liburan</a></li>
                        <li><a href="#">Tiket Pesawat</a></li>
                        <li><a href="#">Hotel & Akomodasi</a></li>
                        <li><a href="#">Tour Guide</a></li>
                    </ul>
                </section>

                <!-- KOLOM 4: Hubungi Kami -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Hubungi Kami</h3>
                    <div class="footer-separator-premium"></div>
                    <div class="footer-contact-item">
                        <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" class="footer-link-contact">📱 WhatsApp</a>
                    </div>
                    <div class="footer-contact-item">
                        <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" class="footer-link-contact"><?php echo htmlspecialchars($companyInfoData['whatsapp']); ?></a>
                    </div>
                    <div class="footer-contact-item">
                        <a href="mailto:<?php echo htmlspecialchars($companyInfoData['email']); ?>" class="footer-link-contact">📧 Email</a>
                    </div>
                    <div class="footer-contact-item">
                        <p class="footer-label-premium">Alamat:</p>
                        <p class="footer-text-premium"><?php echo htmlspecialchars($companyInfoData['address']); ?></p>
                    </div>
                </section>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom-premium">
                <p class="footer-copyright-premium">
                    &copy; 2024 <?php echo htmlspecialchars($companyInfoData['name']); ?>. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <div class="wa-float">
        <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" target="_blank">
            <i class="icon icon-whatsapp"></i>
        </a>
    </div>

    <script>
        function handleContactForm(e) {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            const fullMessage = `*FORM KONTAK - CV. CENDANA TRAVEL*

Nama: ${name}
Email: ${email}
Subjek: ${subject}

Pesan:
${message}

---
Dikirim dari website
`;

            const waNumber = '<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>';
            const waURL = `https://wa.me/${waNumber}?text=${encodeURIComponent(fullMessage)}`;
            
            window.open(waURL, '_blank');
            document.getElementById('contactForm').reset();
        }

        function toggleFaq(button) {
            const item = button.parentElement;
            const allItems = document.querySelectorAll('.faq-item');
            
            allItems.forEach(el => {
                if (el !== item && el.classList.contains('active')) {
                    el.classList.remove('active');
                }
            });
            
            item.classList.toggle('active');
        }
    </script>
    <script src="config.js"></script>
    <script src="script.js"></script>
</body>
</html>

<?php
if (isset($conn)) {
    $conn->close();
}
?>
