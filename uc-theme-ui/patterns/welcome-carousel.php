
<?php
/**
 * Title: Welcome Carousel
 * Slug: welcome-carousel
 * Categories: Featured
 */
?>	
<!-- Pattern code goes here. -->




<?php 

/* $the_welcome_carousel = make_an_carousel(6);  



#  PHP Conditionals don't require wrapping? 
#  (  OR they are wrapped by WP Inclusion Loop ?  ) 
if($the_welcome_carousel){
    echo $the_welcome_carousel;

    # backticks to the rescue 
    #echo '<script>console.log(`' . $the_welcome_carousel . '`);</script>';
}


else {
echo '<h1> The Carousel would be here </h1>';
} */



#This is output from the above. make_an_carousel() is ess obsolete. 
?>
<section class="carousel welcome-carousel" aria-label="Gallery" style="height: 567.6px;"><ol class="carousel__viewport"> <li id="carousel__slide0" tabindex="0" class="carousel__slide"> <div class="carousel__snapper">  <a href="#carousel__slide6" class="carousel__prev">  </a><figure class="home-figure portrait" id="foto-last-clone"><img src="http://untouchedcocktails.com/wp-content/uploads/2024/09/Cranberry-Citrus-Dragon_RO-T.jpg" alt="Cranberry Citrus Dragon Romantic Cocktail" title="Cranberry Citrus Dragon Romantic Cocktail"><figcaption>Romantic Cocktails</figcaption></figure><a href="#carousel__slide1" class="carousel__next"> </a></div></li> <li id="carousel__slide1" tabindex="0" class="carousel__slide"> <div class="carousel__snapper">  <a href="#carousel__slide0" class="carousel__prev">  </a><figure class="home-figure landscape"><img src="http://untouchedcocktails.com/wp-content/uploads/2024/09/Pair-of-Fireplace-Drinks_FP-T-scaled.jpg" alt="Pair of Fireplace Drinks" title="Pair of Fireplace Drinks"><figcaption>Fireplace Cocktails</figcaption></figure><a href="#carousel__slide2" class="carousel__next"> </a></div></li> <li id="carousel__slide2" tabindex="0" class="carousel__slide"> <div class="carousel__snapper">  <a href="#carousel__slide1" class="carousel__prev">  </a><figure class="home-figure portrait" id="foto-deux"><img src="http://untouchedcocktails.com/wp-content/uploads/2024/09/Ginger-Peach-n-Scotch_AU-T-rotated.jpg" alt="Ginger Peach n' Scotch Autumnal Cocktail" title="Ginger Peach n' Scotch Autumnal Cocktail"><figcaption>Seasonal Cocktails</figcaption></figure><a href="#carousel__slide3" class="carousel__next"> </a></div></li> <li id="carousel__slide3" tabindex="0" class="carousel__slide"> <div class="carousel__snapper">  <a href="#carousel__slide2" class="carousel__prev">  </a><figure class="home-figure portrait"><img src="http://untouchedcocktails.com/wp-content/uploads/2024/09/Holiday-Old-Fashioned-and-Kir-Royale_SO-T.jpg" alt="Holiday Old Fashioned and Kir Royale" title="Holiday Old Fashioned and Kir Royale"><figcaption>Special Occasion Cocktails</figcaption></figure><a href="#carousel__slide4" class="carousel__next"> </a></div></li> <li id="carousel__slide4" tabindex="0" class="carousel__slide"> <div class="carousel__snapper">  <a href="#carousel__slide3" class="carousel__prev">  </a><figure class="home-figure portrait" id="foto-quatre"><img src="http://untouchedcocktails.com/wp-content/uploads/2024/09/Citrus-Gimlet-with-Butterfly-Pea-Flower-Float_EV-T.jpg" alt="Citrus Gimlet with Butterfly Pea Flower Float Everyday Cocktail" title="Citrus Gimlet with Butterfly Pea Flower Float Everyday Cocktail"><figcaption>Everyday Cocktails</figcaption></figure><a href="#carousel__slide5" class="carousel__next"> </a></div></li> <li id="carousel__slide5" tabindex="0" class="carousel__slide"> <div class="carousel__snapper">  <a href="#carousel__slide4" class="carousel__prev">  </a><figure class="home-figure portrait" id="foto-last"><img src="http://untouchedcocktails.com/wp-content/uploads/2024/09/Cranberry-Citrus-Dragon_RO-T.jpg" alt="Cranberry Citrus Dragon Romantic Cocktail" title="Cranberry Citrus Dragon Romantic Cocktail"><figcaption>Romantic Cocktails</figcaption></figure><a href="#carousel__slide6" class="carousel__next"> </a></div></li> <li id="carousel__slide6" tabindex="0" class="carousel__slide"> <div class="carousel__snapper">  <a href="#carousel__slide5" class="carousel__prev">  </a><figure class="home-figure landscape" id="foto-first-clone"><img src="http://untouchedcocktails.com/wp-content/uploads/2024/09/Pair-of-Fireplace-Drinks_FP-T-scaled.jpg" alt="Pair of Fireplace Drinks" title="Pair of Fireplace Drinks"><figcaption>Fireplace Cocktails</figcaption></figure><a href="#carousel__slide0" class="carousel__next"> </a></div></li></ol></section>





<style>
    /*    ORIGINAL CAROUSEL STUFF BELOW    */
 
    @keyframes tonext {
        75% {
        left: 0;
        }
        95% {
        left: 100%;
        }
        98% {
        left: 100%;
        }
        99% {
        left: 0;
        }
    }
    @keyframes tostart {
        75% {
        left: 0;
        }
        95% {
        left: -300%;
        }
        98% {
        left: -300%;
        }
        99% {
        left: 0;
        }
    }
    @keyframes snap {
        96% {
        scroll-snap-align: center;
        }
        97% {
        scroll-snap-align: none;
        }
        99% {
        scroll-snap-align: none;
        }
        100% {
        scroll-snap-align: center;
        }
    }
    
    *::-webkit-scrollbar {
    width: 0;
    }
    *::-webkit-scrollbar-track {
    background: transparent;
    }
    *::-webkit-scrollbar-thumb {
    background: transparent;
    border: none;
    }
    ol, li {
    list-style: none;
    margin: 0;
    padding: 0;
    }
    


    /*    FINISH TRANSFER UNQUERIED STYLES FROM HERE */ 

    
    .carousel__snapper {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        scroll-snap-align: center;
    }
    
    @media (hover: hover) {
        .carousel__snapper {
        animation-name: tonext, snap;
        animation-timing-function: ease;
        animation-duration: 4s;
        animation-iteration-count: infinite;
        }
    
        .carousel__slide:last-child .carousel__snapper {
        animation-name: tostart, snap;
        }
    }
    
    @media (prefers-reduced-motion: reduce) {
        .carousel__snapper {
        animation-name: none;
        }
    }
    
    .carousel:hover .carousel__snapper,
    .carousel:focus-within .carousel__snapper {
        animation-name: none;
    }
    
    .carousel__navigation {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        text-align: center;
    }
    
    .carousel__navigation-list,
    .carousel__navigation-item {
        display: inline-block;
    }
    
    .carousel__navigation-button {
        display: inline-block;
        width: 1.5rem;
        height: 1.5rem;
        background-color: #333;
        background-clip: content-box;
        border: 0.25rem solid transparent;
        border-radius: 50%;
        font-size: 0;
        transition: transform 0.8s;
    }
    
    .carousel::before,
    .carousel::after,
    .carousel__prev,
    .carousel__next {
        position: absolute;
        top: 50%;
    
        width: 4rem;
        height: 4rem;
        transform: translateY(-50%);
        border-radius: 50%;
        font-size: 0;
        outline: 0;
    }
    
    .carousel::before,
    .carousel__prev {
        left: -1rem;
    }
    
    .carousel::after,
    .carousel__next {
        right: -1rem;
    }
    
    .carousel::before,
    .carousel::after {
        content: '';
        z-index: 1;
        background-color: #333;
        background-size: contain; 
        background-repeat: no-repeat;
        background-position: center center;
        color: #fff;
        font-size: 2.5rem;
        line-height: 4rem;
        text-align: center;
        pointer-events: none;
    }
    
    /* .carousel::before {
        background-image: url('data:image/svg+xml,<%3Fxml version="1.0" encoding="UTF-8"%3F><svg width="24px" height="24px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="%23000000"><path d="M11 6L5 12L11 18" stroke="%23000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M19 6L13 12L19 18" stroke="%23000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>');
    }
    
    .carousel::after {
        background-image: url('data:image/svg+xml,<%3Fxml version="1.0" encoding="UTF-8"%3F><svg width="24px" height="24px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="%23000000"><path d="M13 6L19 12L13 18" stroke="%23000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5 6L11 12L5 18" stroke="%23000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>');
    }    */

    .carousel::before { /*    changes made to SVG-CSS hard code    */
        background-image: url('data:image/svg+xml,<%3Fxml version="1.0" encoding="UTF-8"%3F><svg width="48px" height="48px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="%23ffffff"><path d="M11 6L5 12L11 18" stroke="%23ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M19 6L13 12L19 18" stroke="%23ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>');
        background-size: 3rem;
    }

    .carousel::after {
        background-image: url('data:image/svg+xml,<%3Fxml version="1.0" encoding="UTF-8"%3F><svg width="48px" height="48px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="%23ffffff"><path d="M13 6L19 12L13 18" stroke="%23ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5 6L11 12L5 18" stroke="%23ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>');
        background-size: 3rem;
    }
    
    
    
    .scroll-container {
        --size: 150px;
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: var(--size);
        gap: 1rem;
        overflow-x: auto;
        overscroll-behavior-inline: contain;
        scroll-snap-type: inline mandatory;
        scroll-padding-inline: 1rem;
    }
    
    .scroll-container > * {
        scroll-snap-align: start;
    }
    
    .scroll-element {
        display: grid;
        grid-template-rows: min-content;
        gap: 1rem;
        padding: 1rem;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgb(0 0 0 / 10%);
    }
    
    .scroll-element > img {
        inline-size: 100%;
        aspect-ratio: 16/9;
        object-fit: cover;
    }








    /* Hide the Carousel on Desktop/Landscape */
    @media screen and (orientation: landscape){
    


    .carousel {
        position: relative;
        padding-top: 45%; /* Reduced from 75% for better desktop proportions */
        filter: drop-shadow(0 0 10px #0003);
        perspective: 100px;
        max-width: 80vw; /* Limit width on desktop */
        margin: 0 auto; /* Center the carousel */

    
    }

    .carousel__viewport {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        overflow-x: scroll;
        counter-reset: item;
        scroll-behavior: smooth;
        scroll-snap-type: x mandatory;
        gap: 1rem; /* Add spacing between slides */
    }

    .carousel__slide {
        position: relative;
        flex: 0 0 100%;
        width: 100%;
        background-color: transparent;
        scroll-snap-align: center;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;

        counter-increment: item;
    }
    /*    Remove Slide #s   
    .carousel__slide:before {
        content: counter(item);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate3d(-50%,-40%,70px);
        color: #fff;
        font-size: 2em;
    } */

    .carousel__snapper {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        scroll-snap-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Image and figure styling */
    .carousel__snapper figure {
        border-radius: var(--gallery-border);
        max-height: 70vh;
        width: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .carousel__snapper figure img {
        height: auto;
        max-height: 65vh;
        width: auto;
        border-radius: 2em;
        object-fit: contain;
    }

    .carousel__snapper figure figcaption {
        margin-top: 1rem;
        text-align: center;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    /* Navigation arrows */
    .carousel::before,
    .carousel::after {
        width: 3rem;
        height: 3rem;
        top: 50%;
        transform: translateY(-50%);
        background-color: transparent;
        opacity: 0.8;
        transition: opacity 0.8s ease;
        cursor: pointer;
    }

    .carousel::before {
        left: 0.8rem;
    }

    .carousel::after {
        right: 0.8rem;
    }

    .carousel::before:hover,
    .carousel::after:hover {
        opacity: 1;
    }
    
    
    
    
    
    
    /* REmoved because we want display:none on landscape for Welcome page only 
        
    .welcome-carousel{ 
        display: none;
    }
        */


    
    }

    @media screen and (orientation: portrait){


    .carousel {

        display: flex; /* does nothing */ 
        position: relative;
        
        filter: drop-shadow(0 0 10px #0003); /* whats this? */
        perspective: 100px;
        
        overflow-y: hidden; /* stops scrolling */
        
        min-height: fit-content;
        /*  NEITHER effective  */
        
        
        /*replace child with the actual selector of the tallest child element 
        height: calc(100% + max-height(child) + padding-top + padding-bottom);  */
        
        
        
        }
        
        .carousel__viewport {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        overflow-x: scroll;
        counter-reset: item;
        scroll-behavior: smooth;
        scroll-snap-type: x mandatory;
        
        }
        
        .carousel__slide {
        position: relative;
        flex: 0 0 100%;
        width: 100%;
        background-color: transparent;
        counter-increment: item;
        }
        /*
        .carousel__slide::before {
        content: counter(item);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate3d(-50%,-40%,70px);
        color: #fff;
        font-size: 2em;
        }*/
        
        .carousel__snapper {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%; /* stop touching edge of screen , but alignment gets weird*/
        height: 100%;
        scroll-snap-align: center;
        padding: 0.5rem;
        margin: 0.5rem 0;
        
        min-height:fit-content; 
        
        /* added to place drinks centered, without margins BS */
        display: flex; 
        align-items: center;
        justify-content: center;
        
        }
        
        
        .angled-gradient {
        background: linear-gradient(70deg, rgba(128, 128, 128, 0.6), rgba(0, 0, 0,0.6));
        border-radius: 4em;
        
        }
        
        
        
        
        @media (hover: hover) {
        .carousel__snapper {
        animation-name: tonext, snap;
        animation-timing-function: ease;
        animation-duration: 4s;
        animation-iteration-count: infinite;
        }
        
        .carousel__slide:last-child .carousel__snapper {
        animation-name: tostart, snap;
        }
        }
        
        @media (prefers-reduced-motion: reduce) {
        .carousel__snapper {
        animation-name: none;
        }
        }
        
        .carousel:hover .carousel__snapper,
        .carousel:focus-within .carousel__snapper {
        animation-name: none;
        }
        
        .carousel__navigation {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        text-align: center;
        }
        #
        .carousel__navigation-list,
        .carousel__navigation-item {
        display: inline-block;
        }
        
        .carousel__navigation-button {
        display: inline-block;
        width: 1.5rem;
        height: 1.5rem;
        background-color: #333;
        background-clip: content-box;
        border: 0.25rem solid transparent;
        border-radius: 50%;
        font-size: 0;
        transition: transform 0.8s;
        }
        
        /* control shape, size of arrow buttons */
        .carousel::before,
        .carousel::after,
        .carousel__prev,
        .carousel__next {
        position: absolute;
        top: 50%;
        /*margin-top: 37.5%;   TOP WORKS FINE BY ITSELF INCLUDING W/ HEIGHT JS DYNAMIC*/ 
        width: 3rem;
        height: 3rem;
        transform: translateY(-50%);
        /*border-radius: 50%;*/
        
        outline: 0;  
        
        }
        
        
        
        
        /*handle placement of the left/right swiper butttons*/
        .carousel::before,
        .carousel__prev {
        left: 0.8rem;
        }
        .carousel::after,
        .carousel__next {
        right: 0.8rem;
        }
        
        
        
        .carousel::before,
        .carousel::after {
        content: '';
        z-index: 1;
        background-color: transparent;
        /*controls size of the arrow "button" */
        background-repeat: no-repeat;
        background-position: center center;
        color: #fff;
        font-size: 2.5rem;
        line-height: 4rem;
        text-align: center;
        pointer-events: none;
        
        
        
        
        }
        
        .carousel__snapper figure{
        
        border-radius: var(--gallery-border);
        border-color: var(--summertime-cocktails-border-color);
        
        
        }
        
        .carousel__snapper figure img{
        
        border-radius: 2em;
        
        }
        
        .carousel__snapper .pop-off{
        position: absolute;
        
        }
        .carousel-subheads{
        display: flex;
        flex-direction: column;
        }
    

    }

    /*    END ORIGINAL CAROUSEL STUFF    */







    /*    WORDPRESS CAROUSEL STUFF BELOW    */

    @media screen and (orientation: landscape){
    /* WordPress Query Carousel Styling */

    .is-style-carousel.wp-block-query {
        position: relative;
        padding-top: 75%;
        filter: drop-shadow(0 0 10px #0003);
        perspective: 100px;
        overflow-y: hidden;
        min-height: fit-content;
    }

    .is-style-carousel .wp-block-post-template {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        overflow-x: scroll;
        scroll-behavior: smooth;
        scroll-snap-type: x mandatory;
    }

    /* Individual post styling */
    .is-style-carousel .wp-block-post {
        position: relative;
        flex: 0 0 100%;
        width: 100%;
        background-color: transparent;
        scroll-snap-align: center;
        padding: 0.5rem;
        margin: 0.5rem 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Featured image container */
    .is-style-carousel .wp-block-post-featured-image {
        border-radius: 2em;
        overflow: hidden;
    }

    /* Post title and date styling */
    .is-style-carousel .wp-block-post-title,
    .is-style-carousel .wp-block-post-date {
        position: absolute;
        z-index: 1;
        color: #fff;
    }

    .is-style-carousel .wp-block-post-title {
        bottom: 2rem;
        left: 2rem;
    }

    .is-style-carousel .wp-block-post-date {
        top: 2rem;
        left: 2rem;
    }

    /* Pagination styling to match carousel navigation */
    .is-style-carousel .wp-block-query-pagination {
        text-align: center;

        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        pointer-events: none; /* Allow clicks to pass through to the actual buttons */
    }





    

    
        /* Hide the number pagination */
    .is-style-carousel .wp-block-query-pagination-numbers {
        display: none;
    }

    .is-style-carousel .wp-block-query-pagination-numbers a,
    .is-style-carousel .wp-block-query-pagination-numbers span {
        display: inline-block;
        width: 1.5rem;
        height: 1.5rem;
        background-color: #333;
        background-clip: content-box;
        border: 0.25rem solid transparent;
        border-radius: 50%;
        font-size: 0;
        transition: transform 0.8s;
        margin: 0 0.25rem;
    

    }
    
        .is-style-carousel .wp-block-query-pagination-previous,
        .is-style-carousel .wp-block-query-pagination-next {
        position: absolute;
        top: 50%;
        width: 3rem;
        height: 3rem;
        transform: translateY(-50%);
        background-color: #333;
        border-radius: 50%;
        font-size: 0; /* Hide text */
        pointer-events: auto; /* Re-enable clicks on buttons */
        background-color: transparent;
        background-repeat: no-repeat;
        background-position: center center;
        z-index: 1;
        }
    
        .is-style-carousel .wp-block-query-pagination-previous {

        /* Force both buttons to always show */
        display: block !important; /* Override WP's default hiding */
        visibility: visible !important;
        opacity: 1 !important;

        
        left: 0.8rem;
        background-image: url('data:image/svg+xml,<%3Fxml version="1.0" encoding="UTF-8"%3F><svg width="48px" height="48px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="%23ffffff"><path d="M11 6L5 12L11 18" stroke="%23ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M19 6L13 12L19 18" stroke="%23ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>');
        background-size: 3rem;

        
        }

        .is-style-carousel .wp-block-query-pagination-next {
        right: 0.8rem;
        background-image: url('data:image/svg+xml,<%3Fxml version="1.0" encoding="UTF-8"%3F><svg width="48px" height="48px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="%23ffffff"><path d="M13 6L19 12L13 18" stroke="%23ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5 6L11 12L5 18" stroke="%23ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>');
        background-size: 3rem;
        }

        
    /* When actually disabled, reduce opacity */
    .is-style-carousel .wp-block-query-pagination-previous[aria-disabled="true"],
    .is-style-carousel .wp-block-query-pagination-next[aria-disabled="true"] {
        opacity: 0.3;
        pointer-events: none;
    }
    
        




    }
    /*    END WORDPRESS CAROUSEL    */




</style>