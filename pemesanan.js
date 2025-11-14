/**
 * ============================================
 * PEMESANAN.JS - JAVASCRIPT UNTUK HALAMAN PEMESANAN
 * ============================================
 * File khusus untuk menangani logika halaman pemesanan
 * termasuk tampilan cards, modal, dan integrasi WhatsApp
 */

/**
 * ============================================
 * FUNGSI: RENDER TRANSPORT CARDS
 * ============================================
 * Fungsi untuk menampilkan cards transportasi sesuai desain visual
 */
function renderTransportCards(filterType = 'semua') {
    const container = document.getElementById('transport-cards-grid');
    if (!container) {
        console.error('❌ Container transport-cards-grid tidak ditemukan');
        return;
    }

    // Kosongkan container
    container.innerHTML = '';

    // Ambil data transportasi
    const transportData = window.dataTransportasi || DATA_TRANSPORTASI_DEFAULT;

    // Kumpulkan semua layanan berdasarkan filter
    let allServices = [];
    
    if (filterType === 'semua') {
        // Gabungkan semua layanan
        Object.keys(transportData).forEach(type => {
            allServices = allServices.concat(transportData[type] || []);
        });
    } else {
        // Ambil layanan berdasarkan jenis tertentu
        allServices = transportData[filterType] || [];
    }

    // Jika tidak ada layanan, tampilkan pesan
    if (allServices.length === 0) {
        container.innerHTML = `
            <div class="no-services-message">
                <div class="no-services-icon">
                    <i class="icon icon-info"></i>
                </div>
                <h3>Belum Ada Layanan</h3>
                <p>Saat ini belum ada layanan ${filterType === 'semua' ? '' : filterType} yang tersedia.</p>
            </div>
        `;
        return;
    }

    // Render setiap layanan sebagai card
    allServices.forEach(service => {
        const card = createServiceCard(service);
        container.appendChild(card);
    });

    console.log(`✅ Berhasil render ${allServices.length} cards transportasi`);
}

/**
 * ============================================
 * FUNGSI: CREATE SERVICE CARD
 * ============================================
 * Membuat elemen card untuk satu layanan transportasi
 */
function createServiceCard(service) {
    // Buat container card
    const card = document.createElement('div');
    card.className = 'transport-card';
    card.setAttribute('data-service-id', service.id);
    card.setAttribute('data-transport-type', service.transportType);

    // Path logo perusahaan
    const logoPath = service.logo ? `uploads/${service.logo}` : getDefaultLogo(service.transportType);

    // HTML content untuk card sesuai desain visual
    card.innerHTML = `
        <div class="transport-card-content">
            <img src="${logoPath}" 
                 alt="${service.name}" 
                 class="company-logo"
                 onerror="this.src='${getDefaultLogo(service.transportType)}'">
            
            <h3>${service.name}</h3>
            
            <div class="description">
                ${service.route || 'Layanan transportasi terpercaya'}
            </div>
            
            <div class="price-range">
                ${service.price || 'Hubungi untuk harga'}
            </div>
            
            <button class="btn-book-now" onclick="bukaPemesanan('${service.name}', '${service.transportType}')">
                <i class="icon icon-whatsapp"></i>
                Pesan Sekarang
            </button>
        </div>
    `;

    return card;
}

/**
 * ============================================
 * FUNGSI: GET DEFAULT LOGO
 * ============================================
 * Mengembalikan path logo default berdasarkan jenis transportasi
 */
function getDefaultLogo(transportType) {
    const defaultLogos = {
        'pesawat': 'uploads/pesawat/default-plane.png',
        'kapal': 'uploads/kapal/default-ship.png',
        'bus': 'uploads/bus/default-bus.png'
    };
    
    return defaultLogos[transportType] || 'uploads/default-transport.png';
}

/**
 * ============================================
 * FUNGSI: FILTER TRANSPORTASI
 * ============================================
 * Filter layanan berdasarkan jenis transportasi
 */
function filterTransportasi(jenisTransportasi) {
    // Update tab aktif
    const tabs = document.querySelectorAll('.filter-tab');
    tabs.forEach(tab => {
        tab.classList.remove('active');
        if (tab.dataset.filter === jenisTransportasi) {
            tab.classList.add('active');
        }
    });

    // Render cards dengan filter
    renderTransportCards(jenisTransportasi);
    
    console.log(`🔍 Filter transportasi: ${jenisTransportasi}`);
}

/**
 * ============================================
 * FUNGSI: BUKA MODAL PEMESANAN
 * ============================================
 * Membuka modal pemesanan dengan data layanan yang dipilih
 */
function bukaPemesanan(namaLayanan, jenisTransportasi) {
    const modal = document.getElementById('bookingModal');
    if (!modal) {
        console.error('❌ Modal pemesanan tidak ditemukan');
        return;
    }

    // Set nilai field jenis layanan (readonly)
    const serviceNameField = document.getElementById('booking-service-name');
    const transportTypeField = document.getElementById('booking-transport-type');
    const transportTypeDisplayField = document.getElementById('booking-transport-type-display');
    
    if (serviceNameField) serviceNameField.value = namaLayanan;
    if (transportTypeField) transportTypeField.value = jenisTransportasi;
    if (transportTypeDisplayField) transportTypeDisplayField.value = namaLayanan;

    // Reset form
    resetBookingForm();

    // Tampilkan modal
    modal.style.display = 'flex';
    
    // Animate modal appearance
    requestAnimationFrame(() => {
        modal.style.opacity = '1';
        const modalContent = modal.querySelector('.booking-modal');
        if (modalContent) {
            modalContent.style.transform = 'scale(1)';
        }
    });

    console.log(`📋 Modal pemesanan dibuka untuk: ${namaLayanan}`);
}

/**
 * ============================================
 * FUNGSI: TUTUP MODAL PEMESANAN
 * ============================================
 * Menutup modal pemesanan dengan animasi
 */
function tutupModalPemesanan() {
    const modal = document.getElementById('bookingModal');
    if (!modal) return;

    // Animate modal disappearance
    modal.style.opacity = '0';
    const modalContent = modal.querySelector('.booking-modal');
    if (modalContent) {
        modalContent.style.transform = 'scale(0.9)';
    }

    // Hide modal after animation
    setTimeout(() => {
        modal.style.display = 'none';
        resetBookingForm();
    }, 300);

    console.log('✖️ Modal pemesanan ditutup');
}

/**
 * ============================================
 * FUNGSI: RESET BOOKING FORM
 * ============================================
 * Reset semua field di form pemesanan
 */
function resetBookingForm() {
    const form = document.getElementById('bookingForm');
    if (!form) return;

    // Reset field yang tidak readonly
    const fields = ['customer-name', 'origin', 'destination', 'passengers', 'travel-date'];
    fields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field && !field.readOnly) {
            field.value = fieldId === 'passengers' ? '1' : '';
        }
    });
}

/**
 * ============================================
 * FUNGSI: KIRIM PEMESANAN VIA WHATSAPP
 * ============================================
 * Mengumpulkan data form dan kirim via WhatsApp
 */
function kirimPemesanan(event) {
    event.preventDefault();

    // Ambil data dari form
    const formData = {
        jenisLayanan: document.getElementById('booking-transport-type-display')?.value || '',
        nama: document.getElementById('customer-name')?.value || '',
        lokasiSekarang: document.getElementById('origin')?.value || '',
        lokasiTujuan: document.getElementById('destination')?.value || '',
        jumlahOrang: document.getElementById('passengers')?.value || '1',
        tanggalBerangkat: document.getElementById('travel-date')?.value || '',
        pesanTambahan: document.getElementById('additional-message')?.value || 'Tidak ada'
    };

    // Validasi data wajib
    if (!formData.nama || !formData.lokasiSekarang || !formData.lokasiTujuan) {
        alert('Mohon lengkapi semua field yang wajib diisi (ditandai dengan *)');
        return;
    }

    // Buat template pesan WhatsApp
    const pesanWhatsApp = generateWhatsAppMessage(formData);

    // Ambil nomor WhatsApp perusahaan
    const nomorWhatsApp = (window.KONFIGURASI_PERUSAHAAN?.whatsapp || '6285821841529').replace(/\D/g, '');

    // URL WhatsApp
    const whatsappURL = `https://wa.me/${nomorWhatsApp}?text=${encodeURIComponent(pesanWhatsApp)}`;

    // Buka WhatsApp
    window.open(whatsappURL, '_blank');

    // Tutup modal
    tutupModalPemesanan();

    console.log('📱 Pemesanan dikirim via WhatsApp');
}

/**
 * ============================================
 * FUNGSI: GENERATE WHATSAPP MESSAGE
 * ============================================
 * Membuat template pesan WhatsApp sesuai format yang diminta
 */
function generateWhatsAppMessage(data) {
    let pesan = `Halo Admin, saya ingin melakukan pemesanan layanan:

• Jenis Layanan: ${data.jenisLayanan}
• Nama Pemesan: ${data.nama}
• Lokasi Saat Ini: ${data.lokasiSekarang}
• Lokasi Tujuan: ${data.lokasiTujuan}
• Jumlah Orang: ${data.jumlahOrang}`;

    // Tambahkan tanggal jika diisi
    if (data.tanggalBerangkat) {
        const tanggalFormatted = new Date(data.tanggalBerangkat).toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        pesan += `\n• Tanggal Berangkat: ${tanggalFormatted}`;
    }

    // Tambahkan pesan tambahan jika ada
    if (data.pesanTambahan && data.pesanTambahan !== 'Tidak ada') {
        pesan += `\n\nPesan Tambahan:\n${data.pesanTambahan}`;
    }

    pesan += '\n\nTerima kasih!';

    return pesan;
}

/**
 * ============================================
 * EVENT LISTENERS DAN INITIALIZATION
 * ============================================
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Pemesanan.js initialized');

    // Render cards transportasi pertama kali
    setTimeout(() => {
        renderTransportCards('semua');
    }, 500);

    // Event listener untuk menutup modal dengan klik di overlay
    const modalOverlay = document.getElementById('bookingModal');
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) {
                tutupModalPemesanan();
            }
        });
    }

    // Event listener untuk tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            tutupModalPemesanan();
        }
    });

    // Set min date untuk field tanggal
    const travelDateField = document.getElementById('travel-date');
    if (travelDateField) {
        const today = new Date().toISOString().split('T')[0];
        travelDateField.min = today;
    }
});

// Ekspos fungsi ke global scope untuk kompatibilitas
window.renderTransportCards = renderTransportCards;
window.filterTransportasi = filterTransportasi;
window.bukaPemesanan = bukaPemesanan;
window.tutupModalPemesanan = tutupModalPemesanan;
window.kirimPemesanan = kirimPemesanan;