<?php

/**
*
* Plugin Name: Ajax Post Search Filter
* Description: Plugin to filter custom post type using ajax.
* Plugin URI: 
* Plugin Author: SATYAM SAGAR
* Author URI: 
* Version: 1.0
*
*/

if (! defined('ABSPATH')) {
  die;
}

require_once(plugin_dir_path(__FILE__).'/includes/requiredfiles.php');



// Shortcode: [bed_search]
function create_bedsearch_shortcode() {
  
  bed_search_scripts();

  ob_start();
  ?>
  <div id="bed-search">
    <form class="form-inline" action="" method="get">

      <label for="bed-type">Bed Type</label>
        <select id="bed-type" name="bed-type">
          <option value="no">No Base</option>
          <option value="platform">Platform Base</option>
          <option value="2">2 Drw</option>
          <option value="4">4 Drw</option>
        </select>

        <label for="bed-size">Bed Sie</label>
          <select id="bed-size" name="bed-size">
            <option value="90cm">90cm</option>
            <option value="135">135cm</option>
            <option value="150cm">150cm</option>
            <option value="180cm">180cm</option>
          </select>

          <label for="with-pocket">With Pocket</label>
          <input id="with-pocket" type="checkbox" name="with-pocket" />

        <button type="submit">Search</button>
    </form>
     <ul></ul>
  </div>

  <?php
  return ob_get_clean();

}
add_shortcode( 'bed_search', 'create_bedsearch_shortcode' );


add_action('wp_ajax_bed_search', 'bed_search_callback');
add_action('wp_ajax_nopriv_bed_search', 'bed_search_callback');

function bed_search_callback() {

  header("Content-Type: application/json");

  $type = 0;
  if(isset($_GET['type']))
      $type = sanitize_text_field( $_GET['type']);
  
  $size = 0;
  if(isset($_GET['size']))
      $size = sanitize_text_field( $_GET['size']);

  $with_pocket = 0;
  if(isset($_GET['with_pocket']))
      $with_pocket = intval(sanitize_text_field( $_GET['with_pocket']));


  $result = array();

  $args = array(
    "post_type" => "bed",
    "posts_per_page" => -1
  );

  $args['meta_query'][] = array(
    'key' => 'type',
    'value' => $type,
    'compare' => "=",
  );

  $args['meta_query'][] = array(
    'key' => 'size',
    'value' => $size,
    'compare' => "=",
  );

  $args['meta_query'][] = array(
    'key' => 'with_pocket',
    'value' => $with_pocket,
    'compare' => "=",
  );

  $bed_query = new WP_Query($args);

  while($bed_query->have_posts()){
    $bed_query->the_post();

    $result[] = array(
      "id" => get_the_ID(),
      "title" => get_the_title(),
      "permalink" => get_permalink(),
    );
  }

  echo json_encode($result);

  wp_die();


}
