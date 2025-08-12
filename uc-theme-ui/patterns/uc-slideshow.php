<?php
/**
 * Title: UC Slideshow
 * Slug: uc-slideshow
 * Categories: Featured
*/
?>
<!-- Pattern code goes here. -->
 








<!-- Pattern code goes here. -->
<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<h3> Make Evt Listen with AJAX </h3> 
<!-- wp:jetpack/slideshow {"autoplay":true,"ids":[2765,2760,2753],"sizeSlug":"large"} -->

<div class="wp-block-jetpack-slideshow aligncenter uc-slideshow hidden" data-autoplay="true" data-delay="3" data-effect="slide" data-slides="5">
    <div class="wp-block-jetpack-slideshow_container swiper-container">
        <ul class="wp-block-jetpack-slideshow_swiper-wrapper swiper-wrapper uc-swiper-list">
            <?php //echo generate_slideshow_slides($slideshow_images);  // The Reference Example 

            $drink_posts = uc_get_drinks();
            
            // Get search term using get_search_query()
            $search_term = get_search_query();

            // Or using $_GET with sanitization
            //$search_term = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

            if($search_term){
            // Then use it in your carousel
                $filter_carousel=uc_filter_carousel($search_term, $drink_posts, 5, 0, 1, 1); //uses generate_slideshow_slides
            } else {

                $filter_carousel=uc_random_carousel($drink_posts, 5, 0, 1);

            }
            //error_log('filter_carousel: ' . print_r($filter_carousel, true));

            echo $filter_carousel;

            ?>  
            <!-- THE PRIOR EXAMPLE: ?php echo uc_filter_carousel('mar', $drink_posts, 3, 0, 1); ?--> 
        </ul>



        
        <!-- ... rest of slideshow controls ... -->
        <a class="wp-block-jetpack-slideshow_button-prev swiper-button-prev swiper-button-white" role="button" tabindex="0" aria-label="Previous slide" aria-controls="swiper-wrapper-3446d0c323a53100f">
            </a>
            <a class="wp-block-jetpack-slideshow_button-next swiper-button-next swiper-button-white" role="button" tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-3446d0c323a53100f">
            </a>
            <a aria-label="Pause Slideshow" class="wp-block-jetpack-slideshow_button-pause" role="button">
            </a>
            <div class="wp-block-jetpack-slideshow_pagination swiper-pagination swiper-pagination-white swiper-pagination-custom"><button class="swiper-pagination-bullet swiper-pagination-bullet-active" tab-index="0" role="button" aria-label="Go to slide 1"></button></div>
    </div>
<!-- /wp:jetpack/slideshow -->
</div>
<!-- /wp:group -->








<?php

/*    THESE FUNCTIONS MAYBE DUPLICATE OF cocktail-images/includes/functions.php
*    MOVED HERE TO FIX FATAL REDECLARATION ERRORS
*    COMPARE BEFORE UNCOMMENT  ! ! 
*
*
*
*


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
//         $slideshow_images = array(
//            array(
//                'id' => '2765',
//                'src' => 'http://localhost/wordpress/wp-content/uploads/2024/12/AU_Ginger-Peach-n-Scotch-T-rotated.jpg',
//                'alt' => ''
//            ),
///            array(
 //               'id' => '2760',
//                'src' => 'http://localhost/wordpress/wp-content/uploads/2024/12/Cherry-Limoncello-GT_AU-T-768x1024.jpg',
//                'alt' => ''
//            ),
//            array(
//                'id' => '2753',
//                'src' => 'http://localhost/wordpress/wp-content/uploads/2024/12/Ribbon-Candy-Old-Fashioned_SO-2-768x1024.jpg',
//                'alt' => ''
//            )
//        ); 


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

*/

?>







<?php    //    PAST ITERATIONS BELOW    //

/* <!-- Pattern code goes here. -->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<h3> Supplement with Random Drinks</h3>
<!-- wp:jetpack/slideshow {"autoplay":true,"ids":[2765,2760,2753],"sizeSlug":"large"} -->



<div class="wp-block-jetpack-slideshow aligncenter" data-autoplay="true" data-delay="3" data-effect="slide">
    <div class="wp-block-jetpack-slideshow_container swiper-container">
        <ul class="wp-block-jetpack-slideshow_swiper-wrapper swiper-wrapper">
            <?php //echo generate_slideshow_slides($slideshow_images);  // The Reference Example 
            
            // Get search term using get_search_query()
            $search_term = get_search_query();

            // Or using $_GET with sanitization
            //$search_term = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

            $filter_carousel=uc_filter_carousel($search_term, $drink_posts, 12, 0, 1, 1);

            //error_log('filter_carousel: ' . print_r($filter_carousel, true));


            // Then use it in your carousel

            echo $filter_carousel;

              
            <!-- THE PRIOR EXAMPLE: ?php echo uc_filter_carousel('mar', $drink_posts, 3, 0, 1); ?--> 
        </ul>



        <!-- ... rest of slideshow controls ... -->
            <a class="wp-block-jetpack-slideshow_button-prev swiper-button-prev swiper-button-white" role="button">
            </a>
            <a class="wp-block-jetpack-slideshow_button-next swiper-button-next swiper-button-white" role="button">
            </a>
            <a aria-label="Pause Slideshow" class="wp-block-jetpack-slideshow_button-pause" role="button">
            </a>
            <div class="wp-block-jetpack-slideshow_pagination swiper-pagination swiper-pagination-white">
            </div>
    </div>
<!-- /wp:jetpack/slideshow -->
</div>
<!-- /wp:group -->





<!-- Pattern code goes here. -->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<h3> Add Filter by Search Term</h3>
<!-- wp:jetpack/slideshow {"autoplay":true,"ids":[2765,2760,2753],"sizeSlug":"large"} -->

<div class="wp-block-jetpack-slideshow aligncenter" data-autoplay="true" data-delay="3" data-effect="slide">
    <div class="wp-block-jetpack-slideshow_container swiper-container">
        <ul class="wp-block-jetpack-slideshow_swiper-wrapper swiper-wrapper">
            <?php //echo generate_slideshow_slides($slideshow_images);  // The Reference Example 
            
            // Get search term using get_search_query()
            $search_term = get_search_query();

            // Or using $_GET with sanitization
            //$search_term = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

            // Then use it in your carousel
            echo uc_filter_carousel($search_term, $drink_posts, 3, 0, 1);

            ?>  
            <!-- THE PRIOR EXAMPLE: ?php echo uc_filter_carousel('mar', $drink_posts, 3, 0, 1); ?--> 
        </ul>



        <!-- ... rest of slideshow controls ... -->
            <a class="wp-block-jetpack-slideshow_button-prev swiper-button-prev swiper-button-white" role="button">
            </a>
            <a class="wp-block-jetpack-slideshow_button-next swiper-button-next swiper-button-white" role="button">
            </a>
            <a aria-label="Pause Slideshow" class="wp-block-jetpack-slideshow_button-pause" role="button">
            </a>
            <div class="wp-block-jetpack-slideshow_pagination swiper-pagination swiper-pagination-white">
            </div>
    </div>
<!-- /wp:jetpack/slideshow -->
</div>
<!-- /wp:group -->





<!-- Pattern code goes here. -->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<h3> Add Filter by 'Term' from Drink Posts Query </h3>
<!-- wp:jetpack/slideshow {"autoplay":true,"ids":[2765,2760,2753],"sizeSlug":"large"} -->

<div class="wp-block-jetpack-slideshow aligncenter" data-autoplay="true" data-delay="3" data-effect="slide">
    <div class="wp-block-jetpack-slideshow_container swiper-container">
        <ul class="wp-block-jetpack-slideshow_swiper-wrapper swiper-wrapper">
            <?php //echo generate_slideshow_slides($slideshow_images);  // The Reference Example ?>  
            <?php echo uc_filter_carousel('mar', $drink_posts, 3, 0, 1); ?> 
        </ul>



        <!-- ... rest of slideshow controls ... -->
            <a class="wp-block-jetpack-slideshow_button-prev swiper-button-prev swiper-button-white" role="button">
            </a>
            <a class="wp-block-jetpack-slideshow_button-next swiper-button-next swiper-button-white" role="button">
            </a>
            <a aria-label="Pause Slideshow" class="wp-block-jetpack-slideshow_button-pause" role="button">
            </a>
            <div class="wp-block-jetpack-slideshow_pagination swiper-pagination swiper-pagination-white">
            </div>
    </div>
<!-- /wp:jetpack/slideshow -->
</div>
<!-- /wp:group -->




<!-- Pattern code goes here. -->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<h3> Plus Post Content ?  </h3>
<!-- wp:jetpack/slideshow {"autoplay":true,"ids":[2765,2760,2753],"sizeSlug":"large"} -->

<div class="wp-block-jetpack-slideshow aligncenter" data-autoplay="true" data-delay="3" data-effect="slide">
    <div class="wp-block-jetpack-slideshow_container swiper-container">
        <ul class="wp-block-jetpack-slideshow_swiper-wrapper swiper-wrapper">
            <?php //echo generate_slideshow_slides($slideshow_images);  // The Reference Example ?>  
            <?php echo uc_random_carousel($drink_posts, 3, 0, 1); ?> 
        </ul>



        <!-- ... rest of slideshow controls ... -->
            <a class="wp-block-jetpack-slideshow_button-prev swiper-button-prev swiper-button-white" role="button">
            </a>
            <a class="wp-block-jetpack-slideshow_button-next swiper-button-next swiper-button-white" role="button">
            </a>
            <a aria-label="Pause Slideshow" class="wp-block-jetpack-slideshow_button-pause" role="button">
            </a>
            <div class="wp-block-jetpack-slideshow_pagination swiper-pagination swiper-pagination-white">
            </div>
    </div>
<!-- /wp:jetpack/slideshow -->
</div>
<!-- /wp:group -->







<!-- Pattern code goes here. -->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<h3> Abstracted & Randomized </h3>
<!-- wp:jetpack/slideshow {"autoplay":true,"ids":[2765,2760,2753],"sizeSlug":"large"} -->


<div class="wp-block-jetpack-slideshow aligncenter abs-slideshow" data-autoplay="true" data-delay="3" data-effect="slide">
    <div class="wp-block-jetpack-slideshow_container swiper-container abs-container">
        <ul class="wp-block-jetpack-slideshow_swiper-wrapper swiper-wrapper abs-swiper-wrapper">
            <?php //echo generate_slideshow_slides($slideshow_images);  // The Reference Example ?>  
            <?php echo uc_random_carousel($drink_posts, 3); ?> 
        </ul>



        <!-- ... rest of slideshow controls ... -->
            <a class="wp-block-jetpack-slideshow_button-prev swiper-button-prev swiper-button-white" role="button">
            </a>
            <a class="wp-block-jetpack-slideshow_button-next swiper-button-next swiper-button-white" role="button">
            </a>
            <a aria-label="Pause Slideshow" class="wp-block-jetpack-slideshow_button-pause" role="button">
            </a>
            <div class="wp-block-jetpack-slideshow_pagination swiper-pagination swiper-pagination-white">
            </div>
    </div>
<!-- /wp:jetpack/slideshow -->
</div>
<!-- /wp:group -->












<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<h3> PlaceHolder Below </h3>
<!-- wp:jetpack/slideshow {"autoplay":true,"ids":[2765,2760,2753],"sizeSlug":"large"} -->

    
    <div class="wp-block-jetpack-slideshow aligncenter" data-autoplay="true" data-delay="3" data-effect="slide">
    <div class="wp-block-jetpack-slideshow_container swiper-container">
    <ul class="wp-block-jetpack-slideshow_swiper-wrapper swiper-wrapper">
    <li class="wp-block-jetpack-slideshow_slide swiper-slide">
    <figure>
    <img alt="" class="wp-block-jetpack-slideshow_image wp-image-2765" data-id="2765" src="http://localhost/wordpress/wp-content/uploads/2024/12/AU_Ginger-Peach-n-Scotch-T-rotated.jpg"/>
    </figure>
    </li>
    <li class="wp-block-jetpack-slideshow_slide swiper-slide">
    <figure>
    <img alt="" class="wp-block-jetpack-slideshow_image wp-image-2760" data-id="2760" src="http://localhost/wordpress/wp-content/uploads/2024/12/Cherry-Limoncello-GT_AU-T-768x1024.jpg"/>
    </figure>
    </li>
    <li class="wp-block-jetpack-slideshow_slide swiper-slide">
    <figure>
    <img alt="" class="wp-block-jetpack-slideshow_image wp-image-2753" data-id="2753" src="http://localhost/wordpress/wp-content/uploads/2024/12/Ribbon-Candy-Old-Fashioned_SO-2-768x1024.jpg"/>
    </figure>
    </li>
    </ul>
    <a class="wp-block-jetpack-slideshow_button-prev swiper-button-prev swiper-button-white" role="button">
    </a>
    <a class="wp-block-jetpack-slideshow_button-next swiper-button-next swiper-button-white" role="button">
    </a>
    <a aria-label="Pause Slideshow" class="wp-block-jetpack-slideshow_button-pause" role="button">
    </a>
    <div class="wp-block-jetpack-slideshow_pagination swiper-pagination swiper-pagination-white">
    </div>
    </div>
    </div>
<!-- /wp:jetpack/slideshow -->
</div>

<!-- /wp:group -->
 */

?>

