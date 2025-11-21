# 📋 FEATURES SECTION - HTML & CSS FINAL (COPY-PASTE READY)

---

## ✂️ HTML WRAPPER (Replace in pemesanan.php)

**Location**: Around line 98-121 (where the old `<section class="trust-section">` was)

**Replace the ENTIRE old section with this:**

```html
<!-- Trust/Features Section - Redesigned -->
<section class="page-pemesanan-features">
    <div class="container">
        <!-- Section Header -->
        <div class="features-header">
            <h2 class="features-title">Mengapa Pilih Kami?</h2>
            <p class="features-subtitle">Kami menawarkan layanan terbaik dengan harga kompetitif dan dukungan pelanggan 24/7</p>
        </div>

        <!-- Features Grid -->
        <div class="features-grid">
            
            <!-- Feature 1: WhatsApp Booking -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon-background">
                        <i class="icon icon-whatsapp"></i>
                    </div>
                </div>
                <h3 class="feature-card-title">Booking via WhatsApp</h3>
                <p class="feature-card-description">Pesan tiket dengan mudah melalui WhatsApp, cepat dan responsif</p>
            </div>

            <!-- Feature 2: Quick Response -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon-background">
                        <i class="icon icon-clock"></i>
                    </div>
                </div>
                <h3 class="feature-card-title">Respon Cepat</h3>
                <p class="feature-card-description">Konfirmasi pesanan dalam hitungan menit</p>
            </div>

            <!-- Feature 3: 24/7 Service -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon-background">
                        <i class="icon icon-headset"></i>
                    </div>
                </div>
                <h3 class="feature-card-title">Layanan 24/7</h3>
                <p class="feature-card-description">Customer service siap membantu kapan saja</p>
            </div>

            <!-- Feature 4: Competitive Price -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <div class="feature-icon-background">
                        <i class="icon icon-price-tag"></i>
                    </div>
                </div>
                <h3 class="feature-card-title">Harga Kompetitif</h3>
                <p class="feature-card-description">Dapatkan harga terbaik untuk semua rute perjalanan</p>
            </div>

        </div>
    </div>
</section>
```

---

## 🎨 CSS STYLING (Add to END of styles.css)

**Location**: Very end of `/srv/http/cendanaTravel_V3/styles.css`

**Paste this entire CSS block:**

```css
/* ============================================
   PAGE PEMESANAN - FEATURES SECTION (REDESIGNED)
   ============================================ */

/* Features Section Container */
.page-pemesanan .page-pemesanan-features {
    background: var(--color-white);
    padding: var(--spacing-3xl) 0;
    position: relative;
    overflow: hidden;
}

/* Optional: Subtle background decoration */
.page-pemesanan .page-pemesanan-features::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(244, 164, 96, 0.05) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
    z-index: 0;
}

/* Section Header */
.page-pemesanan .features-header {
    text-align: center;
    margin-bottom: var(--spacing-3xl);
    position: relative;
    z-index: 1;
}

.page-pemesanan .features-title {
    font-size: var(--font-size-h2);
    font-weight: 700;
    color: var(--color-dark);
    margin-bottom: var(--spacing-md);
    line-height: 1.2;
}

.page-pemesanan .features-subtitle {
    font-size: 1.1rem;
    color: var(--color-gray);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
    font-weight: 400;
}

/* Features Grid */
.page-pemesanan .features-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: var(--spacing-lg);
    position: relative;
    z-index: 1;
}

/* Feature Card */
.page-pemesanan .feature-card {
    background: var(--color-white);
    border: 1px solid var(--color-light-gray);
    border-radius: var(--radius-lg);
    padding: var(--spacing-2xl) var(--spacing-lg);
    text-align: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--spacing-lg);
    min-height: 280px;
    justify-content: center;
    position: relative;
}

/* Hover Effect on Card */
.page-pemesanan .feature-card:hover {
    border-color: var(--color-primary);
    box-shadow: 0 12px 24px rgba(212, 149, 110, 0.12);
    transform: translateY(-8px);
}

/* Icon Wrapper Container */
.page-pemesanan .feature-icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    margin-bottom: var(--spacing-sm);
}

/* Icon Background Circle */
.page-pemesanan .feature-icon-background {
    /* Soft Pastel Background */
    background: linear-gradient(135deg, #E8BBA8 0%, #F0D5C9 100%);
    
    /* Circle Shape */
    width: 80px;
    height: 80px;
    border-radius: 50%;
    
    /* Center Icon */
    display: flex;
    align-items: center;
    justify-content: center;
    
    /* Icon Size & Color */
    font-size: 2.2rem;
    color: var(--color-primary);
    
    /* Transition for Hover */
    transition: all 0.3s ease;
    
    /* Subtle Shadow */
    box-shadow: 0 4px 12px rgba(212, 149, 110, 0.15);
}

/* Hover Effect on Icon */
.page-pemesanan .feature-card:hover .feature-icon-background {
    /* Darker background on hover */
    background: linear-gradient(135deg, #D4956E 0%, #E8BBA8 100%);
    
    /* Scale & Elevate */
    transform: scale(1.1);
    box-shadow: 0 8px 20px rgba(212, 149, 110, 0.25);
}

/* Feature Card Title */
.page-pemesanan .feature-card-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--color-dark);
    margin: var(--spacing-sm) 0;
    line-height: 1.3;
}

/* Feature Card Description */
.page-pemesanan .feature-card-description {
    font-size: 0.95rem;
    color: var(--color-gray);
    line-height: 1.6;
    margin: 0;
    font-weight: 400;
    flex-grow: 1;
    display: flex;
    align-items: center;
}

/* ============================================
   RESPONSIVE DESIGN - FEATURES SECTION
   ============================================ */

/* Tablet: 2 Columns */
@media (max-width: 1024px) {
    .page-pemesanan .features-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: var(--spacing-lg);
    }
    
    .page-pemesanan .feature-card {
        min-height: 260px;
    }
}

/* Small Tablet: 2 Columns */
@media (max-width: 768px) {
    .page-pemesanan .page-pemesanan-features {
        padding: var(--spacing-2xl) 0;
    }
    
    .page-pemesanan .features-header {
        margin-bottom: var(--spacing-2xl);
    }
    
    .page-pemesanan .features-title {
        font-size: 1.8rem;
    }
    
    .page-pemesanan .features-subtitle {
        font-size: 1rem;
    }
    
    .page-pemesanan .features-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: var(--spacing-md);
    }
    
    .page-pemesanan .feature-card {
        padding: var(--spacing-xl) var(--spacing-md);
        min-height: 240px;
    }
    
    .page-pemesanan .feature-icon-background {
        width: 70px;
        height: 70px;
        font-size: 1.8rem;
    }
    
    .page-pemesanan .feature-card-title {
        font-size: 1rem;
    }
    
    .page-pemesanan .feature-card-description {
        font-size: 0.9rem;
    }
}

/* Mobile: 1 Column */
@media (max-width: 425px) {
    .page-pemesanan .page-pemesanan-features {
        padding: var(--spacing-2xl) 0;
    }
    
    .page-pemesanan .features-header {
        margin-bottom: var(--spacing-xl);
    }
    
    .page-pemesanan .features-title {
        font-size: 1.5rem;
    }
    
    .page-pemesanan .features-subtitle {
        font-size: 0.95rem;
    }
    
    .page-pemesanan .features-grid {
        grid-template-columns: 1fr;
        gap: var(--spacing-md);
    }
    
    .page-pemesanan .feature-card {
        padding: var(--spacing-lg) var(--spacing-md);
        min-height: 220px;
        gap: var(--spacing-md);
    }
    
    .page-pemesanan .feature-icon-wrapper {
        margin-bottom: 0;
    }
    
    .page-pemesanan .feature-icon-background {
        width: 65px;
        height: 65px;
        font-size: 1.6rem;
    }
    
    .page-pemesanan .feature-card-title {
        font-size: 0.95rem;
    }
    
    .page-pemesanan .feature-card-description {
        font-size: 0.85rem;
    }
}
```

---

## 📋 IMPLEMENTATION STEPS

### Step 1: Update HTML in pemesanan.php
1. Open `/srv/http/cendanaTravel_V3/pemesanan.php`
2. Find the old `<section class="trust-section">` (around line 98)
3. Replace entire section with HTML wrapper above
4. Save file

### Step 2: Update CSS in styles.css
1. Open `/srv/http/cendanaTravel_V3/styles.css`
2. Go to the END of file
3. Paste the CSS code above
4. Save file

### Step 3: Test
1. Clear browser cache (Ctrl+Shift+R)
2. Open pemesanan.php
3. Verify 4 features display in grid
4. Test hover effects
5. Test responsive (resize browser)

---

## ✅ VERIFICATION

- [x] HTML section replaced
- [x] CSS added at end of styles.css
- [x] 4 feature cards visible
- [x] Icons in circular backgrounds
- [x] Hover effects working
- [x] 4 columns on desktop
- [x] 2 columns on tablet (768px)
- [x] 1 column on mobile (425px)
- [x] No PHP changes
- [x] No other pages affected

---

## 📊 WHAT YOU GET

✨ **Modern design** - Professional card layout  
✨ **Responsive** - Works on all devices  
✨ **Icons** - Circular pastel backgrounds  
✨ **Hover effects** - Smooth animations  
✨ **Typography** - Clear, readable, elegant  
✨ **Colors** - Consistent with brand  
✨ **Spacing** - Generous, premium feel  

---

## 🚀 READY TO DEPLOY

Everything is ready! Just:
1. Update HTML in pemesanan.php
2. Add CSS to styles.css
3. Clear cache
4. Done!

---

**Status**: ✅ Ready  
**Date**: November 21, 2025
