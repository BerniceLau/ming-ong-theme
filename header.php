<!DOCTYPE html>

<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header class="site-header">
            <div class="container">
                
              <h1 class="school-logo-text float-left"><a href="<?php echo site_url() ?>"><strong>民恩堂</strong> </a></h1>
              <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
              <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
              <div class="site-header__menu group">
                <nav class="main-navigation">
                    <!--
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'headerMenuLocation'
                        ));
                    ?>
                    -->
                  <ul>
                    <li <?php if (is_page('首页')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url() ?>">首页</a></li>
                    <li <?php if (is_page('教会历史')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/教会历史') ?>">教会历史</a></li>
                    <li <?php if (is_page('教会肢体') or wp_get_post_parent_id(0) == 16) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/教会肢体') ?>">教会肢体</a></li>
                    <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/近期动态') ?>">近期动态</a></li>
                    <li <?php if (is_page('联络我们')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/联络我们') ?>">联络我们</a></li>
                    <li <?php if (get_post_type() == 'churchloc') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('churchloc'); ?>">教堂位置</a></li>
                  </ul>
                </nav>
                  
                
                <div class="site-header__util">
                  <?php if(is_user_logged_in()) { ?>
                    <a href="<?php echo esc_url(site_url('/近期事工')); ?>" class="btn btn--small btn--orange float-left push-right">近期事工</a>
                    <a href="<?php echo esc_url(site_url('/团契聚会')); ?>" class="btn btn--small btn--orange float-left push-right">团契聚会</a>
                    <a href="<?php echo wp_logout_url(); ?>" class="btn btn--small  btn--dark-orange float-left btn--with-photo">
                        <span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60); ?></span>
                        <span class="btn__text">Log Out</span>
                    </a>
                  <?php } else { ?>
                    <a href="<?php echo wp_login_url();?>" class="btn btn--small btn--orange float-left push-right">Login</a>
                  <?php } ?>
                    
                  <!--
                    <a href="#" class="btn btn--small  btn--dark-orange float-left">Sign Up</a>
                    <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
                  -->
                    
                </div>
                
              </div>
            </div>
        </header>