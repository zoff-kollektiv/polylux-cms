<?php

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

    [
      'name' => 'accordion',
      'title' => __('Accordion'),
      'render_callback'	=> 'acf_block_render_callback',
      'category' 	=> 'common',
      'icon' => 'sort',
      'keywords' 	=> array('accordion'),
      'post_types' => array('projects', 'page'),
      'mode' => 'auto',
      'supports' => array(
        'align' => false
      )
    ],

    [
      'name' => 'projects',
      'title' => __('Projects'),
      'render_callback'	=> 'acf_block_render_callback',
      'category' 	=> 'common',
      'icon' => 'sort',
      'keywords' 	=> array('projects'),
      'post_types' => array('page'),
      'mode' => 'auto',
      'supports' => array(
        'align' => false
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

  function allowed_block_types() {
    global $BLOCKS;

    $acf_blocks = array_map(function($block) {
      return "acf/{$block['name']}";
    }, $BLOCKS);

    $allowed_core_blocks = [
      'core/heading',
      'core/paragraph',
      'core/button'
    ];

    return array_merge($acf_blocks, $allowed_core_blocks);
  }

  function register_post_types() {
    register_post_type('projects',
      array(
        'labels' => array(
          'name' => 'Projects',
          'singular_name' => 'Project'
          ),
          'public' => true,
          'has_archive' => false,
          'rewrite' => array(
            'slug' => 'projekte'
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

  function cleanup_admin() {
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
  }

  function register_menus() {
    register_nav_menus(
      array(
        'header' => __( 'Header' ),
        'footer' => __( 'Footer' )
      )
    );
  }

  function attachments_bw_filter($meta) {
    $file = wp_upload_dir();
    $file = trailingslashit($file['path']).$meta['sizes']['project-image']['file'];

    list($orig_type) = @getimagesize($file);
    $image = wp_load_image($file);

    imagefilter($image, IMG_FILTER_GRAYSCALE);

    switch ($orig_type) {
        case IMAGETYPE_GIF:
            imagegif( $image, $file );
            break;
        case IMAGETYPE_PNG:
            imagepng( $image, $file );
            break;
        case IMAGETYPE_JPEG:
            imagejpeg( $image, $file );
            break;
    }

    return $meta;
  }

  function overwrite_core_blocks() {
    register_block_type('core/paragraph', array(
      'render_callback' => function($attributes, $content) {
        return '<div class="constraint">
          <div class="paragraph">'
            . $content .
          '</div>
        </div>';
      },
    ));

    register_block_type('core/heading', array(
      'render_callback' => function($attributes, $content) {
        return '<div class="constraint">
          <div class="heading">'
            . $content .
          '</div>
        </div>';
      },
    ));
  }

  function register_footer_widgets() {
    register_sidebar( array(
      'id' => 'footer-account',
      'name' => __( 'Footer Account' ),
      'description' => __( 'Bank account information' ),
      'before_widget' => '<aside class="footer-widget footer-widget--account">',
      'after_widget' => '</aside>',
      'before_title' => '<h3 class="footer-widget__title">',
      'after_title' => '</h3>',
    ));

    register_sidebar( array(
      'id' => 'footer-contact',
      'name' => __( 'Footer Contact' ),
      'description' => __( 'Bank contact information' ),
      'before_widget' => '<aside class="footer-widget footer-widget--contact">',
      'after_widget' => '</aside>',
      'before_title' => '<h3 class="footer-widget__title">',
      'after_title' => '</h3>',
    ));
  }

  acf_add_options_page(array(
    'page_title' => 'Theme General Settings',
    'menu_title' => 'Theme Settings',
    'menu_slug' => 'theme-general-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ));

  add_theme_support('post-thumbnails');

  add_action('init', 'register_post_types');
  add_action('init', 'register_menus');
  add_action('admin_menu','cleanup_admin');
  add_filter('wp_generate_attachment_metadata','attachments_bw_filter');
  add_action('acf/init', 'acf_init_blocks');
  add_filter('allowed_block_types', 'allowed_block_types');
  add_action('init', 'overwrite_core_blocks');
  add_action( 'widgets_init', 'register_footer_widgets', 20 );

  add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
  function wps_deregister_styles() {
      wp_dequeue_style( 'wp-block-library' );
  }
?>
