<?php
/**
 * Title: dynamic parts
 * Slug: drinks
 * Categories: header
 */
?>	
<!-- Pattern code goes here. -->


<?php 


#  REMAINDER FACTORED OUT old-header.php to keep simple header.html

    /*    PASTE BELOW to "carry over" PHP variables    
		<script>
  			var jsvar = <?php echo json_encode($PHPVar); ? > ;
	 	< / script >  
	*/
/*   // Not Sure how to print Array contents into Console; no matter
	echo "<script>console.log('PAGE INFO:  ".  $page_id  ."');</script>" ;
	echo '<pre>' . 	str_contains($page_id, "special") . '</pre>';    
	    */

		?>




<?php 

$page_id = "home";  //  Default to Home Page where no url/extension/

//TEMPORARY UNCOMMENT DUE 
//$test = $_SERVER['REQUEST_URI'];

//if( strlen($test) > 11){ //IF longer than /wordpress/ (NOT index)
//	$page_id = $_SERVER['REQUEST_URI'];

//	$page_id = uc_page_id($page_id);
//}




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









    <!--figure class = "single" id = "pane">      THE ORIGINAL POP-OUT DESIGN, NOW DONE by JS? 
            
                
                <img src ="https://untouchedcocktails.com/wp-content/uploads/2023/05/T2-Cranberry-sidecar_FP-T-2-scaled.jpg" 
                        alt = "Cranberry Sidecar"
                        title = "Cranberry Sidecar"/>
     <a href="https://untouchedcocktails.com/wp-content/uploads/2023/05/T2-Cranberry-sidecar_FP-T-2-scaled.jpg" 
               target="_parent"> 
               <span style="color:blue; display: none;">https://untouchedcocktails.com/wp-content/uploads/2023/05/T2-Cranberry-sidecar_FP-T-2-scaled.jpg
                </span>
             <figcaption  id="detailCaption"><u>Cranberry Sidecar</u></figcaption>
        </a>
                        
                <div class="subheads">
                    <a href="fireplace.html">Fireplace</a>
                    <a>Bold & Brash</a>
                </div>
                    
                    
                <div class = "tagged">	
                    <ul class = "col1">
                        <li>cranberry</li>
                        <li>brandy</li>
                        <li>cognac</li>
                        <li>citrus</li>
                    </ul>
                    <ul class= "col2">
                        <li>orange</li>
                        <li>tornado</li>
                        <li>GranMarnier</li> 
                        <li>lemon</li>
                    </ul>
                </div>
               
        </figure-->
