<?php

  $number_of_projects = get_field('number_of_projects');
  $projects = get_posts([
    'numberposts' => $number_of_projects,
    'post_type' => 'projects'
  ]);

?>

<?php if ($projects) : ?>
  <section class="projects">
    <div class="constraint constraint--width-wide">
      <ul class="projects__list">
        <?php foreach ( $projects as $project ) : ?>
          <li class="projects-item">
            <a href="<?php echo get_permalink($project->ID); ?>" class="projects-item__link">
              <?php echo get_the_post_thumbnail($project->ID, 'project', [
                'class' => 'projects-item__image'
              ]); ?>

              <h2 class="projects-item__title">
                <?php echo $project->post_title; ?>
              </h2>
            </a>
          </li>
        <?php endforeach; wp_reset_postdata(); ?>
      </ul>
    </div>

  </section>
<?php endif; ?>
