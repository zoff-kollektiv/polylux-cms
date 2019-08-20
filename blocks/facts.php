<div class="constraint">
  <div class="facts">
    <h2 class="facts__title">Facts</h2>

    <ul class="facts__list">
      <?php while (have_rows('facts')) : the_row(); ?>
        <li class="facts__item">
          <?php echo get_sub_field('fact'); ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
</div>
