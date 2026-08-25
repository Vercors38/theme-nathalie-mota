<footer id="site-footer" class="site-footer">
    <div class="footer-container">
        <!-- Menu Footer (Mentions légales, Vie privée...) -->
        <nav class="footer-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'container'      => false,
                'menu_class'     => 'footer-links',
            ));
            ?>
        </nav>
        <div class="copyright">
            <p>TOUS DROITS RÉSERVÉS</p>
        </div>
    </div>
</footer>

<?php 
// Appels obligatoires : la modale et la fonction wp_footer() pour charger les JS
get_template_part('templates_part/modal-contact'); 
wp_footer(); 
?>
</body>
</html>