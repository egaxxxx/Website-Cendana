/**
 * ============================================
 * SCRIPT UNTUK HALAMAN PEMESANAN
 * ============================================
 * Menangani filter transportasi, tampilan kartu,
 * dan form pemesanan yang redirect ke WhatsApp
 */

/**
 * Filter transportasi berdasarkan kategori
 * @param {string} filter - Kategori filter (semua, pesawat, kapal, bus)
 */
function filterTransportasi(filter) {
    // Update tab aktif
    const tabs = document.querySelectorAll('.filter-tab');
    tabs.forEach(tab => {
        tab.classList.remove('active');
        if (tab.dataset.filter === filter) {
            tab.classList.add('active');
        }
    });
    
    // Tampilkan kartu sesuai filter
    tampilkanKartuTransportasi(filter);
}

/**
 * Tampilkan kartu transportasi sesuai filter
 * @param {string} filter - Kategori filter
 */
function tampilkanKartuTransportasi(filter) {
    const container = document.getElementById('transport-cards-grid');
    if (!container) return;
    
    container.innerHTML = '';
    
    // Jika filter "semua", tampilkan semua transportasi
    if (filter === 'semua') {
        const semuaJenis = ['pesawat', 'kapal', 'bus'];
        semuaJenis.forEach(jenis => {
            tampilkanTransportasiJenis(jenis, container);
        });
    } else {
        // Tampilkan hanya jenis yang dipilih
        tampilkanTransportasiJenis(filter, container);
    }
    
    // Tambahkan animasi fade-in
    const cards = container.querySelectorAll('.transport-booking-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
}

/**
 * Tampilkan transportasi berdasarkan jenis
 * @param {string} jenis - Jenis transportasi
 * @param {HTMLElement} container - Container untuk menampilkan kartu
 */
function tampilkanTransportasiJenis(jenis, container) {
    if (!dataTransportasi[jenis] || dataTransportasi[jenis].length === 0) {
        return;
    }
    
    dataTransportasi[jenis].forEach(service => {
        const card = buatKartuTransportasi(service, jenis);
        container.appendChild(card);
    });
}

/**
 * Buat kartu transportasi
 * @param {Object} service - Data layanan transportasi
 * @param {string} jenis - Jenis transportasi
 * @returns {HTMLElement} - Elemen kartu
 */
function buatKartuTransportasi(service, jenis) {
    const card = document.createElement('div');
    card.className = 'transport-booking-card';
    card.dataset.jenis = jenis;
    
    // Ikon berdasarkan jenis
    const icons = {
        'pesawat': 'icon-plane',
        'kapal': 'icon-ship',
        'bus': 'icon-bus'
    };
    
    const jenisNama = {
        'pesawat': 'Pesawat',
        'kapal': 'Kapal',
        'bus': 'Bus'
    };
    
    card.innerHTML = `
        <div class="transport-booking-image">
            <img src="${service.logo || 'cendana/placeholder.png'}" alt="${service.name}" onerror="this.src='cendana/placeholder.png'">
            <div class="transport-booking-badge">${jenisNama[jenis]}</div>
        </div>
        <div class="transport-booking-content">
            <h3>${service.name}</h3>
            <p class="transport-booking-route">${service.route || 'Rute tersedia'}</p>
            <p class="transport-booking-price">${service.price || 'Hubungi untuk harga'}</p>
            <button class="btn-pesan-sekarang" onclick="bukaFormPemesanan('${jenis}', '${service.name.replace(/'/g, "\\'")}', '${(service.route || '').replace(/'/g, "\\'")}', '${(service.price || '').replace(/'/g, "\\'")}')">
                Pesan Sekarang
            </button>
        </div>
    `;
    
    return card;
}

/**
 * Buka form pemesanan
 * @param {string} jenis - Jenis transportasi
 * @param {string} namaLayanan - Nama layanan
 * @param {string} rute - Rute layanan
 * @param {string} harga - Harga layanan
 */
function bukaFormPemesanan(jenis, namaLayanan, rute, harga) {
    const modal = document.getElementById('bookingModal');
    if (!modal) return;
    
    // Set nilai form
    document.getElementById('booking-transport-type').value = jenis;
    document.getElementById('booking-service-name').value = namaLayanan;
    
    const jenisNama = {
        'pesawat': 'Pesawat',
        'kapal': 'Kapal',
        'bus': 'Bus'
    };
    
    document.getElementById('booking-transport-type-display').value = jenisNama[jenis] + ' - ' + namaLayanan;
    
    // Reset form
    document.getElementById('customer-name').value = '';
    document.getElementById('origin').value = '';
    document.getElementById('destination').value = '';
    document.getElementById('passengers').value = '1';
    document.getElementById('travel-date').value = '';
    
    // Tampilkan modal dengan animasi
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.style.opacity = '1';
        const modalContent = modal.querySelector('.booking-modal');
        if (modalContent) {
            modalContent.style.transform = 'scale(1)';
        }
    }, 10);
    
    // Focus ke input nama
    setTimeout(() => {
        document.getElementById('customer-name').focus();
    }, 200);
}

/**
 * Tutup modal pemesanan
 */
function tutupModalPemesanan() {
    const modal = document.getElementById('bookingModal');
    if (!modal) return;
    
    modal.style.opacity = '0';
    const modalContent = modal.querySelector('.booking-modal');
    if (modalContent) {
        modalContent.style.transform = 'scale(0.9)';
    }
    
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

/**
 * Kirim pemesanan ke WhatsApp
 * @param {Event} event - Event form submit
 */
function kirimPemesanan(event) {
    event.preventDefault();
    
    // Ambil nilai form
    const customerName = document.getElementById('customer-name').value;
    const transportType = document.getElementById('booking-transport-type').value;
    const serviceName = document.getElementById('booking-service-name').value;
    const origin = document.getElementById('origin').value;
    const destination = document.getElementById('destination').value;
    const passengers = document.getElementById('passengers').value || '1';
    const travelDate = document.getElementById('travel-date').value;
    
    // Validasi
    if (!customerName || !origin || !destination) {
        alert('Mohon lengkapi semua field yang wajib diisi!');
        return;
    }
    
    // Format tanggal
    const formatDate = (dateString) => {
        if (!dateString) return 'Belum ditentukan';
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
    };
    
    const jenisNama = {
        'pesawat': 'Pesawat',
        'kapal': 'Kapal',
        'bus': 'Bus'
    };
    
    // Buat pesan WhatsApp
    const whatsappNumber = companyInfoData?.whatsapp || '6285821841529';
    const message = `Halo, saya ingin memesan tiket dengan detail berikut:

👤 Nama: ${customerName}
🚌 Jenis Transportasi: ${jenisNama[transportType]}
🏢 Layanan: ${serviceName}
📍 Asal: ${origin}
📍 Tujuan: ${destination}
👥 Jumlah Penumpang: ${passengers} orang
📅 Tanggal Berangkat: ${formatDate(travelDate)}

Mohon konfirmasi ketersediaan dan harga. Terima kasih!`;
    
    // Encode message untuk URL
    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;
    
    // Buka WhatsApp
    window.open(whatsappUrl, '_blank');
    
    // Tutup modal
    tutupModalPemesanan();
}

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Tampilkan semua transportasi secara default
    tampilkanKartuTransportasi('semua');
    
    // Set minimum date untuk input date
    const today = new Date().toISOString().split('T')[0];
    const travelDateInput = document.getElementById('travel-date');
    if (travelDateInput) {
        travelDateInput.setAttribute('min', today);
    }
    
    // Tutup modal ketika klik di luar modal
    const modal = document.getElementById('bookingModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                tutupModalPemesanan();
            }
        });
    }
});

// Export functions untuk digunakan di global scope
window.filterTransportasi = filterTransportasi;
window.bukaFormPemesanan = bukaFormPemesanan;
window.tutupModalPemesanan = tutupModalPemesanan;
window.kirimPemesanan = kirimPemesanan;

