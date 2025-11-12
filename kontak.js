/**
 * ============================================
 * SCRIPT UNTUK HALAMAN KONTAK
 * ============================================
 * Menangani form permintaan yang redirect ke WhatsApp
 */

/**
 * Handle form permintaan kontak
 * @param {Event} event - Event form submit
 */
function kirimPermintaanKontak(event) {
    event.preventDefault();
    
    // Ambil nilai form
    const name = document.getElementById('request-name').value;
    const message = document.getElementById('request-message').value;
    
    // Validasi
    if (!name || !message) {
        alert('Mohon lengkapi semua field yang diperlukan!');
        return;
    }
    
    // Buat pesan WhatsApp
    const whatsappNumber = companyInfoData?.whatsapp || '6285821841529';
    const whatsappMessage = `Halo, nama saya ${name}.

${message}

Terima kasih!`;
    
    // Encode message untuk URL
    const encodedMessage = encodeURIComponent(whatsappMessage);
    const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;
    
    // Buka WhatsApp
    window.open(whatsappUrl, '_blank');
    
    // Reset form
    document.getElementById('contactRequestForm').reset();
    
    // Tampilkan notifikasi sukses
    alert('Permintaan Anda akan dibuka di WhatsApp. Terima kasih!');
}

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactRequestForm');
    if (form) {
        form.addEventListener('submit', kirimPermintaanKontak);
    }
});

// Export functions untuk digunakan di global scope
window.kirimPermintaanKontak = kirimPermintaanKontak;

