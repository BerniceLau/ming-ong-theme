<?php get_header(); ?>
<!--
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large">欢迎!</h1>
      <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
      <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
      <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
  </div>
  
  <div class="full-width-split group">
      
    <div class="full-width-split__one">
      <div class="full-width-split__main">
    
      <div class="container container--narrow page-section group">
          
          <div class="main-area">
    

  <div class="hero-slider">
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bus.jpg') ?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Free Transportation</h2>
        <p class="t-center">All students have free unlimited bus fare.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/apples.jpg') ?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">An Apple a Day</h2>
        <p class="t-center">Our dentistry program recommends eating apples.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bread.jpg')?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Free Food</h2>
        <p class="t-center">Fictional University offers lunch plans for those in need.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>
</div>


<div class="hero-slider">
      <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bus.jpg') ?>);"></div>
      <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bread.jpg')?>);"></div>
      <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg')?>);"></div>     
</div>

-->
<div class="hero-slider">
    <?php 
    
    $slideshows = new WP_Query(array(
        'post_type' => 'slideshow',
        'posts_per_page' => -1
    ));

    while($slideshows->have_posts()) {
        $slideshows->the_post();
        
        
        //if (has_post_thumbnail()) {
        //    $featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
        //}
        
        $link_image = get_field('page_banner_background_image');
        $link_text = get_field('slide_link_text');
        $link_value = get_field('slide_link_value'); ?>
    
    <div class="hero-slider__slide" style="background-image: url(<?php if ($link_image) {echo $link_image['url']; } else {echo get_theme_file_uri('/images/bus.jpg');} ?>)">

    <!--    
        
    <div class="hero-slider__slide" style="background-image: url(<?php if (has_post_thumbnail()) {echo $featured_image; } else {echo get_theme_file_uri('/images/bus.jpg');} ?>)">
        
        <div class="hero-slider__interior container">
            <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center"><?php the_title(); ?></h2>
                <p class="t-center"><?php if (has_excerpt()) {echo get_the_excerpt();} ?></p>
                <p class="t-center no-margin"><a href="<?php echo $link_value; ?>" class="btn btn--blue"><?php echo $link_text; ?></a></p>
            </div>
        </div>
        -->
    </div>
    
    <?php }
    wp_reset_postdata();
    ?>
</div>


<?php
    function getDateDay($idate) {
    
        $date = date_format(date_create($idate),"d/m/y");
        $day = date_format(date_create($idate),"w"); 
    
        switch ($day) {
            case "0":
                $day = "(日)";
                break;
            case "1":
                $day = "(一)";
                break;
            case "2":
                $day = "(二)";
                break;
            case "3":
                $day = "(三)";
                break;    
            case "4":
                $day = "(四)";
                break;
            case "5":
                $day = "(五)";
                break;
            case "6":
                $day = "(六)";
                break;
            default:
                $day = NULL;
        }
    
        return $date.$day;
    }

    function getEvenCol($fdate, $edate) {
        
        $startdate = date_format(date_create($fdate),"y/m/d");
        $today = date("y/m/d");
        $tomorrow = date("y/m/d", strtotime("tomorrow"));
        
        if ($edate) {
            $enddate = date_format(date_create($edate),"y/m/d");
            if ($startdate == $tomorrow) {
                $col = "blue";
            } else if (($startdate <= $today) && ($enddate >= $today)) {
                $col = "red";
            } else if ($enddate < $today) {
                $col = "#BEBEBE";
            } else {
                $col = "#000000";
            }
        } else {
            if ($startdate < $today) {
                $col = "#BEBEBE";
            } else if ($startdate == $today) {
                $col = "red";
            } else if ($startdate == $tomorrow) {
                $col = "blue";
            } else {
                $col = "#000000";
            }
        }
        return $col;
    }

    function getProgramCol($fdate) {
        $today = date("y/m/d");
        $tomorrow = date("y/m/d", strtotime("tomorrow"));
        $date = date_format(date_create($fdate),"y/m/d");
        
        
        if ($date < $today) {
            $col = "#BEBEBE";
        } else if ($date == $today) {
            $col = "red";
        } else if ($date == $tomorrow) {
            $col = "green";
        } else {
            $col = "#000000";
        }
        return $col;
    }

?>

<div class="container container--narrow page-section group">
    <div class="main-area">
        <?php 
        
        $argevents = array(
            'post_type' => 'event',
            'posts_per_page' => -1,
            'meta_query' => array (
                'relation' => 'OR',
                
                    array (
                        'key' => 'start_date',
                        'value' => array(date('Y-m-d', strtotime(' - 1 days')), date('Y-m-d', strtotime(' + 21 days'))),
                        'compare' => 'BETWEEN'
                    ),
                    array (
                        'key' => 'end_date',
                        'value' => date('Y-m-d', strtotime(' - 1 days')),
                        'compare' => '>='
                    ),
            ),
            'meta_key' => 'start_date',
            'orderby' => 'meta_value',
            'order' => 'ASC'
        );
            
            
        $events = new WP_Query($argevents);

        if ($events->have_posts()) { ?>
            <h2 class="headline headline--small-plus t-center">重要事工/节目</h2>
          
            <table class="churchevent">
               <thead>
                   <tr>
                       <th>日期</th>
                       <th>时间</th>
                       <th>事工</th>
                   </tr>
               </thead>
               <tbody>                
                   <?php
                    while($events->have_posts()){
                        $events->the_post(); 
                        $fontColor = getEvenCol(get_field('start_date'), get_field('end_date'));
                        //$unixstartdate = strtotime(get_field('start_date'));
                        //$unixenddate = strtotime(get_field('end_date'));
                   ?>
                        <tr>
                            <!--
                            <td><font color = <?php echo $fontColor ?>><?php echo date_i18n( "d/m/y(l)", $unixstartdate); 
                                if (esc_attr(get_field('end_date'))) { ?>
                                    -> <?php echo date_i18n( "d/m/y(l)", $unixenddate); 
                                } ?></td>
                            -->
                            <td><font color = <?php echo $fontColor ?>><?php echo getDateDay(esc_attr(get_field('start_date'))); 
                                if (esc_attr(get_field('end_date'))) { ?>
                                    -> <?php echo getDateDay(esc_attr(get_field('end_date'))); 
                                } ?></td>
                            <td><font color = <?php echo $fontColor ?>><?php echo esc_attr(get_field('time')); ?></td>
                            <td><font color = <?php echo $fontColor ?>><?php echo esc_attr(get_the_content()); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>       
            </table>
        
            <hr class="section-break">
        <?php } 
        
        wp_reset_postdata();
    
        $argprograms = array(
            'post_type' => 'program',
            'posts_per_page' => -1,
            'meta_query' => array (
                'relation' => 'AND',
                
                    'date_clause' => array (
                        'key' => 'start_date',
                        'value' => array(date('Y-m-d', strtotime(' - 1 days')), date('Y-m-d', strtotime(' + 21 days'))),
                        'compare' => 'BETWEEN',
                    ),
                    'cell_clause' => array (
                        'key' => 'cell',
                        'compare' => 'EXISTS',
                    ),
            ),
            'orderby' => array(
                'date_clause' => 'ASC',
                'cell_clause' => 'ASC',
            ),
        );
            
            
        $programs = new WP_Query($argprograms); 
        
        if ($programs->have_posts()) { ?>
        
            <h2 class="headline headline--small-plus t-center">团契聚会节目表</h2>        
            <table class="cellgroup">
                <thead>
                    <tr>
                        <th class="gcol-date">日期</th>
                        <th class="gcol-cell">肢体</th>
                        <th class="gcol-program">节目</th>
                        <th class="gcol-incharge">策划</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                    while($programs->have_posts()){
                        $programs->the_post(); 
                        $fontColor = getProgramCol(get_field('start_date'));
                        $value = esc_attr(get_field('cell'));
                        if ($value == 1) {
                            $cell = '乐龄团契';
                        } elseif ($value == 2) {
                            $cell = '妇女会';    
                        } elseif ($value == 3) {
                            $cell = '成年团契';
                        } elseif ($value == 4) {
                            $cell = '初成团契';
                        } elseif ($value == 5) {
                            $cell = '青年团契';
                        } elseif ($value == 6) {
                            $cell = '少年团契';
                        } elseif ($value == 7) {
                            $cell = '儿童团契';
                        } elseif ($value == 8) {
                            $cell = '女少年军';
                        } elseif ($value == 9) {
                            $cell = '男少年军';
                        } else {
                            $cell = '';
                        }
                   ?>
                        <tr>
                            <td><font color = <?php echo $fontColor ?>><?php echo getDateDay(esc_attr(get_field('start_date'))); ?></td>
                            <td><font color = <?php echo $fontColor ?>><?php echo $cell; ?></td>
                            <td><font color = <?php echo $fontColor ?>><?php echo esc_attr(get_the_content()); ?></td>
                            <td><font color = <?php echo $fontColor ?>><?php echo esc_attr(get_field('planner')); ?></td>
                        </tr>
                    <?php } ?>                    
                </tbody>       
            </table>
            
        <hr class="section-break">
        
        <?php } 
        
        wp_reset_postdata();
        
        $homepagePosts = new WP_Query(array(
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => 'publish_flag',
                    'value' => '1',
                )
            )
        ));
        
        if ($homepagePosts->have_posts()) { ?>
            <div class="table-bottom-padding">
                
                <h2 class="headline headline--small-plus t-center">最新动态</h2>
                    
                <?php
                while ($homepagePosts->have_posts()) {
                    $homepagePosts->the_post(); 
                    get_template_part('template-parts/content','highlight');
                }                        
                ?>
                <p class="t-center no-margin"><a href="<?php echo site_url('/近期动态'); ?>" class="btn btn--yellow">查看近期动态</a></p>
                
            </div>
        <?php } ?>
        
        <?php wp_reset_postdata(); ?>
        
    </div> <!-- main-area -->
    
    <div class="sidebar">
         <?php dynamic_sidebar('sidebar-widgets'); ?>
    </div> <!-- sidebar -->
    
</div> <!-- container -->     
  
  
<?php get_footer(); ?>