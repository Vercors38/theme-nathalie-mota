<div class="related-photo-item">
    <a href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium_large'); ?>
        <?php endif; ?>
    </a>
</div>