<?php
// Admin Dashboard - CV. Cendana Travel
// Username: admin, Password: admin123

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/database.php';
require_once 'includes/functions.php';

startSecureSession();

// cek login admin
if (!isAdminLoggedIn()) {
    header('Location: index.php');
    exit();
}

// Handle CRUD operations dengan POST-REDIRECT-GET Pattern
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $module = $_POST['module'] ?? '';
    
    /* CRUD sederhana tanpa framework dengan PRG Pattern */
    
    // ============================================
    // HANDLE GENERAL INFO UPDATE
    // ============================================
    if ($action === 'update' && $module === 'general') {
        if (updateCompanyInfo($_POST)) {
            $_SESSION['admin_message'] = 'Informasi perusahaan berhasil diperbarui!';
            $_SESSION['admin_message_type'] = 'success';
        } else {
            $_SESSION['admin_message'] = 'Gagal memperbarui informasi perusahaan!';
            $_SESSION['admin_message_type'] = 'error';
        }
        header('Location: admin.php');
        exit();
    }
    
    // ============================================
    // HANDLE BANNER OPERATIONS
    // ============================================
    elseif ($module === 'banner') {
        if ($action === 'add') {
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = uploadImage($_FILES['image'], 'uploads/');
            }
            
            if (addBanner($_POST, $imagePath)) {
                $_SESSION['admin_message'] = 'Banner berhasil ditambahkan!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal menambahkan banner!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php');
            exit();
        }
        elseif ($action === 'update') {
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = uploadImage($_FILES['image'], 'uploads/');
            }
            
            if (updateBanner($_POST['id'], $_POST, $imagePath)) {
                $_SESSION['admin_message'] = 'Banner berhasil diperbarui!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal memperbarui banner!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php');
            exit();
        }
        elseif ($action === 'delete') {
            if (deleteBanner($_POST['id'])) {
                $_SESSION['admin_message'] = 'Banner berhasil dihapus!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal menghapus banner!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php');
            exit();
        }
    }
    
    // ============================================
    // HANDLE GALLERY OPERATIONS
    // ============================================
    elseif ($module === 'gallery') {
        if ($action === 'add') {
            $imagePath = uploadImage($_FILES['image'], 'uploads/gallery/');
            if ($imagePath && addGallery($_POST, $imagePath)) {
                $_SESSION['admin_message'] = 'Foto galeri berhasil ditambahkan!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal menambahkan foto galeri!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php');
            exit();
        }
        elseif ($action === 'update') {
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = uploadImage($_FILES['image'], 'uploads/gallery/');
            }
            
            if (updateGallery($_POST['id'], $_POST, $imagePath)) {
                $_SESSION['admin_message'] = 'Foto galeri berhasil diperbarui!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal memperbarui foto galeri!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php');
            exit();
        }
        elseif ($action === 'delete') {
            if (deleteGallery($_POST['id'])) {
                $_SESSION['admin_message'] = 'Foto galeri berhasil dihapus!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal menghapus foto galeri!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php');
            exit();
        }
    }
    
    // ============================================
    // HANDLE CONTACT INFO UPDATE
    // ============================================
    elseif ($action === 'update' && $module === 'contact') {
        if (updateContactInfo($_POST)) {
            $_SESSION['admin_message'] = 'Informasi kontak berhasil diperbarui!';
            $_SESSION['admin_message_type'] = 'success';
        } else {
            $_SESSION['admin_message'] = 'Gagal memperbarui informasi kontak!';
            $_SESSION['admin_message_type'] = 'error';
        }
        header('Location: admin.php');
        exit();
    }
    
    // ============================================
    // HANDLE FAQ OPERATIONS
    // ============================================
    elseif ($module === 'faq') {
        if ($action === 'add') {
            if (addFAQ($_POST)) {
                $_SESSION['admin_message'] = 'FAQ berhasil ditambahkan!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal menambahkan FAQ!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php');
            exit();
        }
        elseif ($action === 'update') {
            if (updateFAQ($_POST['id'], $_POST)) {
                $_SESSION['admin_message'] = 'FAQ berhasil diperbarui!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal memperbarui FAQ!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php');
            exit();
        }
        elseif ($action === 'delete') {
            if (deleteFAQ($_POST['id'])) {
                $_SESSION['admin_message'] = 'FAQ berhasil dihapus!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal menghapus FAQ!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php');
            exit();
        }
    }
    
    // ============================================
    // HANDLE TRANSPORT OPERATIONS
    // ============================================
    elseif ($module === 'transport') {
        if ($action === 'add') {
            $logoPath = null;
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $logoPath = uploadImage($_FILES['logo'], 'uploads/' . $_POST['transport_type'] . '/');
            }
            
            if (addTransportService($_POST, $logoPath)) {
                $_SESSION['admin_message'] = 'Layanan transportasi berhasil ditambahkan!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal menambahkan layanan transportasi!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php#transportasi');
            exit();
        }
        elseif ($action === 'update') {
            $logoPath = null;
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $logoPath = uploadImage($_FILES['logo'], 'uploads/' . $_POST['transport_type'] . '/');
            }
            
            if (updateTransportService($_POST['id'], $_POST, $logoPath)) {
                $_SESSION['admin_message'] = 'Layanan transportasi berhasil diperbarui!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal memperbarui layanan transportasi!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php#transportasi');
            exit();
        }
        elseif ($action === 'delete') {
            if (deleteTransportService($_POST['id'])) {
                $_SESSION['admin_message'] = 'Layanan transportasi berhasil dihapus!';
                $_SESSION['admin_message_type'] = 'success';
            } else {
                $_SESSION['admin_message'] = 'Gagal menghapus layanan transportasi!';
                $_SESSION['admin_message_type'] = 'error';
            }
            header('Location: admin.php#transportasi');
            exit();
        }
    }

}

// Ambil data untuk dashboard
$stats = getDashboardStats();
$companyInfo = getCompanyInfo();
$contactInfo = getContactInfo();
$transportServices = getAllTransportServices();
$transportTypes = getAllTransportTypes();
$galleries = getAllGallery();
$faqs = getAllFAQ();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CV. Cendana Travel</title>
    
    <!-- External Dependencies -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin-enhancements.css">
    <script src="config.js"></script>
    
    <style>
        /* ============================================
         * CSS VARIABLES - KONSISTEN DENGAN WEBSITE UTAMA
         * ============================================ */
        :root {
            /* Warna utama - Dark Glassmorphism Premium Theme */
            --admin-primary: #4A84FF;
            --admin-secondary: #6DA8FF;
            --admin-accent: #8BB4FF;
            --admin-dark: rgba(15, 15, 20, 0.75);
            --admin-darker: rgba(10, 10, 15, 0.85);
            
            /* Background colors - Dark Glass */
            --admin-bg-main: rgba(20, 20, 30, 0.6);
            --admin-bg-secondary: rgba(15, 15, 20, 0.5);
            --admin-bg-tertiary: rgba(25, 25, 35, 0.55);
            --admin-bg-card: rgba(30, 30, 45, 0.65);
            
            /* Text colors - Light for dark backgrounds */
            --admin-text-primary: #f0f0f5;
            --admin-text-secondary: #d0d0d8;
            --admin-text-muted: #a0a0a8;
            
            /* Border and shadows - Dark theme */
            --admin-border: rgba(255, 255, 255, 0.1);
            --admin-border-light: rgba(255, 255, 255, 0.05);
            --admin-shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.3);
            --admin-shadow-md: 0 4px 12px rgba(0, 0, 0, 0.4);
            --admin-shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.5);
            --admin-shadow-primary: 0 4px 20px rgba(74, 132, 255, 0.25);
            
            /* Gradients - Dark Glass with Blue Accent */
            --admin-gradient-primary: linear-gradient(135deg, #4A84FF 0%, #6DA8FF 100%);
            --admin-gradient-header: linear-gradient(135deg, rgba(15, 15, 20, 0.9) 0%, rgba(74, 132, 255, 0.2) 50%, rgba(109, 168, 255, 0.15) 100%);
            --admin-gradient-sidebar: linear-gradient(180deg, rgba(30, 30, 45, 0.7) 0%, rgba(15, 15, 20, 0.8) 100%);
            
            /* Success, warning, danger colors - Premium Status */
            --admin-success: #4CD964;
            --admin-warning: #FFBB33;
            --admin-danger: #FF5C5C;
            --admin-info: #06b6d4;
            
            /* Pastel accents for premium feel */
            --admin-pastel-warm: #E8C4A0;
            --admin-pastel-light: #F1DAC7;
            --admin-pastel-accent: #D9A679;
        }

        /* Dark mode variables *//* Reset dan Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, rgba(15, 15, 20, 0.6) 0%, rgba(25, 25, 35, 0.5) 100%);
            color: #f0f0f5;
            line-height: 1.6;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }

        /* Header Styles - Dark Glassmorphism Premium */
        .admin-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: linear-gradient(135deg, rgba(15, 15, 20, 0.9) 0%, rgba(74, 132, 255, 0.15) 100%);
            backdrop-filter: blur(18px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.6), inset 1px 1px 0 rgba(255, 255, 255, 0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .admin-logo {
            color: #f0f0f5;
            font-weight: 700;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.02em;
        }

        .admin-logo i {
            font-size: 1.6rem;
            color: #4A84FF;
            filter: drop-shadow(0 2px 8px rgba(74, 132, 255, 0.4));
        }

        .admin-user {
            color: #f0f0f5;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .admin-user span {
            font-size: 0.95rem;
            font-weight: 500;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 25px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .logout-btn {
            background: rgba(74, 132, 255, 0.12);
            color: #4A84FF;
            border: 2px solid rgba(74, 132, 255, 0.3);
            padding: 10px 18px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn:hover {
            background: rgba(74, 132, 255, 0.2);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(74, 132, 255, 0.3);
            border-color: rgba(74, 132, 255, 0.5);
        }

        /* Sidebar Styles - Dark Elegant Theme */
        .sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            width: 280px;
            height: calc(100vh - 70px);
            background: linear-gradient(180deg, rgba(30, 30, 45, 0.8) 0%, rgba(15, 15, 20, 0.9) 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            padding: 24px 0;
            overflow-y: auto;
            z-index: 999;
            box-shadow: inset -1px 0 0 rgba(255, 255, 255, 0.05), 4px 0 16px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
        }

        .sidebar-nav {
            padding: 0 20px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            margin: 6px 16px;
            color: rgba(240, 240, 245, 0.7);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
            border: 1px solid transparent;
        }

        .nav-link i {
            width: 20px;
            margin-right: 16px;
            text-align: center;
            opacity: 0.8;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(74, 132, 255, 0.15);
            color: #f0f0f5;
            transform: translateX(4px);
            box-shadow: inset 0 0 20px rgba(74, 132, 255, 0.1);
            border-color: rgba(74, 132, 255, 0.2);
        }

        .nav-link:hover i {
            transform: scale(1.1);
            opacity: 1;
            color: #4A84FF;
        }

        .nav-link.active i {
            opacity: 1;
            color: #4A84FF;
        }

        .nav-link.active {
            background: rgba(74, 132, 255, 0.25);
            color: #f0f0f5;
            box-shadow: 0 4px 16px rgba(74, 132, 255, 0.25), inset 0 0 20px rgba(74, 132, 255, 0.08);
            border-color: rgba(74, 132, 255, 0.3);
            font-weight: 600;
            transform: translateX(4px);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: -20px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 24px;
            background: #4A84FF;
            border-radius: 0 4px 4px 0;
            box-shadow: 0 0 12px rgba(74, 132, 255, 0.5);
        }

        /* Main Content - Dark Glass Layout */
        .admin-content {
            margin-left: 280px;
            margin-top: 70px;
            padding: 40px 36px;
            min-height: calc(100vh - 70px);
            background: linear-gradient(135deg, rgba(15, 15, 20, 0.6) 0%, rgba(25, 25, 35, 0.5) 100%);
            position: relative;
            overflow: auto;
        }

        .content-section {
            display: none;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .content-section.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
            animation: fadeInUp 0.4s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Page Headers - Typography yang Profesional untuk Dark Theme */
        .content-section h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #f0f0f5;
            margin-bottom: 12px;
            letter-spacing: -0.03em;
            line-height: 1.2;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .content-section > p {
            color: rgba(240, 240, 245, 0.8);
            margin-bottom: 32px;
            font-size: 1.1rem;
            line-height: 1.6;
            max-width: 600px;
        }

        /* Stats Grid - Dark Glass Cards */
        .stat-card {
            background: rgba(30, 30, 45, 0.7);
            padding: 32px 28px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), inset 1px 1px 0 rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--admin-gradient-primary);
            opacity: 0.6;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(74, 132, 255, 0.15) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 48px rgba(74, 132, 255, 0.25), inset 1px 1px 0 rgba(255, 255, 255, 0.1);
            border-color: rgba(74, 132, 255, 0.3);
            background: rgba(30, 30, 45, 0.8);
        }

        .stat-card:hover::after {
            opacity: 1;
        }

        .stat-card h3 {
            color: rgba(240, 240, 245, 0.6);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .stat-card .number {
            background: var(--admin-gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 2.4rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }

        .stat-card small {
            color: rgba(240, 240, 245, 0.7);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Section Cards - Dark Glass Modern */
        .section-card {
            background: rgba(30, 30, 45, 0.7);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), inset 1px 1px 0 rgba(255, 255, 255, 0.08);
            margin-bottom: 32px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .section-card:hover {
            box-shadow: 0 12px 48px rgba(74, 132, 255, 0.25), inset 1px 1px 0 rgba(255, 255, 255, 0.1);
            border-color: rgba(74, 132, 255, 0.3);
            background: rgba(30, 30, 45, 0.8);
        }

        .section-header {
            padding: 24px 32px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: linear-gradient(135deg, rgba(20, 20, 30, 0.5) 0%, rgba(40, 40, 55, 0.3) 100%);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .section-header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--admin-gradient-primary);
            opacity: 0.5;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .section-card:hover .section-header::before {
            transform: scaleX(1);
        }

        .section-header h2 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #f0f0f5;
            letter-spacing: -0.01em;
        }

        .section-content {
            padding: 32px 36px;
            color: #f0f0f5;
        }

        /* Form Styles - Dark Glass Premium */
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group input[type="file"] {
            padding: 10px;
            border: 2px dashed rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            background: transparent;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #f0f0f5;
            font-size: 0.95rem;
            letter-spacing: -0.01em;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 16px 18px;
            border: 2px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            font-size: 0.95rem;
            background: rgba(20, 20, 30, 0.6);
            color: #f0f0f5;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: inherit;
            backdrop-filter: blur(8px);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder,
        .form-group select::placeholder {
            color: rgba(240, 240, 245, 0.4);
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4A84FF;
            box-shadow: 0 0 0 4px rgba(74, 132, 255, 0.25), inset 0 0 12px rgba(74, 132, 255, 0.1);
            transform: translateY(-2px);
            background: rgba(20, 20, 30, 0.8);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        .form-group input[type="file"] {
            padding: 12px 16px;
            background: rgba(20, 20, 30, 0.5);
            border-style: dashed;
            color: rgba(240, 240, 245, 0.6);
        }

        .form-group input[type="checkbox"] {
            width: auto;
            margin-right: 12px;
            transform: scale(1.2);
            accent-color: #4A84FF;
            background: rgba(74, 132, 255, 0.2);
            border-color: #4A84FF;
        }

        .form-group small {
            color: rgba(240, 240, 245, 0.6);
            font-size: 0.85rem;
            display: block;
            margin-top: 6px;
            line-height: 1.4;
        }

        /* Button Styles - Premium Gradients */
        .btn {
            padding: 14px 28px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.9rem;
            font-family: inherit;
            letter-spacing: -0.01em;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: var(--admin-gradient-primary);
            color: white;
            box-shadow: 0 4px 20px rgba(74, 132, 255, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 30px rgba(74, 132, 255, 0.5);
        }

        .btn-secondary {
            background: linear-gradient(135deg, rgba(240, 240, 245, 0.15) 0%, rgba(240, 240, 245, 0.1) 100%);
            color: #f0f0f5;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(240, 240, 245, 0.15);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, rgba(240, 240, 245, 0.2) 0%, rgba(240, 240, 245, 0.15) 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 132, 255, 0.2);
        }

        .btn-success {
            background: linear-gradient(135deg, #4CD964 0%, #5fe368 100%);
            color: white;
            box-shadow: 0 4px 20px rgba(76, 217, 100, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(76, 217, 100, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #FF5C5C 0%, #ff7575 100%);
            color: white;
            box-shadow: 0 4px 20px rgba(255, 92, 92, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(255, 92, 92, 0.4);
        }

        /* Table Styles - Dark Glass Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(30, 30, 45, 0.5);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
        }

        .table th,
        .table td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .table th {
            font-weight: 700;
            color: #f0f0f5;
            background: linear-gradient(135deg, rgba(74, 132, 255, 0.15) 0%, rgba(74, 132, 255, 0.05) 100%);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            position: relative;
        }

        .table th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--admin-gradient-primary);
            opacity: 0.6;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(74, 132, 255, 0.1);
            transform: scale(1.01);
        }

        .table tbody tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.02);
        }

        .table td {
            color: rgba(240, 240, 245, 0.9);
        }

        /* Badge Styles - Premium Status Colors */
        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .badge:hover {
            transform: scale(1.05);
        }

        .badge-success { 
            background: linear-gradient(135deg, #4CD964, #5fe368);
            color: white;
            border-color: rgba(76, 217, 100, 0.3);
            box-shadow: 0 4px 12px rgba(76, 217, 100, 0.3);
        }
        
        .badge-warning { 
            background: linear-gradient(135deg, #FFBB33, #ffc84d);
            color: white;
            border-color: rgba(255, 187, 51, 0.3);
            box-shadow: 0 4px 12px rgba(255, 187, 51, 0.3);
        }
        
        .badge-danger { 
            background: linear-gradient(135deg, #FF5C5C, #ff7575);
            color: white;
            border-color: rgba(255, 92, 92, 0.3);
            box-shadow: 0 4px 12px rgba(255, 92, 92, 0.3);
        }
        
        .badge-info { 
            background: linear-gradient(135deg, #4A84FF, #6DA8FF);
            color: white;
            border-color: rgba(74, 132, 255, 0.3);
            box-shadow: 0 4px 12px rgba(74, 132, 255, 0.3);
        }

        /* Gallery Grid - Dark Glass Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            margin-top: 24px;
        }

        .gallery-item {
            background: rgba(30, 30, 45, 0.7);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), inset 1px 1px 0 rgba(255, 255, 255, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.08);
            position: relative;
            backdrop-filter: blur(10px);
        }

        .gallery-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--admin-gradient-primary);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .gallery-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 48px rgba(74, 132, 255, 0.25), inset 1px 1px 0 rgba(255, 255, 255, 0.1);
            border-color: rgba(74, 132, 255, 0.3);
            background: rgba(30, 30, 45, 0.8);
        }

        .gallery-item:hover::before {
            opacity: 1;
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-info {
            padding: 20px;
        }

        .gallery-info h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #f0f0f5;
            margin-bottom: 12px;
            letter-spacing: -0.01em;
        }

        .gallery-info p {
            font-size: 0.9rem;
            color: rgba(240, 240, 245, 0.7);
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .gallery-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* FAQ Styles - Dark Glass Cards */
        .faq-item {
            background: rgba(30, 30, 45, 0.7);
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), inset 1px 1px 0 rgba(255, 255, 255, 0.08);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .faq-item:hover {
            box-shadow: 0 12px 48px rgba(74, 132, 255, 0.25), inset 1px 1px 0 rgba(255, 255, 255, 0.1);
            border-color: rgba(74, 132, 255, 0.3);
            transform: translateY(-2px);
            background: rgba(30, 30, 45, 0.8);
        }

        .faq-header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: linear-gradient(135deg, rgba(74, 132, 255, 0.1) 0%, rgba(74, 132, 255, 0.05) 100%);
            position: relative;
        }

        .faq-header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--admin-gradient-primary);
            opacity: 0.5;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .faq-item:hover .faq-header::before {
            transform: scaleX(1);
        }

        .faq-question {
            font-weight: 700;
            color: #4A84FF;
            margin-bottom: 12px;
            font-size: 1.05rem;
            letter-spacing: -0.01em;
        }

        .faq-content {
            padding: 20px 24px;
            color: rgba(240, 240, 245, 0.85);
        }

        .faq-actions {
            display: flex;
            gap: 10px;
            float: right;
        }

        /* Mobile Menu Toggle - Dark Glass */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 80px;
            left: 20px;
            z-index: 1001;
            background: var(--admin-gradient-primary);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 15px;
            cursor: pointer;
            font-size: 18px;
            box-shadow: 0 8px 30px rgba(74, 132, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .mobile-menu-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 40px rgba(74, 132, 255, 0.4);
        }

        .mobile-menu-toggle:active {
            transform: scale(0.95);
        }

        /* Dark Mode Comprehensive Styling *//* Dark mode for transport components *//* Responsive Design - Lebih Komprehensif */
        @media (max-width: 1200px) {
            .admin-content {
                margin-left: 280px;
                padding: 32px 24px;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: none;
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            }

            .admin-content {
                margin-left: 0;
                padding: 24px 20px;
                margin-top: 70px;
            }

            .admin-header {
                padding: 0 1rem;
            }

            .admin-logo {
                font-size: 1.1rem;
            }

            .admin-user span {
                padding: 6px 12px;
                font-size: 0.85rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .stat-card {
                padding: 24px 20px;
            }

            .section-header {
                padding: 20px 24px;
            }

            .section-content {
                padding: 24px;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .table {
                font-size: 0.85rem;
            }

            .table th,
            .table td {
                padding: 10px 12px;
            }

            .btn {
                padding: 12px 20px;
                font-size: 0.85rem;
            }

            .content-section h1 {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 480px) {
            .admin-header {
                padding: 0 0.75rem;
            }

            .admin-logo {
                font-size: 1rem;
            }

            .admin-user span {
                display: none;
            }

            .dark-mode-toggle {
                width: 38px;
                height: 38px;
                font-size: 14px;
            }

            .logout-btn {
                padding: 8px 12px;
                font-size: 0.8rem;
            }

            .admin-content {
                padding: 16px;
            }

            .section-content {
                padding: 20px 16px;
            }

            .section-header {
                padding: 16px 20px;
            }

            .section-header h2 {
                font-size: 1.1rem;
            }

            .btn {
                padding: 10px 16px;
                font-size: 0.8rem;
            }

            .form-group input,
            .form-group textarea,
            .form-group select {
                padding: 12px 14px;
            }

            .content-section h1 {
                font-size: 1.6rem;
            }

            .content-section > p {
                font-size: 1rem;
            }
        }

        /* Dark Mode Toggle - Dark Glass */
        .dark-mode-toggle-container {
            margin-right: 20px;
        }

        .dark-mode-toggle {
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(255, 255, 255, 0.15);
            color: #f0f0f5;
            padding: 10px 14px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 16px;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
        }

        .dark-mode-toggle:hover {
            background: rgba(74, 132, 255, 0.15);
            border-color: rgba(74, 132, 255, 0.3);
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 8px 20px rgba(74, 132, 255, 0.2);
        }@media (max-width: 768px) {
            .dark-mode-toggle-container {
                margin-right: 10px;
            }
            
            .dark-mode-toggle {
                padding: 6px 10px;
                font-size: 12px;
            }
        }

        /* ============================================
         * TRANSPORT MANAGEMENT STYLING
         * ============================================ */
        .transport-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            border-bottom: 2px solid var(--admin-border-light);
            padding-bottom: 16px;
        }

        .tab-btn {
            padding: 12px 24px;
            background: var(--admin-bg-card);
            border: 2px solid var(--admin-border);
            border-radius: 12px;
            color: var(--admin-text-primary);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
        }

        .tab-btn i {
            font-size: 1.1rem;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .tab-btn:hover i,
        .tab-btn.active i {
            opacity: 1;
            transform: scale(1.1);
        }

        .tab-btn:hover {
            background: var(--admin-bg-secondary);
            border-color: var(--admin-primary);
            transform: translateY(-2px);
        }

        .tab-btn.active {
            background: var(--admin-gradient-primary);
            color: white;
            border-color: var(--admin-primary);
            box-shadow: var(--admin-shadow-md);
        }

        .transport-tab-content {
            display: none;
        }

        .transport-tab-content.active {
            display: block;
        }

        .transport-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .transport-card {
            background: var(--admin-bg-card);
            border: 2px solid var(--admin-border);
            border-radius: 16px;
            padding: 20px;
            transition: all 0.3s ease;
            position: relative;
        }

        .transport-card:hover {
            border-color: var(--admin-primary);
            transform: translateY(-4px);
            box-shadow: var(--admin-shadow-lg);
        }

        .transport-card-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .transport-logo {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            object-fit: contain;
            background: var(--admin-bg-secondary);
            padding: 8px;
        }

        .transport-info h3 {
            margin: 0 0 4px 0;
            color: var(--admin-text-primary);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .transport-info p {
            margin: 0;
            color: var(--admin-text-secondary);
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .transport-price {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--admin-primary);
            margin: 12px 0 16px 0;
        }

        .transport-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .transport-actions .btn {
            padding: 8px 16px;
            font-size: 0.85rem;
        }

        /* Modal Styling */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background: var(--admin-bg-card);
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--admin-shadow-lg);
            border: 2px solid var(--admin-border);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 2px solid var(--admin-border-light);
            background: var(--admin-bg-secondary);
            border-radius: 14px 14px 0 0;
        }

        .modal-header h3 {
            margin: 0;
            color: var(--admin-text-primary);
            font-size: 1.3rem;
            font-weight: 600;
        }

        .modal-close {
            font-size: 24px;
            cursor: pointer;
            color: var(--admin-text-secondary);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: var(--admin-bg-main);
            color: var(--admin-danger);
        }

        .modal-body {
            padding: 24px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--admin-border-light);
        }

        /* Dark mode for transport components *//* Professional Tab Icon Styling *//* Mobile responsive icon adjustments */
        @media (max-width: 768px) {
            .tab-btn {
                gap: 8px;
            }
            
            .tab-btn i {
                font-size: 1rem;
            }
        }

        /* ============================================
         * FLASH NOTIFICATION STYLES
         * ============================================ */
        .flash-notification {
            position: fixed;
            top: 90px;
            right: 30px;
            min-width: 350px;
            max-width: 500px;
            padding: 18px 24px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            animation: slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            border: 2px solid;
        }

        .flash-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.95) 0%, rgba(5, 150, 105, 0.95) 100%);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .flash-error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.95) 0%, rgba(220, 38, 38, 0.95) 100%);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .flash-content {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .flash-content i {
            font-size: 1.4rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .flash-content span {
            font-size: 0.95rem;
            font-weight: 500;
            line-height: 1.4;
        }

        .flash-close {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .flash-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        .flash-notification.hiding {
            animation: slideOutRight 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @media (max-width: 768px) {
            .flash-notification {
                right: 15px;
                left: 15px;
                min-width: auto;
                max-width: none;
            }
        }
    </style>
</head>
<body class="admin-body">
    <!-- Notifikasi Flash Message -->
    <?php if (isset($_SESSION['admin_message'])): ?>
    <div class="flash-notification <?php echo $_SESSION['admin_message_type'] === 'success' ? 'flash-success' : 'flash-error'; ?>" id="flashNotification">
        <div class="flash-content">
            <i class="fas <?php echo $_SESSION['admin_message_type'] === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
            <span><?php echo htmlspecialchars($_SESSION['admin_message']); ?></span>
        </div>
        <button class="flash-close" onclick="closeFlashNotification()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <?php 
        unset($_SESSION['admin_message']);
        unset($_SESSION['admin_message_type']);
    ?>
    <?php endif; ?>

    <!-- Header -->
    <div class="admin-header">
        <div class="admin-logo">
            <i class="fas fa-plane-departure"></i>
            Cendana Travel Admin
        </div>
        <div class="admin-user">
            <div class="dark-mode-toggle-container">
                <button class="dark-mode-toggle" onclick="ubahModeGelap()" title="Toggle Dark Mode">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
            <span>Selamat datang, Admin</span>
            <a href="auth.php?action=logout" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <div class="sidebar admin-sidebar">
        <nav class="sidebar-nav">
            <a href="#dashboard" class="nav-link active" onclick="showSection('dashboard'); return false;">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
            <a href="#general" class="nav-link" onclick="showSection('general'); return false;">
                <i class="fas fa-cog"></i>
                General
            </a>
            <a href="#beranda" class="nav-link" onclick="showSection('beranda'); return false;">
                <i class="fas fa-image"></i>
                Kelola Beranda
            </a>
            <a href="#transportasi" class="nav-link" onclick="showSection('transportasi'); return false;">
                <i class="fas fa-plane"></i>
                Kelola Transportasi
            </a>
            <a href="#galeri" class="nav-link" onclick="showSection('galeri'); return false;">
                <i class="fas fa-images"></i>
                Galeri
            </a>
            <a href="#kontak" class="nav-link" onclick="showSection('kontak'); return false;">
                <i class="fas fa-phone"></i>
                Kontak
            </a>
            <a href="#faq" class="nav-link" onclick="showSection('faq'); return false;">
                <i class="fas fa-question-circle"></i>
                FAQ
            </a>
        </nav>
    </div>

    <!-- Mobile Menu Toggle -->
    <div class="mobile-menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <!-- ============================================ -->
        <!-- DASHBOARD SECTION -->
        <!-- ============================================ -->
        <div id="dashboard-section" class="content-section active">
            <h1>Dashboard Administrasi</h1>
            <p>Sistem manajemen terpadu CV. Cendana Travel untuk operasional dan monitoring kinerja bisnis secara real-time</p>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Layanan</h3>
                    <div class="number"><?= $stats['total_services'] ?? 0 ?></div>
                    <small>Layanan transportasi aktif</small>
                </div>
                <div class="stat-card">
                    <h3>Galeri Aktif</h3>
                    <div class="number"><?= $stats['total_gallery'] ?? 0 ?></div>
                    <small>Foto dalam galeri</small>
                </div>
                <div class="stat-card">
                    <h3>FAQ Aktif</h3>
                    <div class="number"><?= $stats['total_faq'] ?? 0 ?></div>
                    <small>Pertanyaan tersedia</small>
                </div>
                <div class="stat-card">
                    <h3>Jenis Transportasi</h3>
                    <div class="number">3</div>
                    <small>Pesawat, Kapal, Bus</small>
                </div>
            </div>
            
            <div class="section-card">
                <div class="section-header">
                    <h2>Ikhtisar Sistem Manajemen</h2>
                </div>
                <div class="section-content">
                    <p>Sistem administrasi terintegrasi dengan fitur manajemen konten lengkap untuk operasional yang efisien:</p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 24px;">
                        <div style="padding: 20px; background: var(--admin-bg-secondary); border-radius: 12px; border-left: 4px solid var(--admin-primary);">
                            <strong style="color: var(--admin-primary); display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                <i class="fas fa-cog"></i> General
                            </strong>
                            <span style="color: var(--admin-text-secondary); font-size: 0.9rem;">Kelola informasi umum perusahaan</span>
                        </div>
                        <div style="padding: 20px; background: var(--admin-bg-secondary); border-radius: 12px; border-left: 4px solid var(--admin-success);">
                            <strong style="color: var(--admin-success); display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                <i class="fas fa-image"></i> Kelola Beranda
                            </strong>
                            <span style="color: var(--admin-text-secondary); font-size: 0.9rem;">Manajemen banner dan konten utama</span>
                        </div>
                        <div style="padding: 20px; background: var(--admin-bg-secondary); border-radius: 12px; border-left: 4px solid var(--admin-warning);">
                            <strong style="color: var(--admin-warning); display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                <i class="fas fa-ticket-alt"></i> Pemesanan
                            </strong>
                            <span style="color: var(--admin-text-secondary); font-size: 0.9rem;">Monitoring dan pengelolaan reservasi</span>
                        </div>
                        <div style="padding: 20px; background: var(--admin-bg-secondary); border-radius: 12px; border-left: 4px solid var(--admin-info);">
                            <strong style="color: var(--admin-info); display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                <i class="fas fa-images"></i> Galeri
                            </strong>
                            <span style="color: var(--admin-text-secondary); font-size: 0.9rem;">Kurasi dan publikasi media visual</span>
                        </div>
                        <div style="padding: 20px; background: var(--admin-bg-secondary); border-radius: 12px; border-left: 4px solid var(--admin-danger);">
                            <strong style="color: var(--admin-danger); display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                <i class="fas fa-phone"></i> Kontak
                            </strong>
                            <span style="color: var(--admin-text-secondary); font-size: 0.9rem;">Pemeliharaan informasi komunikasi</span>
                        </div>
                        <div style="padding: 20px; background: var(--admin-bg-secondary); border-radius: 12px; border-left: 4px solid #9333ea;">
                            <strong style="color: #9333ea; display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                <i class="fas fa-question-circle"></i> FAQ
                            </strong>
                            <span style="color: var(--admin-text-secondary); font-size: 0.9rem;">Administrasi bantuan pelanggan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- GENERAL INFO SECTION -->
        <!-- ============================================ -->
        <div id="general-section" class="content-section">
            <h1>Informasi Umum Perusahaan</h1>
            <p>Kelola data perusahaan yang ditampilkan di website</p>
            
            <div class="section-card">
                <div class="section-header">
                    <h2>Edit Informasi Perusahaan</h2>
                </div>
                <div class="section-content">
                    <form method="POST">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="module" value="general">
                        
                        <div class="form-group">
                            <label>Nama Perusahaan</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($companyInfo['name'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>WhatsApp</label>
                            <input type="text" name="whatsapp" value="<?= htmlspecialchars($companyInfo['whatsapp'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" name="instagram" value="<?= htmlspecialchars($companyInfo['instagram'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($companyInfo['email'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="address" required><?= htmlspecialchars($companyInfo['address'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Jam Operasional</label>
                            <input type="text" name="hours" value="<?= htmlspecialchars($companyInfo['hours'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Deskripsi Perusahaan</label>
                            <textarea name="description" required><?= htmlspecialchars($companyInfo['description'] ?? '') ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- KELOLA BERANDA SECTION -->
        <!-- ============================================ -->
        <div id="beranda-section" class="content-section">
            <h1>Kelola Banner Beranda</h1>
            <p>Tambah, edit, atau hapus banner yang ditampilkan di halaman utama</p>
            
            <!-- Form Tambah Banner -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Tambah Banner Baru</h2>
                </div>
                <div class="section-content">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="module" value="banner">
                        
                        <div class="form-group">
                            <label>Judul Banner</label>
                            <input type="text" name="title" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Subtitle</label>
                            <textarea name="subtitle"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Gambar Banner</label>
                            <input type="file" name="image" accept="image/*" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Link URL (opsional)</label>
                            <input type="url" name="link_url">
                        </div>
                        
                        <div class="form-group">
                            <label>Urutan Tampil</label>
                            <input type="number" name="display_order" value="0" min="0">
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_active" checked> Aktif
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Banner
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Daftar Banner -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Daftar Banner</h2>
                </div>
                <div class="section-content">
                    <?php $banners = getAllBanners(); ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Urutan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($banners)): ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 2rem;">
                                    Belum ada banner. Silakan tambahkan banner pertama.
                                </td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($banners as $banner): ?>
                            <tr>
                                <td>
                                    <?php if ($banner['image'] && file_exists($banner['image'])): ?>
                                    <img src="<?= $banner['image'] ?>" alt="Banner" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                                    <?php else: ?>
                                    <div style="width: 60px; height: 40px; background: #f3f4f6; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($banner['title']) ?></strong>
                                    <?php if ($banner['subtitle']): ?>
                                    <br><small><?= truncateText($banner['subtitle'], 50) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($banner['is_active']): ?>
                                    <span class="badge badge-success">Aktif</span>
                                    <?php else: ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $banner['display_order'] ?></td>
                                <td>
                                    <button onclick="editBanner(<?= $banner['id'] ?>)" class="btn btn-secondary" style="margin-right: 0.5rem;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus banner ini?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="module" value="banner">
                                        <input type="hidden" name="id" value="<?= $banner['id'] ?>">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- ============================================ -->
        <!-- MANAJEMEN TRANSPORTASI SECTION -->
        <!-- ============================================ -->
        <div id="transportasi-section" class="content-section">
            <h1>Manajemen Layanan Transportasi</h1>
            <p>Kelola data pesawat, kapal, dan bus yang tersedia untuk pemesanan pelanggan</p>
            
            <!-- Transport Type Tabs -->
            <div class="transport-tabs" style="margin-bottom: 30px;">
                <button class="tab-btn active" data-tab="pesawat">
                    <i class="fas fa-plane"></i> Pesawat
                </button>
                <button class="tab-btn" data-tab="kapal">
                    <i class="fas fa-ship"></i> Kapal
                </button>
                <button class="tab-btn" data-tab="bus">
                    <i class="fas fa-bus"></i> Bus
                </button>
            </div>

            <!-- Pesawat Tab -->
            <div id="pesawat-tab" class="transport-tab-content active">
                <div class="section-card">
                    <div class="section-header">
                        <h2>Manajemen Data Pesawat</h2>
                        <button class="btn btn-primary" onclick="showAddTransportForm('pesawat')">
                            <i class="fas fa-plus"></i> Tambah Pesawat
                        </button>
                    </div>
                    <div class="section-content">
                        <div id="pesawat-grid" class="transport-grid">
                            <!-- Data pesawat akan dimuat di sini -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kapal Tab -->
            <div id="kapal-tab" class="transport-tab-content">
                <div class="section-card">
                    <div class="section-header">
                        <h2>Manajemen Data Kapal</h2>
                        <button class="btn btn-primary" onclick="showAddTransportForm('kapal')">
                            <i class="fas fa-plus"></i> Tambah Kapal
                        </button>
                    </div>
                    <div class="section-content">
                        <div id="kapal-grid" class="transport-grid">
                            <!-- Data kapal akan dimuat di sini -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bus Tab -->
            <div id="bus-tab" class="transport-tab-content">
                <div class="section-card">
                    <div class="section-header">
                        <h2>Manajemen Data Bus</h2>
                        <button class="btn btn-primary" onclick="showAddTransportForm('bus')">
                            <i class="fas fa-plus"></i> Tambah Bus
                        </button>
                    </div>
                    <div class="section-content">
                        <div id="bus-grid" class="transport-grid">
                            <!-- Data bus akan dimuat di sini -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Modal untuk Tambah/Edit Transport -->
            <div id="transport-modal" class="modal" style="display: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 id="modal-title">Tambah Data Transportasi</h3>
                        <span class="modal-close" onclick="closeTransportModal()">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form id="transport-form">
                            <input type="hidden" id="transport-id">
                            <input type="hidden" id="transport-type">
                            
                            <div class="form-group">
                                <label for="transport-name">Nama Transportasi</label>
                                <input type="text" id="transport-name" name="name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="transport-route">Deskripsi/Rute</label>
                                <textarea id="transport-route" name="route" rows="3" required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="transport-price">Harga</label>
                                <input type="text" id="transport-price" name="price" placeholder="Contoh: Rp 450.000 - Rp 850.000" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="transport-logo">Logo/Gambar</label>
                                <input type="file" id="transport-logo" name="logo" accept="image/*">
                                <div id="current-logo" style="margin-top: 10px;"></div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" class="btn btn-secondary" onclick="closeTransportModal()">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- GALERI SECTION -->
        <!-- ============================================ -->
        <div id="galeri-section" class="content-section">
            <h1>Kelola Galeri</h1>
            <p>Tambah, edit, atau hapus foto dalam galeri website</p>
            
            <!-- Form Tambah Galeri -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Tambah Foto Baru</h2>
                </div>
                <div class="section-content">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="module" value="gallery">
                        
                        <div class="form-group">
                            <label>Judul Foto</label>
                            <input type="text" name="title" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>File Gambar</label>
                            <input type="file" name="image" accept="image/*" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="category">
                                <option value="Umum">Umum</option>
                                <option value="Kantor">Kantor</option>
                                <option value="Fasilitas">Fasilitas</option>
                                <option value="Transportasi">Transportasi</option>
                                <option value="Tim">Tim</option>
                                <option value="Layanan">Layanan</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Urutan Tampil</label>
                            <input type="number" name="display_order" value="0" min="0">
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_featured"> Foto Unggulan
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_active" checked> Aktif
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Foto
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Daftar Galeri -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Daftar Foto Galeri</h2>
                </div>
                <div class="section-content">
                    <?php $galleries = getAllGallery(); ?>
                    <div class="gallery-grid">
                        <?php if (empty($galleries)): ?>
                        <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: #6c757d;">
                            <i class="fas fa-images" style="font-size: 3rem; margin-bottom: 15px; display: block; color: #dee2e6;"></i>
                            Belum ada foto di galeri. Silakan tambahkan foto pertama.
                        </div>
                        <?php else: ?>
                        <?php foreach ($galleries as $gallery): ?>
                        <div class="gallery-item">
                            <div style="position: relative;">
                                <?php if ($gallery['image'] && file_exists($gallery['image'])): ?>
                                <img src="<?= $gallery['image'] ?>" alt="<?= htmlspecialchars($gallery['title']) ?>">
                                <?php else: ?>
                                <div style="width: 100%; height: 180px; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="font-size: 2.5rem; color: #dee2e6;"></i>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($gallery['is_featured']): ?>
                                <span class="badge badge-warning" style="position: absolute; top: 10px; right: 10px;">
                                    <i class="fas fa-star"></i> Unggulan
                                </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="gallery-info">
                                <h4><?= htmlspecialchars($gallery['title']) ?></h4>
                                
                                <?php if ($gallery['description']): ?>
                                <p><?= truncateText($gallery['description'], 85) ?></p>
                                <?php endif; ?>
                                
                                <div class="gallery-actions">
                                    <div>
                                        <span class="badge badge-info"><?= $gallery['category'] ?></span>
                                        <?php if (!$gallery['is_active']): ?>
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div style="display: flex; gap: 5px;">
                                        <button onclick="editGallery(<?= $gallery['id'] ?>)" class="btn btn-secondary" 
                                                style="padding: 6px 10px; font-size: 0.75rem;">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="POST" style="display: inline;" 
                                              onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="module" value="gallery">
                                            <input type="hidden" name="id" value="<?= $gallery['id'] ?>">
                                            <button type="submit" class="btn btn-danger" style="padding: 6px 10px; font-size: 0.75rem;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- KONTAK SECTION -->
        <!-- ============================================ -->
        <div id="kontak-section" class="content-section">
            <h1>Informasi Kontak</h1>
            <p>Kelola informasi kontak yang ditampilkan di website</p>
            
            <div class="section-card">
                <div class="section-header">
                    <h2>Edit Informasi Kontak</h2>
                </div>
                <div class="section-content">
                    <form method="POST">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="module" value="contact">
                        
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" name="phone" value="<?= htmlspecialchars($contactInfo['phone'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>WhatsApp</label>
                            <input type="text" name="whatsapp" value="<?= htmlspecialchars($contactInfo['whatsapp'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($contactInfo['email'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="address" required><?= htmlspecialchars($contactInfo['address'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Embed Google Maps (iframe)</label>
                            <textarea name="maps_embed" style="min-height: 120px;"><?= htmlspecialchars($contactInfo['maps_embed'] ?? '') ?></textarea>
                            <small>Paste kode embed iframe dari Google Maps</small>
                        </div>
                        
                        <div class="form-group">
                            <label>Jam Operasional</label>
                            <input type="text" name="office_hours" value="<?= htmlspecialchars($contactInfo['office_hours'] ?? '') ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Facebook (opsional)</label>
                            <input type="url" name="facebook" value="<?= htmlspecialchars($contactInfo['facebook'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" name="instagram" value="<?= htmlspecialchars($contactInfo['instagram'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Twitter (opsional)</label>
                            <input type="text" name="twitter" value="<?= htmlspecialchars($contactInfo['twitter'] ?? '') ?>">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- FAQ SECTION -->
        <!-- ============================================ -->
        <div id="faq-section" class="content-section">
            <h1>Kelola FAQ</h1>
            <p>Tambah, edit, atau hapus pertanyaan yang sering ditanyakan</p>
            
            <!-- Form Tambah FAQ -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Tambah FAQ Baru</h2>
                </div>
                <div class="section-content">
                    <form method="POST">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="module" value="faq">
                        
                        <div class="form-group">
                            <label>Pertanyaan</label>
                            <textarea name="question" required placeholder="Tulis pertanyaan di sini..."></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Jawaban</label>
                            <textarea name="answer" required style="min-height: 120px;" placeholder="Tulis jawaban lengkap di sini..."></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="category">
                                <option value="Umum">Umum</option>
                                <option value="Pemesanan">Pemesanan</option>
                                <option value="Pembayaran">Pembayaran</option>
                                <option value="Pembatalan">Pembatalan</option>
                                <option value="Layanan">Layanan</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Urutan Tampil</label>
                            <input type="number" name="display_order" value="0" min="0">
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_active" checked> Aktif
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah FAQ
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Daftar FAQ -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Daftar FAQ</h2>
                </div>
                <div class="section-content">
                    <?php $faqs = getAllFAQ(); ?>
                    <?php if (empty($faqs)): ?>
                    <div style="text-align: center; padding: 3rem; color: #6c757d;">
                        <i class="fas fa-question-circle" style="font-size: 3rem; margin-bottom: 15px; display: block; color: #dee2e6;"></i>
                        Belum ada FAQ. Silakan tambahkan pertanyaan pertama.
                    </div>
                    <?php else: ?>
                    <?php foreach ($faqs as $faq): ?>
                    <div class="faq-item">
                        <div class="faq-header">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div style="flex: 1;">
                                    <div class="faq-question">
                                        <i class="fas fa-question-circle"></i>
                                        <?= htmlspecialchars($faq['question']) ?>
                                    </div>
                                    <span class="badge badge-info"><?= $faq['category'] ?></span>
                                </div>
                                
                                <div class="faq-actions">
                                    <button onclick="editFAQ(<?= $faq['id'] ?>)" class="btn btn-secondary" style="padding: 6px 10px; font-size: 0.75rem;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form method="POST" style="display: inline;" 
                                          onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="module" value="faq">
                                        <input type="hidden" name="id" value="<?= $faq['id'] ?>">
                                        <button type="submit" class="btn btn-danger" style="padding: 6px 10px; font-size: 0.75rem;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="faq-content">
                            <p style="margin: 0; color: #495057; line-height: 1.6;">
                                <i class="fas fa-reply" style="color: #667eea; margin-right: 8px;"></i>
                                <?= nl2br(htmlspecialchars($faq['answer'])) ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ============================================ -->
        <!-- KELOLA TRANSPORTASI SECTION -->
        <!-- ============================================ -->
        <div id="transportasi-section" class="content-section">
            <h1>Kelola Jenis Transportasi</h1>
            <p>Tambah, edit, atau hapus layanan transportasi (Pesawat, Kapal, Bus)</p>
            
            <!-- Form Tambah Layanan -->
            <div class="section-card">
                <div class="section-header">
                    <h2>Tambah Layanan Transportasi Baru</h2>
                </div>
                <div class="section-content">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="module" value="transport">
                        
                        <div class="form-group">
                            <label>Jenis Transportasi</label>
                            <select name="transport_type" required>
                                <option value="">-- Pilih Jenis --</option>
                                <?php foreach ($transportTypes as $type): ?>
                                <option value="<?= $type['type_key'] ?>"><?= $type['type_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Nama Layanan</label>
                            <input type="text" name="name" required placeholder="Contoh: Lion Air, KM. Kelud, Bus Pariwisata">
                        </div>
                        
                        <div class="form-group">
                            <label>Logo/Gambar</label>
                            <input type="file" name="logo" accept="image/*">
                            <small>Upload logo maskapai/operator (opsional)</small>
                        </div>
                        
                        <div class="form-group">
                            <label>Rute/Deskripsi</label>
                            <textarea name="route" required placeholder="Contoh: Penerbangan domestik terpercaya"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="price" required placeholder="Contoh: Rp 450.000 - Rp 850.000">
                        </div>
                        
                        <div class="form-group">
                            <label>Urutan Tampil</label>
                            <input type="number" name="display_order" value="0" min="0">
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_active" checked> Aktif
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Layanan
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Daftar Layanan per Jenis Transportasi -->
            <?php 
            $servicesByType = [];
            foreach ($transportServices as $service) {
                $servicesByType[$service['transport_type']][] = $service;
            }
            ?>
            
            <?php foreach ($transportTypes as $type): ?>
            <div class="section-card">
                <div class="section-header">
                    <h2><?= $type['type_name'] ?> (<?= $type['type_key'] ?>)</h2>
                </div>
                <div class="section-content">
                    <?php if (empty($servicesByType[$type['type_key']])): ?>
                    <div style="text-align: center; padding: 2rem; color: var(--admin-text-muted);">
                        <i class="fas fa-box-open" style="font-size: 3rem; margin-bottom: 15px; display: block; opacity: 0.3;"></i>
                        Belum ada layanan <?= $type['type_name'] ?>
                    </div>
                    <?php else: ?>
                    <div style="display: grid; gap: 1rem;">
                        <?php foreach ($servicesByType[$type['type_key']] as $service): ?>
                        <div style="padding: 1.25rem; background: var(--admin-bg-secondary); border-radius: 12px; border: 1px solid var(--admin-border); display: flex; align-items: center; gap: 1rem;">
                            <?php if ($service['logo']): ?>
                            <img src="<?= $service['logo'] ?>" alt="<?= $service['name'] ?>" 
                                 style="width: 60px; height: 60px; object-fit: contain; border-radius: 8px; background: white; padding: 5px;">
                            <?php else: ?>
                            <div style="width: 60px; height: 60px; background: var(--admin-primary); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                                <i class="fas fa-image"></i>
                            </div>
                            <?php endif; ?>
                            
                            <div style="flex: 1;">
                                <h4 style="margin: 0 0 0.5rem 0; color: var(--admin-text-primary); font-size: 1.1rem;">
                                    <?= htmlspecialchars($service['name']) ?>
                                    <?php if (!$service['is_active']): ?>
                                    <span class="badge badge-warning">Tidak Aktif</span>
                                    <?php endif; ?>
                                </h4>
                                <p style="margin: 0 0 0.5rem 0; color: var(--admin-text-secondary); font-size: 0.9rem;">
                                    <?= htmlspecialchars($service['route']) ?>
                                </p>
                                <strong style="color: var(--admin-success); font-size: 1rem;">
                                    <?= htmlspecialchars($service['price']) ?>
                                </strong>
                            </div>
                            
                            <div style="display: flex; gap: 0.5rem;">
                                <button onclick="editTransport(<?= $service['id'] ?>)" class="btn btn-secondary" style="padding: 8px 12px; font-size: 0.85rem;">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="module" value="transport">
                                    <input type="hidden" name="id" value="<?= $service['id'] ?>">
                                    <button type="submit" class="btn btn-danger" style="padding: 8px 12px; font-size: 0.85rem;">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
    </div>

    <!-- Mobile Menu Toggle -->
    <div class="mobile-menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>

    <script>
        // ============================================
        // JAVASCRIPT UNTUK ADMIN DASHBOARD
        // ============================================
        
        /* Enhanced Navigation Functions */
        
        // Function untuk toggle sidebar mobile
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }
        
        // Function untuk edit banner (placeholder)
        function editBanner(id) {
            // Untuk sementara pakai prompt, nanti bisa dibikin modal
            alert('Edit banner ID: ' + id + '\nFitur edit akan dibuat di form terpisah.');
        }
        
        // Function untuk edit gallery
        function editGallery(id) {
            alert('Edit galeri ID: ' + id + '\nFitur edit akan dibuat di form terpisah.');
        }
        
        // Function untuk edit FAQ
        function editFAQ(id) {
            alert('Edit FAQ ID: ' + id + '\nFitur edit akan dibuat di form terpisah.');
        }
        
        // Function untuk edit Transport
        function editTransport(id) {
            alert('Edit Transportasi ID: ' + id + '\nFitur edit akan dibuat di form terpisah.');
        }
        
        // Enhanced Mobile Menu with Overlay
        const overlay = document.createElement('div');
        overlay.className = 'mobile-overlay';
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(8px);
        `;
        document.body.appendChild(overlay);

        // Enhanced Mobile Menu Toggle
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const isActive = sidebar.classList.contains('active');
            
            if (!isActive) {
                sidebar.classList.add('active');
                overlay.style.opacity = '1';
                overlay.style.visibility = 'visible';
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.classList.remove('active');
                overlay.style.opacity = '0';
                overlay.style.visibility = 'hidden';
                document.body.style.overflow = '';
            }
        }

        // Close mobile menu when clicking overlay
        overlay.addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.remove('active');
            overlay.style.opacity = '0';
            overlay.style.visibility = 'hidden';
            document.body.style.overflow = '';
        });

        // Close mobile menu when clicking nav links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                const sidebar = document.querySelector('.sidebar');
                sidebar.classList.remove('active');
                overlay.style.opacity = '0';
                overlay.style.visibility = 'hidden';
                document.body.style.overflow = '';
            });
        });

        // Enhanced Auto-hide alerts with better animation
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transform = 'translateX(400px)';
                alert.style.opacity = '0';
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.remove();
                    }
                }, 500);
            });
        }, 4000);

        // Enhanced Dark Mode Functions
        function ubahModeGelap() {
            const body = document.body;
            const html = document.documentElement;
            const toggleBtn = document.querySelector('.dark-mode-toggle');
            const isCurrentlyDark = body.classList.contains('dark-mode');
            
            // Add loading animation
            toggleBtn.style.transform = 'scale(0.8)';
            toggleBtn.style.opacity = '0.7';
            
            // Smooth transition
            body.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
            
            setTimeout(() => {
                if (isCurrentlyDark) {
                    // Switch to light mode
                    body.classList.remove('dark-mode');
                    html.classList.remove('dark-mode');
                    localStorage.setItem('darkMode', 'false');
                    
                    const toggleIcon = document.querySelector('.dark-mode-toggle i');
                    if (toggleIcon) {
                        toggleIcon.className = 'fas fa-moon';
                    }
                } else {
                    // Switch to dark mode
                    body.classList.add('dark-mode');
                    html.classList.add('dark-mode');
                    localStorage.setItem('darkMode', 'true');
                    
                    const toggleIcon = document.querySelector('.dark-mode-toggle i');
                    if (toggleIcon) {
                        toggleIcon.className = 'fas fa-sun';
                    }
                }
                
                // Reset button animation
                setTimeout(() => {
                    toggleBtn.style.transform = 'scale(1)';
                    toggleBtn.style.opacity = '1';
                    body.style.transition = '';
                }, 100);
            }, 150);
        }

        // Enhanced Dark Mode Initialization
        function aturModeGelapSaatDimuat() {
            const savedDarkMode = localStorage.getItem('darkMode');
            const systemDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const body = document.body;
            const html = document.documentElement;
            
            // Use saved preference or system preference
            const shouldBeDark = savedDarkMode === 'true' || (savedDarkMode === null && systemDarkMode);
            
            if (shouldBeDark) {
                body.classList.add('dark-mode');
                html.classList.add('dark-mode');
                
                const toggleIcon = document.querySelector('.dark-mode-toggle i');
                if (toggleIcon) {
                    toggleIcon.className = 'fas fa-sun';
                }
            } else {
                body.classList.remove('dark-mode');
                html.classList.remove('dark-mode');
                
                const toggleIcon = document.querySelector('.dark-mode-toggle i');
                if (toggleIcon) {
                    toggleIcon.className = 'fas fa-moon';
                }
            }
        }

        // Enhanced Section Navigation with Smooth Transitions
        function showSection(sectionName) {
            const currentSection = document.querySelector('.content-section.active');
            const targetSection = document.getElementById(sectionName + '-section');
            const allNavLinks = document.querySelectorAll('.nav-link');
            
            if (!targetSection) {
                console.error('Section not found:', sectionName + '-section');
                return;
            }
            
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Show target section
            targetSection.classList.add('active');
            
            // Update navigation active state - perbaiki bug active state
            allNavLinks.forEach(link => link.classList.remove('active'));
            
            // Find and activate the correct nav link
            const activeNav = document.querySelector(`[onclick*="showSection('${sectionName}')"]`);
            if (activeNav) {
                activeNav.classList.add('active');
            }
        }

        // Add Ripple Effect to Interactive Elements
        function addRippleEffect(element) {
            element.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const ripple = document.createElement('span');
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255, 255, 255, 0.4);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple-effect 0.8s ease-out;
                    pointer-events: none;
                    z-index: 1;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    if (ripple.parentNode) {
                        ripple.remove();
                    }
                }, 800);
            });
        }

        // Enhanced Initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dark mode
            aturModeGelapSaatDimuat();
            
            // Ensure dashboard is active by default
            const dashboardSection = document.getElementById('dashboard-section');
            const dashboardNav = document.querySelector('[onclick*="showSection(\'dashboard\')"]');
            
            if (dashboardSection && !document.querySelector('.content-section.active')) {
                dashboardSection.classList.add('active');
            }
            
            if (dashboardNav && !document.querySelector('.nav-link.active')) {
                dashboardNav.classList.add('active');
            }
            
            // Add ripple effects
            document.querySelectorAll('.btn, .nav-link, .dark-mode-toggle').forEach(addRippleEffect);
            
            // Smooth page load
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Handle window resize for responsive behavior
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const sidebar = document.querySelector('.sidebar');
                sidebar.classList.remove('active');
                overlay.style.opacity = '0';
                overlay.style.visibility = 'hidden';
                document.body.style.overflow = '';
            }
        });

        // Add CSS for enhanced animations
        const enhancedStyles = document.createElement('style');
        enhancedStyles.textContent = `
            @keyframes ripple-effect {
                0% { transform: scale(0); opacity: 1; }
                100% { transform: scale(2); opacity: 0; }
            }
            
            body {
                opacity: 0;
                transition: opacity 0.6s ease, background-color 0.4s ease;
            }
            
            .alert {
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .sidebar {
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
        `;
        document.head.appendChild(enhancedStyles);

        // Initialize immediately
        aturModeGelapSaatDimuat();

        /* ============================================
         * TRANSPORT MANAGEMENT FUNCTIONS
         * ============================================ */

        // Load transport data from config.js
        let transportData = {
            pesawat: [],
            kapal: [],
            bus: []
        };

        // Load default transport data
        function loadDefaultTransportData() {
            if (typeof DATA_TRANSPORTASI_DEFAULT !== 'undefined') {
                transportData = DATA_TRANSPORTASI_DEFAULT;
            } else {
                // Fallback data if config.js not loaded
                transportData = {
                    pesawat: [
                        {
                            id: 1,
                            name: 'Lion Air',
                            logo: 'uploads/pesawat/Lionair.png',
                            route: 'Penerbangan domestik terpercaya',
                            price: 'Rp 450.000 - Rp 850.000',
                            transportType: 'pesawat'
                        },
                        {
                            id: 2,
                            name: 'Garuda Indonesia',
                            logo: 'uploads/pesawat/Garuda.png',
                            route: 'Maskapai nasional Indonesia',
                            price: 'Rp 500.000 - Rp 1.200.000',
                            transportType: 'pesawat'
                        },
                        {
                            id: 3,
                            name: 'Batik Air',
                            logo: 'uploads/pesawat/Batik.png',
                            route: 'Layanan premium dengan harga terjangkau',
                            price: 'Rp 500.000 - Rp 950.000',
                            transportType: 'pesawat'
                        }
                    ],
                    kapal: [
                        {
                            id: 9,
                            name: 'KM. Kelud',
                            logo: 'uploads/kapal/kapallaut.png',
                            route: 'Kapal penumpang antar pulau',
                            price: 'Rp 250.000 - Rp 450.000',
                            transportType: 'kapal'
                        }
                    ],
                    bus: [
                        {
                            id: 11,
                            name: 'Bus Pariwisata',
                            logo: 'uploads/bus/bus.png',
                            route: 'Bus pariwisata dengan fasilitas lengkap',
                            price: 'Rp 100.000 - Rp 250.000',
                            transportType: 'bus'
                        }
                    ]
                };
            }
        }

        // Tab switching functionality
        function switchTab(tabName) {
            // Remove active from all tabs and content
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.transport-tab-content').forEach(content => content.classList.remove('active'));
            
            // Add active to clicked tab and content
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
            document.getElementById(`${tabName}-tab`).classList.add('active');
            
            // Load data for the tab
            loadTransportData(tabName);
        }

        // Load transport data for specific type
        function loadTransportData(type) {
            const grid = document.getElementById(`${type}-grid`);
            const data = transportData[type] || [];
            
            if (data.length === 0) {
                grid.innerHTML = `
                    <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: var(--admin-text-secondary);">
                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>Belum ada data ${type}.</p>
                        <button class="btn btn-primary" onclick="showAddTransportForm('${type}')">
                            <i class="fas fa-plus"></i> Tambah ${type.charAt(0).toUpperCase() + type.slice(1)}
                        </button>
                    </div>
                `;
                return;
            }
            
            grid.innerHTML = data.map(item => `
                <div class="transport-card">
                    <div class="transport-card-header">
                        <img src="${item.logo}" alt="${item.name}" class="transport-logo" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIGZpbGw9IiNjY2MiIHZpZXdCb3g9IjAgMCAyNCAyNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDJjNS41MjIgMCAxMCA0LjQ3NyAxMCAxMHMtNC40NzggMTAtMTAgMTAtMTAtNC40NzctMTAtMTAgNC40NzgtMTAgMTAtMTB6bTAgMThhOCA4IDAgMSAwIDAtMTYgOCA4IDAgMCAwIDAgMTZ6bS0xLTEzaDJ2NmgtMnptMCA4aDJ2MmgtMnoiLz4KPHN2Zz4='">
                        <div class="transport-info">
                            <h3>${item.name}</h3>
                            <p>${item.route}</p>
                        </div>
                    </div>
                    <div class="transport-price">${item.price}</div>
                    <div class="transport-actions">
                        <button class="btn btn-sm btn-primary" onclick="editTransport('${type}', ${item.id})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteTransport('${type}', ${item.id})">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Show add/edit form
        function showAddTransportForm(type, item = null) {
            document.getElementById('transport-modal').style.display = 'flex';
            document.getElementById('transport-type').value = type;
            document.getElementById('modal-title').textContent = 
                item ? `Edit ${type.charAt(0).toUpperCase() + type.slice(1)}` : `Tambah ${type.charAt(0).toUpperCase() + type.slice(1)}`;
            
            if (item) {
                document.getElementById('transport-id').value = item.id;
                document.getElementById('transport-name').value = item.name;
                document.getElementById('transport-route').value = item.route;
                document.getElementById('transport-price').value = item.price;
                
                if (item.logo) {
                    document.getElementById('current-logo').innerHTML = `
                        <label style="font-size: 0.85rem; color: var(--admin-text-secondary);">Logo saat ini:</label>
                        <br><img src="${item.logo}" alt="Current logo" style="max-width: 100px; max-height: 60px; border-radius: 8px; margin-top: 5px;">
                    `;
                }
            } else {
                document.getElementById('transport-form').reset();
                document.getElementById('transport-id').value = '';
                document.getElementById('current-logo').innerHTML = '';
            }
        }

        // Edit transport
        function editTransport(type, id) {
            const item = transportData[type].find(item => item.id == id);
            if (item) {
                showAddTransportForm(type, item);
            }
        }

        // Delete transport
        function deleteTransport(type, id) {
            if (confirm(`Yakin ingin menghapus ${type} ini?`)) {
                transportData[type] = transportData[type].filter(item => item.id != id);
                loadTransportData(type);
                
                // Here you would save to database/localStorage
                saveTransportData();
                
                alert(`${type.charAt(0).toUpperCase() + type.slice(1)} berhasil dihapus!`);
            }
        }

        // Close modal
        function closeTransportModal() {
            document.getElementById('transport-modal').style.display = 'none';
            document.getElementById('transport-form').reset();
        }

        // Save transport data (placeholder - implement with actual backend)
        function saveTransportData() {
            // Here you would implement saving to database or localStorage
            localStorage.setItem('transportData', JSON.stringify(transportData));
            
            // Update dashboard stats
            updateDashboardStats();
        }

        // Update dashboard statistics
        function updateDashboardStats() {
            const totalServices = (transportData.pesawat?.length || 0) + 
                                (transportData.kapal?.length || 0) + 
                                (transportData.bus?.length || 0);
            
            const totalElement = document.getElementById('total-services');
            if (totalElement) {
                totalElement.textContent = totalServices;
            }
        }

        // Load transport data from storage
        function loadTransportDataFromStorage() {
            const saved = localStorage.getItem('transportData');
            if (saved) {
                transportData = JSON.parse(saved);
            } else {
                loadDefaultTransportData();
            }
        }

        // Handle form submission
        document.addEventListener('DOMContentLoaded', function() {
            // Load transport data
            loadTransportDataFromStorage();
            
            // Setup tab click handlers
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    switchTab(btn.dataset.tab);
                });
            });
            
            // Load default tab (pesawat)
            loadTransportData('pesawat');
            
            // Update dashboard stats
            updateDashboardStats();
            
            // Handle form submission
            document.getElementById('transport-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const type = document.getElementById('transport-type').value;
                const id = document.getElementById('transport-id').value;
                const name = document.getElementById('transport-name').value;
                const route = document.getElementById('transport-route').value;
                const price = document.getElementById('transport-price').value;
                const logoFile = document.getElementById('transport-logo').files[0];
                
                // Create or update item
                const item = {
                    id: id || Date.now(),
                    name: name,
                    route: route,
                    price: price,
                    transportType: type,
                    logo: logoFile ? `uploads/${type}/${logoFile.name}` : (id ? transportData[type].find(i => i.id == id)?.logo : `uploads/${type}/default.png`),
                    dateAdded: id ? transportData[type].find(i => i.id == id)?.dateAdded : new Date().toISOString().split('T')[0]
                };
                
                if (id) {
                    // Update existing
                    const index = transportData[type].findIndex(i => i.id == id);
                    if (index >= 0) {
                        transportData[type][index] = item;
                    }
                } else {
                    // Add new
                    transportData[type].push(item);
                }
                
                // Save and reload
                saveTransportData();
                loadTransportData(type);
                closeTransportModal();
                
                alert(`${type.charAt(0).toUpperCase() + type.slice(1)} berhasil ${id ? 'diperbarui' : 'ditambahkan'}!`);
            });
            
            // Close modal when clicking outside
            document.getElementById('transport-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeTransportModal();
                }
            });
        });

        /**
         * ============================================
         * FLASH NOTIFICATION FUNCTIONS
         * ============================================
         */
        function closeFlashNotification() {
            const notification = document.getElementById('flashNotification');
            if (notification) {
                notification.classList.add('hiding');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        }

        // Auto close notification after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('flashNotification');
            if (notification) {
                setTimeout(() => {
                    closeFlashNotification();
                }, 5000);
            }
        });
    </script>
</body>
</html>
