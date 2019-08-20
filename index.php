<?php get_header(); ?>

<div class="site">
  <?php get_template_part('template-parts/header/header'); ?>

  <main class="content">
    <?php
      while (have_posts()) : the_post();
        get_template_part('template-parts/content/content');
      endwhile;
    ?>
  </main>
</div>

<?php get_footer(); ?>
