/**
 * ============================================
 * SCRIPT UNTUK HALAMAN FAQ
 * ============================================
 * Menangani fungsi search, filter kategori, dan accordion
 */

/**
 * Inisialisasi FAQ saat halaman dimuat
 */
function inisialisasiFAQ() {
    const searchInput = document.getElementById('faqSearch');
    const categoryButtons = document.querySelectorAll('.faq-category-btn');
    const faqItems = document.querySelectorAll('.faq-item');
    const noResults = document.getElementById('faqNoResults');
    const categoryGroups = document.querySelectorAll('.faq-category-group');

    // Fungsi untuk menampilkan/menyembunyikan FAQ berdasarkan pencarian dan kategori
    function filterFAQ() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const activeCategoryBtn = document.querySelector('.faq-category-btn.active');
        const activeCategory = activeCategoryBtn ? activeCategoryBtn.dataset.category : null;
        let visibleCount = 0;

        categoryGroups.forEach(group => {
            const category = group.dataset.category;
            // Hanya tampilkan kategori yang aktif (tidak ada opsi "semua")
            const matchesCategory = !activeCategory || category === activeCategory;
            
            let categoryVisible = false;
            const items = group.querySelectorAll('.faq-item');

            items.forEach(item => {
                const question = item.querySelector('.faq-question-text').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer-content p').textContent.toLowerCase();
                const matchesSearch = searchTerm === '' || question.includes(searchTerm) || answer.includes(searchTerm);
                
                if (matchesCategory && matchesSearch) {
                    item.style.display = 'block';
                    categoryVisible = true;
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Tampilkan/sembunyikan kategori berdasarkan apakah ada item yang terlihat
            group.style.display = categoryVisible ? 'block' : 'none';
        });

        // Tampilkan pesan "tidak ada hasil" jika tidak ada FAQ yang terlihat
        if (visibleCount === 0) {
            noResults.style.display = 'block';
        } else {
            noResults.style.display = 'none';
        }
    }

    // Event listener untuk search box
    if (searchInput) {
        searchInput.addEventListener('input', filterFAQ);
    }

    // Event listener untuk tombol kategori
    categoryButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Hapus class active dari semua tombol
            categoryButtons.forEach(b => b.classList.remove('active'));
            // Tambahkan class active ke tombol yang diklik
            this.classList.add('active');
            // Filter ulang FAQ
            filterFAQ();
        });
    });

    // Event listener untuk accordion (buka/tutup jawaban)
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const chevron = item.querySelector('.faq-chevron');

        question.addEventListener('click', function() {
            const isActive = item.classList.contains('active');

            // Toggle FAQ item yang diklik dengan animasi smooth
            if (isActive) {
                // Tutup item
                item.classList.remove('active');
                answer.style.maxHeight = '0px';
                chevron.classList.remove('rotated');
            } else {
                // Buka item
                item.classList.add('active');
                // Hitung tinggi konten dan tambahkan sedikit padding untuk smooth transition
                const contentHeight = answer.scrollHeight;
                answer.style.maxHeight = contentHeight + 'px';
                chevron.classList.add('rotated');
                
                // Reset maxHeight setelah transisi selesai agar responsif terhadap perubahan ukuran
                setTimeout(() => {
                    if (item.classList.contains('active')) {
                        answer.style.maxHeight = 'none';
                    }
                }, 400);
            }
        });
    });

    console.log('✅ FAQ diinisialisasi dengan sukses');
}

// Jalankan inisialisasi saat halaman selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    inisialisasiFAQ();
});

