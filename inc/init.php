<?php

define('PLUGIN_SLUG', 'media-repository');

function ccrest_init() {
  /* Make sure that ACF is installed and activated */
  if( !class_exists('acf') || !function_exists( 'the_field') ) {
    add_action( 'admin_notices', function() {
      ?>
        <div class="update-nag notice">
          <p><?php _e( '<strong>Assets Repository:</strong> Please install the <a href="https://www.advancedcustomfields.com/" target="_blank">Advanced Custom Fields PRO</a>. It is required for this plugin to work properly.', 'ccrest-media-repo'); ?></p>
        </div>
      <?php
    } );
  }
  
  /* Create /media-repository page if doesn't exist */
  $page = get_page_by_path( PLUGIN_SLUG , OBJECT );
  if ( !isset($page) ) {
    $post_details = array(
      'post_title'    => ucwords(str_replace('-', ' ', PLUGIN_SLUG)),
      'post_name'     => PLUGIN_SLUG,
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_type'     => 'page'
      );
      wp_insert_post( $post_details );
  }
}
add_action('init', 'ccrest_init');


/* Add 'lost password?' link to login form */
add_action( 'login_form_middle', 'add_lost_password_link' );
function add_lost_password_link() {
	return '<a href="/wp-login.php?action=lostpassword">Lost Password?</a>';
}


function ccrest_enqueue_scripts_styles() {
  wp_register_style( 'animate_css', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css' );

  if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
    $app_js = 'http://localhost:3000/static/js/bundle.js';
  } else {
    echo 'IS LIVE!';
  }
  wp_register_script( 'app_js', $app_js, array(), false, true );

  if (is_page(PLUGIN_SLUG)) {
    wp_enqueue_style('animate_css');
    wp_enqueue_script('app_js');
  }
}
add_action('wp_enqueue_scripts', 'ccrest_enqueue_scripts_styles');