/**
 * ============================================
 * SCRIPT UNTUK HALAMAN GALERI
 * ============================================
 * Menampilkan foto-foto galeri dengan popup
 * deskripsi ketika gambar diklik
 */

/**
 * Tampilkan galeri foto
 */
function tampilkanGaleri() {
    const container = document.getElementById('gallery-grid');
    if (!container) return;
    
    container.innerHTML = '';
    
    // Jika ada data fasilitas, gunakan sebagai galeri
    if (dataFasilitas && dataFasilitas.length > 0) {
        dataFasilitas.forEach((item, index) => {
            const card = buatKartuGaleri(item, index);
            container.appendChild(card);
        });
    } else {
        // Jika tidak ada data, tampilkan pesan
        container.innerHTML = '<p class="empty-gallery">Belum ada foto galeri. Admin dapat menambahkan foto melalui dashboard.</p>';
    }
    
    // Tambahkan animasi fade-in
    const cards = container.querySelectorAll('.gallery-item');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'scale(0.9)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'scale(1)';
        }, index * 100);
    });
}

/**
 * Buat kartu galeri
 * @param {Object} item - Data item galeri
 * @param {number} index - Index item
 * @returns {HTMLElement} - Elemen kartu galeri
 */
function buatKartuGaleri(item, index) {
    const card = document.createElement('div');
    card.className = 'gallery-item';
    card.onclick = () => bukaModalGaleri(item);
    
    card.innerHTML = `
        <div class="gallery-image">
            <img src="${item.image || 'cendana/placeholder.png'}" alt="${item.name}" onerror="this.src='cendana/placeholder.png'">
            <div class="gallery-overlay">
                <i class="icon icon-search-plus"></i>
                <p>Klik untuk melihat detail</p>
            </div>
        </div>
        <div class="gallery-info">
            <h4>${item.name}</h4>
        </div>
    `;
    
    return card;
}

/**
 * Buka modal galeri
 * @param {Object} item - Data item galeri
 */
function bukaModalGaleri(item) {
    const modal = document.getElementById('galleryModal');
    if (!modal) return;
    
    // Set konten modal
    document.getElementById('gallery-modal-img').src = item.image || 'cendana/placeholder.png';
    document.getElementById('gallery-modal-title').textContent = item.name || 'Foto Galeri';
    document.getElementById('gallery-modal-description').textContent = item.description || 'Tidak ada deskripsi';
    
    // Tampilkan modal dengan animasi
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.style.opacity = '1';
        const modalContent = modal.querySelector('.gallery-modal');
        if (modalContent) {
            modalContent.style.transform = 'scale(1)';
        }
    }, 10);
}

/**
 * Tutup modal galeri
 */
function tutupModalGaleri() {
    const modal = document.getElementById('galleryModal');
    if (!modal) return;
    
    modal.style.opacity = '0';
    const modalContent = modal.querySelector('.gallery-modal');
    if (modalContent) {
        modalContent.style.transform = 'scale(0.9)';
    }
    
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Tunggu sampai data fasilitas dimuat
    setTimeout(() => {
        tampilkanGaleri();
    }, 500);
    
    // Tutup modal ketika klik di luar modal atau tekan ESC
    const modal = document.getElementById('galleryModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                tutupModalGaleri();
            }
        });
        
        // Tutup dengan tombol ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.style.display === 'flex') {
                tutupModalGaleri();
            }
        });
    }
});

// Export functions untuk digunakan di global scope
window.tampilkanGaleri = tampilkanGaleri;
window.bukaModalGaleri = bukaModalGaleri;
window.tutupModalGaleri = tutupModalGaleri;

