/** 
 *  * This is the complaintsValidator
    *
    * @author Gioele Giunta
    * @version 1.0
    * @since 2024-05-16
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/


// Get the form and the input fields
const subjectInput = document.getElementById('subject');
const descriptionInput = document.getElementById('description');
const submitButton = document.getElementById('submit_complaint');
const subjectErrorMessage = document.getElementById('subject-error');
const descriptionErrorMessage = document.getElementById('description-error');
const form = document.querySelector('#complaint-make-form');

/*
* This function validate the Subject
* @param void
* return bool
*/
function validateSubject() {
      //Required check
      if(subjectInput.value.length == 0){
        //Change the subject-error classed p
        subjectErrorMessage.textContent = 'The subject is Required!';
        submitButton.disabled = true;
        return false;
      }
        //Check if the subject contain whan special character like at least one number and is between 8,16 in one unique call in a different way from email
      if (subjectInput.value.length < 8 || subjectInput.value.length > 25) {
        //Change the subject-error classed p
        subjectErrorMessage.textContent = 'Subject must be between 8 and 25 characters.';
        submitButton.disabled = true;
        return false;
      }
        subjectErrorMessage.textContent = '';
        submitButton.disabled = false;
        return true;
}

/*
* This function validate the description
* return bool
*/
function validateDescription() {
    //Required check
if(descriptionInput.value.length == 0){
  //Change the description-error classed p
  descriptionErrorMessage.textContent = 'The description is Required!';
  submitButton.disabled = true;
  return false;
}
  //Check if the description contain whan special character like at least one number and is between 8,16 in one unique call in a different way from email
if (descriptionInput.value.length < 25 || descriptionInput.value.length > 200) {
  //Change the description-error classed p
  descriptionErrorMessage.textContent = 'Description must be between 25 and 200 characters.';
  submitButton.disabled = true;
  return false;
}
  descriptionErrorMessage.textContent = '';
  submitButton.disabled = false;
  return true;
}



// Add an event listener to the form's submit events

subjectInput.addEventListener('input', validateSubject);
descriptionInput.addEventListener('input', validateDescription);


submitButton.addEventListener('click', (event) => {
  // Prevent the default form submission
  event.preventDefault();

  if (validateSubject() && validateDescription()) {
    // If both fields are valid, enable the submit button and submit the form
    submitButton.disabled = false;
    form.submit();
  }

});