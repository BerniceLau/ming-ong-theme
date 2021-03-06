<?php get_header();

while(have_posts()){
    the_post(); 
    pageBanner();
?>

<div class="container container--narrow page-section">
      
    <?php
        $theParent = wp_get_post_parent_id(get_the_ID());
        if ($theParent) { ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> 返回 <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
            </div>
        <?php }
    
    $testArray = get_pages(array(
        'child_of' => get_the_ID()
    ));
    if ($theParent or $testArray) { ?> 
        <div class="page-links">
            <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent)?></a></h2>
            <ul class="min-list">
                <?php
        
                if ($theParent) {
                    $findChildrenOf = $theParent;
                } else {
                    $findChildrenOf = get_the_ID();
                } 
            
                wp_list_pages(array(
                    'title_li' => NULL,
                    'child_of' =>  $findChildrenOf,
                    'sort_column' => 'menu_order'
                ));
                                   
                ?>
            </ul>
        </div>
    <?php } ?>
      
    <div class="generic-content">
      <?php 
      the_content(); 
      
      $evenPosts = new WP_Query(array(
                'posts_per_page' => -1,
                'post_type' => 'myaf',
                'orderby' => 'post_date',
                'order' => 'DESC',
                'meta_query' => array(
                    array(
                        'key' => 'publish_flag',
                        'value' => '1',
                    )
                )
            ));
    
        if($evenPosts->have_posts()) { ?>    
            <hr class="section-break">
            <ul class="cell-cards">
                <?php
                while($evenPosts->have_posts()) {
                $evenPosts->the_post(); 
                get_template_part('template-parts/content','thumbnail');
                } ?>    
            </ul>
        <?php } ?> 
    </div>  
</div> <!--container-->

<?php }

get_footer();

?>