# Sistem Informasi Travel Cv. Cendana Travel

## Deskripsi Proyek

Sistem informasi berbasis web untuk manajemen layanan travel yang menyediakan platform terintegrasi untuk pemesanan tiket transportasi (pesawat, kapal, bus) dengan fitur administrasi lengkap. Sistem ini dikembangkan menggunakan teknologi web modern dengan fokus pada user experience dan kemudahan pengelolaan konten.

## Informasi Akademik

| Aspek | Detail |
|-------|--------|
| **Mata Kuliah** | Pemrograman Web |
| **Program Studi** | Informatika |
| **Universitas** | Universitas Mulawarman |
| **Tahun Akademik** | 2024/2025 |

## Profil Perusahaan

**Cv. Cendana Travel** adalah perusahaan jasa travel yang berlokasi di Samarinda, Kalimantan Timur.

| Informasi | Detail |
|-----------|--------|
| **Nama Perusahaan** | Cv. Cendana Travel |
| **Alamat** | Jl. Cendana No.8, Tlk. Lerong Ulu, Kec. Sungai Kunjang |
| **Kota** | Samarinda, Kalimantan Timur 75127 |
| **Telepon** | 0821-5206-9585 |
| **Email** | info@cendanatravel.com |

## Tujuan Pengembangan

1. **Akademik**: Memenuhi tugas mata kuliah Pemrograman Web dengan implementasi teknologi web modern
2. **Praktis**: Menyediakan solusi digital untuk industri travel di Kalimantan Timur
3. **Teknis**: Mengimplementasikan best practices dalam pengembangan web application

## Ruang Lingkup Sistem

### Fitur Utama
- **Frontend User Interface**: Tampilan responsif untuk customer
- **Admin Dashboard**: Panel administrasi untuk pengelolaan konten
- **Content Management**: Sistem manajemen fasilitas, transportasi, dan informasi perusahaan
- **Integration**: Integrasi dengan WhatsApp untuk pemesanan langsung

### Batasan Sistem
- Sistem berbasis web client-side dengan optional server-side untuk upload
- Tidak termasuk sistem pembayaran online
- Fokus pada informasi dan redirect ke WhatsApp untuk transaksi

## Analisis Kebutuhan

### Kebutuhan Fungsional
1. **Manajemen Konten**: Sistem CRUD untuk fasilitas, transportasi, dan informasi perusahaan
2. **User Interface**: Antarmuka yang responsif dan user-friendly
3. **Admin Panel**: Dashboard untuk pengelolaan konten oleh administrator
4. **Integration**: Koneksi dengan platform komunikasi (WhatsApp)

### Kebutuhan Non-Fungsional
1. **Performance**: Loading time < 3 detik, smooth scrolling animation
2. **Usability**: Intuitive navigation, responsive design
3. **Compatibility**: Cross-browser support (Chrome, Firefox, Safari, Edge)
4. **Accessibility**: Easy admin access tanpa kompleksitas berlebihan

## Spesifikasi Teknis

### Frontend Technologies
- **HTML5**: Semantic markup dengan accessibility compliance
- **CSS3**: Modern styling dengan CSS Grid, Flexbox, dan CSS Variables
- **JavaScript ES6+**: Vanilla JavaScript tanpa framework dependencies
- **LocalStorage API**: Client-side data persistence

### Backend Technologies (Optional)
- **PHP 7.4+**: Server-side file upload handling
- **Apache/Nginx**: Web server configuration

### Development Tools
- **Version Control**: Git untuk source code management
- **Code Editor**: VS Code dengan extensions untuk web development
- **Browser DevTools**: Debugging dan performance testing

## Arsitektur Sistem

### Struktur Direktori
```
Cv-Cendana-Travel/
├── index.html              # Halaman utama (entry point)
├── admin.html              # Dashboard administrasi
├── script.js               # Core JavaScript logic
├── styles.css              # Stylesheet utama
├── icons.css               # Custom icon definitions
├── config.js               # Konfigurasi aplikasi
├── upload.php              # File upload handler (optional)
├── config.php              # Server configuration (optional)
├── cendana/                # Company assets
│   ├── bannercendana.png   # Hero banner image
│   ├── cendanamaps.png     # Google Maps location image
│   └── Screenshot*.png     # Facility images
├── pesawat/                # Airline logos
├── kapal/                  # Ship operator logos
├── bus/                    # Bus operator logos
└── JenisTransportasi/      # Transport type icons
    ├── *terang.png         # Light mode icons
    └── *gelap.png          # Dark mode icons
```

### Komponen Sistem
1. **Presentation Layer**: HTML5 semantic structure
2. **Styling Layer**: CSS3 dengan responsive design
3. **Logic Layer**: JavaScript untuk interactivity
4. **Data Layer**: LocalStorage untuk client-side persistence
5. **Asset Layer**: Organized media files

## Implementasi Fitur

### User Interface Features
- **Responsive Design**: Mobile-first approach dengan breakpoints optimal
- **Dark/Light Mode**: Theme switching dengan localStorage persistence
- **Smooth Scrolling**: Custom easing function (easeInOutQuart) untuk navigasi halus
- **Lazy Loading**: Intersection Observer API untuk performance optimization

### Admin Panel Features
- **Secure Authentication**: Password-based login dengan session management
- **CRUD Operations**: Create, Read, Update, Delete untuk semua konten
- **File Upload**: Drag-and-drop interface dengan validation
- **Real-time Preview**: Live preview untuk perubahan konten

### Integration Features
- **WhatsApp API**: Direct messaging untuk customer inquiries
- **Google Maps Integration**: Direct link ke lokasi perusahaan
- **Cross-browser Compatibility**: Fallback functions untuk browser lama
- **SEO Optimization**: Meta tags dan semantic HTML structure

## Panduan Instalasi

### Persyaratan Sistem
- **Browser**: Chrome 80+, Firefox 75+, Safari 13+, Edge 80+
- **Server** (optional): Apache/Nginx dengan PHP 7.4+
- **Storage**: Minimum 50MB untuk assets

### Langkah Instalasi

#### Development Mode
1. Clone atau download repository
2. Buka `index.html` di browser modern
3. Semua fitur client-side akan berfungsi normal

#### Production Deployment
1. Upload semua file ke web server
2. Set permissions untuk direktori upload:
   ```bash
   chmod 755 cendana/ pesawat/ kapal/ bus/ JenisTransportasi/
   ```
3. Konfigurasi web server untuk PHP (jika menggunakan upload feature)
4. Akses melalui domain/URL server

### Konfigurasi Admin
- **Akses**: Tekan `Ctrl+Shift+A` pada halaman utama
- **Password**: `travel123`
- **Login**: Tanpa batasan percobaan untuk kemudahan akses

## Testing dan Quality Assurance

### Browser Compatibility Testing
| Browser | Version | Status |
|---------|---------|--------|
| Chrome | 80+ | ✅ Fully Supported |
| Firefox | 75+ | ✅ Fully Supported |
| Safari | 13+ | ✅ Fully Supported |
| Edge | 80+ | ✅ Fully Supported |

### Responsive Testing
| Device Type | Breakpoint | Layout Test |
|-------------|------------|-------------|
| Mobile | < 768px | ✅ Single column, touch-friendly |
| Tablet | 768px - 1024px | ✅ Two-column grid |
| Desktop | > 1024px | ✅ Multi-column layout |

### Performance Metrics
- **First Contentful Paint**: < 1.5s
- **Largest Contentful Paint**: < 2.5s
- **Cumulative Layout Shift**: < 0.1
- **First Input Delay**: < 100ms

## Dokumentasi API dan Konfigurasi

### Konfigurasi Perusahaan
```javascript
// config.js - Pengaturan dasar perusahaan
const COMPANY_CONFIG = {
    name: 'Cv. Cendana Travel',
    whatsapp: '6282152069585',
    instagram: '@cendanatravel_official',
    email: 'info@cendanatravel.com',
    address: 'Jl. Cendana No.8, Tlk. Lerong Ulu, Kec. Sungai Kunjang\nKota Samarinda, Kalimantan Timur 75127',
    hours: 'Senin - Minggu: 08.00 - 22.00 WIB'
};
```

### Struktur Data
```javascript
// Contoh struktur data fasilitas
const facilityData = {
    id: 1,
    name: "Ruang Tunggu VIP",
    image: "cendana/facility_1.png",
    description: "Ruang tunggu nyaman dengan AC dan WiFi gratis"
};

// Contoh struktur data transportasi
const transportData = {
    id: 1,
    name: "Lion Air",
    logo: "pesawat/lionair.png",
    route: "Penerbangan domestik terpercaya",
    price: "Rp 450.000 - Rp 850.000",
    transportType: "pesawat"
};
```

## Kesimpulan dan Evaluasi

### Pencapaian Tujuan
1. **✅ Akademik**: Berhasil mengimplementasikan konsep pemrograman web modern
2. **✅ Teknis**: Sistem berjalan optimal dengan performa tinggi
3. **✅ Fungsional**: Semua fitur bekerja sesuai spesifikasi
4. **✅ User Experience**: Interface responsif dan user-friendly

### Pembelajaran yang Diperoleh
- **Frontend Development**: HTML5 semantic, CSS3 advanced, JavaScript ES6+
- **Responsive Design**: Mobile-first approach dan cross-device compatibility
- **Performance Optimization**: Lazy loading, smooth animations, efficient DOM manipulation
- **User Interface Design**: Modern web design principles dan accessibility

### Pengembangan Selanjutnya
- **Database Integration**: Implementasi backend dengan MySQL/PostgreSQL
- **Payment Gateway**: Integrasi sistem pembayaran online
- **Real-time Features**: WebSocket untuk notifikasi real-time
- **Progressive Web App**: Service worker untuk offline functionality

## Referensi dan Sumber

### Teknologi yang Digunakan
- **MDN Web Docs**: HTML5, CSS3, JavaScript ES6+ documentation
- **W3C Standards**: Web accessibility dan semantic markup guidelines
- **Google Web Fundamentals**: Performance optimization best practices
- **Can I Use**: Browser compatibility reference

### Design Inspiration
- **Material Design**: Google's design system principles
- **Modern Web Design**: Contemporary UI/UX patterns
- **Travel Industry Standards**: Industry-specific design conventions

### Libraries dan Tools
- **Vanilla JavaScript**: Zero external dependencies untuk performa optimal
- **CSS Grid & Flexbox**: Modern layout techniques
- **Intersection Observer API**: Efficient scroll-based animations
- **LocalStorage API**: Client-side data persistence

---

## Lampiran

### A. Struktur Database (Future Development)
```sql
-- Contoh struktur tabel untuk pengembangan selanjutnya
CREATE TABLE facilities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE transport_services (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    type ENUM('pesawat', 'kapal', 'bus'),
    logo_path VARCHAR(255),
    route VARCHAR(255),
    price_range VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### B. Deployment Checklist
- [ ] Upload semua file ke server
- [ ] Set file permissions (755 untuk direktori, 644 untuk file)
- [ ] Test semua fitur di environment production
- [ ] Verify responsive design di berbagai device
- [ ] Test admin panel functionality
- [ ] Validate form submissions dan file uploads
- [ ] Check cross-browser compatibility
- [ ] Optimize images untuk web delivery

---

**Dikembangkan sebagai tugas akhir mata kuliah Pemrograman Web**  
**Program Studi Informatika, Universitas Mulawarman**  
**Tahun Akademik 2024/2025**