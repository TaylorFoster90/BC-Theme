<?php
//-----------------------
// Toggle Admin Bar
//-----------------------

show_admin_bar( false );

//-----------------------
// REQUIRED `lib/` files
//-----------------------

/* WARNING: Removing the following two lines will break the theme */
include 'lib/setup.php';
include 'lib/shortcodes.php';

//-----------------------
// Optional `lib/` files
//-----------------------

// include 'lib/post-types.php';
// include 'lib/thumbnails.php';
// include 'lib/custom-roles.php';

//-----------------------
// Helper Functions
//-----------------------

// function to take a phone number and make it compatble with an href attr
function sanatize_phone($number){
  $safe = str_replace(array(' ', '-', '(', ')'), '', $number);
  return $safe;
}

//-----------------------
// Attribute Setups
//-----------------------

// Social Media Links
$social_array= array(
  'facebook'  => null,
  'google'    => null,
  'twitter'   => null,
  'youtube'   => null,
  'linkedin'  => null,
  'instagram' => null,
  'yelp'      => null,
  'pinterest' => null,
);

//-----------------------
// Constants
//-----------------------

// Version of the BC Template
define('BC_TEMPLATE_VERSION', '1.9.16');

// Address of Company
if(have_rows('global_address', 'option')) :
  $i = 1;
  while(have_rows('global_address', 'option')) : the_row();
    $company_name = get_sub_field('company_name', 'option');
    $street = get_sub_field('street', 'option');
    $city = get_sub_field('city', 'option');
    $state = get_sub_field('state', 'option');
    $zip = get_sub_field('zip', 'option');
    $phone = get_sub_field('phone', 'option');
    $email = get_sub_field('email', 'option');
    $fax = get_sub_field('fax', 'option');
    $directions = get_sub_field('directions', 'option');
    $thumbnail = get_sub_field('location_thumbnail', 'option');
    define('MAIN_ADDRESS_NAME_' . $i, $company_name);
    define('MAIN_ADDRESS_STREET_' . $i, $street);
    define('MAIN_ADDRESS_CITY_' . $i, $city);
    define('MAIN_ADDRESS_STATE_' . $i, $state);
    define('MAIN_ADDRESS_ZIP_' . $i, $zip);
    define('MAIN_ADDRESS_PHONE_' . $i, $phone);
    define('MAIN_ADDRESS_EMAIL_' . $i, $email);
    define('MAIN_ADDRESS_FAX_' . $i, $fax);
    define('MAIN_ADDRESS_DIRECTIONS_' . $i, $directions);
    define('MAIN_ADDRESS_THUMBNAIL_' . $i, $thumbnail);
    $i++;
  endwhile;
endif;
?>
