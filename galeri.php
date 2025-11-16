<?php
/**
 * ============================================
 * HALAMAN GALERI - CV. CENDANA TRAVEL
 * ============================================
 */

// Data default tanpa database untuk menghindari error
$companyInfoData = [
    'name' => 'CV. Cendana Travel',
    'whatsapp' => '6285821841529',
    'instagram' => '@cendanatravel_official',
    'email' => 'info@cendanatravel.com',
    'address' => 'Jl. Cendana No.8, Tlk. Lerong Ulu, Kec. Sungai Kunjang<br>Kota Samarinda, Kalimantan Timur 75127',
    'hours' => 'Senin - Minggu: 08.00 - 22.00 WIB',
    'description' => 'Kami adalah penyedia layanan travel terpercaya dengan pengalaman lebih dari 10 tahun dalam melayani perjalanan Anda.'
];

// Data galeri akan dimuat dari config.js
$dataFasilitas = [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - <?php echo htmlspecialchars($companyInfoData['name']); ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="icons.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <a href="index.php" class="logo"><?php echo htmlspecialchars($companyInfoData['name']); ?></a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="pemesanan.php">Pemesanan</a></li>
                    <li><a href="galeri.php" class="active">Galeri</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                </ul>
            </nav>
            <div class="header-controls">
                <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" class="wa-header-btn" target="_blank" title="Hubungi via WhatsApp">
                    <i class="icon icon-whatsapp"></i>
                    <span>WhatsApp</span>
                </a>
                <button class="dark-mode-toggle" onclick="ubahModeGelap()" title="Ubah Mode Gelap/Terang">
                    <i class="icon icon-moon"></i>
                </button>
                <div class="mobile-menu" title="Menu">
                    <i class="icon icon-menu"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Galeri Perjalanan</h1>
            <p>Koleksi momen indah dari perjalanan pelanggan kami ke berbagai destinasi menakjubkan</p>
        </div>
    </section>

    <!-- Galeri Grid -->
    <section class="gallery-section">
        <div class="container">
            <div class="gallery-grid" id="gallery-grid">
                <!-- Foto galeri akan dimuat di sini menggunakan JavaScript -->
            </div>
        </div>
    </section>

    <!-- Modal Popup Gambar -->
    <div class="gallery-modal-overlay" id="galleryModal">
        <div class="gallery-modal">
            <button class="gallery-modal-close" onclick="tutupModalGaleri()">
                <i class="icon icon-times"></i>
            </button>
            <div class="gallery-modal-image">
                <img id="gallery-modal-img" src="" alt="Galeri">
            </div>
            <div class="gallery-modal-info">
                <h3 id="gallery-modal-title"></h3>
                <p id="gallery-modal-description"></p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?php echo htmlspecialchars($companyInfoData['name']); ?></h3>
                    <p><?php echo htmlspecialchars($companyInfoData['description']); ?></p>
                </div>
                <div class="footer-section">
                    <h3>Menu</h3>
                    <ul>
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="pemesanan.php">Pemesanan</a></li>
                        <li><a href="galeri.php">Galeri</a></li>
                        <li><a href="kontak.php">Kontak</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Hubungi Kami</h3>
                    <p><i class="icon icon-whatsapp"></i> <?php echo htmlspecialchars($companyInfoData['whatsapp']); ?></p>
                    <p><i class="icon icon-email"></i> <?php echo htmlspecialchars($companyInfoData['email']); ?></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 <?php echo htmlspecialchars($companyInfoData['name']); ?>. All rights reserved.</p>
                <!-- Ikon kunci admin (tersembunyi) -->
                <div class="admin-access" onclick="showAdminLogin()" title="Akses Admin">
                    <i class="icon icon-sign-in"></i>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <div class="wa-float">
        <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" target="_blank">
            <i class="icon icon-whatsapp"></i>
        </a>
    </div>

    <!-- Admin Login Modal -->
    <div class="admin-login-overlay" id="adminLoginOverlay" style="display: none;">
        <div class="admin-login-modal">
            <div class="admin-login-header">
                <h3>🔐 Admin Access</h3>
                <button class="close-modal" onclick="closeAdminLogin()">
                    <i class="icon icon-times"></i>
                </button>
            </div>
            <div class="admin-login-body">
                <p>Masukkan password untuk mengakses dashboard admin</p>
                <div class="password-input-group">
                    <input type="password" id="adminPassword" placeholder="Password" maxlength="50">
                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="icon icon-eye" id="passwordToggleIcon"></i>
                    </button>
                </div>
                <div class="admin-login-actions">
                    <button class="btn-admin-login" onclick="attemptAdminLogin()">
                        <i class="icon icon-sign-in"></i> Login
                    </button>
                    <button class="btn-admin-cancel" onclick="closeAdminLogin()">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Config First -->
    <script src="config.js"></script>
    <script src="script.js"></script>
    
    <!-- Inline Galeri Script for Immediate Execution -->
    <script>
        console.log('=== INLINE GALERI SCRIPT START ===');
        
        // Check if config data exists
        if (typeof DATA_FASILITAS_DEFAULT === 'undefined') {
            console.error('ERROR: DATA_FASILITAS_DEFAULT not found!');
        } else {
            console.log('✓ DATA_FASILITAS_DEFAULT found:', DATA_FASILITAS_DEFAULT.length, 'items');
            
            // Wait for DOM to be ready
            function initGallery() {
                console.log('Initializing gallery...');
                const galleryGrid = document.getElementById('gallery-grid');
                
                if (!galleryGrid) {
                    console.error('ERROR: gallery-grid element not found!');
                    return;
                }
                
                console.log('✓ gallery-grid element found');
                
                if (DATA_FASILITAS_DEFAULT.length === 0) {
                    galleryGrid.innerHTML = '<div class="gallery-empty"><i class="icon icon-image"></i><p>Belum ada foto di galeri</p></div>';
                    return;
                }
                
                galleryGrid.innerHTML = '';
                
                DATA_FASILITAS_DEFAULT.forEach((item, index) => {
                    const imgPath = 'uploads/' + item.image;
                    console.log('Adding item ' + (index + 1) + ':', item.name, '|', imgPath);
                    
                    const galleryItem = document.createElement('div');
                    galleryItem.className = 'gallery-item';
                    
                    galleryItem.innerHTML = `
                        <div class="gallery-image">
                            <img src="${imgPath}" alt="${item.name}" onload="console.log('✓ Image loaded: ${item.name}')" onerror="console.error('✗ Image failed: ${imgPath}')">
                            <div class="gallery-overlay">
                                <div class="gallery-overlay-content">
                                    <h3>${item.name}</h3>
                                    <button class="gallery-view-btn" onclick="openGalleryModal(${item.id})">
                                        <i class="icon icon-eye"></i>
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    galleryGrid.appendChild(galleryItem);
                });
                
                console.log('✓ Gallery items added:', DATA_FASILITAS_DEFAULT.length);
            }
            
            // Gallery modal functions
            window.openGalleryModal = function(itemId) {
                const modal = document.getElementById('galleryModal');
                const item = DATA_FASILITAS_DEFAULT.find(f => f.id === itemId);
                
                if (!modal || !item) return;
                
                document.getElementById('gallery-modal-img').src = 'uploads/' + item.image;
                document.getElementById('gallery-modal-title').textContent = item.name;
                document.getElementById('gallery-modal-description').textContent = item.description;
                
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            };
            
            window.tutupModalGaleri = function() {
                const modal = document.getElementById('galleryModal');
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            };
            
            // Initialize when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initGallery);
            } else {
                initGallery();
            }
        }
        
        console.log('=== INLINE GALERI SCRIPT END ===');
    </script>
</body>
</html>

