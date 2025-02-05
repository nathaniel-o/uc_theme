/* 
*
*    DRINK FUNCTIONS BACKUP in drinks.js - Not In Use after 17 Dec 2024
*
*/

		/*    PRE_LOAD FUNCTIONS : CALLED BY OLD HEADER.PHP    
				////    ////    ////    ////    ////     */

		/*
					MODIFIES <div="wp-site-blocks".style.backgroundImage using 
					scoped pageID
				*/
		function ucInsertBackground(){

					let anPage = document.getElementsByClassName("wp-site-blocks");

					/*  
					
					*/
					
					/* WORKS with single quotes in CSS URL variables!! &&
						ALSO with String.concat() NOT string += approach 
					*/
					let bgVar = 'var(--';
					//bgVar.concat('var(--');
					bgVar = bgVar.concat(pageID);
					bgVar = bgVar.concat("-bg-img)");
						//	console.log(bgVar);  
					
					//anPage[0].style.backgroundImage = "var(--romantic-bg-img)";

					anPage[0].style.backgroundImage =  bgVar  ;
					//document.body.style.background = bgVar;
					//console.log(anPage);

		}

		function ucColorH1(){

					//console.log("test again");

					var highlight = 'var(--';
					highlight = highlight.concat(pageID);
					highlight = highlight.concat("-shadow)");

					//console.log(highlight);

					//document.getElementsByTagName("h1")[0].style.textShadow = highlight;

					//console.log(document.querySelectorAll("h1"));

					var headings = document.querySelectorAll("h1");

					// Where more than one h1 exists...
					for (let i = 0; i < headings.length; i++){

						headings[i].style.textShadow = highlight; 

						// Work around an_gallery slug being weird. 
						if(pageID.includes("gallery")){

							headings[i].style.textShadow = "var(--std-text-shadow)";

						}

						if(pageID.includes("fireplace")){

							//headings[i].style.color = "#b6b6b6";


						}



					}

					//console.log(headings);


		}



		        ////    ////    ////    ////     ////
		/*    PRE_LOAD FUNCTIONS : CALLED BY OLD HEADER.PHP    */



		/*    MISC. HELPER FUNCTIONS    
		    ////    ////    ////    ////    */ 
			
			//  Add CSS class to figure based on dimensions of img (on load) 
			//  Repurposed from Drink.ucConvertDrinkToFigure(), to Be Used Everywhere. 
			function ucPortraitLandscape(anImage, anFigure){
				let drinkImage = anImage;
				let figure = anFigure;	
				//console.log('Image src:', drinkImage.src);
				
				//console.log('Image complete:', drinkImage.complete);		
				if (drinkImage.complete) {
					// Image is already loaded, process immediately
					//console.log(drinkImage.naturalHeight);
					//console.log(drinkImage.naturalWidth);
					processImageDimensions();
				} else {
					// Image is not loaded yet, wait for load event
					drinkImage.onload = processImageDimensions;
				}
						
				function processImageDimensions() {
					//console.log(drinkImage.naturalHeight);
					//console.log(drinkImage.naturalWidth);
					if(drinkImage.naturalHeight > drinkImage.naturalWidth){
						figure.classList.add("portrait");
						//console.log("portrait");

					} else if (drinkImage.naturalHeight < drinkImage.naturalWidth){
						figure.classList.add("landscape");
						//console.log("landscape");
					} 
				}

			}
			document.addEventListener("DOMContentLoaded", (event) => {
				// Query Selector to affect Gallery Pages' Query Body only. 
				document.querySelectorAll('.wp-block-post-featured-image').forEach(figure => {
					ucPortraitLandscape(figure.querySelector('img'), figure);
				});
			});


			/*
				Remove 3 digits of anString 

				modifies original string
				*/

			function ucRemovePrefix(anString){ 
					/*ACCEPTS tags[i] in .pop-off, column constructing for loop above*/

					let ucStr = Array.from(anString);
					//console.log(ucStr);
					//console.log("Arr");

					/*quick fix*/ 
					ucStr.shift();
					ucStr.shift(); ucStr.shift();

					
					/*	join() excludes commas from array, unlike .toString()	*/
					anString = ucStr.join("");
					//console.log(anString);
					//console.log("final");



					return anString;
			}





			/*	Repurposed from NavBar to Generic for Carousel, etc.  */
			function showHide(lmnt) {
				const element = document.querySelector(lmnt);
				console.log(element);
				if (element) {
					if (element.style.display === "none") {


						element.style.display = "block";
					} else {
						element.style.display = "none";
					}
				}
			}

			// Apply Carousel Click Evt Lstnr to an Array of Figures
			function ucListenIteratively(anyFigureArray){  //  Repurposed to use AJAX & functions.php uc_filter_carousel

				for(const figure of anyFigureArray){
					const nodes = figure.childNodes;
					nodes.forEach(element => {
					//console.log(element);
							element.addEventListener("click", 
								(e) => {	
									/*	Show clicked Drink (as Object	*/
									//console.log( /*ucCreateModalFromDrink(*/ ucMatchSelection(e.target) );
									//console.log(e.target.parentElement);
									
									//console.log( ucMatchSelection(e.target));
									//let anFig = ucMatchSelection(e.target).ucShowDetails(); // NEED REVIEW 
							
									//console.log(e.target)
									e.preventDefault(); //Stop page refresh
									 
									// Find the closest parent with .post & .post-#### class
									 const postElement = e.target.closest('.post[class*="post-"]');
									 //console.log(postElement);
									 if (postElement) {
										 // Get the post title from within this element
										 const postTitle = postElement.querySelector('.wp-block-post-title')?.textContent || 'Title not found';
										 (`Post Title: ${postTitle}`);

										
											// Make AJAX call to WordPress
											fetch(`${window.location.origin}/wordpress/wp-admin/admin-ajax.php`, {
												method: 'POST',
												headers: {
													'Content-Type': 'application/x-www-form-urlencoded',
												},
												body: `action=filter_carousel&search_term=${encodeURIComponent(postTitle)}`
											})
											.then(response => response.text())
											.then(html => {
												// Update the carousel with the new HTML
												const carousel = document.querySelector('.uc-swiper-list');
												if (carousel) {
													carousel.innerHTML = html;
												}
												console.log(carousel);

												 // Apply portrait/landscape classes to new figures
												carousel.querySelectorAll('figure').forEach(figure => {
													ucPortraitLandscape(figure.querySelector('img'), figure);
												});
												document.querySelector('.uc-slideshow').classList.toggle("hidden");
											})
											.catch(error => console.error('Error:', error));
											




									 }

								
								})	}
						);	};
							
			}

			//
			window.addEventListener("load", (event) => {
				// ... existing load event code ...
				
				/* const toggleButton = document.querySelector('.toggle-button');
				if (toggleButton) {
					toggleButton.addEventListener('click', () => {
						showHide('.uc-slideshow'); //Does styling inline
					});
				} */

				const allFigures = document.querySelectorAll(".portrait, .landscape");
				if(allFigures.length > 0){
					ucListenIteratively(allFigures);
				}

				
			}); 
				











			/*    ucRemoveMenuItem filters current page off navbar...	*/
			function ucRemoveMenuItem(){
				
					var thisPage = document.getElementsByTagName("title")[0].innerText;
					//console.log(thisPage);
					var thesePages = document.getElementById("tierOne");
					thesePages = Array.from(thesePages.children);
					
					for (let i = 0; i < thesePages.length; i++){
						
						let currentPage =  thesePages[i].innerText;
						//console.log(currentPage);
				
						/* FIXED BELOW if(currentPage == thisPage){ */
						if(thisPage.includes(currentPage)){   
							
							thesePages[i].setAttribute("id", "hidden"); /*EFFECTIVE*/
							//console.log("IF Succeeded");
							/*console.log(thesePages[i]);*/
					
				
						}
					}
					//console.log(thisPage);
					//console.log(thesePages);
	
			}


			/*  Accepts .querySelector type DOM item, 
			*   Returns height in px of tallest child item, Recursion style
			*   Called By welcome-carousel.php pattern <script insert 
			*/
			function findTallestChild(node) {
			
			 
				let maxHeight = 0;
			  
				function traverse(node) {
				  const childHeight = node.offsetHeight; // or node.clientHeight
				  if (childHeight > maxHeight) maxHeight = childHeight;
			  
				  if (node.children.length === 0) return maxHeight; // leaf node, return height
				  /* node.children.forEach was not a function (NOT due queryselector, not sure why  */
				  Array.from(node.children).forEach((child) => traverse(child));
				}
			  
			
					traverse(node);
					return maxHeight;
	
				
			}  /* END findTallestChild */


			function resizeCarousel(node){ //Resize all Carousels // Not in Use 

				const lookHere = document.querySelectorAll('.carousel, .is-style-carousel');
				console.log(lookHere);
				
				lookHere.forEach(carousel => {
					const carouselHeight = findTallestChild(carousel) * 1.1;     // terrible fix 
			
					carousel.style.height = carouselHeight  + 'px';   
					console.log(carousel.style.height);
					console.log(carouselHeight); 
			   
				});
			}
	
	
	
			////    ////    ////    //// 
		/*    MISC. HELPER FUNCTIONS    */




	/*    SEARCH & FILTER FUNCTIONS    
        ////    ////    ////    ////    */
								
	



	//	EIGHT:  Accept clicked e.target, return Drink Object	
	function ucMatchSelection(clickTarget){
		//console.log(clickTarget.parentElement.children[0].src); //OKAY
	//	console.log("TEST");
	//	console.log(clickTarget.parentElement.children[0].src);
		//let i = 0;
		for(Drink of DRINK_ARRAY){		
			//console.log(i);
			//console.log(Drink.src);	
			if(Drink.src === clickTarget.parentElement.children[0].src){		
				//console.log(Drink);  console.log("DrinkSource MATCH");
				
				return Drink; //returns Successful
				}  	
			else { //console.log("FAILURE"); 
				}
			
		 }    return 1;	//return OUTSIDE for loop assures iteration
	}


	//    accepts a string, returns Array of Drinks w/ that string    
	function ucMatchDrinks(anString){
	
	//console.log(anString);

	let ucResults = [];
	let searchTerm = anString.toLowerCase();
	//let j = 0;/*count iterations only*/

	/*    for each Drink...    */
	for(Drink of DRINK_ARRAY){
		//	console.log(j);/*count iterations only*/

		/*    create new searchable tags Array property (include all property key:values as strings    */
		let tags  = Object.keys(Drink).concat(Object.values(Drink));
		//console.log(Drink.tags);
	
		/*    for each elements in tags...    */
		for(let i = 0; i < tags.length ; i ++){

				/*    Convert element b/c Obj v. Str. matters ?    */
				let tagEntry = tags[i].toString();


				

				/*    IF tag matches && result Arr doesn't include Drink...    */
				if(tagEntry.toLowerCase().includes(searchTerm) && ucResults.includes(Drink) === false){
					//console.log("match");
					//console.log(ucResults.length);
					
					ucResults.push(Drink);
					

				//console.log("RESULTS");
				//console.log(ucResults);
						
				}    //		j++; /*count iterations only*/
			}
	}


	 const theseResults =  ucResults; //Better Don't reassign Arrays,

	 //console.log(theseResults);

	return theseResults;
    }


	function getRandomInt(max) {
		return Math.floor(Math.random() * max);
	  }

		   ////    ////    ////    ////
	/*    SEARCH & FILTER FUNCTIONS    */
 





    /* 
	*    Remove the silly 2 line SVG from WP header, 
	*    instead use our hamburger (insert by CSS) 
	*/
    function ucCustomizeWPHeader(){

	var oldBurger = document.querySelector("body > div.wp-site-blocks > header > nav > button > svg");

	oldBurger.remove();

 	}

	function ucAddPaginationLeftArrowToCarousel(){
		// Find all Query blocks with carousel style
		const carousels = document.querySelectorAll('.is-style-carousel.wp-block-query');
		
		if(carousels){
			carousels.forEach(carousel => {
				// Check if pagination container exists, if not create it
				let paginationContainer = carousel.querySelector('.wp-block-query-pagination');
				if (!paginationContainer) {
					paginationContainer = document.createElement('div');
					paginationContainer.className = 'wp-block-query-pagination';
					carousel.appendChild(paginationContainer);
				}
				
				// Create and insert previous button if it doesn't exist
				if (!carousel.querySelector('.wp-block-query-pagination-previous')) {
					const prevButton = document.createElement('a');
					prevButton.href = '#last-post';
					prevButton.className = 'wp-block-query-pagination-previous';
					prevButton.setAttribute('data-slide', 'last');
					prevButton.textContent = 'Previous Page';
					
					// Insert at the start of pagination container
					paginationContainer.insertBefore(prevButton, paginationContainer.firstChild);
				}
			});
		}
	}







/*    ACTIONS : WHERE THE FUNCTIONS ARE CALLED     */
    ////    ////    ////    ////
       ////    ////    ////    ////
/*    ACTIONS : WHERE THE FUNCTIONS ARE CALLED     */
	
		/*		...WHEN PAGE LOADS... 		*/
		/* document.addEventListener("DOMContentLoaded", (event) =>{ */
		window.addEventListener("load", (event) =>{
			//console.log("Resources Loaded");
			

			/*  ON EVERY PAGE...  */
			//ucCustomizeWPHeader();
			//ucAddPaginationLeftArrowToCarousel();

			/*    On Contact Page, Handle Form?  */
			if(pageID.includes("contact")===true){
				//TRYING to prevent auto page refresh

				//Get form element
				var form=document.getElementById("contact-form");
				//console.log(form);

				function submitForm(event){
				
				//Preventing page refresh
			//	event.preventDefault();
				}

			
				//Calling a function during form submission.
				form.addEventListener('submit', submitForm);
			


			}
			

			if(pageID.includes("home")){ //Show/Hide carousel on home page Only 
				const carousel = document.querySelector('.welcome-carousel');
				
				// Function to handle orientation changes
				function handleOrientation(mediaQuery) {
					if (mediaQuery.matches) {
						// Landscape mode
						carousel.style.display = 'none';
					} else {
						// Portrait mode
						carousel.style.display = 'block';
					}
				}
			
				// Create media query for landscape orientation
				const landscapeQuery = window.matchMedia("(orientation: landscape)");
				
				// Initial check
				handleOrientation(landscapeQuery);
				
				// Add listener for orientation changes
				landscapeQuery.addEventListener('change', handleOrientation);
			}

			if(document.querySelector('.carousel')){ //great 
				resizeCarousel();
			}

			
			
		});

		


/*    ACTIONS : WHERE THE FUNCTIONS ARE CALLED     */
    ////    ////    ////    ////
       ////    ////    ////    ////
/*    ACTIONS : WHERE THE FUNCTIONS ARE CALLED     */






 
