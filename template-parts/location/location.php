<?php

$city = get_field('city');
$state = get_field('federal_state');
?>

<?php if ($city): ?>
    <p class="location"><?php
    echo $city;
    if ($state): ?>, <?php echo $state;endif;
    ?></p>
<?php endif; ?>
