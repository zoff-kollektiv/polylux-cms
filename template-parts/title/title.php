<?php
  $subtitle = get_field('subtitle');
?>

<h1 class="title">
  <?php the_title(); ?>

  <?php if ($subtitle) : ?>
    <small class="title__subtitle">
      <?php echo $subtitle; ?>
    </small>
  <?php endif; ?>
</h1>
