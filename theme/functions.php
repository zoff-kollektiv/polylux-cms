<?php

  $PRODUCTION_URL = 'https://develop--polylux.netlify.com';

  $BLOCKS = [
    [
      'name' => 'facts',
      'title' => __('Facts'),
      'render_callback'	=> 'acf_block_render_callback',
      'category' 	=> 'common',
      'icon' => 'editor-ul',
      'keywords' 	=> array('fact'),
      'post_types' => array('projects'),
      'mode' => 'auto',
      'supports' => array(
        'align' => false,
        'multiple' => false
      )
    ],
  ];

  function acf_block_render_callback($block) {
    $slug = str_replace('acf/', '', $block['name']);

    if(file_exists(get_theme_file_path("blocks/{$slug}.php"))) {
      include(get_theme_file_path("blocks/{$slug}.php"));
    }
  }

  function acf_init_blocks() {
    global $BLOCKS;

    if( function_exists('acf_register_block_type') ) {
      foreach($BLOCKS as $block) {
        acf_register_block_type($block);
      }
    }
  }

  function add_blocks_to_api() {
    if (!function_exists('use_block_editor_for_post_type')) {
      require ABSPATH . 'wp-admin/includes/post.php';
    }

    $post_types = get_post_types_by_support(['editor']);

    foreach ($post_types as $post_type) {
      if (use_block_editor_for_post_type($post_type)) {
        register_rest_field(
          $post_type,
          'blocks',
          [
            'get_callback' => function(array $post) {
              return parse_blocks($post['content']['raw']);
            },
          ]
        );
      }
    }
  }

  function allowed_block_types($allowed_blocks) {
    global $BLOCKS;

    $acf_blocks = array_map(function($block) {
      return "acf/{$block['name']}";
    }, $BLOCKS);

    // disable all core blocks
    // $core_blocks = [];

    return array_merge($acf_blocks, $core_blocks);
  }

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

  add_action('rest_api_init', 'add_blocks_to_api');
  add_action('acf/init', 'acf_init_blocks');
  add_filter('allowed_block_types', 'allowed_block_types');
?>
