document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('contact-modal');
    
    // 1. GESTION DE LA MODALE DE CONTACT
    const contactBtns = document.querySelectorAll('a[href*="contact"], .btn-contact, .btn-modal-contact');

    if (modal) {
        contactBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                if (btn.getAttribute('href') === '#contact' || btn.innerText.toLowerCase().includes('contact') || btn.classList.contains('btn-modal-contact')) {
                    e.preventDefault();
                    
                    // Récupération de la référence photo envoyée via l'attribut data-reference
                    const photoRef = btn.getAttribute('data-reference');
                    if (photoRef) {
                        // Ciblage précis du champ ref-photo dans Contact Form 7
                        const refInput = modal.querySelector('input[name="ref-photo"]');
                        if (refInput) {
                            refInput.value = photoRef;
                        }
                    }

                    // Ouverture avec transition CSS
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.classList.add('active');
                    }, 10);
                }
            });
        });

        // Fermeture de la modale au clic à l'extérieur
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.remove('active');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        });
    }

    // 2. GESTION DE LA MINIATURE AU SURVOL DES FLÈCHES (Navigation Photo)
    const arrows = document.querySelectorAll('.nav-arrow');
    const previewContainer = document.querySelector('.nav-thumbnail-preview');

    if (arrows.length && previewContainer) {
        arrows.forEach(arrow => {
            arrow.addEventListener('mouseenter', function () {
                const targetThumbClass = this.getAttribute('data-thumb');
                const targetThumb = previewContainer.querySelector('.' + targetThumbClass);

                // Masquer toutes les miniatures
                previewContainer.querySelectorAll('.thumbnail-item').forEach(item => {
                    item.style.display = 'none';
                });

                // Afficher la bonne miniature
                if (targetThumb) {
                    targetThumb.style.display = 'block';
                    previewContainer.style.opacity = '1';
                }
            });

            arrow.addEventListener('mouseleave', function () {
                previewContainer.style.opacity = '0';
            });
        });
    }
});