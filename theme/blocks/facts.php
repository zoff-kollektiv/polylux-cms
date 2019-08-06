<ul>
  <?php while (have_rows('facts')) : the_row(); ?>
    <li>
      <?php echo get_sub_field('fact'); ?>
    </li>
  <?php endwhile; ?>
</ul>
