<?php
/**
 * Title: carousell
 * Slug: carousell
 * Categories: carousell
 */
?>	
<!-- Pattern code goes here. -->




<div class="carousel-subheads">

<!-- wp:template-part {"slug":"uc-subheads"} /-->



   <?php 
   $old_carousel = ' 
   <section class="carousel hidden" aria-label="Gallery">
   <ol class="carousel__viewport">

      <li id="carousel__slide1"  tabindex="0"  class="carousel__slide">
         
         <div class="carousel__snapper">
               <a href="#carousel__slide4"
                  class="carousel__prev">
                           
                  </a>
         
            <a href="#carousel__slide2"
               class="carousel__next">
               
               </a>
            
         </div>
      </li>

      <li id="carousel__slide2"
         tabindex="0"
         class="carousel__slide">
         <div class="carousel__snapper">

         
   
         
         <a href="#carousel__slide1"
            class="carousel__prev">

            </a>
         <a href="#carousel__slide3"
            class="carousel__next">
            
            </a>
         
            </div>
      </li>

      <li id="carousel__slide3"
         tabindex="0"
         class="carousel__slide">
         <div class="carousel__snapper"></div>

            
         <a href="#carousel__slide2"
            class="carousel__prev">

                           </a>
         <a href="#carousel__slide1"
            class="carousel__next">
            

            </a>
            
         
      </li>
      

   </ol> 


   <!-- NOT IN USE 
         li id="carousel__slide4"
         tabindex="0"
         class="carousel__slide">
         <div class="carousel__snapper">
         
         </div>
         
         <a href="#carousel__slide3"
            class="carousel__prev">Go to previous slide</a>
         <a href="#carousel__slide1"
            class="carousel__next">Go to first slide</a>
            
      </li>



      <aside class="carousel__navigation">
      <ol class="carousel__navigation-list">
         <li class="carousel__navigation-item">
         <a href="#carousel__slide1"
            class="carousel__navigation-button">Go to slide 1</a>
         </li>
         <li class="carousel__navigation-item">
         <a href="#carousel__slide2"
            class="carousel__navigation-button">Go to slide 2</a>
         </li>
         <li class="carousel__navigation-item">
         <a href="#carousel__slide3"
            class="carousel__navigation-button">Go to slide 3</a>
         </li>
         <li class="carousel__navigation-item">
         <a href="#carousel__slide4"
            class="carousel__navigation-button">Go to slide 4</a>
            </li>
      </ol>
   </aside-->


   </section>';



   $index_carousel = '
   <section class = "index-carousel carousel">
   <ol class="carousel__viewport">

      <li id="carousel__slide1"  tabindex="0"  class="carousel__slide">
         <div class="carousel__snapper">
               <a href="#carousel__slide4"
                  class="carousel__prev">
                           
                  </a>

                  <figure class = "home-figure landscape">
               <img  src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Pair-of-Fireplace-Drinks_FP-T-scaled.jpg" 
                     alt = "Pair of Fireplace Drinks" 
                     title = "Pair of Fireplace Drinks" />
               <figcaption>Fireplace Cocktails</figcaption>
            </figure>
         
            <a href="#carousel__slide2"
               class="carousel__next">
               
               </a>
            
         </div>
      </li>

      <li id="carousel__slide2"
         tabindex="0"
         class="carousel__slide">
         <div class="carousel__snapper">

         
   
         
         <a href="#carousel__slide1"
            class="carousel__prev">

            <figure class = "home-figure portrait" id="foto-deux">
               <img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Ginger-Peach-n-Scotch_AU-T-rotated.jpg" 
                  alt = "Ginger Peach n\' Scotch Autumnal Cocktail"
                  title = "Ginger Peach n\' Scotch Autumnal Cocktail" />
               <figcaption>Seasonal Cocktails</figcaption>
            </figure>

            </a>
         <a href="#carousel__slide3"
            class="carousel__next">
            
            </a>
         
            </div>
      </li>

      <li id="carousel__slide3"
         tabindex="0"
         class="carousel__slide">
         <div class="carousel__snapper"></div>

            
         <a href="#carousel__slide2"
            class="carousel__prev">

                           </a>

                           <figure class = "home-figure portrait">
               <img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Holiday-Old-Fashioned-and-Kir-Royale_SO-T.jpg" 
                  alt = "Holiday Old Fashioned and Kir Royale"
                  title = "Holiday Old Fashioned and Kir Royale" />
               <figcaption>Special Occasion Cocktails</figcaption>
               </figure>

         <a href="#carousel__slide1"
            class="carousel__next">
            

            </a>
            
         </div>
      </li>

         <li id="carousel__slide4"
         tabindex="0"
         class="carousel__slide">
         <div class="carousel__snapper"></div>

            
         <a href="#carousel__slide3"
            class="carousel__prev">

                           </a>

                           <figure class = "home-figure portrait" id="foto-quatre">
               <img src ="http://untouchedcocktails.com/wp-content/uploads/2024/09/Citrus-Gimlet-with-Butterfly-Pea-Flower-Float_EV-T.jpg" 
               alt = "Citrus Gimlet with Butterfly Pea Flower Float Everyday Cocktail" 
               title = "Citrus Gimlet with Butterfly Pea Flower Float Everyday Cocktail" />
               <figcaption>Everyday Cocktails</figcaption>
               </figure>

         <a href="#carousel__slide5"
            class="carousel__next">
            

            </a>
            
         </div>
         </li>

            <li id="carousel__slide5"
         tabindex="0"
         class="carousel__slide">
         <div class="carousel__snapper"></div>

            
         <a href="#carousel__slide4"
            class="carousel__prev">

                           </a>

                           <figure class = "home-figure portrait" id="foto-last">
               <img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/Cranberry-Citrus-Dragon_RO-T.jpg"
                  alt = "Cranberry Citrus Dragon Romantic Cocktail"
                  title = "Cranberry Citrus Dragon Romantic Cocktail" />
               <figcaption>Romantic Cocktails</figcaption>
               </figure>

         <a href="#carousel__slide1"
            class="carousel__next">
            


            </a>
            
         </div></li>
      

   </ol> 

   </section>
   ';



   if (str_contains($page_id, "home") == false){
   echo $old_carousel;
   } else if (str_contains($page_id, "home") == true ){
   echo $index_carousel;
   }
   ?>



</div>




