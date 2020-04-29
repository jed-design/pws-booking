?<?php
// Our custom post type function
// This script is copied from: https://www.wpbeginner.com/wp-tutorials/how-to-create-custom-post-types-in-wordpress/
// WARNING! The modification may be completely wrong! 
// *****************************************************************************************************************
function create_posttype() {
 
    register_post_type( 'members',
    // Create Post Type Options
        array(
            'labels' => array(
				'firstname' =>__( 'Fornavn' ),
				'lastname' =>__( 'Etternavn' ),
		    		'fullname' =>__( 'For- og Etternavn'),
				'adress1' =>__( 'Adresse' ),
		    		'status' =>__( 'Active-Inactive' ),
				'email' =>__( 'E-post' ),
				'phonemobile' =>__( 'Tlf.mobil' ),
				'postaladdress' =>__( 'Postadresse' ),
				'postalcode' =>__( 'Postnr' ),	
				'userid' =>__( 'Tlf.Mobil' ),
				'id' =>__( 'PersonId' ),
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
