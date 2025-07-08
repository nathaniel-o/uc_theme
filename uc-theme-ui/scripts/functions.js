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
		MODIFIES <div="wp-site-blocks".style.backgroundImage using 
		scoped pageID
	*/
	function ucInsertTierOneBg(){

					let anPage = document.querySelector("body");
					
					/* WORKS with single quotes in CSS URL variables!! &&
						ALSO with String.concat() NOT string += approach 
					*/
					let bgVar = 'var(--';
					//bgVar.concat('var(--');
					bgVar = bgVar.concat(pageID);
					bgVar = bgVar.concat("-bg-img)");
					console.log(bgVar);  
					
					//anPage[0].style.backgroundImage = "var(--romantic-bg-img)";
					anPage.style.backgroundImage =  bgVar  ;
					//document.body.style.background = bgVar;
					//console.log(anPage);
	}
	function ucInsertDrinkPostsBg(bgVar){


		let anPage = document.querySelector("body");
		
		if (!anPage) {  // Check DOM is loaded
			console.warn("Body element not found, retrying after DOM load");
			document.addEventListener("DOMContentLoaded", () => {
				anPage = document.querySelector("body");
				if (anPage) {
					//console.log(bgVar);
					//console.log(anPage);
					anPage.style.backgroundImage = bgVar;
				}
			});
			return;
		}
		
		//anPage.style.backgroundImage = bgVar;

		

		if (bgVar) {
			document.body.style.backgroundImage = bgVar;
		}
		//console.log(bgVar);
		//console.log(anPage);


	
	}

	function ucInsertBackgrounds() {  // Combine both above.
		//  Handle background for tier one pages 
		if (!document.body.classList.contains('single-post')) {
			console.log("not single-post");
			ucInsertTierOneBg();
		}
		// Handle background for single post pages
		if (document.body.classList.contains('single-post')) {

			console.log("single-post");
			ucInsertDrinkPostsBg(); // Probably not working due bgVar undefined 
			
		}
		
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



		/*    MISC. HELPER FUNCTIONS    
		    ////    ////    ////    ////    */ 
			
		//  Add CSS class to figure based on dimensions of img (on load) 
			//  Repurposed from Drink.ucConvertDrinkToFigure(), to Be Used Everywhere. 
		function ucPortraitLandscape(anImage, anFigure){
				let drinkImage = anImage;
				let figure = anFigure;	
				//console.log('Image src:', drinkImage.src);
				//console.log('Image complete:', drinkImage.complete);		


				/*
				*  Ignore the pop-off figure which contains media & text > figure (Single Pages)
				*  Ignore the Gallery Block's figure which contains multiple figures 
				*/
				if(!figure.classList.contains("pop-off") && !figure.classList.contains("wp-block-gallery")){ 
					if (drinkImage.complete) {
						// Image is already loaded, process immediately
						//console.log(drinkImage.naturalHeight);
						//console.log(drinkImage.naturalWidth);
						processImageDimensions();
					} else {
						// Image is not loaded yet, wait for load event
						drinkImage.onload = processImageDimensions;
					}

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
				/* document.querySelectorAll('.wp-block-post-featured-image').forEach(figure => {
					ucPortraitLandscape(figure.querySelector('img'), figure);
				}); */

				/* the logo isn't a figure by default  */ 
				document.querySelectorAll('figure').forEach(figure => {
					ucPortraitLandscape(figure.querySelector('img'), figure);
				});
		});






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
					fetch(`${window.location.origin}/wordpress-new1/wp-admin/admin-ajax.php`, {
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

						// Apply portrait/landscape classes to new figures
						carousel.querySelectorAll('figure').forEach(figure => {
							ucPortraitLandscape(figure.querySelector('img'), figure);
						});
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
									

									//ucAjaxCarousel(e);
							
									

								
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

				if(document.querySelector(".wp-block-search__button")){
					document.querySelector(".wp-block-search__button").addEventListener("click", (e) => {
						ucAjaxCarousel(e);
					});
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
		const theLogo = `<div class="wp-block-site-logo uc-extra-logo"><a href="untouchedcocktails.com" class="custom-logo-link" rel="home"><img width="512" height="512" src="http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x.jpg" class="custom-logo" alt="Untouched Cocktails" decoding="async" fetchpriority="high" srcset="http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x.jpg 512w, http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x-300x300.jpg 300w, http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x-150x150.jpg 150w" sizes="(max-width: 512px) 100vw, 512px" data-attachment-id="2684" data-permalink="http://localhost/wordpress-new1/logo512x/" data-orig-file="http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x.jpg" data-orig-size="512,512" data-comments-opened="1" data-image-meta="{&quot;aperture&quot;:&quot;0&quot;,&quot;credit&quot;:&quot;&quot;,&quot;camera&quot;:&quot;&quot;,&quot;caption&quot;:&quot;&quot;,&quot;created_timestamp&quot;:&quot;0&quot;,&quot;copyright&quot;:&quot;&quot;,&quot;focal_length&quot;:&quot;0&quot;,&quot;iso&quot;:&quot;0&quot;,&quot;shutter_speed&quot;:&quot;0&quot;,&quot;title&quot;:&quot;&quot;,&quot;orientation&quot;:&quot;1&quot;}" data-image-title="logo512x" data-image-description="" data-image-caption="" data-medium-file="http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x-300x300.jpg" data-large-file="http://untouchedcocktails.com/wp-content/uploads/2024/12/logo512x.jpg"></a></div>`;
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
			


 			//ucCustomizeWPHeader();
			//ucAddPaginationLeftArrowToCarousel();
			
			// Setup image randomization
			ucSetupImageRandomization();


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


	// Image Randomization Functions for WordPress Image Blocks
	/*
	 * FEATURE: Image Randomization on Click
	 * 
	 * This feature allows users to click on any WordPress Image Block to randomize
	 * the image shown. The new image will be randomly selected from your drink posts.
	 * 
	 * HOW IT WORKS:
	 * 1. Click any WordPress Image Block (figure.wp-block-image)
	 * 2. AJAX call fetches a random drink post thumbnail
	 * 3. Image source and attributes are updated
	 * 4. Portrait/landscape classes are reapplied
	 * 
	 * REQUIREMENTS:
	 * - WordPress Image Blocks (figure.wp-block-image)
	 * - Drink posts with featured images
	 * - AJAX handler in functions.php
	 * 
	 * VISUAL INDICATORS:
	 * - Images have pointer cursor on hover
	 * - Hover effect shows 🔄 icon
	 * - Console logs show randomization activity
	 */
	function ucRandomizeImage(e) {
		e.preventDefault(); // Stop page refresh
		
		const clickedImage = e.target;
		if (clickedImage.tagName !== 'IMG') {
			return; // Only handle image clicks
		}
		
		// Check if this is a WordPress Image Block
		const figure = clickedImage.closest('figure.wp-block-image');
		if (!figure) {
			return; // Only handle WordPress Image Blocks
		}
		
		// Get current image data for reference
		const currentImageId = clickedImage.getAttribute('data-id') || clickedImage.getAttribute('data-attachment-id');
		const currentAlt = clickedImage.getAttribute('alt') || '';
		
		console.log('Randomizing image:', currentImageId, currentAlt);
		
		const ajaxUrl = `${window.location.origin}/wordpress-new1/wp-admin/admin-ajax.php`;
		const requestBody = `action=randomize_image&current_id=${encodeURIComponent(currentImageId)}`;
		
		console.log('AJAX URL:', ajaxUrl);
		console.log('Request body:', requestBody);
		
		// Make AJAX call to get random image
		fetch(ajaxUrl, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: requestBody
		})
		.then(response => response.json())
		.then(data => {
			if (data.success && data.data.image) {
				const newImage = data.data.image;
				
				console.log('Image randomized to:', newImage.title);
				console.log('New image URL:', newImage.src);
				
				// Update the image source and attributes
				clickedImage.src = newImage.src;
				clickedImage.alt = newImage.alt;
				clickedImage.setAttribute('data-id', newImage.id);
				
				// Update WordPress-specific attributes
				if (newImage.attachment_id) {
					clickedImage.setAttribute('data-attachment-id', newImage.attachment_id);
				}
				
				// Update srcset and sizes for responsive images
				if (newImage.srcset) {
					clickedImage.setAttribute('srcset', newImage.srcset);
				}
				if (newImage.sizes) {
					clickedImage.setAttribute('sizes', newImage.sizes);
				}
				
				// Update other WordPress data attributes
				if (newImage.data_orig_file) {
					clickedImage.setAttribute('data-orig-file', newImage.data_orig_file);
				}
				if (newImage.data_orig_size) {
					clickedImage.setAttribute('data-orig-size', newImage.data_orig_size);
				}
				if (newImage.data_image_title) {
					clickedImage.setAttribute('data-image-title', newImage.data_image_title);
				}
				if (newImage.data_image_caption) {
					clickedImage.setAttribute('data-image-caption', newImage.data_image_caption);
				}
				if (newImage.data_medium_file) {
					clickedImage.setAttribute('data-medium-file', newImage.data_medium_file);
				}
				if (newImage.data_large_file) {
					clickedImage.setAttribute('data-large-file', newImage.data_large_file);
				}
				
				// Update class to match new image
				if (newImage.attachment_id) {
					clickedImage.className = clickedImage.className.replace(/wp-image-\d+/, `wp-image-${newImage.attachment_id}`);
				}
				
				// Update the figcaption if it exists
				const figcaption = figure.querySelector('figcaption');
				if (figcaption && newImage.data_image_caption) {
					figcaption.innerHTML = newImage.data_image_caption;
					console.log('Updated figcaption:', newImage.data_image_caption);
				}
				
				// Force image reload - try a different approach
				clickedImage.onload = function() {
					console.log('New image loaded successfully');
					// Update figure classes if needed
					ucPortraitLandscape(clickedImage, figure);
				};
				
				// If onload doesn't fire, force it after a delay
				setTimeout(() => {
					if (clickedImage.complete) {
						console.log('Image load completed');
						ucPortraitLandscape(clickedImage, figure);
					}
				}, 100);
				
			} else {
				console.error('Failed to randomize image:', data.message);
			}
		})
		.catch(error => {
			console.error('Error randomizing image:', error);
		});
	}
	
	// Apply click event listeners to WordPress Image Blocks
	function ucSetupImageRandomization() {
		const imageBlocks = document.querySelectorAll('figure.wp-block-image img');
		
		imageBlocks.forEach(img => {
			// Set up automatic randomization for each image
			const randomDelay = Math.random() * (90000 - 10000) + 10000; // 10-90 seconds in milliseconds
			console.log(`Setting up auto-randomization for image in ${Math.round(randomDelay/1000)}s`);
			
			setTimeout(() => {
				// Create a fake click event to trigger randomization
				const fakeEvent = {
					target: img,
					preventDefault: () => {}
				};
				ucRandomizeImage(fakeEvent);
				
				// Set up recurring randomization every 10-90 seconds
				const setupRecurringRandomization = () => {
					const nextDelay = Math.random() * (90000 - 10000) + 10000;
					console.log(`Next auto-randomization in ${Math.round(nextDelay/1000)}s`);
					setTimeout(() => {
						const fakeEvent = {
							target: img,
							preventDefault: () => {}
						};
						ucRandomizeImage(fakeEvent);
						setupRecurringRandomization(); // Schedule next randomization
					}, nextDelay);
				};
				
				setupRecurringRandomization();
			}, randomDelay);
		});
		
		console.log(`Setup auto-randomization for ${imageBlocks.length} image blocks`);
	}

	// Initialize image randomization when page loads
	// CALLED BY functions.php DOM lstnr
	// document.addEventListener('DOMContentLoaded', ucSetupImageRandomization);

