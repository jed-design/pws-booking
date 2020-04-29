<?php
// Our custom post type function
// This script is copied from: https://www.wpbeginner.com/wp-tutorials/how-to-create-custom-post-types-in-wordpress/
// this adds Custom Post Types for Booking.
// *****************************************************************************************************************
function create_posttype() {
 
    register_post_type( 'bookings',
    // Create Post Type Options
	// bookings/id's: Name of the actual room. Bak kjøkkent f.eks = bk
	// bookings/children/id: the bed in the room, example bk.1 for bed 1 in room bk.
		
        array(
            'labels' => array(
				'start' =>__( 'Start time of booking' ),
				'end' =>__( 'End time of booking' ),
				'resourceId' =>__( ' Booking OPK-member' ), 
				'id' =>__( 'Room Id' ),
				'title' =>__( 'Room Name' ),
				'children' =>_array(
					'id' =>__( 'bed id' ),
					'title' =>__( 'Sengeplass' ),
					)
			
			),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'm'),
            'show_in_rest' => true,
 
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
?>
