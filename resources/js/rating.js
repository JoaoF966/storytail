document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const feedback = document.getElementById('rating-feedback');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = this.getAttribute('data-value');
            const bookId = document.getElementById('rating-stars').getAttribute('data-book-id');

            fetch(`/books/${bookId}/rate`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ rating }),
            })
                .then(response => response.json())
                .then(data => {
                    feedback.classList.remove('hidden');
                    feedback.innerText = data.message;

                    stars.forEach(s => {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-400');
                    });
                    for (let i = 0; i < rating; i++) {
                        stars[i].classList.add('text-yellow-400');
                    }
                })
                .catch(error => {
                    console.error('Error submitting rating:', error);
                });
        });
    });
});
