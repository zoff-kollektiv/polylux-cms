<?php get_header(); ?>

<div class="site">
  <?php get_template_part('template-parts/header/header'); ?>

  <main class="content">
    <?php
      while (have_posts()) : the_post();
        get_template_part('template-parts/title/title');
        get_template_part('template-parts/location/location');
        get_template_part('template-parts/media-strip/media-strip');
        get_template_part('template-parts/call-to-action/call-to-action');
        get_template_part('template-parts/content/content');
      endwhile;
    ?>
  </main>
</div>

<?php get_footer(); ?>
