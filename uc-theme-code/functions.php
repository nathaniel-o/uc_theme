<?php

add_theme_support( 'custom-logo' );


function uc_enqueue_styles(){
	wp_enqueue_style( 
		'uc-theme-slug',
		get_theme_file_uri( 'style.css' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		'all', 
	);

	wp_enqueue_style( 
		'iconoir',
		'https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css',
		array()
	);
}



function uc_enqueue_script(){
	wp_enqueue_script(
	'uc-script',
	get_theme_file_uri('/scripts/source-libraryy.js'),
	array( ),  /*  params: load strategy async/defer, in_footer t/f  */ 
  	time() );

        #prints only /wordpress/page-slug/
	        //echo $_SERVER['REQUEST_URI'];     

	
		
		#     is the same as WP's  $page_id


}





/* */add_action( 'wp_enqueue_scripts', 'uc_enqueue_script' );
add_action( 'wp_enqueue_scripts', 'uc_enqueue_styles'  );




	
	#prints full URL to document
 		// echo get_theme_file_uri('/scripts/source-libraryy.js'); 

	#PRINT TO CONSOLE
	//echo "<script>console.log('PAGE INFO:  ".  $page_id  ."');</script>" ;
	









# This Function is called by header.php, 
function uc_dynamic_h1($page_id){

	//Begin string so concatenation works
	$dynamic_h1 = "<h1>";


	#  If title follows "____ Cocktails, one line format... 
	if ($page_id !== "home" && str_contains($page_id, "gallery") == false && str_contains($page_id, "contact") == false ){
		//$dynamic_h1 .= "&#8203;~&nbsp; " . ucfirst($page_id) . " ~ &#8203; " . "Cocktails </h1>";	
		//$dynamic_h1 .=  ucfirst($page_id) . " Cocktails</h1>" ;


		if (str_contains($page_id, "-cocktails")){

			$page_bits = explode("-", $page_id);  
	
			for($i = 0; $i < count($page_bits) ; $i++){
				//echo "<pre>" . $i . $page_bits[$i] . "</pre>" ;
				$dynamic_h1 .= " ";
				$dynamic_h1 .= ucfirst($page_bits[$i]) ; 
				
			}
			//echo "<pre> HELP:" . $dynamic_h1 . ": HELP</pre>" ;
			
	
		}

		$dynamic_h1 .= "</h1>";
	} 

	else {  #otherwise, complete first line
		$dynamic_h1 .= " Untouched Cocktails</h1>";
	}
	
	return $dynamic_h1;
}



function uc_dynamic_tagline($page_id){

	$dynamic_h1 = '<h1>';
	#  Generate 2nd lines where <h1> is nonstandard
	if (str_contains($page_id, "gallery")){
		$dynamic_h1 .= " ~ Gallery Page ~ </h1>";
	}  else if (str_contains($page_id, "contact")){
        $dynamic_h1 .= "Learn More </h1>";
	} else if (str_contains($page_id, "home")){ 
		$dynamic_h1 .= "Celebrating ~Every~ Occasion</h1>";
	}


	return $dynamic_h1;
}













#accepts $_SERVER[REQUEST_URI]
#returns WP  page slug /such-as-this-cocktails/
function uc_page_id($page_name){
    #accepts $_SERVER[REQUEST_URI]
	$page_name = $page_name;
	

	#  Isolate Slug from URL format by separate at / 
	//$page_name = explode("/", $page_name)[2]; 
	$page_name = trim($page_name, "/");
	#  Isolate page title from slug where /title-cocktails/ is the format


	return $page_name;

}















 

/*  add_action( 'wp_enqueue_scripts', 'uc_enqueue_scripts_and_styles' );
function uc_enqueue_scripts_and_styles(){
	uc_enqueue_script();
	uc_enqueue_styles(); 
	

}  */

//add_action( 'wp_enqueue_scripts','uc_enqueue_scripts_and_styles');



  #  $to = $_POST['email']; //[email protected]
  #  $subject = 'The subject';
  #  $body = 'The email body content';
  #  $headers = array('Content-Type: text/html; charset=UTF-8');

  #  wp_mail( $to, $subject, $body, $headers );

























function register_my_menus() {

  register_nav_menus(
    array(
      'site-ribbon' => __( 'Site Ribbon' ),
      
    )
  );

  
}
add_action( 'init', 'register_my_menus' );
?>