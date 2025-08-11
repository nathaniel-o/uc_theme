<?php


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
	
	// Add custom CSS for rotated images - not sure what this does since removing inline click effects @ images randomizer 
	wp_add_inline_style('uc-theme-slug', ' 
		img.rotate-90 { transform: rotate(90deg); }
		img.rotate-180 { transform: rotate(180deg); }
		img.rotate-270 { transform: rotate(270deg); }
		img.rotate-custom { transform: rotate(var(--rotation-angle)); }
		
		
	');
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

add_action( 'init', 'uc_register_taxonomy_drinks' );
// taxonomy.php
function uc_register_taxonomy_drinks() {
    $labels = array(
        'name'              => _x( 'Drinks', 'taxonomy general name' ),
        'singular_name'     => _x( 'Drink', 'taxonomy singular name' ),
        // ...
    );
    $args = array(
        'hierarchical'      => true, // hierarchical taxonomy
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'drink' ),
    );
    register_taxonomy( 'drinks', array( 'post' ), $args );
}

//Passes slug from URI to JS for more usage. 
function uc_page_id() {    
    // Only run on frontend, not in admin
    if (is_admin()) {
        return;
    }

    add_action('wp_head', function() {
        // Get current URL path and remove leading/trailing slashes
        $slug = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        
        
        // Remove any backslash and all preceding characters i.e. the wordpress-folder/ prefix. 
        $slug = preg_replace('/^.*\//', '', $slug);

        //  Finally, remove the trailing -cocktails if exists (due simplified CSS vars)
        $slug = preg_replace('/-cocktails$/', '', $slug);

        
        // Set to 'home' if empty
        if (empty($slug)) {
            $slug = 'home';
        }

        if ($slug != 'wp-json') {
            echo '<script> var pageID = "' . esc_js($slug) . '"</script>';
            echo '<script> console.log("Page Slug: ' . esc_js($slug) . '");</script>';
        }
    });
}
add_action('init', 'uc_page_id');  
  #Must pass REFERENCE to a function, as a STRING to Hook

add_action('wp_head', function() {
    # FOR DEBUG //error_log('Registered patterns: ' . print_r(WP_Block_Patterns_Registry::get_instance()->get_all_registered(), true));
    echo dom_content_loaded(testing_backgrounds(), 'styleImagesByPageID(pageID);', 0 );    //    Pass JS backgrounds function into DOMContent Evt Lstnr

    
});

/*
* Wrapper function that applies DOMContentLoaded event listener to testing_backgrounds output
*/
function dom_content_loaded($your_function, $another, $more) {
    $background_script = $your_function;

    if ($another != 0) {
        $background_script .= $another;
    }

    if ($more != 0) {
        $background_script .= $more;
    }
    
    // If there's no script output, return empty
    if (empty($background_script)) {
        return '';
    }
    
    // Wrap in DOMContentLoaded event listener
    return '<script>document.addEventListener("DOMContentLoaded", function() { ' . $background_script . ' });</script>';
}

/*
*    Based on page type, 
*/
function testing_backgrounds(){
    $script_output = '';

    if(is_single() ){    //    If the page is a single post 
        $post_id = get_the_ID();    //    Get the ID #### of the post
        echo '<script>console.log("Current Post ID: ' . esc_js($post_id) . '");</script>';

        // Check if post has drinks taxonomy
        $taxonomies = get_object_taxonomies('post');
        if (in_array('drinks', $taxonomies)) {
            $terms = wp_get_post_terms($post_id, 'drinks');    //    Get the Drink Categor(ies) 
            if (!empty($terms) && !is_wp_error($terms)) {
                echo '<script>console.log("Post has Drinks taxonomy terms: ' . esc_js(implode(', ', wp_list_pluck($terms, 'name'))) . '");</script>';
            }

            // Map taxonomy terms to background image variables
            $term_to_bg_map = array(
                'Everyday Cocktails' => 'everyday-cocktails-bg-img',
                'Romantic Cocktails' => 'romantic-cocktails-bg-img', 
                'Special Occasion Cocktails' => 'special-occasion-cocktails-bg-img',
                'Summertime Cocktails' => 'summertime-cocktails-bg-img',
                'Springtime Cocktails' => 'springtime-cocktails-bg-img',
                'Fireplace Cocktails' => 'fireplace-cocktails-bg-img',
                'Wintertime Cocktails' => 'winter-cocktails-bg-img',
                'Autumnal Cocktails' => 'autumnal-cocktails-bg-img'
            );

            foreach ($terms as $term) {
                if (isset($term_to_bg_map[$term->name])) {
                    $bg_var = $term_to_bg_map[$term->name];
                     echo '<script>console.log("Background variable for ' . esc_js($term->name) . ': var(--' . esc_js($bg_var) . ')");</script>';
                    
                    //  Output for Single Posts 
                    $script_output =  'var drinkBg = "var(--' . esc_js($bg_var) . ')"; ucInsertDrinkPostsBg(drinkBg);';
                }
                /* else {
                    echo '<script>console.log("No background variable found for ' . esc_js($term->name) . '");</script>';
                } */
            }
        }
    } /*  end IF is_single()  */
    
    else {
        /* DOM Listener here, whereas for posts it's contained in JS function ucInsertDrinkPostsBg()s */ 
        $script_output = 'ucInsertTierOneBg();';
    }
    

    return $script_output;
    
}

add_action('after_setup_theme', function() {
    add_theme_support('post-thumbnails');  //forget what this does
    add_theme_support('wp-block-styles');  //forget what this does

	add_theme_support('custom-logo');
});

// Allow HTML in excerpts  ?? ? ? 
//remove_filter('get_the_excerpt', 'wp_strip_all_tags');

# This Function is Not in Use. 
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

// Customize WordPress Core Lightbox to show titles
function uc_customize_lightbox_overlay() {
    // Remove the default lightbox overlay
    remove_action('wp_footer', 'block_core_image_print_lightbox_overlay');
    
    // Add our custom lightbox overlay
    add_action('wp_footer', 'uc_custom_lightbox_overlay');
}
add_action('init', 'uc_customize_lightbox_overlay');

function uc_custom_lightbox_overlay() {
    $close_button_label = esc_attr__('Close');

    // Get theme colors
    $background_color   = '#fff';
    $close_button_color = '#000';
    if (wp_theme_has_theme_json()) {
        $global_styles_color = wp_get_global_styles(array('color'));
        if (!empty($global_styles_color['background'])) {
            $background_color = esc_attr($global_styles_color['background']);
        }
        if (!empty($global_styles_color['text'])) {
            $close_button_color = esc_attr($global_styles_color['text']);
        }
    }

    echo <<<HTML
        <div
            class="wp-lightbox-overlay zoom"
            data-wp-interactive="core/image"
            data-wp-context='{}'
            data-wp-bind--role="state.roleAttribute"
            data-wp-bind--aria-label="state.currentImage.ariaLabel"
            data-wp-bind--aria-modal="state.ariaModal"
            data-wp-class--active="state.overlayEnabled"
            data-wp-class--show-closing-animation="state.showClosingAnimation"
            data-wp-watch="callbacks.setOverlayFocus"
            data-wp-on--keydown="actions.handleKeydown"
            data-wp-on-async--touchstart="actions.handleTouchStart"
            data-wp-on--touchmove="actions.handleTouchMove"
            data-wp-on-async--touchend="actions.handleTouchEnd"
            data-wp-on-async--click="actions.hideLightbox"
            data-wp-on-async-window--resize="callbacks.setOverlayStyles"
            data-wp-on-async-window--scroll="actions.handleScroll"
            data-wp-bind--style="state.overlayStyles"
            tabindex="-1"
            >
                <button type="button" aria-label="$close_button_label" style="fill: $close_button_color" class="close-button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><path d="m13.06 12 6.47-6.47-1.06-1.06L12 10.94 5.53 4.47 4.47 5.53 10.94 12l-6.47 6.47 1.06 1.06L13.06 12Z"></path></svg>
                </button>
                <div class="lightbox-image-container">
                    <figure data-wp-bind--class="state.currentImage.figureClassNames" data-wp-bind--style="state.figureStyles">
                        <img data-wp-bind--alt="state.currentImage.alt" data-wp-bind--class="state.currentImage.imgClassNames" data-wp-bind--style="state.imgStyles" data-wp-bind--src="state.currentImage.currentSrc">
                        <figcaption class="lightbox-caption" data-wp-text="state.currentImage.alt"></figcaption>
                    </figure>
                </div>
                <div class="lightbox-image-container">
                    <figure data-wp-bind--class="state.currentImage.figureClassNames" data-wp-bind--style="state.figureStyles">
                        <img data-wp-bind--alt="state.currentImage.alt" data-wp-bind--class="state.currentImage.imgClassNames" data-wp-bind--style="state.imgStyles" data-wp-bind--src="state.enlargedSrc">
                        <figcaption class="lightbox-caption" data-wp-text="state.currentImage.alt"></figcaption>
                    </figure>
                </div>
                <div class="scrim" style="background-color: $background_color" aria-hidden="true"></div>
        </div>
HTML;
}

// Add custom CSS to style the lightbox captions
function uc_add_lightbox_caption_styles() {
    echo '<style>
        /* Show captions in lightbox */
        .wp-lightbox-overlay .wp-block-image figcaption {
            display: block !important;
        }
        
        /* Style the lightbox captions */
        .wp-lightbox-overlay .lightbox-caption {
            color: #fff;
            text-align: center;
            padding: 10px;
            background: rgba(0, 0, 0, 0.7);
            margin-top: 10px;
            border-radius: 4px;
            font-size: 14px;
            line-height: 1.4;
        }
        
        /* Ensure caption doesn\'t interfere with image positioning */
        .wp-lightbox-overlay .wp-block-image {
            flex-direction: column;
        }
    </style>';
}
add_action('wp_head', 'uc_add_lightbox_caption_styles');



/**
 * Update all drink post excerpts
 */
function uc_update_all_drink_excerpts() {
    $drinks_query = uc_drink_query();

    if ($drinks_query->have_posts()) {
        while ($drinks_query->have_posts()) {
            $drinks_query->the_post();
            $post_id = get_the_ID();
            $new_excerpt = uc_generate_metadata_list($post_id);
            
            wp_update_post(array(
                'ID' => $post_id,
                'post_excerpt' => $new_excerpt
            ));
        }
        wp_reset_postdata();
    }
}

/**
 * Clear all drink post excerpts
 */
function uc_clear_all_drink_excerpts() {
    $drinks_query = uc_drink_query();

    if ($drinks_query->have_posts()) {
        while ($drinks_query->have_posts()) {
            $drinks_query->the_post();
            $post_id = get_the_ID();
            
            wp_update_post(array(
                'ID' => $post_id,
                'post_excerpt' => ''  // Set excerpt to empty string
            ));
        }
        wp_reset_postdata();
    }
}

?>




