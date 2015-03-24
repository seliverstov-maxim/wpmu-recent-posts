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
    echo $args['before_widget'];
    $blog_id = $instance['blog_id'];
    switch_to_blog($blog_id);
    $posts = wp_get_recent_posts(array('numberposts' => 1));
    foreach($posts as $post) {
      echo "<a href='" . get_permalink($post['ID']) . "'>";
      echo "<div class='recent_post_blogname widget-title clearfix'><span class='title-text'>" . get_bloginfo('name') . "</span></div>";
      echo "<div class='recent_post_title'>" . $post['post_title'] . "</div>";
      echo "<div class='recent_post_thumbnail'>" . get_the_post_thumbnail( $post['ID'], 'thumbnail' ) . "</div>";
      echo "</a>";
    }
    restore_current_blog();
    echo $args['after_widget'];
  }

  function form($instance) {
    global $wpdb;
    $sites = wp_get_sites(array(
      'network_id' => $wpdb->siteid,
      'public' => true));
?>
    <p>
      <label>SubSite</label>
      <select name=<?php echo $this->get_field_name('blog_id'); ?> class="widefat">
        <?php
          foreach($sites as $val) {
            $id = $val['blog_id'];
            $details = get_blog_details($id);
            echo "<option value=$id ". ((array_key_exists('blog_id', $instance) && $instance['blog_id']==$id) ? ' selected ' : '') .">".$details->blogname."</option>";
          }
        ?>
      </select>
    </p>
<?php
  }

  function update($new_instance, $old_instance) {
    $instance = array();
    $instance['blog_id'] = array_key_exists('blog_id', $new_instance) ? intval($new_instance['blog_id']) : 0;

    return $instance;
  }
}
?>
