<?php get_header();

 while(have_posts()){
    the_post(); 
    pageBanner();
     
?>
    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
                <p><a class="metabox__blog-home-link" href="<?php echo site_url('/近期动态'); ?>"><i class="fa fa-home" aria-hidden="true"></i> 近期动态 </a> <span class="metabox__main">由<?php the_author_posts_link(); ?>发表于<?php the_time('j.n.Y(l)'); ?>, 发表在<?php the_category(', '); ?></span></p>
        </div>
        <div class="generic-content">
            <?php the_content(); ?>
        </div>
    </div>
<?php }

get_footer();
?>