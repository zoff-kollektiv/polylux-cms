<ul>
  <?php while (have_rows('accordion')) : the_row(); ?>
    <li>
      <?php echo get_sub_field('title'); ?>
    </li>
  <?php endwhile; ?>
</ul>
