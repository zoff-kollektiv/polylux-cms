<?php

  $PRODUCTION_URL = 'https://develop--polylux.netlify.com';

  function register_post_types() {
    register_post_type('projects',
      array(
        'labels' => array(
          'name' => 'Projects',
          'singular_name' => 'Project'
          ),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array(
            'slug' => 'projects'
          ),
          'show_in_rest' => true,
          'menu_icon' => 'dashicons-media-document',
          'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
          )
      )
    );
  }

  // see https://plugins.trac.wordpress.org/browser/wp-gatsby/trunk/class-wp-gatsby.php
  function trigger_netlify_deploy() {
    wp_remote_post('https://api.netlify.com/build_hooks/5d49714c6108316fd70e10fb');
  }

  function cleanup_admin() {
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
  }

  function custom_visit_site_url($wp_admin_bar) {
    global $PRODUCTION_URL;
    // Get a reference to the view-site node to modify.
    $node = $wp_admin_bar->get_node('view-site');
    $node->meta['target'] = '_blank';
    $node->meta['rel'] = 'noopener noreferrer';
    $node->href = $PRODUCTION_URL;
    $wp_admin_bar->add_node($node);
    // Site name node
    $node = $wp_admin_bar->get_node('site-name');
    $node->meta['target'] = '_blank';
    $node->meta['rel'] = 'noopener noreferrer';
    $node->href = $PRODUCTION_URL;
    $wp_admin_bar->add_node($node);
  }

  function register_menus() {
    register_nav_menus(
      array(
        'header' => __( 'Header' ),
        'footer' => __( 'Footer' )
      )
    );
  }

  add_theme_support('post-thumbnails');

  add_filter('acf/fields/wysiwyg/toolbars' , 'acf_toolbar');
  add_action('init', 'register_post_types');
  add_action('init', 'register_menus');
  add_action('save_post', 'trigger_netlify_deploy');
  add_action('admin_menu','cleanup_admin');
  add_action('admin_bar_menu', 'custom_visit_site_url', 80);
?>
