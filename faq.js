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
        const activeCategory = document.querySelector('.faq-category-btn.active')?.dataset.category || 'all';
        let visibleCount = 0;

        categoryGroups.forEach(group => {
            const category = group.dataset.category;
            const matchesCategory = activeCategory === 'all' || category === activeCategory;
            
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

            // Tutup semua FAQ item lainnya (opsional - bisa dihapus jika ingin multiple open)
            // faqItems.forEach(otherItem => {
            //     if (otherItem !== item) {
            //         otherItem.classList.remove('active');
            //         otherItem.querySelector('.faq-answer').style.maxHeight = null;
            //         otherItem.querySelector('.faq-chevron').classList.remove('rotated');
            //     }
            // });

            // Toggle FAQ item yang diklik
            if (isActive) {
                item.classList.remove('active');
                answer.style.maxHeight = null;
                chevron.classList.remove('rotated');
            } else {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
                chevron.classList.add('rotated');
            }
        });
    });

    console.log('✅ FAQ diinisialisasi dengan sukses');
}

// Jalankan inisialisasi saat halaman selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    inisialisasiFAQ();
});

