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

    <!-- Hero Section with Gradient Background -->
    <section class="gallery-hero">
        <div class="container">
            <div class="gallery-hero-content">
                <h1 class="gallery-hero-title">Galeri Perjalanan</h1>
                <p class="gallery-hero-subtitle">Koleksi momen indah dari perjalanan pelanggan kami ke berbagai destinasi menakjubkan. Lihat pengalaman nyata dan fasilitas yang kami tawarkan.</p>
            </div>
        </div>
        
        <!-- Decorative Background Elements -->
        <div class="hero-decoration">
            <div class="decoration-circle circle-1"></div>
            <div class="decoration-circle circle-2"></div>
            <div class="decoration-circle circle-3"></div>
        </div>
    </section>

    <!-- Galeri Grid -->
    <section class="gallery-section">
        <div class="container">
            <!-- Filter Tabs -->
            <div class="gallery-filter-tabs">
                <button class="filter-tab active" data-category="all" onclick="filterGallery('all')">
                    <i class="icon icon-th"></i>
                    Semua Foto
                </button>
                <button class="filter-tab" data-category="kantor" onclick="filterGallery('kantor')">
                    <i class="icon icon-building"></i>
                    Kantor & Fasilitas
                </button>
                <button class="filter-tab" data-category="layanan" onclick="filterGallery('layanan')">
                    <i class="icon icon-star"></i>
                    Layanan
                </button>
                <button class="filter-tab" data-category="sistem" onclick="filterGallery('sistem')">
                    <i class="icon icon-cog"></i>
                    Sistem & Teknologi
                </button>
            </div>

            <!-- Gallery Stats -->
            <div class="gallery-stats">
                <div class="stat-item">
                    <span class="stat-number" id="gallery-count">7</span>
                    <span class="stat-label">Total Foto</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1000+</span>
                    <span class="stat-label">Perjalanan Sukses</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">⭐ 4.8</span>
                    <span class="stat-label">Rating Pelanggan</span>
                </div>
            </div>

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
            
            <!-- Navigation Arrows -->
            <button class="gallery-modal-nav gallery-modal-prev" onclick="navigateGallery(-1)">
                <i class="icon icon-chevron-left"></i>
            </button>
            <button class="gallery-modal-nav gallery-modal-next" onclick="navigateGallery(1)">
                <i class="icon icon-chevron-right"></i>
            </button>
            
            <div class="gallery-modal-image">
                <img id="gallery-modal-img" src="" alt="Galeri">
            </div>
            <div class="gallery-modal-info">
                <div class="gallery-modal-header">
                    <div class="modal-title-group">
                        <h3 id="gallery-modal-title"></h3>
                        <span class="gallery-modal-counter" id="gallery-modal-counter">1 / 7</span>
                    </div>
                </div>
                
                <!-- Metadata Info -->
                <div class="gallery-modal-metadata">
                    <div class="metadata-item">
                        <i class="icon icon-calendar"></i>
                        <div class="metadata-content">
                            <span class="metadata-label">Tanggal Upload</span>
                            <span class="metadata-value" id="gallery-modal-date">28 Oktober 2024</span>
                        </div>
                    </div>
                    <div class="metadata-item">
                        <i class="icon icon-map-marker"></i>
                        <div class="metadata-content">
                            <span class="metadata-label">Lokasi</span>
                            <span class="metadata-value" id="gallery-modal-location">Kantor Pusat</span>
                        </div>
                    </div>
                    <div class="metadata-item">
                        <i class="icon icon-tag"></i>
                        <div class="metadata-content">
                            <span class="metadata-label">Kategori</span>
                            <span class="metadata-value" id="gallery-modal-category">Fasilitas</span>
                        </div>
                    </div>
                </div>
                
                <p class="gallery-modal-description" id="gallery-modal-description"></p>
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
                    galleryItem.setAttribute('data-category', item.category || 'all');
                    galleryItem.setAttribute('data-index', index);
                    galleryItem.style.animationDelay = (index * 0.1) + 's';
                    
                    galleryItem.innerHTML = `
                        <div class="gallery-image">
                            <img src="${imgPath}" alt="${item.name}" onload="console.log('✓ Image loaded: ${item.name}')" onerror="console.error('✗ Image failed: ${imgPath}')">
                            <div class="gallery-overlay">
                                <div class="gallery-overlay-content">
                                    <h3>${item.name}</h3>
                                    <button class="gallery-view-btn" onclick="openGalleryModal(${index})">
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
                updateGalleryCount();
            }
            
            // Current modal index
            let currentModalIndex = 0;
            
            // Format tanggal Indonesia
            function formatTanggalIndonesia(dateString) {
                const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                const date = new Date(dateString);
                return date.getDate() + ' ' + bulan[date.getMonth()] + ' ' + date.getFullYear();
            }
            
            // Get category name
            function getCategoryName(category) {
                const categories = {
                    'kantor': 'Kantor & Fasilitas',
                    'layanan': 'Layanan',
                    'sistem': 'Sistem & Teknologi'
                };
                return categories[category] || 'Umum';
            }
            
            // Gallery modal functions
            window.openGalleryModal = function(index) {
                currentModalIndex = index;
                const modal = document.getElementById('galleryModal');
                const item = DATA_FASILITAS_DEFAULT[index];
                
                if (!modal || !item) return;
                
                document.getElementById('gallery-modal-img').src = 'uploads/' + item.image;
                document.getElementById('gallery-modal-title').textContent = item.name;
                document.getElementById('gallery-modal-description').textContent = item.description;
                document.getElementById('gallery-modal-counter').textContent = (index + 1) + ' / ' + DATA_FASILITAS_DEFAULT.length;
                
                // Set metadata
                document.getElementById('gallery-modal-date').textContent = formatTanggalIndonesia(item.uploadDate || new Date().toISOString().split('T')[0]);
                document.getElementById('gallery-modal-location').textContent = item.location || 'Tidak disebutkan';
                document.getElementById('gallery-modal-category').textContent = getCategoryName(item.category);
                
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            };
            
            window.navigateGallery = function(direction) {
                currentModalIndex += direction;
                
                if (currentModalIndex < 0) currentModalIndex = DATA_FASILITAS_DEFAULT.length - 1;
                if (currentModalIndex >= DATA_FASILITAS_DEFAULT.length) currentModalIndex = 0;
                
                openGalleryModal(currentModalIndex);
            };
            
            window.tutupModalGaleri = function() {
                const modal = document.getElementById('galleryModal');
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            };
            
            // Filter gallery function
            window.filterGallery = function(category) {
                const items = document.querySelectorAll('.gallery-item');
                const tabs = document.querySelectorAll('.filter-tab');
                
                // Update active tab
                tabs.forEach(tab => {
                    if (tab.getAttribute('data-category') === category) {
                        tab.classList.add('active');
                    } else {
                        tab.classList.remove('active');
                    }
                });
                
                // Filter items
                items.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    if (category === 'all' || itemCategory === category) {
                        item.style.display = 'block';
                        item.classList.add('fade-in');
                    } else {
                        item.style.display = 'none';
                        item.classList.remove('fade-in');
                    }
                });
                
                updateGalleryCount();
            };
            
            // Update gallery count
            function updateGalleryCount() {
                const visibleItems = document.querySelectorAll('.gallery-item[style*="display: block"], .gallery-item:not([style*="display: none"])');
                const countElement = document.getElementById('gallery-count');
                if (countElement) {
                    countElement.textContent = visibleItems.length;
                }
            }
            
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

