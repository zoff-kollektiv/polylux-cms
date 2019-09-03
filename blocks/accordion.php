<div class="constraint">
  <ul class="accordion">
    <?php while (have_rows('panels')):
        the_row(); ?>
      <li class="accordion__panel">
        <h2 class="accordion__title"><?php echo get_sub_field('title'); ?></h2>

        <?php if (have_rows('content')): ?>
          <div class="accordion__content">
            <?php while (have_rows('content')):
                the_row(); ?>

                <?php if (get_row_layout() == 'richtext'): ?>
                  <div class="richtext">
                    <?php the_sub_field('content'); ?>
                  </div>
                <?php elseif (get_row_layout() == 'formular'): ?>
                  <div class="form">
                    <?php
                    $form = get_sub_field('formular');
                    echo do_shortcode(
                        '[contact-form-7 id="' . $form[0]->ID . '"]'
                    );
                    ?>
                  </div>
                <?php endif; ?>
            <?php
            endwhile; ?>
          </div>
        <?php endif; ?>
      </li>
    <?php
    endwhile; ?>
  </ul>
</div>
