<?php 

if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
}

get_header();

while(have_posts()){
    the_post();
?>

  <div class="container container--narrow page-section">
      <h2>教会重要事工</h2>
      <hr class="section-break">
      <div  class="wrap">
          <form action="" method="post">
              <label>从日期 : </label> <input type="date" class="newfr_date" style="width:160px" name="newfr_date"> &nbsp;
              <label>至日期 : </label> <input type="date" class="newto_date" style="width:160px" name="newto_date"><br><br>
              <label>时间 : </label> <input type="text" class="newtime" style="width:180px" name="newtime"><br><br>
              <label>事工 : </label> <input type="text" class="newevent" style="width:250px" name="newevent"><br><br>
              <span class="submit-note"><i class="fa fa-pencil" aria-hidden="true"></i>添加</span>
          </form>
          
            <hr class="section-break">
          
            <table class="wp-list-table widefat striped" border="1" id="my-notes">
                <thead>
                    <tr>
                      <th>从日期</th>
		              <th>至日期</th>
                      <th>时间</th>
                      <th>事工</th>
                    </tr>
                </thead>
	            <tbody>
                    <?php
                    $events = new WP_Query(array(
                        'post_type' => 'event',
                        'posts_per_page' => -1 ,
                        'meta_key' => 'start_date',
                        'orderby' => 'meta_value',
                        'order' => 'ASC'
                    ));
                    while($events->have_posts()){
                        $events->the_post(); ?>
                        <tr data-id="<?php the_ID(); ?>">
                            <td><?php echo date_format(date_create(esc_attr(get_field('start_date'))),"Y-m-d"); ?></td>
                            <td><?php if (esc_attr(get_field('end_date'))) 
                                {echo date_format(date_create(esc_attr(get_field('end_date'))),"Y-m-d");} ?></td>
                            <td><?php echo esc_attr(get_field('time')); ?></td>
                            <td><?php echo esc_attr(get_the_content()) ?></td>
                            <td><span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i>删除</span></td>
                            <!--<td><a href='#'><button type='button'><删除</button></a></td>-->   
                            <!--<td><span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i>编辑</span>
                                <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i>删除</span></td> -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table> 
      </div>
  </div>

<?php }

get_footer();

?>