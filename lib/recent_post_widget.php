<?php
class RecentPostWidget extends WP_Widget {
  function __construct() {
    parent::__construct('recent_post_widget',
      __('Recent Post Widget', 'recent_post_widget'),
      array(
        'description' => __('Recent post from sub site', 'recent_post_from_subsite')
      )
    );
  }

  function widget($args, $instance) {
  }

  function form($instance) {
    global $wpdb;
    $sites = wp_get_sites(array(
      'network_id' => $wpdb->siteid,
      'public' => true));
?>
    <p>
      <label>SubSite</label>
      <select name='subsite'>
        <?php
          foreach($sites as $val) {
            $id = $val['blog_id'];
            $details = get_blog_details($id);
            echo "<option value=$id >".$details->blogname."</option>";
          }
        ?>
      </select>
    </p>
<?php
  }

  function update($new_instance, $old_instance) {
  }
}
?>
