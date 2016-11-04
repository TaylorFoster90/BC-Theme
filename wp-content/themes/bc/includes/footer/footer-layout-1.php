<?php
 global $social_array;
?>
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

  <h3 class="footer-header">Footer Col Header</h3>
  <ul itemscope="" itemtype="http://schema.org/LocalBusiness" class="footer-schema hidden-phone fa-ul">
    <li class="c-name"><i class="fa-li fa fa-home"></i> <span itemprop="name"><?php echo MAIN_ADDRESS_NAME_1; ?></span></li>
    <li itemprop="address" class="addr" itemscope="" itemtype="http://schema.org/PostalAddress"><i class="fa-li fa fa-map-marker"></i><a href="https://www.google.com/maps/place/Orlando,+FL/@28.4810968,-81.5091771,11z/data=!3m1!4b1!4m2!3m1!1s0x88e773d8fecdbc77:0xac3b2063ca5bf9e" onclick="ga('send', 'event', 'Map Tracking', 'Click/Touch', 'Map Tracking');" target="_blank"><span itemprop="streetAddress"><?php echo MAIN_ADDRESS_STREET_1; ?></span><br><span itemprop="addressLocality"><?php echo MAIN_ADDRESS_CITY_1; ?>, </span><span itemprop="addressRegion"><?php echo MAIN_ADDRESS_STATE_1; ?> </span><span itemprop="postalCode"><?php echo MAIN_ADDRESS_ZIP_1; ?></span></a></li><li class="phone"><i class="fa-li fa fa-phone"></i> <a href="tel:+1<?php echo sanatize_phone(MAIN_ADDRESS_PHONE_1);?>" onclick="ga('send', 'event', 'Call Tracking', 'Click/Touch', 'Call Tracking');"><span itemprop="telephone" class="number"><?php echo MAIN_ADDRESS_PHONE_1; ?></span></a></li><li class="email"><i class="fa-li fa fa-envelope"></i> <a href="mailto:<?php echo MAIN_ADDRESS_EMAIL_1; ?>" onclick="ga('send', 'event', 'Email Tracking', 'Click/Touch', 'Email Tracking');"><span itemprop="email"><?php echo MAIN_ADDRESS_EMAIL_1; ?></span></a></li>
  </ul>

  <div itemscope itemtype="http://schema.org/LocalBusiness" class="visible-mobile">
    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
      <a href="<?php echo MAIN_ADDRESS_DIRECTIONS_1; ?>" class="btn btn-sm btn-footer mbs" target="_blank"><i class="fa fa-map-marker"></i> <span itemprop="streetAddress"><?php echo MAIN_ADDRESS_STREET_1; ?></span> <span itemprop="addressLocality"><?php echo MAIN_ADDRESS_CITY_1; ?></span>, <span itemprop="addressRegion"><?php echo MAIN_ADDRESS_STATE_1; ?></span> <span itemprop="postalCode"><?php echo MAIN_ADDRESS_ZIP_1; ?></span></a>
    </div>
    <div class="schema-links">
      <a href="tel:+1<?php echo MAIN_ADDRESS_PHONE_1; ?>" class="number_link btn btn-sm btn-footer mbs"><i class="fa fa-phone"></i> <span itemprop="telephone" class="number"><?php echo MAIN_ADDRESS_PHONE_1; ?></span></a>
      <br>
      <a href="mailto:<?php echo MAIN_ADDRESS_EMAIL_1; ?>" class="btn btn-sm btn-footer"><i class="fa fa-envelope"></i> <span itemprop="email"><?php echo MAIN_ADDRESS_EMAIL_1; ?></span></a>
    </div>
  </div>

</div>

<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
  <h3 class="footer-header">Footer Col Header</h3>
  <ul class="footer-links footer-links-stacked">
    <li><a href="#">Link</a></li>
    <li><a href="#">Link</a></li>
    <li><a href="#">Link</a></li>
    <li><a href="#">Link</a></li>
  </ul>
</div>

<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
  <h3 class="footer-header">Footer Col Header</h3>
  <div class="footer-social block-grid-xxs-2 block-grid-xs-2 block-grid-sm-2 block-grid-md-2 block-grid-lg-2">
    <?php foreach($social_array as $social_key => $social_value) : ?>
      <?php if($social_value) : ?>
        <?php
          switch ($social_key) {
            case 'facebook':
              echo '<div class="block-grid-item"><span class="fa-stack fa-md"><i class="fa fa-circle fa-stack-2x" style="color: #3b5998"></i><i class="fa fa-facebook fa-stack-1x"></i></span> <a target="_blank" href="' . $social_value . '"> Facebook</a></div>';
            break;
            case 'google':
              echo '<div class="block-grid-item"><span class="fa-stack fa-md"><i class="fa fa-circle fa-stack-2x" style="color: #dd4b39"></i><i class="fa fa-google-plus fa-stack-1x"></i></span>  <a target="_blank" href="' . $social_value . '"> Google+</a></div>';
            break;
            case 'twitter':
              echo '<div class="block-grid-item"><span class="fa-stack fa-md"><i class="fa fa-circle fa-stack-2x" style="color: #55acee"></i><i class="fa fa-twitter fa-stack-1x"></i></span>  <a target="_blank" href="' . $social_value . '"> Twitter</a></div>';
            break;
            case 'linkedin':
              echo '<div class="block-grid-item"><span class="fa-stack fa-md"><i class="fa fa-circle fa-stack-2x" style="color: #007bb5"></i><i class="fa fa-linkedin fa-stack-1x" aria-hidden="true"></i></span>  <a target="_blank" href="' . $social_value . '"> LinkedIn</a></div>';
            break;
            case 'instagram':
              echo '<div class="block-grid-item"><span class="fa-stack fa-md"><i class="fa fa-circle fa-stack-2x" style="color: #125688"></i><i class="fa fa-instagram fa-stack-1x" aria-hidden="true"></i></span>  <a target="_blank" href="' . $social_value . '"> Instagram</a></div>';
            break;
            case 'youtube':
              echo '<div class="block-grid-item"><span class="fa-stack fa-md"><i class="fa fa-circle fa-stack-2x" style="color: #bb0000"></i><i class="fa fa-youtube fa-stack-1x" aria-hidden="true"></i></span>  <a target="_blank" href="' . $social_value . '"> Youtube</a></div>';
            break;
            case 'yelp':
              echo '<div class="block-grid-item"><span class="fa-stack fa-md"><i class="fa fa-circle fa-stack-2x" style="color: #af0606"></i><i class="fa fa-yelp fa-stack-1x" aria-hidden="true"></i></span>  <a target="_blank" href="' . $social_value . '"> Youtube</a></div>';
            break;
            case 'pinterest':
              echo '<div class="block-grid-item"><span class="fa-stack fa-md"><i class="fa fa-circle fa-stack-2x" style="color: #cb2027"></i><i class="fa fa-pinterest-p fa-stack-1x" aria-hidden="true"></i></span>  <a target="_blank" href="' . $social_value . '"> Pinterest</a></div>';
            break;
          }
        ?>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>
