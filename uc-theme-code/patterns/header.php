<?php
/**
 * Title: header
 * Slug: header
 * Categories: header
 */
?>	
<!-- Pattern code goes here. -->


<?php 
    /*    PASTE BELOW to "carry over" PHP variables    
		<script>
  			var jsvar = <?php echo json_encode($PHPVar); ? > ;
	 	< / script >  
	*/



/* 	<div class="menu">    //FROM WORDPRESS
	<ul>
		<li class="page_item page-item-27"><a href="http://untouchedcocktails.com/everyday-cocktails/">Everyday Cocktails</a></li>
		<li class="page_item page-item-25"><a href="http://untouchedcocktails.com/fireplace-cocktails/">Fireplace Cocktails</a></li>
		<li class="page_item page-item-29"><a href="http://untouchedcocktails.com/romantic-cocktails/">Romantic Cocktails</a></li>
		<li class="page_item page-item-32"><a href="http://untouchedcocktails.com/special-occasion-cocktails/">Special Occasion Cocktails</a></li>
		<li class="page_item page-item-34"><a href="http://untouchedcocktails.com/springtime-cocktails/">Springtime Cocktails</a></li>
		<li class="page_item page-item-36"><a href="http://untouchedcocktails.com/summertime-cocktails/">Summertime Cocktails</a></li>
	</ul>
</div>
<div> */



/*   // Not Sure how to print Array contents into Console; no matter
	echo "<script>console.log('PAGE INFO:  ".  $page_id  ."');</script>" ;
	echo '<pre>' . 	str_contains($page_id, "special") . '</pre>';    
	    */

?>



<!-- NAVIGATION MENU  -->
	<nav class = "topnav">
				
	<a class="icon"href="http://untouchedcocktails.com/">
		<figure>
			<img src = "http://untouchedcocktails.com/wp-content/uploads/2024/09/logo.jpg" />
		</figure>
		</a>
		
		<div class="write-over">
			<p id="size-this"> 
				UntouchedCocktails.com © 2024   </p>
			<p id="size-this">
				information@untouchedcocktails.com    </p>
			<p id="size-this"> 
				# (617) 759-2057    </p>
		</div>



				
				<div id = "tierOne">
					<a href="http://untouchedcocktails.com/fireplace-cocktails/" class="page">Fireplace Cocktails</a>
					<a href="http://untouchedcocktails.com/special-occasion-cocktails/" class="page">Special Occasion Cocktails</a>
					<a href="http://untouchedcocktails.com/everyday-cocktails/" class="page">EveryDay Cocktails</a>
					<a href="http://untouchedcocktails.com/autumnal-cocktails/" class="page">Seasonal Cocktails</a>
					<a href="http://untouchedcocktails.com/romantic-cocktails/" class="page">Romantic Cocktails</a>
					<a href="http://untouchedcocktails.com/contact-us/" class="page">Learn More</a>
					<a href="http://untouchedcocktails.com" class="page">Home Page</a>
					<a href="http://untouchedcocktails.com/an_gallery/" class="page">Gallery</a>
					<a href ="" class="page">Blog</a>
				</div>


			
			<!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
			<a class="hamburgler" onclick="myFunction()">
				<div class ="hamburger">	</div>
			</a> 
	</nav>






<?php 

$page_id = "home";  //  Default to Home Page where no url/extension/

$test = $_SERVER['REQUEST_URI'];

if( strlen($test) > 11){ //IF longer than /wordpress/ (NOT index)
	$page_id = $_SERVER['REQUEST_URI'];

	$page_id = uc_page_id($page_id);
}




$dynamic_h1 = uc_dynamic_h1($page_id);


$dynamic_tagline = uc_dynamic_tagline($page_id);

//Conditional Where Page != "home" ?!
	echo $dynamic_h1;

	echo $dynamic_tagline;  //Working as intended except styling?! 
	



echo "<script> var pageID = '$page_id'; </script>"; 
echo '<script> console.log( pageID );</script>';


/*
Do Some Styling, early in page load
*/
echo "<script> ucInsertBackground(); ucColorH1(); </script>";

#echo "<pre> Any String Here </pre>";

?>

<!-- wp:template-part {"slug":"Sheet1", "tagName":"div"}  /-->

<!--  SEARCH BAR  -->

<section class = "srch">
      <input type="search" id="ucQuery" name="searchBar" placeholder="Explore Drinks"/>

      <button class="testBtn"><label for="ucQuery">
         <!-- an Iconoir import , where stroke = "color"  -->
         <!-- ?xml version="1.0" encoding="UTF-8"?><svg width="4rem" height="2em" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M17 17L21 21" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M3 11C3 15.4183 6.58172 19 11 19C13.213 19 15.2161 18.1015 16.6644 16.6493C18.1077 15.2022 19 13.2053 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg-->
         </label></button>
</section>



<!--  wp:pattern {"slug":"carousell", "tagName":"div"}  /-->








