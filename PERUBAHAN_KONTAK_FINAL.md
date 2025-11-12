# Perubahan Bagian Kontak - CV. Cendana Travel

## Perubahan yang Dilakukan

### 🔄 **Tombol WhatsApp di Showcase:**
- **Sebelum**: Mengarah ke WhatsApp langsung
- **Sesudah**: Mengarah ke halaman `pemesanan.php`

### ✨ **Bagian Kontak - Efek Visual Menarik:**

#### **Background Baru:**
- **Gradasi Navy Blue**: Linear gradient dengan 3 warna (1a365d → 2c5282 → 2b6cb0)
- **Floating Shapes**: 4 lingkaran dengan animasi mengambang
- **Animasi Float**: Gerakan naik-turun dengan rotasi 180 derajat

#### **Card Design:**
- **Glass Effect**: Background rgba putih dengan backdrop blur
- **Hover Animation**: Kartu terangkat saat di-hover
- **Shadow**: Box shadow yang lebih dramatis

#### **Content Styling:**
- **Emoji Icons**: Menggunakan emoji sebagai ikon (💰, ⚡, 🏆, 📱, 📍, 🕒)
- **Interactive Elements**: Hover effect pada setiap item
- **Color Coding**: Highlight biru untuk info, hijau untuk kontak

### 🗺️ **Google Maps - Format Lebih Lebar:**

#### **Penggantian:**
- **Sebelum**: Foto static `cendana/cendanamaps.png`
- **Sesudah**: Google Maps iframe yang interaktif

#### **Fitur Baru:**
- **Ukuran Lebih Besar**: Height 450px (sebelumnya 300px)
- **Interactive Maps**: User bisa zoom, drag, dan explore
- **Filter Effect**: Grayscale 20% dengan hover effect
- **Overlay Info**: Card informasi di pojok kanan atas
- **Tombol Petunjuk Arah**: Link langsung ke Google Maps

## Kode Utama

### HTML Structure:
```html
<section class="about-contact">
    <!-- Floating shapes background -->
    <div class="contact-background">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <!-- ... more shapes -->
        </div>
    </div>
    
    <!-- Content cards -->
    <div class="info-card">...</div>
    <div class="contact-card">...</div>
    
    <!-- Google Maps -->
    <div class="google-maps-section">
        <iframe src="google-maps-embed-url"></iframe>
        <div class="maps-overlay">...</div>
    </div>
</section>
```

### CSS Highlights:
```css
/* Floating animation */
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* Glass effect cards */
.info-card, .contact-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

/* Interactive maps */
.maps-wrapper iframe {
    filter: grayscale(20%) contrast(1.1);
    transition: filter 0.3s ease;
}
```

## Hasil Visual

### ✅ **Efek yang Dicapai:**
- **Background Dinamis**: Floating shapes yang bergerak halus
- **Glass Morphism**: Card dengan efek kaca transparan
- **Interactive Elements**: Hover effects pada semua komponen
- **Professional Maps**: Google Maps yang lebih informatif
- **Responsive Design**: Adaptif di semua ukuran layar

### 🎯 **User Experience:**
- **Visual Appeal**: Lebih menarik dengan animasi subtle
- **Information Hierarchy**: Informasi tersusun dengan baik
- **Easy Navigation**: Tombol dan link yang jelas
- **Mobile Friendly**: Floating shapes disembunyikan di mobile

Website sekarang memiliki bagian kontak yang jauh lebih menarik dan profesional dengan efek visual modern yang tidak berlebihan.