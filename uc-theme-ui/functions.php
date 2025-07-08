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

   # //error_log($filtered_carousel);
    wp_die(); // Required for proper AJAX response
}

// Add AJAX handler for image randomization
add_action('wp_ajax_randomize_image', 'handle_randomize_image');
add_action('wp_ajax_nopriv_randomize_image', 'handle_randomize_image');

function handle_randomize_image() {
    error_log('handle_randomize_image called');
    error_log('POST data: ' . print_r($_POST, true));
    
    $current_id = isset($_POST['current_id']) ? sanitize_text_field($_POST['current_id']) : '';
    error_log('Current ID: ' . $current_id);
    
    // Define category IDs
    $category_ids = array('AU', 'SO', 'SU', 'SP', 'FP', 'EV', 'RO', 'WI');
    
    // Parse current image title for category ID
    $current_category = '';
    if (!empty($current_id)) {
        $current_attachment = get_post($current_id);
        if ($current_attachment) {
            $current_title = $current_attachment->post_title;
            foreach ($category_ids as $id) {
                if (strpos($current_title, $id) !== false) {
                    $current_category = $id;
                    error_log('Found current category: ' . $current_category);
                    break;
                }
            }
        }
    }
    
    // Build query args
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'post_status' => 'inherit',
        'posts_per_page' => 1,
        'orderby' => 'rand',
        'exclude' => array($current_id) // Exclude current image if provided
    );
    
    // If we found a category, filter by it
    if (!empty($current_category)) {
        // Get all images and filter by title content
        $all_attachments = get_posts(array(
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'post_status' => 'inherit',
            'posts_per_page' => -1,
            'exclude' => array($current_id)
        ));
        
        // Filter attachments that contain the category ID
        $filtered_attachments = array();
        foreach ($all_attachments as $attachment) {
            if (strpos($attachment->post_title, $current_category) !== false) {
                $filtered_attachments[] = $attachment;
            }
        }
        
        if (!empty($filtered_attachments)) {
            $random_attachment = array($filtered_attachments[array_rand($filtered_attachments)]);
            error_log('Found ' . count($filtered_attachments) . ' images with category ' . $current_category);
        } else {
            error_log('No images found with category ' . $current_category . ', trying without category filter');
            $random_attachment = get_posts($args);
        }
    } else {
        $random_attachment = get_posts($args);
    }
    
    if (empty($random_attachment)) {
        wp_send_json_error(array('message' => 'No images found in Media Library'));
        return;
    }
    
    $attachment = $random_attachment[0];
    $attachment_id = $attachment->ID;
    
    // Get attachment data
    $attachment_data = wp_get_attachment_image_src($attachment_id, 'large');
    $attachment_metadata = wp_get_attachment_metadata($attachment_id);
    
    // Get responsive image data
    $image_srcset = wp_get_attachment_image_srcset($attachment_id);
    $image_sizes = wp_get_attachment_image_sizes($attachment_id);
    
    // Get caption and format it properly
    $caption = wp_get_attachment_caption($attachment_id);
    if (empty($caption)) {
        // If no caption, use the attachment title
        $caption = $attachment->post_title;
        // Normalize the title by:
        // 1. Replace hyphens and underscores with spaces
        // 2. Remove numbers and special characters
        // 3. Remove file extensions
        // 4. Clean up extra spaces
        // 5. Remove 'T2' anywhere it exists
        // 6. Remove anything after underscore
        $normalized_title = $attachment->post_title;
        $normalized_title = preg_replace('/_\w+.*$/', '', $normalized_title); // Remove anything after underscore
        $normalized_title = str_replace(['-', '_'], ' ', $normalized_title); // Replace - and _ with space
        $normalized_title = preg_replace('/[\d\-_]+$/', '', $normalized_title); // Remove trailing numbers and separators
        $normalized_title = preg_replace('/\.\w+$/', '', $normalized_title); // Remove file extension
        $normalized_title = preg_replace('/\s+/', ' ', $normalized_title); // Clean up multiple spaces
        $normalized_title = str_replace('T2', '', $normalized_title); // Remove 'T2' anywhere
        $normalized_title = preg_replace('/\s+/', ' ', $normalized_title); // Clean up multiple spaces again
        $normalized_title = trim($normalized_title); // Remove leading/trailing spaces
        
        

        $caption = $normalized_title;

    }
    
    // Debug logging
    error_log('Randomizing image - Attachment ID: ' . $attachment_id . ', Title: ' . $attachment->post_title . ', URL: ' . $attachment_data[0]);
    
    // Prepare the response with all WordPress image attributes
    $image_data = array(
        'id' => $attachment_id,
        'title' => $attachment->post_title,
        'src' => $attachment_data[0],
        'alt' => get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ?: $attachment->post_title,
        'attachment_id' => $attachment_id,
        'srcset' => $image_srcset,
        'sizes' => $image_sizes,
        'data_orig_file' => $attachment_data[0],
        'data_orig_size' => $attachment_data[1] . ',' . $attachment_data[2],
        'data_image_title' => $attachment->post_title,
        'data_image_caption' => $caption,
        'data_medium_file' => wp_get_attachment_image_url($attachment_id, 'medium'),
        'data_large_file' => wp_get_attachment_image_url($attachment_id, 'large')
    );
    
    error_log('Sending image data: ' . print_r($image_data, true));
    
    wp_send_json_success(array('image' => $image_data));
}







add_action('wp_head', function() {
    # FOR DEBUG //error_log('Registered patterns: ' . print_r(WP_Block_Patterns_Registry::get_instance()->get_all_registered(), true));
    echo dom_content_loaded(testing_backgrounds(), 'styleImagesByPageID(pageID);', 'ucSetupImageRandomization;' );    //    Pass JS backgrounds function into DOMContent Evt Lstnr

    
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



?>



<?php
##  The uc-slideshow Carousel Pattern.

       
    // Function to generate slideshow HTML, optional param for more data 
    function generate_slideshow_slides($images, $show_titles = 0, $show_content = 0) {
        $slides_html = '';
        $total_slides = count($images);
        
        // Add last slide as first for infinite loop
        $last_image = end($images);
        $slides_html .= generate_single_slide($last_image, $total_slides - 1, true, $show_titles, $show_content);
        
        // Generate regular slides
        foreach ($images as $index => $image) {
            $slides_html .= generate_single_slide($image, $index, false, $show_titles, $show_content);
        }
        
        // Add first slide as last for infinite loop
        $first_image = reset($images);
        $slides_html .= generate_single_slide($first_image, 0, true, $show_titles, $show_content);
        
        return $slides_html;
    }
    
    function generate_single_slide($image, $index, $is_duplicate, $show_titles, $show_content) {
        // Get post meta data
        $post = get_post($image['id']);
        $drinks = get_the_terms($image['id'], 'drinks');  // Changed from 'category' to 'drinks'
        $color = get_post_meta($image['id'], 'drink_color', true);
        $glass = get_post_meta($image['id'], 'drink_glass', true);
        $garnish = get_post_meta($image['id'], 'drink_garnish1', true);
        $base = get_post_meta($image['id'], 'drink_base', true);
        $ice = get_post_meta($image['id'], 'drink_ice', true);

        $slide_classes = array(
            'wp-block-jetpack-slideshow_slide',
            'swiper-slide',
            $is_duplicate ? 'swiper-slide-duplicate' : ''
        );

        $html = '<li class="' . implode(' ', array_filter($slide_classes)) . '" ';
        $html .= 'data-swiper-slide-index="' . $index . '" aria-hidden="true">';
        $html .= '<figure>';
        $html .= '<img alt="' . esc_attr($image['alt']) . '" ';
        $html .= 'class="wp-block-jetpack-slideshow_image wp-image-' . esc_attr($image['id']) . '" ';
        $html .= 'data-id="' . esc_attr($image['id']) . '" ';
        $html .= 'src="' . esc_url($image['src']) . '">';

        if ($show_content) {
            $html .= '<div class="slideshow-content">';
            $html .= '<h3><a href="' . get_permalink($image['id']) . '">' . esc_html($image['alt']) . '</a></h3>';
            $html .= '<ul class="wp-block-list">';
            $html .= '<li><em>Category</em>: ' . esc_html($drinks ? $drinks[0]->name : 'Uncategorized') . '</li>';
            $html .= '<li><em>Color</em>: ' . esc_html($color) . '</li>';
            $html .= '<li><em>Glass</em>: ' . esc_html($glass) . '</li>';
            $html .= '<li><em>Garnish</em>: ' . esc_html($garnish) . '</li>';
            $html .= '<li><em>Base</em>: ' . esc_html($base) . '</li>';
            $html .= '<li><em>Ice</em>: ' . esc_html($ice) . '</li>';
            $html .= '</ul>';
            $html .= '</div>';
        }

        $html .= '</figure>';
        $html .= '</li>';

        return $html;
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


function uc_drink_query(){

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

    return $drink_query;

}



//Retrieve Drink Posts from DB 
//$drink_posts = uc_get_drinks();  //defined in uc-slideshow instead. 
function uc_get_drinks(){

    $drink_query = uc_drink_query();
   
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
function uc_random_carousel($drink_posts, $num_slides, $show_titles = 0, $show_content = 0) {
    //error_log('Starting uc_random_carousel');
    //error_log('Requested slides: ' . $num_slides);
    //error_log('Available posts: ' . count($drink_posts));

    $slideshow_images = array();
    $used_ids = array();

    // Keep trying until we have the requested number of slides
    while (count($slideshow_images) < $num_slides) {
        if (empty($drink_posts)) {
            //error_log('No more available posts to select from');
            break;
        }

        $random_index = array_rand($drink_posts);
        $random_drink = $drink_posts[$random_index];
        
        // Only add if not already used
        if (!in_array($random_drink['id'], $used_ids)) {
            $slideshow_images[] = array(
                'id' => $random_drink['id'],
                'src' => $random_drink['thumbnail'],
                'alt' => $random_drink['title']
            );
            $used_ids[] = $random_drink['id'];
            //error_log('Added slide ' . count($slideshow_images) . ': ' . $random_drink['title']);
            
            // Remove used drink from available pool
            unset($drink_posts[$random_index]);
            $drink_posts = array_values($drink_posts);
        }
    }

    //error_log('Final number of slides: ' . count($slideshow_images));
    return generate_slideshow_slides($slideshow_images, $show_titles, $show_content);
}

// An Copy of uc_random_carousel, returns <li><figure>..etc Slides Content via generate_slideshow_slides
function uc_filter_carousel($srchStr, $drink_posts, $num_slides, $show_titles = 0, $show_content = 0, $supp_rand = 0) {
    //error_log('Starting uc_filter_carousel');
    //error_log('Search term: ' . $srchStr);
    //error_log('Requested slides: ' . $num_slides);
    //error_log('Available posts: ' . count($drink_posts));

    // Filter drinks matching search string
    $filtered_drinks = array_filter($drink_posts, function($drink) use ($srchStr) {
        return stripos($drink['title'], $srchStr) !== false;
    });
    $filtered_drinks = array_values($filtered_drinks);
    
    //error_log('Matching posts found: ' . count($filtered_drinks));

    $slideshow_images = array();
    $used_ids = array();

    // First add matching drinks
    while (count($slideshow_images) < $num_slides && !empty($filtered_drinks)) {
        $random_index = array_rand($filtered_drinks);
        $random_drink = $filtered_drinks[$random_index];
        
        if (!in_array($random_drink['id'], $used_ids)) {
            $slideshow_images[] = array(
                'id' => $random_drink['id'],
                'src' => $random_drink['thumbnail'],
                'alt' => $random_drink['title']
            );
            $used_ids[] = $random_drink['id'];
            //error_log('Added matching slide ' . count($slideshow_images) . ': ' . $random_drink['title']);
            
            unset($filtered_drinks[$random_index]);
            $filtered_drinks = array_values($filtered_drinks);
        }
    }

    // If supp_rand is true and we need more slides, add random ones
    if ($supp_rand && count($slideshow_images) < $num_slides) {
        //error_log('Supplementing with random slides. Current count: ' . count($slideshow_images));
        
        while (count($slideshow_images) < $num_slides && !empty($drink_posts)) {
            $random_index = array_rand($drink_posts);
            $random_drink = $drink_posts[$random_index];
            
            if (!in_array($random_drink['id'], $used_ids)) {
                $slideshow_images[] = array(
                    'id' => $random_drink['id'],
                    'src' => $random_drink['thumbnail'],
                    'alt' => $random_drink['title']
                );
                $used_ids[] = $random_drink['id'];
                //error_log('Added random slide ' . count($slideshow_images) . ': ' . $random_drink['title']);
                
                unset($drink_posts[$random_index]);
                $drink_posts = array_values($drink_posts);
            }
        }
    }

    //error_log('Final number of slides: ' . count($slideshow_images));
    return generate_slideshow_slides($slideshow_images, $show_titles, $show_content);
}


// Allow HTML in excerpts
remove_filter('get_the_excerpt', 'wp_strip_all_tags');





// Generate metadata list for a post
function uc_generate_metadata_list($post_id) {
    $drinks = get_the_terms($post_id, 'drinks');
    $color = get_post_meta($post_id, 'drink_color', true);
    $glass = get_post_meta($post_id, 'drink_glass', true);
    $garnish = get_post_meta($post_id, 'drink_garnish1', true);
    $base = get_post_meta($post_id, 'drink_base', true);
    $ice = get_post_meta($post_id, 'drink_ice', true);

    // Start an unordered list
    $output = '<ul class="drink-metadata-list">';
    
    if ($drinks) {
        $output .= sprintf("<li>Category: %s</li>", esc_html($drinks[0]->name));
    }
    if ($color) {
        $output .= sprintf("<li>Color: %s</li>", esc_html($color));
    }
    if ($glass) {
        $output .= sprintf("<li>Glass: %s</li>", esc_html($glass));
    }
    if ($garnish) {
        $output .= sprintf("<li>Garnish: %s</li>", esc_html($garnish));
    }
    if ($base) {
        $output .= sprintf("<li>Base: %s</li>", esc_html($base));
    }
    if ($ice) {
        $output .= sprintf("<li>Ice: %s</li>", esc_html($ice));
    }
    
    $output .= '</ul>';
    
    return $output;
}

// Update all drink post excerpts
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

// Uncomment the following line to update all excerpts, then comment it out again
//add_action('init', 'uc_update_all_drink_excerpts');

// Clear all drink post excerpts
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

// Uncomment the following line to run once, then comment it out again
//add_action('init', 'uc_clear_all_drink_excerpts');





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









