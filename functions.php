<?php

// Supports du thème
function mota_supports() {
    // Gestion automatique de la balise <title>
    add_theme_support('title-tag');
    
    // Support des images à la une
    add_theme_support('post-thumbnails');
    
    // Support du logo personnalisé dans l'admin
    add_theme_support('custom-logo');
    
    // Enregistrement des emplacements de menus
    register_nav_menus(array(
        'main-menu'   => __('Menu Principal', 'nathalie-mota'),
        'footer-menu' => __('Menu Pied de Page', 'nathalie-mota'),
    ));
}
add_action('after_setup_theme', 'mota_supports');

// Chargement des scripts et styles via wp_enqueue
function mota_register_assets() {
    // Polices Google Fonts (Space Mono et Poppins)
    wp_enqueue_style(
        'google-fonts', 
        'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,300&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap', 
        array(), 
        null
    );

    // Style principal du thème
    wp_enqueue_style(
        'mota-style', 
        get_stylesheet_uri(), 
        array('google-fonts'), 
        '1.0'
    );

    // Script JS personnalisé pour la modale
    wp_enqueue_script(
        'mota-scripts', 
        get_template_directory_uri() . '/js/scripts.js', 
        array('jquery'), 
        '1.0', 
        true // Chargé en bas de page (footer)
    );
}
add_action('wp_enqueue_scripts', 'mota_register_assets');