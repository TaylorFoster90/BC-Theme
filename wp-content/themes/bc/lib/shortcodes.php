<?php
//-----------------------
// Shortcodes
//-----------------------

// Shortcode For A Section
// USAGE: [section] content here [/section]
function Section($atts, $content = null){
  extract(shortcode_atts(array(
      "id"         => false,
      "class"      => false,
      "style"      => false,
      "container"  => false,
      "row"        => false,
      "background" => false,
      /* "parallax"   => false, */
      "underlay"   => false,
      "mp4"        => false,
      "ogv"        => false
  ), $atts));
  $video = $mp4 && $ogv && !wp_is_mobile() ? ' data-vide-bg="mp4:' . $mp4 . ', ogv:' . $ogv . '"' : '';
  $parallax_class = $parallax ? ' section-parallax' : '';
  $underlay = $underlay ? '<div class="section-underlay" style="background-color:' . $underlay . ';"></div>' : '';
  $classes = $class ? ' class="section ' . $class . $parallax_class . '"' : ' class="section"' . $parallax_class;
  $id = $id ? 'id="' . $id . '"' : '';
  $parallax = $parallax ? 'data-stellar-background-ratio=".6"' : '';
  $background = $background ? 'style="background-image: url(' . $background . ');' . $style .'"'  : 'style="' . $style . '"';
  $output = '<section ' . $id . ' ' . $classes . ' ' . $background . ' ' . $parallax . ' ' . $video . '>';
  $output .= $underlay;
  if($container){ $output.= '<div class="container">'; };
  if($row){ $output.= '<div class="row">'; };
  $output .= do_shortcode($content);
  if($row){ $output.= '</div>'; };
  if($container){ $output.= '</div>'; };
  $output .= '</section>';
  return $output;
}
add_shortcode("section", "Section");

// USAGE: [section_video] content here [/section_video]
function Section_Video($atts, $content = null){
  extract(shortcode_atts(array(
      "id"         => false,
      "class"      => false,
      "style"      => false,
      "container"  => false,
      "row"        => false,
      "background" => false,
      "mp4"        => false,
      "ogv"        => false,
      "overlay"    => false,
  ), $atts));
  $classes = $class ? ' class="section section-video-bg ' . $class . '"' : ' class="section section-video-bg"';
  $id = $id ? 'id="' . $id . '"' : '';
  $overlay = $overlay ? 'background-color:' . $overlay . ';' : '';
  $background = wp_is_mobile() ? 'background-image: url(' . $background . ');' : '';
  $output = '<section ' . $id . ' ' . $classes . ' style="' . $overlay . $background . $style . '">';
  if($mp4 || $ogv && !wp_is_mobile()){
    $output .= '<video class="video-bg" loop><source src="' . $mp4 . '" type="video/mp4"><source src="' . $ogv . '" type="video/ogv"></video>';
  }
  if($container){ $output.= '<div class="container">'; };
  if($row){ $output.= '<div class="row">'; };
  $output .= do_shortcode($content);
  if($row){ $output.= '</div>'; };
  if($container){ $output.= '</div>'; };
  $output .= '</section>';
  return $output;
}
add_shortcode("section_video", "Section_Video");

// Shortcode For A Button
// USAGE: [bc_btn href="http://google.com/" size="md" class="btn-red"] content here [/bc_btn]
function BC_BTN($atts, $content = null){
  extract(shortcode_atts(array(
      "href"           => '#',
      "size"           => 'md',
      "class"          => null,
      "style"          => null,
      "block"          => false,
      "icon_before"    => false,
      "icon_after"     => false,
      "target"         => false,
      "data"           => false,
      "tracking"       => false
  ), $atts));
  $tracking = $tracking ? 'onlick="ga(\'send\', \'event\',\'' .  $tracking .  '\', \'Click/Touch\', \'' . $tracking . '\')"' : '';
  $target = $target ? 'target="' . $target . '"' : '';
  $output = '<a href="' . $href . '"' . $data . ' ' . $tracking . ' ' . $target . ' class="btn ';
  switch($size){
    case 'small':
    case 'sm':
      $output .= 'btn-sm ';
      break;
    case 'medium':
    case 'md':
      $output .= 'btn-md ';
      break;
    case 'large':
    case 'lg':
      $output .= 'btn-lg ';
      break;
    case 'xlg':
    case 'x-lg':
    case 'x-large':
      $output .= 'btn-xlg ';
      break;
  }
  if($block){
    $output .= 'btn-block ';
  }
  if($class && $style){
    $output .= $class . '" style="' . $style . '">';
  }else if($class && !$style){
    $output .= $class . '">';
  }else if($style && !$class){
    $output .= '" style="' . $style . '">';
  }else{
    $output .= '">';
  }
  if($icon_before){
    $output .= '<i class="fa ' . $icon_before . '"></i> ';
  }
  $output .= $content;
  if($icon_after){
    $output .= ' <i class="fa ' . $icon_after . '"></i>';
  }
  $output .= '</a>';
  return $output;
}
add_shortcode("bc_btn", "BC_BTN");

// Shortcode For Block Grid

function Block_Grid($atts, $content = null){
  extract(shortcode_atts(array(
      "gutter"   => null,
      "gutter_bottom"   => null,
      "animate"  => null,
      "class"    => null,
      "style"    => null,
      "xxs"      => '',
      "xs"       => '',
      "sm"       => '',
      "md"       => '',
      "lg"       => ''
  ), $atts));
  $animate = $animate ? ' block-grid-' . $animate . ' ': '';
  $gutter = $gutter ? ' block-grid-gutter-' . $gutter . ' ' : '';
  $gutter_bottom = $gutter_bottom ? ' block-grid-lower-gutter-' . $gutter_bottom . ' ' : '';
  $output = '<div class="block-grid ' . $gutter . $animate . '' . $gutter_bottom . 'block-grid-xxs-' . $xxs . ' block-grid-xs-' . $xs . ' block-grid-sm-' . $sm . ' block-grid-md-' . $md . ' block-grid-lg-' .$lg . ' ';
  if($class && $style){
    $output .= $class . '" style="' . $style . '">';
  }else if($class && !$style){
    $output .= $class . '">';
  }else if($style && !$class){
    $output .= '" style="' . $style . '">';
  }else{
    $output .= '">';
  }
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("block_grid", "Block_Grid");

// Shortcode For Block Grid Item
function Block_Grid_Item($atts, $content = null){
  extract(shortcode_atts(array(
      "class"    => null,
      "style"    => null
  ), $atts));
  $output = '<div class="block-grid-item ';
  if($class && $style){
    $output .= $class . '" style="' . $style . '">';
  }else if($class && !$style){
    $output .= $class . '">';
  }else if($style && !$class){
    $output .= '" style="' . $style . '">';
  }else{
    $output .= '">';
  }
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("block_grid_item", "Block_Grid_Item");

// Shortcode For Page Banner
function Page_Banner($atts, $content = null){
  extract(shortcode_atts(array(
      "class"       => null,
      "style"       => null,
      "background"  => null,
      "title"       => ''
  ), $atts));
  $output = '<div class="page-banner nav-clear-point ';
  if($class){
    $output .= $class . '"';
  }else{
    $output .= '"';
  }
  if($background && $style){
    $output .= ' style="background-image: url(\'' . $background  . '\');' . $style . '"';
  }else if($background && !$style){
    $output .= ' style="background-image: url(\'' . $background  . '\');"';
  }else if(!$background && $style){
    $output .= ' style="' . $style . '"';
  }
  $output .= '>';
  $output .= '<div class="container">';
  $output .= '<div class="row">';
  $output .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
  $output .= '<h1 class="mbn">' . $title . '</h1>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
add_shortcode("page_banner", "Page_Banner");

function Page_Banner_Large($atts, $content = null){
  extract(shortcode_atts(array(
      "class"       => null,
      "style"       => null,
      "background"  => null,
      /* "parallax"    => null, */
      "title"       => '',
      "sub_title"   => null,
      "button_text" => null,
      "button_link" => null
  ), $atts));
  $parallax_class = $parallax ? ' section-parallax' : '';
  $id = $id ? 'id="' . $id . '"' : '';
  $parallax = $parallax ? 'data-stellar-background-ratio=".6"' : '';
  $background = $background ? 'style="background-image: url(' . $background . ');' . $style .'"'  : 'style="' . $style . '"';
  $output = '<div ' . $id . ' class="page-banner-large nav-clear-point ' . $class . $parallax_class . '" ' . $background . ' ' . $parallax . '>';
  $output .= '<div class="container">';
  $output .= '<div class="row">';
  $output .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
  $output .= '<h1 class="mbn text-white">' . $title . '</h1>';
  if($sub_title){
    $output .= '<h2 class="text-white">' . $sub_title . '</h2>';
  }
  if($button_link && $button_text){
    $output .= '<a href="' . $button_link . '" class="btn btn-lg btn-color-3">' . $button_text . ' <i class="fa fa-angle-double-right"></i></a>';
  }
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
add_shortcode("page_banner_large", "Page_Banner_Large");

// Shortcode To Loop Address'
function Address_Loop($atts, $content = null){
  $output ='';
  extract(shortcode_atts(array(
      "class"       => null
  ), $atts));
  if(have_rows('global_address', 'option')) :
    while(have_rows('global_address', 'option')) : the_row();
      $company_name = get_sub_field('company_name', 'option');
      $street = get_sub_field('street', 'option');
      $city = get_sub_field('city', 'option');
      $state = get_sub_field('state', 'option');
      $zip = get_sub_field('zip', 'option');
      $phone = get_sub_field('phone', 'option');
      $email = get_sub_field('email', 'option');
      $directions = get_sub_field('directions', 'option');
      $page = get_sub_field('location_page', 'option');
      $output .= '<ul itemscope itemtype="http://schema.org/LocalBusiness" class="fa-ul address-loop">';
      if($company_name) :
        $output .= '<li class="c-name"><i class="fa-li fa fa-home"></i> <span itemprop="name"><a href="' . $page . '">' . $company_name . '</a></span></li>';
      endif;
      if($street || $city || $state || $zip) :
        $output .= '<li itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="addr"><i class="fa-li fa fa-map-marker"></i>';
        $output .= '<a target="_blank" href="' . $directions . '" onclick="ga(\'send\', \'event\', \'Map Tracking\', \'Click/Touch\', \'Map Tracking\');"><span itemprop="streetAddress">' . $street . '</span><br><span itemprop="addressLocality">' . $city . '</span>, <span itemprop="addressRegion">' . $state . '</span> <span itemprop="postalCode">' . $zip . '</span></a>';
        $output .= '</li>';
      endif;
      if($phone) :
        $output .= '<li class="phone"><i class="fa-li fa fa-phone"></i> <a href="tel:+1' . str_replace(' ', '', $phone) . '" class="number_link" onclick="ga(\'send\', \'event\', \'Phone Call Tracking\', \'Click/Touch\', \'Call Tracking\');"><span itemprop="telephone" class="number">' . $phone . '</span></a></li>';
      endif;
      if($email) :
        $output .= '<li class="email"><i class="fa-li fa fa-envelope"></i> <a href="mailto:' . $email . '"  onclick="ga(\'send\', \'event\', \'Email Tracking\', \'Click/Touch\', \'Email Tracking\');"><span itemprop="email">' . $email . '</span></a></li>';
      endif;
      $output .= '</ul>';
    endwhile;
  endif;
  return $output;
}
add_shortcode("address_loop", "Address_Loop");

function Mobile_Location_Conversion($atts, $content = null){
  extract(shortcode_atts(array(
      "class"       => null
  ), $atts));
  $output = '';
  if(have_rows('global_address', 'option')) :
    while(have_rows('global_address', 'option')) : the_row();
      $company_name = get_sub_field('company_name', 'option');
      $street = get_sub_field('street', 'option');
      $city = get_sub_field('city', 'option');
      $state = get_sub_field('state', 'option');
      $zip = get_sub_field('zip', 'option');
      $phone = get_sub_field('phone', 'option');
      $email = get_sub_field('email', 'option');
      $directions = get_sub_field('directions', 'option');
      $thumbnail = get_sub_field('location_thumbnail', 'option');
      $page = get_sub_field('location_page', 'option');
      $output .= '<div class="location-block-mobile visible-phone ';
      if($class){
        $output .= $class . '">';
      }else{
        $output .= '">';
      }
      $output .= '<div class="col-inner">';
      $output .= '<div itemscope itemtype="http://schema.org/LocalBusiness">';
      $output .= '<span itemprop="name" class="name"><a href="' . $page . '">' . $company_name . '</a></span>';
      $output .= '<div itemprop="address" class="mbm address" itemscope itemtype="http://schema.org/PostalAddress">';
      $output .= '<span itemprop="streetAddress"><a target="_blank" class="dark-blue-link" href="' . $directions . '">' . $street . ', </span><span itemprop="addressLocality">' . $city . ', </span><span itemprop="addressRegion">' . $state . '. </span><span itemprop="postalCode">' . $zip . '</a></span>';
      $output .= '</div>';
      $output .= '<figure><a class="ilb" href="'.$directions.'" target="_blank"><img src="' . $thumbnail . '" class="img-responsive" style="border: 1px solid #CCC;" /></a></figure>';
      $output .= '<div class="schema-contact">';
      $output .= '<a class="btn number_link" href="tel:+1' . str_replace(' ', '', $phone) . '" onclick="ga(\'send\', \'event\', \'Phone Call Tracking\', \'Click/Touch\', \'Call Tracking\');"><i class="fa fa-phone"></i> <span itemprop="telephone" class="number">' . $phone . '</span></a>';
      $output .= '<a class="btn" target="_blank" href="' . $directions . '"  onclick="ga(\'send\', \'event\', \'Map Tracking\', \'Click/Touch\', \'Map Tracking\');"><i class="fa fa-map-marker"></i> <span itemprop="email">Directions</span></a>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
    endwhile;
  endif;
  return $output;
}
add_shortcode("mobile_location_conversion", "Mobile_Location_Conversion");
// Shortcode For Accordion
function Accordion($atts, $content = null){
  extract(shortcode_atts(array(
      "class"    => null,
      "style"    => null
  ), $atts));
  $output = '<div class="accordion ';
  if($class && $style){
    $output .= $class . '" style="' . $style . '">';
  }else if($class && !$style){
    $output .= $class . '">';
  }else if($style && !$class){
    $output .= '" style="' . $style . '">';
  }else{
    $output .= '">';
  }
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("accordion", "Accordion");
function Accordion_Item($atts, $content = null){
  extract(shortcode_atts(array(
      "class"    => null,
      "style"    => null,
      "title"    => null,
      "active"   => false
  ), $atts));
  $output = '<div class="accordion-block ';
  if($active){
    $output .= 'active-accordion ';
  }
  if($class && $style){
    $output .= $class . '" style="' . $style . '">';
  }else if($class && !$style){
    $output .= $class . '">';
  }else if($style && !$class){
    $output .= '" style="' . $style . '">';
  }else{
    $output .= '">';
  }
  $output .= '<div class="accordion-header">';
  $output .= '<a href="#"><span>+</span> ' . $title . '</a>';
  $output .= '</div>';
  $output .= '<div class="accordion-content"';
  if($active){
    $output .= '>';
  }else{
    $output .= 'style= "display: none">';
  }
  $output .= do_shortcode($content);
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
add_shortcode("accordion_item", "Accordion_Item");

function Bc_Img($atts, $content = null){
  $output ='';
  extract(shortcode_atts(array(
      "class"     => null,
      "alt"       => null,
      "style"     => null,
      "src"       => null,
      "align"     => null,
      "lightbox"  => null
  ), $atts));
  if($lightbox){
    $output .= '<a href="' . $src . '" data-lightbox="' . $lightbox . '">';
  }
  $output .= '<img class="img-responsive ';
  if($class && $style){
    $output .= $class . '" style="' . $style . '"';
  }else if($class && !$style){
    $output .= $class . '"';
  }else if($style && !$class){
    $output .= '" style="' . $style . '"';
  }else{
    $output .= '"';
  }
  $output .= ' src="' . $src . '"';
  if($alt){
    $output .= ' alt="' . $alt . '"';
  }
  if($align){
    $output .= ' align="' . $align . '" />';
  }else{
    $output .= ' />';
  }
  if($lightbox){
    $output .= '</a>';
  }
  return $output;
}
add_shortcode("bc_img", "Bc_Img");


function singleLocationAddress($atts, $content = null){
  extract(shortcode_atts(array(
      "location"       => null
  ), $atts));
  $output .= '<ul itemscope itemtype="http://schema.org/LocalBusiness" class="single-location-address hidden-phone fa-ul">';
  $output .= '<li class="c-name"><i class="fa-li fa fa-home"></i> <span itemprop="name">' . constant("MAIN_ADDRESS_NAME_" . $location) . '</span></li>';
  $output .= '<li itemprop="address" class="addr" itemscope itemtype="http://schema.org/PostalAddress"><i class="fa-li fa fa-map-marker"></i><a href="' . constant("MAIN_ADDRESS_DIRECTIONS_" . $location) . '" onclick="ga(\'send\', \'event\', \'Map Tracking\', \'Click/Touch\', \'Map Tracking\');" target="_blank">';
  $output .= '<span itemprop="streetAddress">' .  constant("MAIN_ADDRESS_STREET_" . $location) . '</span>';
  $output .= '<br>';
  $output .= '<span itemprop="addressLocality">' .  constant("MAIN_ADDRESS_CITY_" . $location) . ', </span>';
  $output .= '<span itemprop="addressRegion">' .  constant("MAIN_ADDRESS_STATE_" . $location) . '. </span>';
  $output .= '<span itemprop="postalCode">' .  constant("MAIN_ADDRESS_ZIP_" . $location) . '</span>';
  $output .= '</a></li>';
  $output .= '<li class="phone"><i class="fa-li fa fa-phone"></i> <a href="tel:+1' .  str_replace(' ', '', constant("MAIN_ADDRESS_PHONE_" . $location)) . '" onclick="ga(\'send\', \'event\', \'Call Tracking\', \'Click/Touch\', \'Call Tracking\');"><span itemprop="telephone" class="number">' .  constant("MAIN_ADDRESS_PHONE_" . $location) . '</span></a></li>';
  $output .= '<li class="email"><i class="fa-li fa fa-envelope"></i> <a href="mailto:' .  constant("MAIN_ADDRESS_EMAIL_" . $location) . '" onclick="ga(\'send\', \'event\', \'Email Tracking\', \'Click/Touch\', \'Email Tracking\');"><span itemprop="email">' .  constant("MAIN_ADDRESS_EMAIL_" . $location) . '</span></a></li>';
  $output .= '</ul>';
  $output .= '<div class="location-block-mobile visible-phone">';
  $output .= '<div class="col-inner">';
  $output .= '<div itemscope itemtype="http://schema.org/LocalBusiness">';
  $output .= '<span itemprop="name" class="name">' . constant("MAIN_ADDRESS_NAME_" . $location) . '</span>';
  $output .= '<div itemprop="address" class="mbm address" itemscope itemtype="http://schema.org/PostalAddress">';
  $output .= '<span itemprop="streetAddress"><a class="dark-blue-link" href="' . constant("MAIN_ADDRESS_DIRECTIONS_" . $location) . '">' . constant("MAIN_ADDRESS_STREET_" . $location) . ', </span><span itemprop="addressLocality">' . constant("MAIN_ADDRESS_CITY_" . $location) . ', </span><span itemprop="addressRegion">' .  constant("MAIN_ADDRESS_STATE_" . $location) . '. </span><span itemprop="postalCode">' . constant("MAIN_ADDRESS_ZIP_" . $location) . '</a></span>';
  $output .= '</div>';
  $output .= '<figure><img src="' . constant("MAIN_ADDRESS_THUMBNAIL_" . $location) . '" class="img-responsive" /></figure>';
  $output .= '<div class="schema-contact">';
  $output .= '<a class="btn btn-md btn-color-1" href="tel:+1' . str_replace(' ', '', constant("MAIN_ADDRESS_PHONE_" . $location)) . '" onclick="ga(\'send\', \'event\', \'Phone Tracking\', \'Click/Touch\', \'Phone Tracking\');"><i class="fa fa-phone"></i> <span itemprop="telephone" class="number">' . constant("MAIN_ADDRESS_PHONE_" . $location) . '</span></a>';
  $output .= '<a class="btn btn-md btn-color-1" target="_blank" href="' . constant("MAIN_ADDRESS_DIRECTIONS_" . $location) .  '" onclick="ga(\'send\', \'event\', \'Map Tracking\', \'Click/Touch\', \'Map Tracking\');"><i class="fa fa-map-marker"></i> <span itemprop="email">Directions</span></a>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
add_shortcode("single_location_address", "singleLocationAddress");

function childPageLinkGroup($atts, $content = null){
  extract(shortcode_atts(array(
      "parent_page" => '',
      "exclude" => '',
      "style"   => '',
      "class"   => ''
  ), $atts));
  $args = array(
  	'sort_order' => 'asc',
    'exclude' => $exclude,
  	'hierarchical' => 1,
  	'child_of' => $parent_page,
    'depth' => 1,
  	'post_status' => 'publish',
    'parent' => $parent_page
  );
  $pages = get_pages($args);
  $output = '<div class="link-group ' . $class . '" style="' . $style . '">';
  foreach($pages as $page){
      $output .= "<a href='" . get_the_permalink($page->ID) . "'";
      if(get_the_permalink($page->ID) == get_the_permalink()){
        $output .= " class='active-page'>";
      }else{
        $output .= ">";
      }
      $output .= get_the_title($page->ID) . "</a>";
  }
  $output .= '</div>';
  return $output;
}
add_shortcode("child_page_link_group", "childPageLinkGroup");

function Breadcrumbs(){
  global $post;
  $output = '';
  if(!is_front_page()) :
    $counter = 1;
    $output .= '<div class="breadcrumb-wrap">';
    $output .= '<div class="container">';
    $output .= '<div class="row">';
    $output .= '<div class="breadcrumbs col-xs-12" itemscope itemtype="http://schema.org/BreadcrumbList">';
    $output .= '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . get_home_url() . '"><span itemprop="name"><i class="fa fa-home"></i></span></a></span>';
    if(is_page()){
      if($post->post_parent){
          $anc = get_post_ancestors( $post->ID );
          $anc_link = get_page_link( $post->post_parent );
          foreach ( $anc as $ancestor ) {
              $output .= " <span class='spacer'><i class='fa fa-angle-right'></i></span> <span itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".$anc_link."'><span itemprop='name'>".get_the_title($ancestor)."</span></a></span> <span class='spacer'> <i class='fa fa-angle-right'></i> </span>";
          }
        $output .= '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . get_the_permalink() . '"><span class="current"><span itemprop="name">'. get_the_title() . '</span></span></a></span>';
      } else {
          $output .= ' <span class="spacer"><i class="fa fa-angle-right"></i></span> ';
          $output .= '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . get_the_permalink() . '"><span class="current"><span itemprop="name">'. get_the_title() . '</span></span></a></span>';
      }
    }
  endif;
  $output .= "</div></div></div></div>";
  return $output;
}
add_shortcode("breadcrumbs", "Breadcrumbs");

function AddressAttr($atts, $content = null){
  extract(shortcode_atts(array(
      "num"     => '',
      "attr"    => '',
      "concat"  => false
  ), $atts));
  $output = '';
  if($concat){
    $output .= str_replace(' ', '', constant("MAIN_ADDRESS_" . strtoupper($attr) . "_" . $num));
  }else{
    $output .= constant("MAIN_ADDRESS_" . strtoupper($attr) . "_" . $num);
  }
  return $output;
}
add_shortcode("address_attr", "AddressAttr");

function BC_Tabs($atts, $content = null){
  extract(shortcode_atts(array(
    "class"   => '',
    "style"   => false
  ), $atts));
  $styles = $style ? ' style="' . $style . '"' : '';
  $output = '<div class="bc-tabs ' .$class . '"' . $styles . '>';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_tabs", "BC_Tabs");

function BC_Tab_Item($atts, $content = null){
  extract(shortcode_atts(array(
    "controls"  => '',
    "text"      => '',
    "active"    => false
  ), $atts));
  $classes = $active ? 'bc-tab tab-active' : 'bc-tab';
  $output = '<a href="#" data-toggle="' . $controls . '" class="' . $classes . '">' . $text . '</a>';
  return $output;
}
add_shortcode("bc_tab_item", "BC_Tab_Item");

function BC_Tab_Panels($atts, $content = null){
  extract(shortcode_atts(array(
    "class"   => '',
    "style"   => false
  ), $atts));
  $styles = $style ? ' style="' . $style . '"' : '';
  $output = '<div class="bc-tab-panels ' . $class . '"' . $styles . '>';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_tab_panels", "BC_Tab_Panels");

function BC_Panel($atts, $content = null){
  extract(shortcode_atts(array(
    "controlled_by"  => '',
    "active"    => false
  ), $atts));
  $style = $active ? 'class="bc-panel panel-active"' : 'class="bc-panel" style="display: none"';
  $output = '<div ' . $style . ' data-tab="' . $controlled_by . '">';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_panel", "BC_Panel");


function Gallery($atts, $content = null){
  extract(shortcode_atts(array(
    "class"      => null,
    "style"      => null,
    "xxs"        => '',
    "xs"         => '',
    "sm"         => '',
    "md"         => '',
    "lg"         => '',
    "thumbnail"  => 'thumbnail',
    "lightbox"   => 'gallery-lightbox'
  ), $atts));
  $output;
  $page_gallery = get_field('page_gallery');
  if($page_gallery):
    $classes = $class ? 'page-gallery block-grid-xxs-' . $xxs . ' block-grid-xs-' . $xs . ' block-grid-sm-' . $sm . ' block-grid-md-' . $md . ' block-grid-lg-' . $lg . ' ' . $class : 'page-gallery block-grid-xxs-' . $xxs . ' block-grid-xs-' . $xs . ' block-grid-sm-' . $sm . ' block-grid-md-' . $md . ' block-grid-lg-' . $lg;
    $styles = $style ? ' style="' . $style . '"' : '';
    $output .= '<div class="' . $classes . '"' . $styles . ">";
    foreach($page_gallery as $image) :
      $output .= '<li class="block-grid-item"><a href="' . $image['url'] . '" data-lightbox="' . $lightbox . '"><img class="img-responsive" src="' . $image['sizes'][$thumbnail] . '" /></a></li>';
    endforeach;
    $output .= '</div>';
  endif;
  return $output;
}
add_shortcode("gallery", "Gallery");

function Anchor($atts){
  extract(shortcode_atts(array(
  	'href' => null,
  	'mail' => null,
  	'phone' => null,
  	'content' => null,
  	'style' => null,
  	'class' => null,
  	'target' => null,
    'btn_switch'  => false,
    'btn_class' => 'btn-md btn-color-1',
    'tracking' => false
  ), $atts));
  $output;
  $link;
  if($href){
  	$link = $href;
  }else if($mail){
  	$link = 'mailto:' . $mail;
  }else if($phone){
  	$link = 'tel:+1' . $phone;
  }
  $style = $style ? 'style="' . $style . '"' : '';
  $class = $class ? 'class="' . $class . '"' : '';
  $target = $target ? 'target="' . $target . '"' : '';
  $tracking = $tracking ? 'onlick="ga(\'send\', \'event\',\'' .  $tracking .  '\', \'Click/Touch\', \'' . $tracking . '\')"' : '';
  if($btn_switch){
    $output = '<span class="hidden-mobile">' . '<a href="' . $link . '" ' . $class . ' ' . $style . ' ' . $target . ' ' . $tracking . '>' . $content . '</a>' . '</span>';
    $output .= '<span class="visible-mobile">' . '<a href="' . $link . '" class="btn ' . $btn_class . '" ' . $style . ' ' . $target . ' ' . $tracking . '>' . $content . '</a>' . '</span>';
  }else{
    $output = '<a href="' . $link . '" ' . $class . ' ' . $style . ' ' . $target . ' ' . $tracking . '>' . $content . '</a>';
  }
  return $output;
}
add_shortcode("anchor", "Anchor");

function Col($atts, $content = null){
  extract(shortcode_atts(array(
  	'flex' => null,
    'style' => null,
    'class' => null,
  ), $atts));
  $style = $style ? 'style="' . $style . '"' : '';
  $class = $class ? $class  : '';
  $no_whitespaces = preg_replace( '/\s*,\s*/', ',', filter_var( $flex, FILTER_SANITIZE_STRING ) );
  $flex_array = explode( ',', $no_whitespaces );
  $col_array = array('col-xs-', 'col-sm-', 'col-md-', 'col-lg-');
  $output = '<div class="';
  foreach($flex_array as $index => $flex){
    $output .= $col_array[$index] . $flex . ' ';
  }
  $output .= $class  . '" ' . $style . '>';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;

}
add_shortcode("col", "Col");
add_shortcode("col_nest", "Col");


function AccentHeader($atts, $content = null){
  extract(shortcode_atts(array(
    'style' =>  null,
    'class' =>  null,
    'level' =>  null,
    'accent' => 'single'
  ), $atts));
  $style = $style ? 'style="' . $style . '"' : '';
  $class = $class ? $class  : '';
  $accent_class = 'accent-' . $accent;
  $output = '<' . $level . ' class="' . $accent_class . ' ' . $class . '" ' . $style . '><span>' . $content . '</span></' . $level . '>';
  return $output;

}
add_shortcode("accent_header", "AccentHeader");

function Placehold($atts){
  extract(shortcode_atts(array(
    't' =>  null,
    'lines' =>  null,
    'dim' =>  null,
    'fluid' => true,
    'style' =>  null,
    'class' =>  null,
  ), $atts));
  $output;
  $lorem = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ';
  $placehold = 'http://placehold.it/';
  $responsive = ($fluid == 'true' ? 'img-responsive' : '');
  $styles = $style ? 'style="' . $style . '"' : '';
  $classes = $class ? 'class="' . $class . '"'  : '';
  if($t == 'txt'){
    $output = '<p ' . $classes . ' ' . $styles . '>' . str_repeat($lorem, $lines) . '</p>';
  }else if($t = 'img'){
    $output = '<img src="' . $placehold . $dim . '" class="' . $responsive . ' '  . $class . '" ' . $styles . '/>';
  }
  return $output;
}
add_shortcode("placehold", "Placehold");

function Version(){
  return constant('BC_TEMPLATE_VERSION');
}
add_shortcode("version", "Version");

function childPageList($atts){
  extract(shortcode_atts(array(
      "parent_page" => '',
      "exclude"    => ''
  ), $atts));
  $args = array(
  	'sort_order' => 'asc',
    'exclude' => $exclude,
  	'hierarchical' => 1,
  	'child_of' => $parent_page,
    'depth' => 1,
  	'post_status' => 'publish',
    'parent' => $parent_page
  );
  $pages = get_pages($args);
  $output = '<div class="child-page-list">';
  foreach($pages as $page){
    $output .= '<p><a href="' . get_the_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></p>';
  }
  $output .= '</div>';
  return $output;
}
add_shortcode("child_page_list", "childPageList");

function IconList($atts, $content = null){
  extract(shortcode_atts(array(
      "class"   => null,
      "style"   => null
  ), $atts));
  $classes = $class ? $class : '';
  $styles = $style ? 'style="'.$style.'"' : '';
  $output = '<ul class="fa-ul icon-list ' . $classes . '" ' . $styles . '>';
  $output .= do_shortcode($content);
  $output .= '</ul>';
  return $output;
}
add_shortcode("icon_list", "IconList");

function Li($atts, $content = null){
  extract(shortcode_atts(array(
    "icon"    => null,
    "class"   => null,
    "style"   => null
  ), $atts));
  $classes = $class ? 'class="' . $class . '"' : '';
  $styles = $style ? 'style="' . $style . '"' : '';
  $output = '<li ' . $class . ' ' . $style .'>';
  if($icon){
    $output .= '<i class="fa-li fa ' . $icon . '"></i> ';
  }
  $output .= do_shortcode($content);
  $output .= '</li>';
  return $output;
}
add_shortcode("li", "Li");

function AffixNav($atts){
  extract(shortcode_atts(array(
    "links"   => '',
    "offset"  => '',
    "class"   => '',
    "style"   => null
  ), $atts));
  $links = json_decode($links, true);
  $style = $style ? 'style="' . $style . '"' : '';
  if($links){
    $output = '<nav class="affix-page-nav ' . $class . '" data-bc-offset="' . $offset . '" ' . $style . '>';
    $output .= '<div class="container">';
    $output .= '<div class="row">';
    $output .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
    foreach($links as $key=>$value) :
      $output .= '<a href="' . $key . '">' . $value . '</a>';
    endforeach;
  };
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</nav>';
  return $output;
}
add_shortcode("affix_nav", "AffixNav");

function HR($atts){
  extract(shortcode_atts(array(
    "class"   => '',
    "style"   => null,
    "type"   => ''
  ), $atts));
  $output = '<hr class="bc-hr ' . $type . ' ' . $class . '">';
  return $output;
}
add_shortcode("hr", "HR");

function ReviewLinks($atts){
  extract(shortcode_atts(array(
    'yelp' => false,
    'manta' => false,
    'yellow_pages' => false,
    'google' => false,
    'home_advisor' => false,
    'facebook' => false,
    'angies_list' => false,
    'bbb' => false,
    'class' => false,
    'style' => false,
  ), $atts));
  $style = $style ? ' style="' . $style . '"' : '';
  $output = '<div class="block-grid-xxs-2 block-grid-xs-3 block-grid-sm-4 block-grid-md-4 block-grid-lg-4 review-link-grid ' . $class . '"' . $style . '>';
  if($yelp){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $yelp . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Yelp.png" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($manta){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $manta . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Manta.png" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($yellow_pages){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $yellow_pages . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Yellow-Pages.png" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($google){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $google . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Google.png" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($home_advisor){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $home_advisor . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Home-Advisor.png" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($facebook){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $facebook . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Facebook.png" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($angies_list){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $angies_list . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Angies-List.png" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($bbb){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $bbb . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-BBB.png" class="img-responsive" target="_blank"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  $output .= '</div>';
  return $output;
}
add_shortcode("review_links", "ReviewLinks");

function BC_Card($atts, $content = null){
  extract(shortcode_atts(array(
    'img' => '',
    'title' => '',
    'btn_text' => '',
    'href' => '',
    'class' => false,
    'style' => false,
  ), $atts));
  $output = '<div class="bc-card">';
  $output .= '<a href="' . $href . '" class="figure"><img src="' . $img . '" class="img-responsive"/></a>';
  $output .= '<div class="content">';
  $output .= '<h3 class="title"><a href="' . $href . '">' . $title . '</a></h3>';
  $output .= do_shortcode($content);
  $output .= '<a href="' . $href . '" class="btn btn-md btn-block btn-color-2">' . $btn_text . '</a>';
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_card", "BC_Card");

function Page_Banner_Flex($atts, $content = null){
  extract(shortcode_atts(array(
      "class"       => null,
      "style"       => null,
      "background"  => null
  ), $atts));
  $classes = $class ? ' ' . $class : '';
  $background = $background ? ' style="background-image:url(\'' . $background .  '\')"' : ' style="' . $style . '"';
  $output = '<div class="page-banner-flex nav-clear-point' . $classes . '"' . $background . '>';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("page_banner_flex", "Page_Banner_Flex");

function Img_Flex($atts, $content = null){
  extract(shortcode_atts(array(
      "class"       => null,
      "style"       => null,
      "src"         => null,
      "x"           => null,
      "y"           => null
  ), $atts));
  $styles = $x && $y ? 'style="background-image:url(\'' . $src . '\');background-position:' . $x . ' ' . $y . ';'. $style .'"' : 'style="background-image:url(\'' . $src . '\');' . $stlye . '';
  $output = '<div class="img-flex ' . $class . '" ' . $styles . '>';
  if($content) {
    $output .= do_shortcode($content);
  }
  $output .= '</div>';
  return $output;
}
add_shortcode("img_flex", "Img_Flex");

function Team_Block($atts, $content = null){
  extract(shortcode_atts(array(
      "name"       => null,
      "src"        => null,
      "position"   => null,
      "email"      => null,
      "facebook"   => null,
      "twitter"    => null,
      "linkedin"   => null,
      "google"     => null,
      "class"      => null,
      "style"      => null
  ), $atts));
  $style = $style ? 'style="' . $style . '"' : '';
  $output = '<div class="team-block ' . $class . '" ' . $style . '>';
  $output .= '<figure>';
  $output .= '<img src="' . $src . '"  class="img-responsive" />';
  $output .= '<div class="overlay">';
  $email = $email ? $output .= '<a href="' . $email .'" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i></a>' : $output .= '';
  $facebook = $facebook ? $output .= '<a href="' . $facebook .'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>' : $output .= '';
  $twitter = $twitter ? $output .= '<a href="' . $twitter .'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>' : $output .= '';
  $linkedin = $linkedin ? $output .= '<a href="' . $linkedin .'" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>' : $output .= '';
  $google = $google ? $output .= '<a href="' . $google .'" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>' : $output .= '';
  $output .= '</div>';
  $output .= '</figure>';
  $output .= '<h3 class="mtm mbxs">' . $name . '</h3>';
  $output .= '<h4 class="mbn">' . $position . '</h4>';
  $output .= '</div>';
  return $output;
}
add_shortcode("team_block", "Team_Block");

function Img_Overlay($atts, $content = null){
  extract(shortcode_atts(array(
      "src"        => null,
      "href"       => '#',
      "class"      => null,
      "style"      => null
  ), $atts));
  $output = '<figure class="bc-img-overlay ' . $class . '">';
  $output .= '<img src="' . $src . '" class="img-responsive" />';
  if($content) :
    $output .= '<a href="' . $href . '" class="overlay">';
    $output .= do_shortcode($content);
    $output .= '</a>';
  endif;
  $output .= '</figure>';
  return $output;
}
add_shortcode("img_overlay", "Img_Overlay");

function G_Map($atts, $content = null){
  extract(shortcode_atts(array(
      "num"        =>  1,
      "height"     => '300',
      "width"      => '100%',
      "class"      => null,
      "style"      => null
  ), $atts));
  $address = constant("MAIN_ADDRESS_STREET_" . $num) . constant("MAIN_ADDRESS_CITY_" . $num) . constant("MAIN_ADDRESS_STATE_" . $num) . constant("MAIN_ADDRESS_ZIP_" . $num);
  $address = str_replace(' ', '', $address);
  $style = $style ? 'style="' . $style . '"' : '';
  $class = $class ? 'class="' . $class . '"' : '';
  $output = '<iframe src="https://www.google.com/maps?q=' . $address . '&output=embed" width="' . $width . '" height="' . $height . '" ' . $class . ' ' . $style .'></iframe>';
  return $output;
}
add_shortcode("g_map", "G_Map");

function Schema($atts, $content = null){
  extract(shortcode_atts(array(
      "icons"        =>  false,
      "num"       => 1,
      "name"      =>  false,
      "address"      =>  false,
      "phone"      =>  false,
      "email"      =>  false,
      "fax"      =>  false,
      "style"        =>  false,
      "class"        =>  false,
  ), $atts));
  $style = $style ? ' style="' . $style . '"' : '';
  $class = $class ? ' ' . $class : '';
  if($icons) :
    $output = '<ul itemscope itemtype="http://schema.org/LocalBusiness" class="schema-list fa-ul' . $class . '"' . $style .'>';
    $name = $name ? $output .= '<li class="c-name"><i class="fa fa-li fa-home"></i> <span itemprop="name">' . constant("MAIN_ADDRESS_NAME_" . $num)  . '</span></li>' : '';
    $address = $address ? $output .= '<li itemprop="address" class="addr" itemscope itemtype="http://schema.org/PostalAddress"><i class="fa-li fa fa-map-marker"></i> <a href="' . constant("MAIN_ADDRESS_DIRECTIONS_" . $num) . '" target="_blank"><span itemprop="streetAddress">' . constant("MAIN_ADDRESS_STREET_" . $num) . '</span><br><span itemprop="addressLocality">' . constant("MAIN_ADDRESS_CITY_" . $num) . ', </span><span itemprop="addressRegion">' . constant("MAIN_ADDRESS_STATE_" . $num) . ' </span><span itemprop="postalCode">' . constant("MAIN_ADDRESS_ZIP_" . $num) . '</span></a></li>'  : '';
    $phone = $phone ? $output .= '<li class="phone"><i class="fa-li fa fa-phone"></i> <a href="tel:+1' . sanatize_phone(constant("MAIN_ADDRESS_PHONE_" . $num)) . '"><span itemprop="telephone" class="number">' . constant("MAIN_ADDRESS_PHONE_" . $num) . '</span></a></li>' : '';
    $email = $email ? $output .= '<li class="email"><i class="fa-li fa fa-envelope"></i> <a href="mailto:' . constant("MAIN_ADDRESS_EMAIL_" . $num) . '"><span itemprop="email">' . constant("MAIN_ADDRESS_EMAIL_" . $num) . '</span></a></li>' : '';
    $fax = $fax ? $output .= '<li class="fax"><i class="fa-li fa fa-fax"></i> <a href="fax:' . sanatize_phone(constant("MAIN_ADDRESS_FAX_" . $num)) . '"><span itemprop="faxNumber">' . constant("MAIN_ADDRESS_FAX_" . $num) . '</span></a></li>' : '';
    $output .= '</ul>';
  else:
    $output = '<ul itemscope itemtype="http://schema.org/LocalBusiness" class="schema-list list-unstyled' . $class . '"' . $style . '>';
    $name = $name ? $output .= '<li class="c-name"><span itemprop="name">' . constant("MAIN_ADDRESS_NAME_" . $num)  . '</span></li>' : '';
    $address = $address ? $output .= '<li itemprop="address" class="addr" itemscope itemtype="http://schema.org/PostalAddress"><a href="' . constant("MAIN_ADDRESS_DIRECTIONS_" . $num) . '" target="_blank"><span itemprop="streetAddress">' . constant("MAIN_ADDRESS_STREET_" . $num) . '</span><br><span itemprop="addressLocality">' . constant("MAIN_ADDRESS_CITY_" . $num) . ', </span><span itemprop="addressRegion">' . constant("MAIN_ADDRESS_STATE_" . $num) . ' </span><span itemprop="postalCode">' . constant("MAIN_ADDRESS_ZIP_" . $num) . '</span></a></li>'  : '';
    $phone = $phone ? $output .= '<li class="phone"><a href="tel:+1' . sanatize_phone(constant("MAIN_ADDRESS_PHONE_" . $num)) . '"><span itemprop="telephone" class="number">' . constant("MAIN_ADDRESS_PHONE_" . $num) . '</span></a></li>' : '';
    $email = $email ? $output .= '<li class="email"><a href="mailto:' . constant("MAIN_ADDRESS_EMAIL_" . $num) . '"><span itemprop="email">' . constant("MAIN_ADDRESS_EMAIL_" . $num) . '</span></a></li>' : '';
    $fax = $fax ? $output .= '<li class="fax"><a href="fax:' . sanatize_phone(constant("MAIN_ADDRESS_FAX_" . $num)) . '"><span itemprop="faxNumber">' . constant("MAIN_ADDRESS_FAX_" . $num) . '</span></a></li>' : '';
    $output .= '</ul>';
  endif;
  return $output;
}
add_shortcode("schema", "Schema");

function BC_Slider($atts, $content = null){
  extract(shortcode_atts(array(
    "style"        =>  false,
    "class"        =>  false,
  ), $atts));
  $style = $style ? ' style="' . $style . '"' : '';
  $class = $class ? ' ' . $class : '';
  $output = '<div class="bc-slideshow' . $class . '"' . $style . '>';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_slider", "BC_Slider");

function Slide($atts, $content = null){
  extract(shortcode_atts(array(
    "container"    => false,
    "background"    => false,
    "row"          => false,
    "style"        => false,
    "class"        => false,
  ), $atts));
  $background = $background ? ' style="background-image: url(\'' . $background . '\');'. $style . '"' : ' style="' . $style . '"';
  $class = $class ? ' class="' . $class . '"' : '';
  $output = '<div' . $class . $background . '>';
  if($container) : $output .= '<div class="container">'; endif;
  if($row) : $output .= '<div class="row">'; endif;
  $output .= do_shortcode($content);
  if($row) : $output .= '</div>'; endif;
  if($container) : $output .= '</div>'; endif;
  $output .= '</div>';
  return $output;
}
add_shortcode("slide", "Slide");

function Navbar_Search($atts, $content = null){
  extract(shortcode_atts(array(

  ), $atts));
  $output = '<a href="#" class="primary-nav-search-toggle"><i class="fa fa-search"></i></a>';
  $output .= '<div class="primary-nav-search-form" style="display: none">';
  $output .= '<form style="" role="search" method="get" id="searchform" class="navbar-search-form" action="' . get_home_url() .'" _lpchecked="1"><h5 class="text-white mbs">Search Our Site</h5><input type="text" value="" name="s" id="s"><button type="submit" id="searchsubmit"><i class="fa fa fa-angle-double-right"></i></button></form>';
  $output .= '</div>';
  return $output;
}
add_shortcode("navbar_search", "Navbar_Search");
?>
