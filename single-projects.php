<?php get_header(); ?>

<div class="site">
  <?php get_template_part('template-parts/header/header'); ?>

  <main class="content">
    <?php while (have_posts()):
        the_post();
        get_template_part('template-parts/title/title');
        get_template_part('template-parts/location/location');
        get_template_part('template-parts/media-strip/media-strip');
        get_template_part('template-parts/call-to-action/call-to-action');
        get_template_part('template-parts/follow-us/follow-us');
        get_template_part('template-parts/content/content');
        get_template_part('template-parts/call-to-action/call-to-action');
    endwhile; ?>
  </main>
</div>

<?php get_footer(); ?>
