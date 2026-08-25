document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('contact-modal');
    
    // Sélectionne tous les éléments ou liens ouvrant la modale
    const contactBtns = document.querySelectorAll('a[href*="contact"], .btn-contact');

    if (modal) {
        // Ouverture de la modale
        contactBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                // Si c'est un lien du menu ou une ancre vers #contact, on annule la redirection
                if (btn.getAttribute('href') === '#contact' || btn.innerText.toLowerCase().includes('contact')) {
                    e.preventDefault();
                    modal.classList.remove('hidden');
                    // Timeout léger pour laisser le temps au CSS de lancer la transition d'opacité
                    setTimeout(() => {
                        modal.classList.add('active');
                    }, 10);
                }
            });
        });

        // Fermeture de la modale au clic à l'extérieur du contenu
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.remove('active');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300); // 300ms correspond à la durée de la transition CSS
            }
        });
    }
});