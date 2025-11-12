# 🚀 CV. CENDANA TRAVEL - ADMIN DASHBOARD

## 📋 Overview
Dashboard admin sederhana untuk mengelola website CV. Cendana Travel dengan gaya coding mahasiswa - tanpa framework, menggunakan HTML, CSS, dan JavaScript murni.

## 🔐 Cara Akses Admin

### Method 1: Floating Button (Recommended)
- **Lokasi**: Kanan bawah website (di atas tombol WhatsApp)
- **Tampilan**: Tombol biru bergradien dengan ikon kunci 🔐
- **Action**: Klik untuk membuka modal login

### Method 2: Keyboard Shortcut (Fastest)
- **Shortcut**: `Ctrl + Shift + A`
- **Action**: Modal login langsung terbuka
- **Benefit**: Akses cepat tanpa scroll

### Method 3: Direct URL
- **URL**: `[your-domain]/admin.php`
- **Note**: Akan redirect ke homepage jika belum login

## 🔑 Login Credentials
```
Username: admin
Password: admin123
```
**Important**: Password bersifat case-sensitive (huruf kecil semua)

## 🎯 Fitur Dashboard Admin

### 📊 Dashboard Utama
- **Statistics Cards**: Total Galeri, Pesanan Bulan Ini, FAQ Aktif, Total Pengunjung
- **System Status**: Informasi status website dan waktu login terakhir
- **Ringkasan**: Overview sistem dengan bayangan lembut

### 🔧 Menu Navigasi

#### 1. **Dashboard** 🏠
- Halaman utama dengan sambutan dan statistik
- Card stats dengan warna berbeda (biru, hijau, orange, merah)

#### 2. **General** ⚙️
- Kelola informasi umum perusahaan
- Edit nama travel, deskripsi, kontak utama
- Form sederhana dengan validasi

#### 3. **Kelola Beranda** 🏠
- **Banner Utama**: Upload banner, edit judul dan subtitle
- **Gambar Promosi**: Upload multiple images, teks promosi
- Area upload dengan card terpisah

#### 4. **Pemesanan** 🛒
- Tambah paket perjalanan baru
- Form: Nama paket, harga, deskripsi, durasi
- Daftar pesanan terbaru

#### 5. **Galeri** 🖼️
- Grid view gambar dengan pratinjau
- Upload gambar baru dengan deskripsi
- Tombol hapus untuk setiap gambar
- Card abu-abu lembut

#### 6. **Kontak** 📞
- Edit nomor telepon, email, alamat
- Link Google Maps khusus
- Instagram handle

#### 7. **FAQ** ❓
- Tambah pertanyaan dan jawaban baru
- List FAQ dengan tombol Edit dan Hapus
- Border kiri biru untuk setiap FAQ item

## 🎨 Design Features (Gaya Mahasiswa)

### Layout Sederhana
- **Sidebar Kiri**: Warna biru tua dengan gradien (#2c3e50 → #34495e)
- **Area Konten**: Putih bersih dengan padding luas
- **Card Design**: Bayangan lembut, border radius 8px
- **No Framework**: Semua dibuat manual dengan CSS murni

### Color Scheme Profesional
- **Sidebar**: Biru tua bergradien
- **Stats Cards**: 
  - Biru (#3498db → #2980b9) 
  - Hijau (#27ae60 → #229954)
  - Orange (#f39c12 → #e67e22)
  - Merah (#e74c3c → #c0392b)
- **Forms**: Border biru saat focus (#3498db)
- **Buttons**: Hover effect dengan translateY(-2px)

## 📱 Responsive Design

### Desktop (1200px+)
- Full sidebar navigation
- Grid layout for cards (4 columns)
- Expanded forms and tables

### Tablet (768px - 1199px)
- Collapsible sidebar
- Grid layout (2-3 columns)
- Optimized touch targets

### Mobile (< 768px)
- Stack navigation (sidebar moves to bottom)
- Single column layout
- Swipe gestures support

## 🌙 Dark Mode Support

### Auto-detection
- Follows system preference
- Manual toggle available
- Smooth transitions between themes

### Dark Theme Colors
- **Background**: Dark blue-gray (#1a202c)
- **Cards**: Medium gray (#2d3748)
- **Text**: Off-white (#f1f5f9)
- **Accents**: Bright variants of primary colors

## 🔧 Management Features

### Transport Services
- **Add New Service**: Form dengan upload logo
- **Edit Existing**: Modal popup untuk quick edit
- **Delete Service**: Confirmation dialog
- **Categorization**: Auto-group by transport type

### Facilities Management
- **Image Upload**: Drag & drop atau click to browse
- **Preview**: Real-time image preview
- **Validation**: File type dan size checking
- **Responsive Images**: Auto-resize untuk optimasi

### Company Information
- **Real-time Preview**: Changes reflect immediately
- **Validation**: Required fields checking
- **Auto-save**: Draft saving functionality
- **Backup**: History of changes

## 🚨 Troubleshooting

### Login Issues
1. **Password salah**: Pastikan menggunakan `cendana123`
2. **Modal tidak muncul**: Cek JavaScript console untuk errors
3. **Button tidak terlihat**: Scroll ke bagian footer website
4. **Shortcut tidak work**: Pastikan focus di halaman website

### Performance Issues
1. **Loading lambat**: Check internet connection
2. **Images tidak load**: Verify file permissions
3. **Form tidak submit**: Check browser console untuk errors

### Browser Compatibility
- **Recommended**: Chrome 90+, Firefox 88+, Safari 14+
- **Mobile**: iOS Safari 14+, Android Chrome 90+
- **Features**: Modern CSS Grid, Flexbox, CSS Variables

## 📄 File Structure

```
admin-styles.css     # Styling khusus dashboard admin
admin.php           # Main dashboard page  
auth.php            # Authentication handler
config/database.php # Database configuration
PASSWORD_ADMIN.txt  # Login credentials & guide
```

## 🔄 Updates & Maintenance

### Recent Changes (v3.0 - Gaya Mahasiswa)
- ✅ Dashboard sederhana dengan sidebar biru tua
- ✅ 7 menu utama: Dashboard, General, Beranda, Pemesanan, Galeri, Kontak, FAQ
- ✅ Statistics cards dengan gradien warna
- ✅ Form styling dengan transisi halus
- ✅ Alert sederhana untuk konfirmasi
- ✅ CSS manual tanpa framework
- ✅ Komentar gaya mahasiswa di kode
- ✅ Password reset ke admin123

### Kode Style Mahasiswa
- **Comments**: `/* belum pakai framework jadi manual aja */`
- **Variables**: Nama yang mudah dipahami
- **Functions**: Alert sederhana untuk feedback
- **Layout**: Grid dan flexbox manual
- **No Dependencies**: Hanya HTML, CSS, JavaScript murni

## 📞 Support
Untuk bantuan teknis atau pertanyaan terkait dashboard admin, silakan hubungi developer melalui dokumentasi yang tersedia.

---
**Last Updated**: November 2025  
**Version**: 3.0  
**Compatibility**: Modern browsers with ES6+ support