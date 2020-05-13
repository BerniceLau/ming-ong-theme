<?php

get_header(); ?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">所有成年团契档案</h1>
      <div class="page-banner__intro">
        <p><?php the_archive_description(); ?></p>
      </div>
    </div>  
</div>

<div class="container container--narrow page-section">
    <?php
        while (have_posts()) {
            the_post(); 
            get_template_part('template-parts/content','event');
        }
        echo paginate_links();
    ?>
    
    <hr class="section-break">
    
    <P><a href="<?php echo site_url('/旧节目')?>">旧节目档案</a></P>
</div>

<?php get_footer();

?>