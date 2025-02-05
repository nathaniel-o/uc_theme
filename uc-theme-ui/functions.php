<?php

//add_theme_support( 'custom-logo' );

#    SOME EXAMPLES 

	#prints full URL to document
 	// echo get_theme_file_uri('/scripts/functions.js'); 

	#PRINT TO CONSOLE
	//echo "<script>console.log('PAGE INFO:  ".  $uc_page_id  ."');</script>" ;
	
#    SOME EXAMPLES





add_action( 'wp_enqueue_scripts', 'uc_enqueue_script' );
add_action( 'wp_enqueue_scripts', 'uc_enqueue_styles'  );
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
	get_theme_file_uri('/scripts/functions.js'),
	array( ),  /*  params: load strategy async/defer, in_footer t/f  */ 
  	time() );

        #prints only /wordpress/page-slug/
	        //echo $_SERVER['REQUEST_URI'];     

	
		
		#     is the same as WP's  $uc_page_id


}





  add_action( 'after_setup_theme', 'theme_support_setup' );
# I Forget what this does. 
function theme_support_setup() {   
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
}



function uc_page_id() {    #Passes slug from URI to JS for more usage. 
    // Only run on frontend, not in admin
    if (is_admin()) {
        return;
    }

    add_action('wp_head', function() {
        // Get the current URL path
		$e = $_SERVER['REQUEST_URI']; //own addition
    //    $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $segments = explode('/', $e);  
        
        // Get the second segment (after 'wordpress'), set to home if empty
		$slug = !empty($segments[2]) ? $segments[2] : 'home';
		

        if($slug != 'wp-json') {
            echo '<script> var pageID = "' . esc_js($slug) . '"</script>';
            echo '<script> console.log("' . esc_js($slug) . '");</script>';
        }
    });
}
add_action('init', 'uc_page_id');  
  #Must pass REFERENCE to a function, as a STRING to Hook




# This Function is called by header.php, 
function uc_dynamic_h1($uc_page_id){

	//Begin string so concatenation works
	$dynamic_h1 = "<h1>";


	#  If title follows "____ Cocktails, one line format... 
	if ($uc_page_id !== "home" && str_contains($uc_page_id, "gallery") == false && str_contains($uc_page_id, "contact") == false ){
		//$dynamic_h1 .= "&#8203;~&nbsp; " . ucfirst($uc_page_id) . " ~ &#8203; " . "Cocktails </h1>";	
		//$dynamic_h1 .=  ucfirst($uc_page_id) . " Cocktails</h1>" ;


		if (str_contains($uc_page_id, "-cocktails")){

			$page_bits = explode("-", $uc_page_id);  
	
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


function uc_dynamic_tagline($uc_page_id){

	$dynamic_h1 = '<h1>';
	#  Generate 2nd lines where <h1> is nonstandard
	if (str_contains($uc_page_id, "gallery")){
		$dynamic_h1 .= " ~ Gallery Page ~ </h1>";
	}  else if (str_contains($uc_page_id, "contact")){
        $dynamic_h1 .= "Learn More </h1>";
	} else if (str_contains($uc_page_id, "home")){ 
		$dynamic_h1 .= "Celebrating ~Every~ Occasion</h1>";
	}


	return $dynamic_h1;
}

//  OLD HTML Concatenation Carousel
function make_an_carousel($n){
	/*
	*  Each li=carousel_slide, shoud have id =carousel__slide[i] (all have tabindex="0" not sure why)
	*  div=carousel__snapper is the same for all, controls animation/behavior? 
	*  Back Button #1, should refer to #carousel__slide[n] where n is max slide # (the Last Slide)
	*   All Back Buttons else refer to i-1
	*  Forward Buttons Refer to i+1, until last (n) points to i=1
	*/


	$welcome_categories_arr = [
		// Last slide duplicate at start
		'<figure class = "home-figure portrait" id="foto-last-clone"><img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Cranberry-Citrus-Dragon_RO-T.jpg" alt = "Cranberry Citrus Dragon Romantic Cocktail" title = "Cranberry Citrus Dragon Romantic Cocktail" /><figcaption>Romantic Cocktails</figcaption></figure>',
		
		// Original slides
		'<figure class = "home-figure landscape"><img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Pair-of-Fireplace-Drinks_FP-T-scaled.jpg" alt = "Pair of Fireplace Drinks" title = "Pair of Fireplace Drinks" /><figcaption>Fireplace Cocktails</figcaption></figure>', 
		'<figure class = "home-figure portrait" id="foto-deux"><img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Ginger-Peach-n-Scotch_AU-T-rotated.jpg" alt = "Ginger Peach n\' Scotch Autumnal Cocktail" title = "Ginger Peach n\' Scotch Autumnal Cocktail" /><figcaption>Seasonal Cocktails</figcaption></figure>', 
		'<figure class = "home-figure portrait"><img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Holiday-Old-Fashioned-and-Kir-Royale_SO-T.jpg" alt = "Holiday Old Fashioned and Kir Royale" title = "Holiday Old Fashioned and Kir Royale" /><figcaption>Special Occasion Cocktails</figcaption></figure>', 
		'<figure class = "home-figure portrait" id="foto-quatre"><img src ="http://untouchedcocktails.com/wp-content/uploads/2024/09/Citrus-Gimlet-with-Butterfly-Pea-Flower-Float_EV-T.jpg" alt = "Citrus Gimlet with Butterfly Pea Flower Float Everyday Cocktail" title = "Citrus Gimlet with Butterfly Pea Flower Float Everyday Cocktail" /><figcaption>Everyday Cocktails</figcaption></figure>', 
		'<figure class = "home-figure portrait" id="foto-last"><img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Cranberry-Citrus-Dragon_RO-T.jpg" alt = "Cranberry Citrus Dragon Romantic Cocktail" title = "Cranberry Citrus Dragon Romantic Cocktail" /><figcaption>Romantic Cocktails</figcaption></figure>',
		
		// First slide duplicate at end
		'<figure class = "home-figure landscape" id="foto-first-clone"><img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Pair-of-Fireplace-Drinks_FP-T-scaled.jpg" alt = "Pair of Fireplace Drinks" title = "Pair of Fireplace Drinks" /><figcaption>Fireplace Cocktails</figcaption></figure>'
	];
	/*
	$welcome_categories_arr = ['<figure class = "home-figure landscape"><img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Pair-of-Fireplace-Drinks_FP-T-scaled.jpg" alt = "Pair of Fireplace Drinks" title = "Pair of Fireplace Drinks" /><figcaption>Fireplace Cocktails</figcaption></figure>', 
	'<figure class = "home-figure portrait" id="foto-deux"><img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Ginger-Peach-n-Scotch_AU-T-rotated.jpg" alt = "Ginger Peach n\' Scotch Autumnal Cocktail" title = "Ginger Peach n\' Scotch Autumnal Cocktail" /><figcaption>Seasonal Cocktails</figcaption>	</figure>', 
	'<figure class = "home-figure portrait"><img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Holiday-Old-Fashioned-and-Kir-Royale_SO-T.jpg" alt = "Holiday Old Fashioned and Kir Royale" title = "Holiday Old Fashioned and Kir Royale" /><figcaption>Special Occasion Cocktails</figcaption></figure>', 
	'<figure class = "home-figure portrait" id="foto-quatre"><img src ="http://untouchedcocktails.com/wp-content/uploads/2024/09/Citrus-Gimlet-with-Butterfly-Pea-Flower-Float_EV-T.jpg" alt = "Citrus Gimlet with Butterfly Pea Flower Float Everyday Cocktail"	title = "Citrus Gimlet with Butterfly Pea Flower Float Everyday Cocktail" /><figcaption>Everyday Cocktails</figcaption></figure>', 
	'<figure class = "home-figure portrait" id="foto-last"><img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Cranberry-Citrus-Dragon_RO-T.jpg" alt = "Cranberry Citrus Dragon Romantic Cocktail" title = "Cranberry Citrus Dragon Romantic Cocktail" /><figcaption>Romantic Cocktails</figcaption></figure>'];
	*/
	$wrappers = '<section class="carousel welcome-carousel" aria-label="Gallery"><ol class="carousel__viewport">';

	# Not in Use, just a Guide 
	$slide = '<li id="carousel__slide1"  tabindex="0"  class="carousel__slide">
          <div class="carousel__snapper">
                <!-- Back Button -->
                <a href="#carousel__slide4"
                   class="carousel__prev">
                </a>

            <!--  Carousel Slide #1 Content Here -->    
			<figure class = "home-figure landscape"><img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Pair-of-Fireplace-Drinks_FP-T-scaled.jpg" alt = "Pair of Fireplace Drinks" title = "Pair of Fireplace Drinks" /><figcaption>Fireplace Cocktails</figcaption></figure>
           
                <!-- Forward Button --> 
                <a href="#carousel__slide2"
                             class="carousel__next">
                </a>
          </div>
       </li>'; 
	  # echo $slide;




	# N Must be FOUR (4 !) for Index Carousel
	# For the number of slides desired...
	for($i = 0; $i <= $n; $i++){
		# Reset at each loop
		$new_slide = ' ';
		#tabIndex = 0 for all, else ($i-1)
		$new_li_snapper = '<li id="carousel__slide' . $i . '"  tabindex="0"  class="carousel__slide"> <div class="carousel__snapper"> ';
		$new_back_btn = ' ';		

		if($i<1){  //  If First Slide, point to Last Slide
			       //DO NOT USE if($i = any) , Server Shits Itself
				   // break; resolves infinitIF, but doesn't put content correctly
			$new_back_btn .= '<a href="#carousel__slide' . $n .'"  class="carousel__prev">  </a>';
		} else {   //  Else, point to previous slide   
			$new_back_btn .= '<a href="#carousel__slide' . ($i-1) .'"  class="carousel__prev">  </a>';	
		}

		/*
		*    INSERT CONTENT HERE 
		*/
		$the_slide_content = $welcome_categories_arr[$i]; 

		if($i < $n){ //If Not Last, Point to Next SLide 
			$new_forward_btn = '<a href="#carousel__slide' . ($i+1) . '"  class="carousel__next"> </a>';
		} elseif ($i = $n){ //If Last Slide, point to First Slide 
			$new_forward_btn = '<a href="#carousel__slide0"  class="carousel__next"> </a>';
		}
			$closing_li = '</div></li>';
		/*
		*    Assemble the pieces
		*/ 
		$new_slide .= $new_li_snapper;
		$new_slide .= $new_back_btn;  
		$new_slide .= $the_slide_content;
		$new_slide .= $new_forward_btn;
		$new_slide .= $closing_li;
	
		/*
		*    ADD EACH SLIDE TO $wrappers container 
		*/ 
		$wrappers .= $new_slide;
 	}  /* END FOR */
	$close_wrappers = '</ol></section>';   # Complete the Carousel by wrapping all <li> 
	$wrappers .= $close_wrappers;
	return $wrappers; 
} /* END fn make_an_carousel */




// Add AJAX handler for filter_carousel
add_action('wp_ajax_filter_carousel', 'handle_filter_carousel');
add_action('wp_ajax_nopriv_filter_carousel', 'handle_filter_carousel');

function handle_filter_carousel() {
    $search_term = isset($_POST['search_term']) ? sanitize_text_field($_POST['search_term']) : '';
    
    // Get drink posts
    $drink_posts = uc_get_drinks();
     
    // Generate carousel HTML
	$filtered_carousel = uc_filter_carousel($search_term, $drink_posts, 5, 0, 1, 1);
    echo $filtered_carousel;
	echo '<script>console.log(' . json_encode($filtered_carousel) . ');</script>';

    
    wp_die(); // Required for proper AJAX response
}







// DEBUGGING: Add this to see if patterns are being registered
add_action('init', function() {
    #error_log('Registered patterns: ' . print_r(WP_Block_Patterns_Registry::get_instance()->get_all_registered(), true));
});



add_action('after_setup_theme', function() {
    add_theme_support('post-thumbnails');  //forget what this does
    add_theme_support('wp-block-styles');  //forget what this does

	add_theme_support('custom-logo');
});



?>



<?php
##  The uc-slideshow Carousel Pattern.

       
    // Function to generate slideshow HTML, optional param for more data 
    function generate_slideshow_slides($images, $show_titles = 0, $show_content = 0) {
        $slides_html = '';
        foreach ($images as $image) {
            $title_html = $show_titles ? sprintf('<figcaption class="wp-block-jetpack-slideshow_caption">%s</figcaption>', esc_html($image['alt'])) : '';
            


            // Add content section if show_content is enabled
            $content_html = '';
            if ($show_content) {
                // Get post meta data
                $post = get_post($image['id']);
                $category = get_the_terms($image['id'], 'category');
                $color = get_post_meta($image['id'], 'drink_color', true);
                $glass = get_post_meta($image['id'], 'drink_glass', true);
                $garnish = get_post_meta($image['id'], 'drink_garnish1', true);

                //error_log('get_post_meta: ' . print_r(get_post_meta($image['id']), true));

                
                
                $base = get_post_meta($image['id'], 'drink_base', true);
                $ice = get_post_meta($image['id'], 'drink_ice', true);

    
                $content_html = sprintf(
                    '<div class="slideshow-content">
                        <h3><a href="%s">%s</a></h3>
                        <ul class="wp-block-list">
                            <li><em>Category</em>: %s</li>
                            <li><em>Color</em>: %s</li>
                            <li><em>Glass</em>: %s</li>
                            <li><em>Garnish</em>: %s</li>
                            <li><em>Base</em>: %s</li>
                            <li><em>Ice</em>: %s</li>
                        </ul>
                    </div>',
                    esc_url(get_permalink($image['id'])),
                    esc_html($image['alt']),
                    esc_html($category ? $category[0]->name : ''),
                    esc_html($color),
                    esc_html($glass),
                    esc_html($garnish),
                    esc_html($base),
                    esc_html($ice)
                );
            }
            
            $slides_html .= sprintf(
                '<li class="wp-block-jetpack-slideshow_slide swiper-slide">
                    <figure>
                        <img alt="%s" class="wp-block-jetpack-slideshow_image wp-image-%s" data-id="%s" src="%s"/>
                        %s
                        %s
                    </figure>
                </li>',
                esc_attr($image['alt']),
                esc_attr($image['id']),
                esc_attr($image['id']),
                esc_url($image['src']),
                $title_html,
                $content_html
            );
        }
		return $slides_html;
    }
    
	 // Define slideshow images //The Reference Example 
        /* $slideshow_images = array(
            array(
                'id' => '2765',
                'src' => 'http://localhost/wordpress/wp-content/uploads/2024/12/AU_Ginger-Peach-n-Scotch-T-rotated.jpg',
                'alt' => ''
            ),
            array(
                'id' => '2760',
                'src' => 'http://localhost/wordpress/wp-content/uploads/2024/12/Cherry-Limoncello-GT_AU-T-768x1024.jpg',
                'alt' => ''
            ),
            array(
                'id' => '2753',
                'src' => 'http://localhost/wordpress/wp-content/uploads/2024/12/Ribbon-Candy-Old-Fashioned_SO-2-768x1024.jpg',
                'alt' => ''
            )
        ); */




//Retrieve Drink Posts from DB 
//$drink_posts = uc_get_drinks();  //defined in uc-slideshow instead. 
function uc_get_drinks(){
    //  Count drink posts, return weird Query Object 
    $drink_query = new WP_Query(array(
        'post_type' => 'post', // or your custom post type
        'tax_query' => array(
            array(
                'taxonomy' => 'drinks', //Plural 
                'operator' => 'EXISTS'
            )
        ),
        'posts_per_page' => -1
    ));
    $post_count = $drink_query->found_posts;
    //echo "Number of posts with drinks: " . $post_count; 

    //  Copy results into a clean Array 
    $drink_posts = array();
    if ($drink_query->have_posts()) {
        while ($drink_query->have_posts()) {
            $drink_query->the_post();
            $drink_posts[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'thumbnail' => get_the_post_thumbnail_url(null, 'large'),
                'excerpt' => get_the_excerpt()
            );
        }
        wp_reset_postdata();
    }
   return $drink_posts;
}

//  Build Carousel with Random Images taken from Drink Posts
//$an_random_carousel = uc_random_carousel($drink_posts, 3, 1);  //multiple use cases in Content below 
function uc_random_carousel($drink_posts, $num_slides, $show_titles = 0, $show_content = 0){



   // Get a random post from the array
    $random_drink = $drink_posts[array_rand($drink_posts)]; 

    // You can now access the random post data like this:
    // echo $random_drink['title'];
    // echo $random_drink['permalink'];
    // etc.

   /*  echo '<pre>';
    print_r($random_drink);
    echo '</pre>';  */

    
    // Define slideshow images Param for generate_slideshow_slides
    $slideshow_images = array(
        array(
            'id' => '2765',
            'src' => 'http://localhost/wordpress/wp-content/uploads/2024/12/AU_Ginger-Peach-n-Scotch-T-rotated.jpg',
            'alt' => ''
        ),
        array(
            'id' => '2760',
            'src' => 'http://localhost/wordpress/wp-content/uploads/2024/12/Cherry-Limoncello-GT_AU-T-768x1024.jpg',
            'alt' => ''
        ),
        array(
            'id' => '2753',
            'src' => 'http://localhost/wordpress/wp-content/uploads/2024/12/Ribbon-Candy-Old-Fashioned_SO-2-768x1024.jpg',
            'alt' => ''
        )
    );

    for($i = 0; $i < $num_slides; $i++){
        $random_drink = $drink_posts[array_rand($drink_posts)]; 
        $slideshow_images[$i] = array(
            'id' => $random_drink['id'],
            'src' => $random_drink['thumbnail'],
            'alt' => $random_drink['title']
        );
    }

    // Instead of conditional, just pass the params to the function
    return generate_slideshow_slides($slideshow_images, $show_titles, $show_content);

}

// An Copy of uc_random_carousel, returns <li><figure>..etc Slides Content via generate_slideshow_slides
function uc_filter_carousel($srchStr, $drink_posts, $num_slides, $show_titles = 0, $show_content = 0, $supp_rand = 0) {
    // Get Drinks from array matching $srchStr
    $filtered_drinks = array_filter($drink_posts, function($drink) use ($srchStr) {
        return strpos(strtolower($drink['title']), strtolower($srchStr)) !== false;
    });

    // Convert to array to allow array_rand
    $filtered_drinks = array_values($filtered_drinks);

    //error_log('filtered_drinks: ' . print_r($filtered_drinks, true));
    

    // Initialize slideshow_images array
    $slideshow_images = array();

    // Keep track of used IDs to avoid duplicates
    $used_ids = array();

    // First, add matching drinks (up to num_slides)
    if (!empty($filtered_drinks)) {
        $matching_count = min(count($filtered_drinks), $num_slides);
        for($i = 0; $i < $matching_count; $i++) {
            $random_index = array_rand($filtered_drinks, 1);
            $random_drink = $filtered_drinks[$random_index];
            
            $slideshow_images[] = array(
                'id' => $random_drink['id'],
                'src' => $random_drink['thumbnail'],
                'alt' => $random_drink['title']
            );
            
            $used_ids[] = $random_drink['id'];
            
            // Remove used drink to avoid duplicates
            unset($filtered_drinks[$random_index]);
            $filtered_drinks = array_values($filtered_drinks);
        }
    }

    // If supp_rand is true or we have no filtered drinks, supplement with random posts
    if ($supp_rand || empty($filtered_drinks)) {
        // Fill remaining slots with random posts
        while(count($slideshow_images) < $num_slides) {
            $random_index = array_rand($drink_posts, 1);
            $random_drink = $drink_posts[$random_index];
            
            // Only add if not already used
            if (!in_array($random_drink['id'], $used_ids)) {
                $slideshow_images[] = array(
                    'id' => $random_drink['id'],
                    'src' => $random_drink['thumbnail'],
                    'alt' => $random_drink['title']
                );
                $used_ids[] = $random_drink['id'];
            }
        }
    }


    // Instead of conditional, just pass the params to the function
    return generate_slideshow_slides($slideshow_images, $show_titles, $show_content); //  returns <li><figure>..etc Slides Content
}




