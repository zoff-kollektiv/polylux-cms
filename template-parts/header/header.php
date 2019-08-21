<?php
$theme = get_field('theme_color'); ?>

<header class="header header--theme-<?php echo $theme; ?>">
  <details class="header__details">
    <summary class="header__summary">
      <svg class="header__toggle-open" aria-hidden="true" focusable="false" role="img" viewBox="0 0 448 512">
        <path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path>
      </svg>

      <svg class="header__toggle-close" aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
        <path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
      </svg>

      <a href="<?php echo home_url(); ?>" class="header__logo-container">
        <?php get_template_part('template-parts/logo/logo'); ?>
      </a>
    </summary>

    <?php wp_nav_menu(array(
        'theme_location' => 'header',
        'container' => false,
        'item_spacing' => 'discard'
    )); ?>
  </details>
</header>
