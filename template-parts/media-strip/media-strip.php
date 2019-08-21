<?php

$images = get_field('media'); ?>

<div class="media-strip">
  <div class="constraint constraint--width-wide">
    <ul class="media-strip__list">
      <li>
        <?php echo get_the_post_thumbnail(get_the_id(), 'project', [
            'class' => 'media-strip__image'
        ]); ?>
      </li>

      <?php if ($images): ?>
        <?php foreach ($images as $image): ?>
          <li>
            <?php echo wp_get_attachment_image($image['ID'], 'project', false, [
                'class' => 'media-strip__image'
            ]); ?>
          </li>
        <?php endforeach; ?>
      <?php endif; ?>
    </ul>
  </div>
</div>
