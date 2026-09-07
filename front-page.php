<?php
get_header();

// Requête pour récupérer 1 photo aléatoire au format "Paysage" pour le Hero
$hero_args = array(
    'post_type'      => 'photo',
    'posts_per_page' => 1,
    'orderby'        => 'rand',
    'tax_query'      => array(
        array(
            'taxonomy' => 'format-photo',
            'field'    => 'slug',
            'terms'    => 'paysage',
        ),
    ),
);

$hero_query = new WP_Query($hero_args);
$hero_bg_url = '';

if ($hero_query->have_posts()) {
    while ($hero_query->have_posts()) {
        $hero_query->the_post();
        $hero_bg_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    }
    wp_reset_postdata();
}
?>

<main id="primary" class="site-main front-page">

    <!-- Section Hero -->
    <section class="hero-header" style="background-image: url('<?php echo esc_url($hero_bg_url); ?>');">
        <div class="hero-content">
            <h1>PHOTOGRAPHE EVENT</h1>
        </div>
    </section>

    <!-- Section Catalogue (Filtres + Grille) -->
   <!-- Section Catalogue (Filtres + Grille) -->
<section class="photo-catalog">
    <div class="container">

        <!-- Zone des filtres (Partie C à venir) -->
        <div class="photo-filters">
            <!-- Les dropdowns seront intégrés ici -->
        </div>

        <!-- Grille de photos -->
        <div class="photo-grid" id="photo-grid">
            <?php
            $args = array(
                'post_type'      => 'photo',
                'posts_per_page' => 8,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'paged'          => 1,
            );

            $photo_query = new WP_Query($args);

            if ($photo_query->have_posts()) :
                while ($photo_query->have_posts()) : $photo_query->the_post();
                    get_template_part('templates_part/photo_block');
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Aucune photo trouvée.</p>';
            endif;
            ?>
        </div>

        <!-- Bouton Charger plus -->
        <div class="load-more-container">
            <button id="load-more-btn" class="btn-load-more" data-page="1">Charger plus</button>
        </div>

    </div>
</section>
</main>

<?php
get_footer();