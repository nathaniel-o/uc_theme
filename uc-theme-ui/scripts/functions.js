/*
*   Functions wrapped in DOM listener by functions.php :   
*		ucInsertTierOneBg / ucInsertDrinkPostsBg (as testing_backgrounds) , 
*		styleImagesByPageID , 
*
*
*/

	function styleImagesByPageID(variableID) {
		
		if(pageID.includes("springtime")){
			variableID = "summertime";
		}  //  (Else variableID = pageID as passed in functions.php)


		// Compose variable names
		const borderVar = `var(--${variableID}-border)`;
		const fontColorVar = `var(--${variableID}-font-color)`;
		const shadowVar = `var(--${variableID}-shadow)`;

		/* console.log(borderVar);
		console.log(fontColorVar);
		console.log(shadowVar); */

		// Get all images within .entry-content
		const entryContent = document.querySelector('.entry-content');
		if (!entryContent) {    //  If no entry-content, no action. 
			return;
		}
	
		const images = entryContent.querySelectorAll('img');

		images.forEach(img => {
			// 1. Apply border variable
			img.style.border = borderVar;

/* 			console.log(img);
 */
			// 2 & 3. If image is in a figure with figcaption, style the caption
			const figure = img.closest('figure');
			if (figure) {
				const caption = figure.querySelector('figcaption');
				if (caption) {
					caption.style.color = fontColorVar;
					caption.style.textShadow = shadowVar;
				}
			}
		});
	}

	/*
		Simple background function that works for all page types
		Now that pageID is set to drinks taxonomy for single posts, we can use one function
	*/
	function ucInsertBackground(){
		let anPage = document.querySelector("body");
		
		if (!anPage) {  // Check DOM is loaded
			console.warn("Body element not found, retrying after DOM load");
			document.addEventListener("DOMContentLoaded", () => {
				anPage = document.querySelector("body");
				if (anPage) {
					ucInsertBackground();
				}
			});
			return;
		}
		
		// Build CSS variable using pageID (which is now drinks taxonomy for single posts)
		let bgVar = 'var(--' + pageID + '-bg-img)';
		console.log("Setting background: " + bgVar);
		
		// Apply background to body
		anPage.style.backgroundImage = bgVar;
	}



	function ucColorH1(){

					console.log("Applying H1 styling for pageID:", pageID);

					var headings = document.querySelectorAll("h1");

					// Where more than one h1 exists...
					for (let i = 0; i < headings.length; i++){
						var heading = headings[i];
						
						// Reset any existing inline styles
						heading.style.cssText = '';
						
						// Apply page-specific styling based on pageID
						if(pageID.includes("everyday")){
							heading.style.color = "var(--everyday-font-color)";
							heading.style.textShadow = "var(--everyday-shadow)";
							heading.style.fontFamily = "var(--std-baskerville-font)";
							heading.style.backgroundColor = "transparent";
							heading.style.accentColor = "var(--everyday-accent-color)";
						}
						else if(pageID.includes("romantic")){
							heading.style.color = "var(--romantic-font-color)";
							heading.style.textShadow = "var(--romantic-shadow)";
							heading.style.fontFamily = "var(--romantic-caption-font)";
							heading.style.backgroundColor = "transparent";
							heading.style.accentColor = "var(--romantic-accent-color)";
						}
						else if(pageID.includes("summertime")){
							heading.style.textShadow = "var(--summertime-shadow)";
							heading.style.backgroundColor = "transparent";
							heading.style.color = "var(--summertime-accent-color)";
							heading.style.accentColor = "var(--summertime-accent-color)";
						}
						else if(pageID.includes("fireplace")){
							heading.style.color = "var(--fireplace-font)";
							heading.style.textShadow = "var(--fireplace-shadow)";
							heading.style.backgroundColor = "transparent";
						}
						else if(pageID.includes("special-occasion")){
							heading.style.fontFamily = "var(--special-occasion-header-font)";
							heading.style.backgroundColor = "transparent";
							heading.style.color = "var(--special-occasion-accent-color)";
						}
						else if(pageID.includes("gallery")){
							heading.style.color = "var(--gallery-font-color)";
							heading.style.textShadow = "var(--std-text-shadow)";
							heading.style.backgroundColor = "transparent";
						}
						else if(pageID.includes("home")){
							heading.style.color = "var(--original-pink)";
							heading.style.textShadow = "var(--std-text-shadow)";
							heading.style.backgroundColor = "transparent";
						}
						else {
							// Default styling for other pages
							heading.style.color = "var(--std-font-color)";
							heading.style.textShadow = "var(--std-text-shadow)";
							heading.style.fontFamily = "var(--std-baskerville-font)";
							heading.style.backgroundColor = "transparent";
						}
						
						// Apply common styling to all headings
						heading.style.padding = "0.5rem 1rem";
						heading.style.margin = "1rem 0";
						heading.style.textAlign = "center";
						heading.style.borderRadius = "4px";
						heading.style.transition = "var(--std-transition)";
						
						console.log("Applied styling to H1:", heading.textContent);
					}

					console.log("H1 styling complete for", headings.length, "headings");


	}



		/*    MISC. HELPER FUNCTIONS    
		    ////    ////    ////    ////    */ 
			
		//  Image orientation detection moved to drinks-plugin
		//  Function ucPortraitLandscape has been refactored and moved to the drinks plugin
		//  for better integration with WordPress Image blocks






			function updateImageLinks() {
				// Find all figures with images and captions
				const figures = document.querySelectorAll('figure.wp-block-image');
				
				figures.forEach(figure => {
					const link = figure.querySelector('a');
					const caption = figure.querySelector('figcaption');
					
					if (link && caption) {
						// Get the href from the existing link
						const href = link.getAttribute('href');
						
						// Create a new link that will wrap everything
						const newLink = document.createElement('a');
						newLink.href = href;
						
						// Move the image into the new link
						const img = link.querySelector('img');
						newLink.appendChild(img);
						
						// Move the figcaption into the new link
						newLink.appendChild(caption);
						
						// Remove the old link
						link.remove();
						
						// Add the new link to the figure
						figure.appendChild(newLink);
					}
				});
			}
			
			// Run when the DOM is fully loaded
			document.addEventListener('DOMContentLoaded', updateImageLinks);



			





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


			function ucAjaxCarousel(e){

				//console.log(e.target)
				e.preventDefault(); //Stop page refresh

				let searchValue = '';

				// Check if event target is an image
				if (e.target.tagName === 'IMG') {
					// Find the closest parent with .post & .post-#### class
					const postElement = e.target.closest('.post[class*="post-"]');
					if (postElement) {
						// Get the post title from within this element
						searchValue = postElement.querySelector('.wp-block-post-title')?.textContent || 'Title not found';

					}
				}
				// Check if event target is a button
				else if (e.target.tagName === 'BUTTON') {
					// Get search term from button's parent element
					searchValue = e.target.closest('.search-container')?.querySelector('input')?.value || '';
				}
				

				//  Make AJAX call to WordPress
					fetch(`${window.location.origin}/wordpress/wp-admin/admin-ajax.php`, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded',
						},
						body: `action=filter_carousel&search_term=${encodeURIComponent(searchValue)}`
					})
					.then(response => response.text())
					.then(html => {
						// Update the carousel with the new HTML
						const carousel = document.querySelector('.uc-swiper-list');
						if (carousel) {
							carousel.innerHTML = html;
						}
						console.log(carousel);

						// Portrait/landscape classes are now handled by drinks-plugin
						// Image orientation detection is automatic
						document.querySelector('.uc-slideshow').classList.toggle("hidden");
					})
					.catch(error => console.error('Error:', error));
				
			}



			// Apply Click Evt Lstnr to an Array of Figures
			function ucListenIteratively(anyFigureArray){  //  Repurposed to use AJAX & functions.php uc_filter_carousel

				for(const figure of anyFigureArray){
					const nodes = figure.childNodes;
					nodes.forEach(element => {
					//console.log(element);
							element.addEventListener("click", 
								(e) => {	
									

									ucAjaxCarousel(e);
							
									

								
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

				/* const allFigures = document.querySelectorAll(".portrait, .landscape");
				if(allFigures.length > 0){
					ucListenIteratively(allFigures);
				} */

				/* if(document.querySelector(".wp-block-search__button")){
					document.querySelector(".wp-block-search__button").addEventListener("click", (e) => {
						ucAjaxCarousel(e);
					});
				} */
				
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

	
	
	
			////    ////    ////    //// 
		/*    MISC. HELPER FUNCTIONS    */




	/*    SEARCH & FILTER FUNCTIONS    
        ////    ////    ////    ////    */
								
	




	function getRandomInt(max) {
		return Math.floor(Math.random() * max);
	  }

		   ////    ////    ////    ////
	/*    SEARCH & FILTER FUNCTIONS    */
 





	function ucStylePopOff(){
		const popoff = document.querySelector(".wp-block-media-text");
		const theFig = document.querySelector(".pop-off figure");
		//console.log(theFig);

		if (theFig) {
			if (theFig.classList.contains("landscape")) {
				// For landscape images, always use column layout
				popoff.style.flexDirection = "column";
			} else if (theFig.classList.contains("portrait")) {
				createOrientationHandler(
					// Portrait screen orientation callback
					() => {
						popoff.style.flexDirection = "column";
					},
					// Landscape screen orientation callback
					() => {
						popoff.style.flexDirection = "row";
					}
				);
			}
		}
	}
	document.addEventListener("DOMContentLoaded", (event) => {
		ucStylePopOff();
	});


	/**
	 * Creates an orientation handler that executes different callbacks for portrait/landscape
	 * @param {Function} portraitCallback - Function to execute in portrait mode
	 * @param {Function} landscapeCallback - Function to execute in landscape mode
	 * @returns {Function} Cleanup function to remove event listener
	 */
	function createOrientationHandler(portraitCallback, landscapeCallback) {
		// Function to handle orientation changes
		function handleOrientation(mediaQuery) {
			if (mediaQuery.matches) { // Landscape mode
				landscapeCallback();
			} else { // Portrait mode
				portraitCallback();
			}
		}

		// Create media query for landscape orientation
		const landscapeQuery = window.matchMedia("(orientation: landscape)");
		
		// Initial check
		handleOrientation(landscapeQuery);
		
		// Add listener for orientation changes
		landscapeQuery.addEventListener('change', handleOrientation);

		// Return cleanup function
		return () => landscapeQuery.removeEventListener('change', handleOrientation);
	}
    /* 
	*    Customize WP Header
	*/
    function ucCustomizeWPHeader() {
		const theLogo = `<div class="wp-block-site-logo uc-extra-logo"><a href="untouchedcocktails.com" class="custom-logo-link" rel="home"><img width="512" height="512" src="http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x.jpg" class="custom-logo" alt="Untouched Cocktails" decoding="async" fetchpriority="high" srcset="http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x.jpg 512w, http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x-300x300.jpg 300w, http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x-150x150.jpg 150w" sizes="(max-width: 512px) 100vw, 512px" data-attachment-id="2684" data-permalink="http://localhost/wordpress/logo512x/" data-orig-file="http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x.jpg" data-orig-size="512,512" data-comments-opened="1" data-image-meta="{&quot;aperture&quot;:&quot;0&quot;,&quot;credit&quot;:&quot;&quot;,&quot;camera&quot;:&quot;&quot;,&quot;caption&quot;:&quot;&quot;,&quot;created_timestamp&quot;:&quot;0&quot;,&quot;copyright&quot;:&quot;&quot;,&quot;focal_length&quot;:&quot;0&quot;,&quot;iso&quot;:&quot;0&quot;,&quot;shutter_speed&quot;:&quot;0&quot;,&quot;title&quot;:&quot;&quot;,&quot;orientation&quot;:&quot;1&quot;}" data-image-title="logo512x" data-image-description="" data-image-caption="" data-medium-file="http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x-300x300.jpg" data-large-file="http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x.jpg"></a></div>`;
		const mobileNav = document.querySelector(".wp-block-navigation");
	
		createOrientationHandler(
			// Portrait callback
			() => {
				if (!mobileNav.querySelector('.uc-extra-logo')) {
					mobileNav.insertAdjacentHTML('afterbegin', theLogo);
				}
			},
			// Landscape callback
			() => {
				const extraLogo = mobileNav.querySelector('.uc-extra-logo');
				if (extraLogo) {
					extraLogo.remove();
				}
			}
		);







		const links = Array.from(document.querySelectorAll(".wp-block-navigation-link"));
		//console.log(links);

		// Array of seasonal cocktail names to match
		const seasonalNames = [
			"Summertime Cocktails",
			"Aurumnal Cocktails",
			"Springtime Cocktails",
			"Wintertime Cocktails"
		];

		// Find indexes of links containing any seasonal cocktail name
		const matchingIndexes = links.reduce((acc, link, index) => {
			if (seasonalNames.some(name => link.textContent.includes(name))) {
				acc.push(index);
			}
			return acc;
		}, []);

		// Replace the .innerText of the links at the indexes with "Seasonal Cocktails"
		matchingIndexes.forEach(index => {
			links[index].innerText = "Seasonal Cocktails";
		});

		console.log("Indexes of seasonal cocktail links:", matchingIndexes);

		
 	}









/*    ACTIONS : WHERE THE FUNCTIONS ARE CALLED     */
    ////    ////    ////    ////
       ////    ////    ////    ////
/*    ACTIONS : WHERE THE FUNCTIONS ARE CALLED     */
	
		/*		...WHEN PAGE LOADS... 		*/
		/* document.addEventListener("DOMContentLoaded", (event) =>{ */
		window.addEventListener("load", (event) =>{
			//console.log("Resources Loaded");
			


 			ucCustomizeWPHeader();
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

			/* if(document.querySelector('.carousel')){ //great 
				resizeCarousel();
			} */

			
			
		});































		/*Remove 3 digits of anString 

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

