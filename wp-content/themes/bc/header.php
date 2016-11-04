<?php
  // Logos
  $desktop_logo = '/bc/wp-content/uploads/brandcoders-logo-red.png';
  $mobile_logo = '/bc/wp-content/uploads/brandcoders-logo-red.png';

  // Topbar or No Topbar
  $topbar = true;

  // Shrink Navbar On Scroll
  $navbar_shrink_on_scroll = true;

  // Break Point To Mobile. Use either 768 or 992 (AS A STRING!!!! NO UNITS!!!);
  $mobile_break_point = '768'; //px

  // Mobile Phone Button
  $mobile_phone_button = true;

  // Mobile Location Finder Button
  $mobile_location_button = true;

  // Fixed Nav on Mobile
  $sticky_mobile_nav = true;

  // Bringing In Social Array
  global $social_array;

  // set to true and change styles in navbar.less to change look of
  // navbar after it clears page banner or a slider
  $navbar_style_change_after_banner = false;

  // the class name of element (with the . ) in which you want the style
  // change to take place after it passes that element
  // by default, both [page_banner] and [page_banner_large] have .nav-clear-point
  $navbar_style_change_active_after = '.nav-clear-point';

  // set this to true if you want the page content to start under the navbar
  // Meaning the page banner will sit under the navbar.
  $navbar_sit_over_banner = false;

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <?php wp_head(); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="<?php echo get_template_directory_uri(); ?>/bower_components/lightbox2/dist/css/lightbox.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/bower_components/slick-carousel/slick/slick-theme.css" rel="stylesheet">
    <?php
     /* Injecting the dependencies we chose on the back end */
      $css_dep = get_field('css_dependencies', 'option');
      if($css_dep){
        foreach($css_dep as $css){
          echo '<link href="' . get_template_directory_uri() . $css . '" rel="stylesheet">';
        }
      }
    ?>
    <!-- Google Number Changer For PPC Tracking -->
    <!-- ADD UNIQUE PNONE NUMBER REPLACEMENT SCRIPT HERE -->
    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <!-- END ADD UNIQUE PNONE NUMBER REPLACEMENT SCRIPT HERE -->
    <script type="text/javascript">
    var callback = function(formatted_number, mobile_number) {
      // formatted_number: number to display, in the same format as the number passed to _googWcmGet(). (EX: '(XXX) XXX-XXXX')
      // mobile_number: number formatted for use in a clickable link with tel:-URI (EX: '+1XXXXXXXXXX')
      var e = document.getElementById("number_link");
      e.href = "tel:" + mobile_number;
      e.innerHTML = "";
      e.appendChild(document.createTextNode(formatted_number));
    };
    </script>
    <!-- END Google Number Changer For PPC Tracking -->
    <!-- GOOGLE ANALYTICS TRACKING CODE  -->
    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <!-- END GOOGLE ANALYTICS TRACKING CODE -->
</head>
<body <?php body_class(); ?>>
<?php
  /* Topbar */
?>
<?php if($topbar) : ?>
  <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <p class="topbar-left">
            <?php foreach($social_array as $social_key => $social_value) : ?>
              <?php if($social_value) : ?>
                <?php
                  switch ($social_key) {
                    case 'facebook':
                      echo '<a target="_blank" href="' . $social_value . '"><i class="fa fa-facebook-square"></i></a>';
                    break;
                    case 'google':
                      echo '<a target="_blank" href="' . $social_value . '"><i class="fa fa-google-plus-square"></i></a>';
                    break;
                    case 'twitter':
                      echo '<a target="_blank" href="' . $social_value . '"><i class="fa fa-twitter-square"></i></a>';
                    break;
                  }
                ?>
              <?php endif; ?>
            <?php endforeach; ?>
          </p>
          <p class="topbar-right">
            <a href="mailto:<?php echo MAIN_ADDRESS_EMAIL_1; ?>" onclick="ga('send', 'event', 'Email Tracking', 'Click/Touch', 'Desktop Top Bar Email');"><i class="fa fa-envelope" style="color: #FFF;"></i>&nbsp; <?php echo MAIN_ADDRESS_EMAIL_1; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="tel:<?php echo sanatize_phone(MAIN_ADDRESS_PHONE_1); ?>" class="number_link" onclick="ga('send', 'event', 'Phone Call Tracking', 'Click/Touch', 'Desktop Top Bar Call');"><i class="fa fa-phone" style="color: #FFF;"></i>&nbsp; <span class="number"><?php echo MAIN_ADDRESS_PHONE_1; ?></span></a>
          </p>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php
  /* Desktop - Tablet Menu */
  $nav_break = 'nav-break-' .   $mobile_break_point;
?>
<?php if(!$navbar_sit_over_banner){ echo '<div class="desktop-nav-wrap ' . $nav_break .  '" >'; }; ?>
  <div <?php if(is_user_logged_in() && !$topbar) { echo 'style="margin-top: 32px;" '; } ?> class="primary-nav <?php echo $nav_break . ' '; if($topbar){ echo 'topbar-active';}else{ echo 'fixed-top'; }; if($navbar_shrink_on_scroll){ echo ' primary-nav-shrink';};if($navbar_style_change_after_banner){ echo ' navbar-style-change';};if($navbar_sit_over_banner){ echo ' navbar-sit-over-banner';}; ?>" <?php if($navbar_style_change_after_banner){ echo 'data-change="' . $navbar_style_change_active_after . '"';}; ?>>
    <div class="container">
      <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3 nav-logo">
          <a href="<?php echo get_home_url(); ?>"><img src="<?php echo $desktop_logo; ?>"/></a>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-9 nav-links" id="menu">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 0 ) ); ?>
        </div>
      </div>
    </div>
  </div>
<?php if(!$navbar_sit_over_banner){ echo '</div>'; }; ?>

<?php
  /* Mobile Menu */
?>
<?php if($sticky_mobile_nav){ echo '<div class="mobile-nav-wrap ' . $nav_break . '">';} ?>
  <div class="mobile-nav <?php echo $nav_break . ' '; if($sticky_mobile_nav){ echo 'mobile-nav-fixed' ;}; ?>">
    <div class="container">
      <div class="row row-first">
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4 nav-logo">
          <a href="<?php echo get_home_url(); ?>"><img src="<?php echo $mobile_logo; ?>" /></a>
        </div>
        <div class="col-xs-6 col-sm-8 col-md-8 col-lg-8">
          <a href="#" class="mobile-nav-toggle nav-button"><i class="fa fa-bars"></i></a>
          <?php if($mobile_phone_button) : ?>
            <a href="tel:<?php echo sanatize_phone(MAIN_ADDRESS_PHONE_1);?>" class="mobile-nav-phone nav-button" onclick="ga('send', 'event', 'Phone Call Tracking', 'Click/Touch', 'Mobile Menu Call');"><i class="fa fa-phone"></i></a>
          <?php endif; ?>
          <?php if($mobile_location_button) : ?>
            <a href="<?php echo MAIN_ADDRESS_DIRECTIONS_1;?>" target="_blank" class="mobile-nav-location nav-button" onclick="ga('send', 'event', 'Location Tracking', 'Click/Touch', 'Mobile Menu Location');"><i class="fa fa-map-marker"></i></a>
          <?php endif; ?>
        </div>
      </div>
      <div class="row">
        <div class="mobile-nav-links col-xs-12" style="display: none">
          <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </div>
      </div>
    </div>
  </div>
<?php if($sticky_mobile_nav){ echo '</div>';}; ?>
