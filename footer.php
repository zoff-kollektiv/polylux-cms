    <footer class="footer">
      <div class="constraint">
        <?php get_template_part('template-parts/logo/logo'); ?>
        <?php if ( is_active_sidebar( 'footer-contact' ) ) : ?>
          <?php dynamic_sidebar( 'footer-contact' ); ?>
        <?php endif; ?>

        <?php
          wp_nav_menu(
            array(
              'theme_location' => 'footer',
              'container' => false,
              'menu_class' => 'footer-menu',
              'item_spacing' => 'discard'
            )
          );
        ?>

        <?php if ( is_active_sidebar( 'footer-account' ) ) : ?>
          <?php dynamic_sidebar( 'footer-account' ); ?>
        <?php endif; ?>
      </div>
    </footer>

    <?php wp_footer(); ?>

  </body>
</html>
