<?php

get_header(); 
pageBanner(array(
    'title' => '近期动态'
));
?>


<div class="container container--narrow page-section">
    <?php
        while (have_posts()) {
            the_post(); ?>
            <div class="post-item">
                <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="metabox">
                    <p>由<?php the_author_posts_link(); ?>发表于<?php the_time('j.n.Y(l)'); ?>, 发表在<?php the_category(', '); ?></p>
                </div>
                
                <div class="generic-content">
                    <?php the_excerpt() ?>
                    <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">继续阅读 &raquo;</a></p>
                </div>
            </div>
        <?php }
        echo paginate_links();
    ?>
</div>

<?php get_footer();

?>