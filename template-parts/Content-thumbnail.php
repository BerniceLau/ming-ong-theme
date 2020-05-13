<li class="cell-card__list-item">
    <a class="cell-card" href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()) { ?>
                <img class="cell-card__image" src="<?php the_post_thumbnail_url('landscapeImage') ?>">
        <?php } else { ?>
                <img class="cell-card__image" src="<?php bloginfo('template_directory'); ?>/images/NoImage.jpg">
        <?php } ?>
                <span class="cell-card__name"><?php the_title(); ?></span>
    </a> 
</li> 