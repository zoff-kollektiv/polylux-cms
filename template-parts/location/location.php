<?php

$city = get_field('city');
$state = get_field('federal_state');

?>

<?php if ($city) : ?>
    <p class="location"><?php echo $city ?><?php if($state) : ?>, <?php echo $state; ?><?php endif; ?></p>
<?php endif; ?>
