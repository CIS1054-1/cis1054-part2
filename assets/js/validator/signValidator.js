/** 
 *  * This is a multifunctional General Sign Validator, working for SignUp and SignIn thankfull to the href in the submit button
    *
    * @author Gioele Giunta
    * @version 1.0
    * @since 2024-04-23
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

// Select the necessary elements
const emailInput = document.getElementById('email-input');
const passwordInput = document.getElementById('password-input');
const nameInput = document.getElementById('name-input');
const surnameInput = document.getElementById('surname-input');
const submitButton = document.getElementById('submit');
//const signLink = document.querySelector('p a[href="sign"]');
const emailErrorMessage = document.getElementById('email-error');
const passwordErrorMessage = document.getElementById('password-error');
const nameErrorMessage = document.getElementById('name-error');
const surnameErrorMessage = document.getElementById('surname-error');



/*
* This function validate the Name
* @param void
* return bool
*/
function validateName() {
  //Required check
  if(nameInput.value.length == 0){
  //Change the name-error classed p
  nameErrorMessage.textContent = 'The Name is Required!';
  submitButton.disabled = true;
  return false;
  }
  //In this case return true, no errors
  nameErrorMessage.textContent = '';
  submitButton.disabled = false;
  return true;
}


/*
* This function validate the Surname
* @param void
* return bool
*/
function validateSurname() {
  //Required check
  if(surnameInput.value.length == 0){
  //Change the surname-error classed p
  surnameErrorMessage.textContent = 'The Surname is Required!';
  submitButton.disabled = true;
  return false;
  }
  //In this case return true, no errors
  surnameErrorMessage.textContent = '';
  submitButton.disabled = false;
  return true;
}


/*
* This function validate the Email
* @param void
* return bool
*/
function validateEmail() {
      //Required check
  if(emailInput.value.length == 0){
    //Change the email-error classed p
    emailErrorMessage.textContent = 'The Email is Required!';
    submitButton.disabled = true;
    return false;
  }
    //Check if the email has the pattern xxxx@xxx.xx
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(emailInput.value.trim())) {
    //Change the email-error classed p
    emailErrorMessage.textContent = 'Invalid email. Must contain an @!';
    submitButton.disabled = true;
    return false;
  }
  //In this case return true, no errors
  emailErrorMessage.textContent = '';
  submitButton.disabled = false;
  return true;
}

/*
* This function validate the Password
* return bool
*/
function validatePassword() {
      //Required check
  if(passwordInput.value.length == 0){
    //Change the password-error classed p
    passwordErrorMessage.textContent = 'The Password is Required!';
    submitButton.disabled = true;
    return false;
  }
    //Check if the password contain whan special character like at least one number and is between 8,16 in one unique call in a different way from email
  const passwordPattern = /^(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-zA-Z]).{8,16}$/;
  if (!passwordPattern.test(passwordInput.value.trim())) {
    //Change the password-error classed p
    passwordErrorMessage.textContent = 'Password must be between 8 and 16 characters, contain at least one special character (!@#$&*), and at least one number.';
    submitButton.disabled = true;
    return false;
  }
    passwordErrorMessage.textContent = '';
    submitButton.disabled = false;
    return true;
}

// Event listeners for validation, to to in real time and can disable the button
if(nameInput != null){nameInput.addEventListener('input', validateName);}
if(surnameInput != null){surnameInput.addEventListener('input', validateSurname);}
emailInput.addEventListener('input', validateEmail);
passwordInput.addEventListener('input', validatePassword);

// Event listener for form submission
submitButton.addEventListener('click', (event) => {
  event.preventDefault();
  if (validateEmail() && validatePassword() && validateName() && validateSurname()) {
    // Perform an AJAX call to the PHP script linked in the button
    fetch('server/scripts/log_user.php', {
      method: 'POST',
      body: new FormData(document.forms.myform)
    })
    .then(response => {
      // Handle the response from the PHP script
      console.log(response);
    })
    .catch(error => {
      console.error('Error in AJAX call:', error);
    });
  }
});
