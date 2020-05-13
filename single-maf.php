<?php get_header();

 while(have_posts()){
    the_post(); 
    pageBanner();
     
?>
    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
                <p><a class="metabox__blog-home-link" href="<?php echo site_url('/教会肢体/成年团契'); ?>"><i class="fa fa-home" aria-hidden="true"></i> 返回成年团契 </a> <span class="metabox__main">发表于<?php the_time('j.n.Y(l)');?></span></p>
        </div>
        <div class="generic-content">
            <div class="row group">
                <div class="one-third">
                    <?php the_post_thumbnail('protraitImage'); ?>
                </div>
                <div class="two-thirds">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
<?php }

get_footer();
?>