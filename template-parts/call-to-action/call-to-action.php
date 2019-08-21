<?php

$target = get_field('call_to_action_target');
$theme = get_field('theme_color');
?>

<?php if ($target): ?>
  <div class="call-to-action">
    <a href="<?php echo get_permalink(
        $target[0]->ID
    ); ?>" class="button button--theme-<?php echo $theme; ?>">
      Unterstützen
    </a>
  </div>
<?php endif; ?>
