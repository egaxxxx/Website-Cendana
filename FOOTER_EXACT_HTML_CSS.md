# 📋 FOOTER PREMIUM - EXACT HTML & CSS

---

## 🟢 NEW HTML FOOTER

Ganti seluruh footer section di index.php dengan kode berikut:

```html
    <!-- Footer Premium -->
    <footer class="footer-premium">
        <div class="container">
            <!-- Main Grid: 4 Kolom -->
            <div class="footer-grid-premium">
                
                <!-- KOLOM 1: Tentang Kami -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Tentang Kami</h3>
                    <div class="footer-separator-premium"></div>
                    <p class="footer-text-premium">
                        <?php echo htmlspecialchars($companyInfoData['description']); ?>
                    </p>
                    <div class="footer-hours-box">
                        <p class="footer-label-premium">Jam Operasional:</p>
                        <p class="footer-text-premium">
                            <?php echo htmlspecialchars($companyInfoData['hours']); ?>
                        </p>
                    </div>
                </section>

                <!-- KOLOM 2: Menu Cepat -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Menu Cepat</h3>
                    <div class="footer-separator-premium"></div>
                    <ul class="footer-links-premium">
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="pemesanan.php">Pemesanan</a></li>
                        <li><a href="galeri.php">Galeri</a></li>
                        <li><a href="kontak.php">Kontak</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                    </ul>
                </section>

                <!-- KOLOM 3: Layanan Kami -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Layanan Kami</h3>
                    <div class="footer-separator-premium"></div>
                    <ul class="footer-links-premium">
                        <li><a href="pemesanan.php">Tiket Pesawat</a></li>
                        <li><a href="pemesanan.php">Tiket Kapal</a></li>
                        <li><a href="pemesanan.php">Tiket Bus</a></li>
                    </ul>
                </section>

                <!-- KOLOM 4: Hubungi Kami -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Hubungi Kami</h3>
                    <div class="footer-separator-premium"></div>
                    <div class="footer-contact-item">
                        <p class="footer-label-premium">WhatsApp:</p>
                        <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" class="footer-link-contact">
                            <?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>
                        </a>
                    </div>
                    <div class="footer-contact-item">
                        <p class="footer-label-premium">Email:</p>
                        <a href="mailto:<?php echo htmlspecialchars($companyInfoData['email']); ?>" class="footer-link-contact">
                            <?php echo htmlspecialchars($companyInfoData['email']); ?>
                        </a>
                    </div>
                    <div class="footer-contact-item">
                        <p class="footer-label-premium">Alamat:</p>
                        <p class="footer-text-premium footer-address">
                            <?php echo $companyInfoData['address']; ?>
                        </p>
                    </div>
                </section>

            </div>

            <!-- Footer Bottom: Copyright -->
            <div class="footer-bottom-premium">
                <p class="footer-copyright-premium">
                    &copy; 2024 <?php echo htmlspecialchars($companyInfoData['name']); ?>. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
```

---

## 🟢 NEW CSS STYLING

Tambahkan atau ganti footer CSS di styles.css dengan kode berikut:

```css
/* ============================================
   FOOTER PREMIUM PASTEL - NEW DESIGN
   ============================================ */

/* Main Footer Container */
.footer-premium {
    background: linear-gradient(135deg, #2a1f1a 0%, #3d2f27 50%, #2a1f1a 100%);
    color: rgba(255, 255, 255, 0.85);
    padding: 4rem 0 2rem;
    position: relative;
    overflow: hidden;
    border-top: 1px solid rgba(215, 165, 122, 0.2);
}

/* Decorative background element */
.footer-premium::before {
    content: '';
    position: absolute;
    top: 0;
    right: -50%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(212, 149, 110, 0.03) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
    z-index: 0;
}

/* Grid Layout - 4 Columns */
.footer-grid-premium {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 3rem;
    margin-bottom: 3rem;
    position: relative;
    z-index: 1;
}

/* Section Container */
.footer-section-premium {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* Section Heading */
.footer-heading-premium {
    font-size: 1.15rem;
    font-weight: 700;
    color: rgba(255, 255, 255, 0.95);
    margin: 0;
    letter-spacing: 0.5px;
}

/* Decorative Separator */
.footer-separator-premium {
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, #d7a57a 0%, rgba(215, 165, 122, 0.2) 100%);
    border-radius: 2px;
    margin: 0.5rem 0;
}

/* Body Text */
.footer-text-premium {
    font-size: 0.95rem;
    line-height: 1.7;
    color: rgba(255, 255, 255, 0.80);
    margin: 0;
}

/* Label Text */
.footer-label-premium {
    font-size: 0.9rem;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.90);
    margin: 0 0 0.5rem 0;
}

/* Address Text */
.footer-address {
    color: rgba(255, 255, 255, 0.75);
    font-size: 0.9rem;
    line-height: 1.6;
}

/* Links List */
.footer-links-premium {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
}

/* Link Items */
.footer-links-premium a {
    color: rgba(255, 255, 255, 0.80);
    text-decoration: none;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    display: inline-block;
    position: relative;
}

/* Link Underline Animation */
.footer-links-premium a::before {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #d7a57a 0%, transparent 100%);
    transition: width 0.3s ease;
}

.footer-links-premium a:hover {
    color: rgba(215, 165, 122, 0.95);
}

.footer-links-premium a:hover::before {
    width: 30px;
}

/* Contact Links */
.footer-link-contact {
    color: rgba(215, 165, 122, 0.90);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.footer-link-contact:hover {
    color: #d7a57a;
    transform: translateX(4px);
}

/* Contact Item */
.footer-contact-item {
    margin-bottom: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
}

/* Operating Hours Box */
.footer-hours-box {
    background: rgba(215, 165, 122, 0.08);
    padding: 1rem;
    border-radius: 0.5rem;
    border-left: 3px solid rgba(215, 165, 122, 0.4);
    margin-top: 0.5rem;
}

.footer-hours-box p {
    margin: 0;
    font-size: 0.9rem;
    line-height: 1.6;
}

/* Footer Bottom */
.footer-bottom-premium {
    border-top: 1px solid rgba(215, 165, 122, 0.15);
    padding-top: 2rem;
    text-align: center;
    position: relative;
    z-index: 1;
}

.footer-copyright-premium {
    color: rgba(255, 255, 255, 0.65);
    font-size: 0.9rem;
    margin: 0;
}

/* ============================================
   FOOTER RESPONSIVE DESIGN
   ============================================ */

/* Tablet - 2 Columns */
@media (max-width: 1024px) {
    .footer-grid-premium {
        grid-template-columns: repeat(2, 1fr);
        gap: 2.5rem;
        margin-bottom: 2.5rem;
    }
}

/* Mobile Tablet - 1 Column */
@media (max-width: 768px) {
    .footer-premium {
        padding: 3rem 0 1.5rem;
    }

    .footer-grid-premium {
        grid-template-columns: 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .footer-heading-premium {
        font-size: 1.05rem;
    }

    .footer-text-premium {
        font-size: 0.9rem;
    }

    .footer-label-premium {
        font-size: 0.85rem;
    }

    .footer-hours-box {
        padding: 0.75rem;
    }
}

/* Mobile Extra Small */
@media (max-width: 425px) {
    .footer-premium {
        padding: 2rem 0 1rem;
    }

    .footer-grid-premium {
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .footer-heading-premium {
        font-size: 1rem;
    }

    .footer-text-premium {
        font-size: 0.85rem;
    }

    .footer-label-premium {
        font-size: 0.8rem;
    }

    .footer-copyright-premium {
        font-size: 0.8rem;
    }

    .footer-separator-premium {
        width: 30px;
    }
}
```

---

## ✅ IMPLEMENTATION STEPS

### STEP 1: Backup Current Footer

1. Open `index.php`
2. Find `<!-- Footer -->` section (around line 430)
3. Copy the current footer code (backup)

### STEP 2: Replace HTML

1. Find the entire `<footer>...</footer>` block in index.php
2. Delete the old footer HTML
3. Paste the NEW HTML FOOTER code above

**Important**: Keep all PHP data inside the new footer intact!

### STEP 3: Add/Replace CSS

1. Open `styles.css`
2. Find the old footer CSS (around line 2484)
3. Replace the entire footer section with NEW CSS above
4. Or add NEW CSS at end of file (recommended)

### STEP 4: Test

1. Clear browser cache: `Ctrl+Shift+R`
2. Reload index.php
3. Scroll to footer
4. Verify:
   - ✅ Footer has warm dark-brown color
   - ✅ 4 columns visible (desktop)
   - ✅ Text is soft white, not bright
   - ✅ Separator lines visible
   - ✅ Hover effects work (links highlight)
   - ✅ Responsive works (resize to mobile)

---

## 🎨 COLOR REFERENCE

| Element | Hex/RGBA |
|---------|----------|
| Background | #2a1f1a |
| Gradient | #3d2f27 |
| Heading | rgba(255,255,255,0.95) |
| Text | rgba(255,255,255,0.80) |
| Label | rgba(255,255,255,0.90) |
| Separator | #d7a57a |
| Hover | rgba(215,165,122,0.95) |
| Border | rgba(215,165,122,0.2) |

---

## 📱 LAYOUT RESPONSIVE

| Screen | Layout | Columns |
|--------|--------|---------|
| Desktop | Grid | 4 |
| Tablet | Grid | 2 |
| Mobile | Stack | 1 |

---

## ✨ KEY IMPROVEMENTS

✅ **Warm Color Palette** - Matches pastel theme  
✅ **Better Typography** - Soft white, better readability  
✅ **Elegant Separators** - Gradient lines add premium feel  
✅ **Improved Spacing** - More generous padding  
✅ **Smooth Hover** - Underline animation on links  
✅ **Contact Box** - Visual hierarchy for info  
✅ **Fully Responsive** - Works on all devices  

---

**Ready to Implement!** ✅

