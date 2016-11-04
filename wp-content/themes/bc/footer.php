<?php
//-----------------------
// Footer Setup
//-----------------------
  /*
    Footer Template Options:
    > footer-layout-1
    > footer-layout-2
    > footer-layout-3
    > footer-layout-custom
  */
  $footer_template = 'footer-layout-1';

  // bottom footer or not
  $footer_bottom = true;

?>
<footer id="footer-top">
  <div class="container">
    <div class="row">
      <?php
        include 'includes/footer/' . $footer_template .  '.php';
      ?>
    </div>
  </div>
</footer>
<?php if($footer_bottom) : ?>
  <footer id="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <p class="footer-bottom-left">&copy; <?php echo MAIN_ADDRESS_NAME_1 . ' ' . date("Y"); ?> &bull; Web Design and Marketing by <a href="http://BrandCoders.com/" target="_blank">BrandCoders</a></p>
          <p class="footer-bottom-right"><a href="<?php echo get_home_url(); ?>">MAIN KEYWORD</a></p>
        </div>
      </div>
    </div>
  </footer>
<?php endif; ?>
<footer>
  <!-- W3TC-include-css -->
  <?php wp_footer(); ?>
  <script src="<?php echo get_template_directory_uri(); ?>/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/bower_components/lightbox2/dist/js/lightbox.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/bower_components/matchHeight/jquery.matchHeight-min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/bower_components/slick-carousel/slick/slick.min.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/bower_components/vide/dist/jquery.vide.min.js"></script>
  <?php
   /* Injecting the dependencies we chose on the back end */
    $js_dep = get_field('js_dependencies', 'option');
    if($js_dep){
      foreach($js_dep as $js){
        echo '<script src="' . get_template_directory_uri() . $js . '"></script>';
      }
    }
  ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
</footer>
</body>
</html>
