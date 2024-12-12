import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('bookLoader', () => ({
    books: [],
    page: 1,
    loading: false,
    noMoreBooks: false,
    init() {
        this.fetchBooks();
        this.setupIntersectionObserver();
    },
    fetchBooks() {
        if (this.loading || this.noMoreBooks) return;
        this.loading = true;

        // get querystring search parameters
        const queryParameters = new URLSearchParams(window.location.search);
        const searchTerm = queryParameters.get('search');

        fetch(`/api/books?page=${this.page}&search=${searchTerm || ''}`)
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    this.noMoreBooks = true;
                } else {
                    this.books = [...this.books, ...data];
                    this.page++;
                }
                this.loading = false;
            });
    },
    setupIntersectionObserver() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.fetchBooks();
                }
            });
        }, {
            rootMargin: '100px',
        });
        observer.observe(this.$refs.loadMoreTrigger);
    }
}));

Alpine.start();
