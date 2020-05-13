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
      <h2>团契聚会节目</h2>
      <hr class="section-break">
      <div  class="wrap">
          <form action="" method="post">
              <label>日期 : </label> <input type="date" class="newdate" style="width:160px" name="newdate" ><br><br>
              <label>肢体 : </label>
              <select class="newcell" style="width:100px">
                  <option value=""></option>
                  <option value="1">乐龄团契</option>
                  <option value="2">妇女会</option>
                  <option value="3">成年团契</option>
                  <option value="4">初成团契</option>
                  <option value="5">青年团契</option>
                  <option value="6">少年团契</option>
                  <option value="7">儿童团契</option>
                  <option value="8">女少年军</option>
                  <option value="9">男少年军</option>
              </select><br><br>
              <label>节目 : </label> <input type="text" class="newprogram" style="width:230px" name="newprogram"><br><br>
              <label>策划 : </label> <input type="text" class="newplanner" style="width:130px" name="newplanner"><br><br>
              <span class="submit-note"><i class="fa fa-pencil" aria-hidden="true"></i>添加</span>
              
          </form>
          
            <hr class="section-break">
          
            <table class="wp-list-table widefat striped" border="1" id="my-notes">
                <thead>
                    <tr>
                      <th>日期</th>
		              <th>肢体</th>
                      <th>节目</th>
                      <th>策划</th>
                    </tr>
                </thead>
	            <tbody>
                    
                    <?php
                    $programs = new WP_Query(array(
                        'post_type' => 'program',
                        'posts_per_page' => -1,
                        'meta_key' => 'start_date',
                        'orderby' => 'meta_value',
                        'order' => 'ASC'
                    ));
                    while($programs->have_posts()){
                        $programs->the_post(); 
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
                        <tr data-id="<?php the_ID(); ?>">
                            <td><?php echo date_format(date_create(esc_attr(get_field('start_date'))),"Y-m-d"); ?></td>
                            <td><?php echo $cell; ?></td>
                            <td><?php echo esc_attr(get_the_content()) ?></td>
                            <td><?php echo esc_attr(get_field('planner')); ?></td>
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