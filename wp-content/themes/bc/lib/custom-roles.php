<?php
/*======================
  Custom Roles
=======================*/
/*
// Add Role
// All capabilities can be found @ https://codex.wordpress.org/Roles_and_Capabilities
$capabilities = array(
  'read' => true,
  'edit_posts'   => true,
  'delete_posts' => false
);

// Can only see 'trainer' related material
add_role('trainer', 'Trainer', $capabilities);
*/
/*======================
  Locking Down Roles
=======================*/
/*
add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
    global $user_ID;
    if ( current_user_can( 'administrator' ) ) {
	     remove_menu_page( 'plugins.php' );
    }
}
*/ 
