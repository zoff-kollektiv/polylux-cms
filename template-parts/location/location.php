<?php

$metadata = get_field('metadata');
$city = $metadata['city'];
$state = $metadata['federal_state'];

?>

<?php if ($city): ?>
    <p class="location"><?php
    echo $city;
    if ($state): ?>, <?php echo $state;endif;
    ?></p>
<?php endif; ?>
