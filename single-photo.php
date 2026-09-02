<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        // Récupération des custom fields
        $reference = get_field('reference');
        $type      = get_field('type');

        // Récupération des taxonomies
        $categories = get_the_terms(get_the_ID(), 'categorie-photo');
        $formats    = get_the_terms(get_the_ID(), 'format-photo');
        
        $categorie_name = $categories ? $categories[0]->name : '';
        $format_name    = $formats ? $formats[0]->name : '';

        // Navigation : photo précédente et suivante
        $next_post = get_next_post();
        $prev_post = get_previous_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('single-photo-container'); ?>>
            <div class="photo-info">
                <h2><?php the_title(); ?></h2>
                <p>RÉFÉRENCE : <span id="photo-ref"><?php echo esc_html($reference); ?></span></p>
                <p>CATÉGORIE : <?php echo esc_html($categorie_name); ?></p>
                <p>FORMAT : <?php echo esc_html($format_name); ?></p>
                <p>TYPE : <?php echo esc_html($type); ?></p>
                <p>ANNÉE : <?php echo get_the_date('Y'); ?></p>
            </div>

            <div class="photo-display">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                <?php endif; ?>
            </div>
        </article>

        <!-- Section Contact & Navigation -->
        <section class="single-photo-contact-nav">
            <div class="single-photo-contact">
                <p>Cette photo vous intéresse ?</p>
                <button class="btn-contact-photo btn-modal-contact" data-reference="<?php echo esc_attr($reference); ?>">Contact</button>
            </div>

            <div class="single-photo-navigation">
                <!-- Zone de prévisualisation miniature -->
                <div class="nav-thumbnail-preview">
                    <?php if ($prev_post) : ?>
                        <div class="thumbnail-item prev-thumb">
                            <?php echo get_the_post_thumbnail($prev_post->ID, 'thumbnail'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($next_post) : ?>
                        <div class="thumbnail-item next-thumb">
                            <?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Flèches de navigation -->
                <div class="nav-arrows">
                    <?php if ($prev_post) : ?>
                        <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-arrow nav-prev" data-thumb="prev-thumb">←</a>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                        <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-arrow nav-next" data-thumb="next-thumb">→</a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Section Photos Apparentées -->
        <?php
        if ($categories) :
            $cat_id = $categories[0]->term_id;
            
            // 1. Recherche dans la même catégorie
            $related_args = array(
                'post_type'      => 'photo',
                'posts_per_page' => 2,
                'post__not_in'   => array(get_the_ID()),
                'orderby'        => 'rand',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'categorie-photo',
                        'field'    => 'term_id',
                        'terms'    => $cat_id,
                    ),
                ),
            );

            $related_query = new WP_Query($related_args);

            // 2. Fallback si pas assez de photos dans cette catégorie
            if (!$related_query->have_posts()) {
                $related_args = array(
                    'post_type'      => 'photo',
                    'posts_per_page' => 2,
                    'post__not_in'   => array(get_the_ID()),
                    'orderby'        => 'rand',
                );
                $related_query = new WP_Query($related_args);
            }

            if ($related_query->have_posts()) : ?>
                <section class="related-photos-section">
                    <h3>VOUS AIMEREZ AUSSI</h3>
                    <div class="related-photos-grid">
                        <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                            <div class="related-photo-item">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium_large'); ?>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </section>
                <?php
                wp_reset_postdata();
            endif;
        endif;

    endwhile;
endif;

get_footer();