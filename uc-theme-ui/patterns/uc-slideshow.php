<?php
/**
 * Title: UC Slideshow
 * Slug: uc-slideshow
 * Categories: Featured
*/

// Include the cocktail-images plugin functions
//require_once WP_PLUGIN_DIR . '/cocktail-images/includes/functions.php';
?>
<!-- Pattern code goes here. -->
 





<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<h3> Make Evt Listen with AJAX </h3> 
<!-- wp:jetpack/slideshow {"autoplay":true,"ids":[2765,2760,2753],"sizeSlug":"large"} -->

<div class="wp-block-jetpack-slideshow aligncenter uc-slideshow hidden" data-autoplay="true" data-delay="3" data-effect="slide" data-slides="5">
    <div class="wp-block-jetpack-slideshow_container swiper-container">
        <ul class="wp-block-jetpack-slideshow_swiper-wrapper swiper-wrapper uc-swiper-list">
            <?php //echo generate_slideshow_slides($slideshow_images);  // The Reference Example 
/* 
THESE FUNCTION CALLS ARE BUSTED BECAUSE THEY MOVED TO PLUGIN LAND
RELOCATE THIS WHOLE BLOCK OR ELSE BE THOROUGH - REQUIRE ONCE STATEMENT BROKE LIVE SITE  ! 
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
 */
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

