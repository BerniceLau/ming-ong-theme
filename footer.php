  <footer class="site-footer">

    <div class="site-footer__inner container container--narrow">

      <div class="group">

        <div class="site-footer__col-one">
          <h1 class="school-logo-text school-logo-text--alt-color"><a href="<?php echo site_url() ?>"><strong>民恩堂</strong></a></h1>
          <p><a class="site-footer__link" href="<?php echo get_post_type_archive_link('churchloc'); ?>"><span class="delete-note"><i class="fa fa-map-marker fa-3x" aria-hidden="true"></i></span></a></p>
        </div>
 
           
        <div class="site-footer__col-two-three-group">
          <div class="site-footer__col-two">
            <h3 class="headline headline--small">菜单</h3>
            <nav class="nav-list">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footerMenuLocationOne'
                    ));
                ?>
             <!--    
              <ul>
                <li><a href="<?php echo site_url() ?>">首页</a></li>
                <li><a href="<?php echo site_url('/民恩堂历史') ?>">教会简介</a></li>
                <li><a href="<?php echo site_url('/教会肢体') ?>">教会肢体</a></li>
                <li><a href="#">近期动态</a></li>
                <li><a href="<?php echo site_url('/联络我们') ?>">联络我们</a></li>
              </ul>
              -->
            </nav>
          </div>
            
            
          <div class="site-footer__col-three">
            <h3 class="headline headline--small">链接表</h3>
            <nav class="nav-list">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footerMenuLocationTwo'
                    ));
                ?>
            </nav>
          </div>
        </div>
        

        <div class="site-footer__col-four">
          <h3 class="headline headline--small">关注我们</h3>
          <nav>
            <ul class="min-list social-icons-list group">
              <li><a href="#" class="social-color-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <!--
                
              <li><a href="#" class="social-color-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                
              <li><a href="#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            -->
        
            </ul>
          </nav>
        </div>
      </div>

    </div>
  </footer>

<?php wp_footer(); ?>
</body>
</html>