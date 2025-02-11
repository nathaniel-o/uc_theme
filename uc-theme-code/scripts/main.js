


const submitter = document.getElementsByClassName("contact-button"); /*Grab button*/
//console.log(submitter);	

submitter[0].addEventListener("click", function(e){

		getForm();
		//console.log(e.target);

});


function getForm(){



	const form = document.getElementById("contact-form"); /*Grab the HTML form#contact-form*/
	//console.log(form); 

	const formData = new FormData(form, submitter[0]);	/*As FormData - WHY?*/
	//console.log(formData);
	var output = [];
	for (const [key, value] of formData) {
	output += `${key}: ${value}\n`;
	}
	console.log("output");
	console.log(output);

	

}







//Declare Class (Object) to store all values retreived & validated as simple object.properties
class User {
	constructor(prenom, name, business, individual, email, phone, country, enquiry, blogY) {
		this.prenom = prenom;
		this.name = name;
		this.business=business;
		this.individual = individual;
		this.email = email;
		this.phone = phone;
		this.country = country;
		this.enquiry = enquiry;
		this.blogY = blogY;
	}
}

/*
//pasted from same codebrainer.com/blog/contact-form-in-javascript
var fields = {};		//Declare array to hold value of all fields in form
	
	///RETRIEVE content when document is loaded (using ghost function?)
	document.addEventListener("DOMContentLoaded", function() {
		
		
		//Add propertiers of [input name] to Array "fields"
		fields.prenom = document.getElementById('prenom');
		fields.name = document.getElementById('Name');
		fields.business = document.getElementById('business');
		fields.individual = document.getElementById('individual');
		fields.email = document.getElementById('email');
		fields.phone = document.getElementById('phone');
		fields.country = document.getElementById('country'); //Instead of ZIP, for international? 
		fields.enquiry = document.getElementById('enquiry');
		fields.blogPost = document.getElementById('blogY');
		//fields.question = document.getElementById('question'); NOT used 
});
*/


	



















////////////////////////////////////////////////////////
/*Example JS file from 
https://developer.mozilla.org/en-US/docs/Learn/Getting_started_with_the_web/JavaScript_basics
--> conditional IMG changer*/
const myImage = document.querySelector('img');

myImage.onclick = () => {
  const mySrc = myImage.getAttribute('src');
  if (mySrc === 'images/firefox-icon.png') {
    myImage.setAttribute('src','images/firefox2.png');
  } else {
    myImage.setAttribute('src','images/firefox-icon.png');
  }
}