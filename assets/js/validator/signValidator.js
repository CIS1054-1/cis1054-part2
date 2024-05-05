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
let nameInput = document.getElementById('name-input');
let surnameInput = document.getElementById('surname-input');
const submitButton = document.getElementById('submit');
const signLink = submitButton.getAttribute('href');
const emailErrorMessage = document.getElementById('email-error');
const passwordErrorMessage = document.getElementById('password-error');
const nameErrorMessage = document.getElementById('name-error');
const surnameErrorMessage = document.getElementById('surname-error');
const generalErrorMessage = document.getElementById('general-error');



/*
* This function validate the Name
* @param void
* return bool
*/
function validateName() {
  //To avoid that during sign in throwns an error
  if(nameInput == undefined){
    return true;
  }
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
    //To avoid that during sign in throwns an error
    if(surnameInput == undefined){
      return true;
    }
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
    const recipeUrl = 'server/scripts/' + signLink;
            const postBody = {
              name: nameInput ? nameInput.value : "",
              surname: surnameInput ? surnameInput.value : "",
              email: emailInput.value.toLowerCase(),
              password: passwordInput.value
            };
            const requestMetadata = {
                method: 'POST',
                headers: {
                  Accept: 'application/json',
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(postBody)
            };
            fetch(recipeUrl, requestMetadata)
                .then((response) => {
                    //console.log("Headers:", response.headers);
                    return response.json(); 
                })
                .then((responseData) => {
                    console.log("Response:", responseData);
                    if (responseData.status === "true") {
                      location.href = "index.php";
                    } else {
                      generalErrorMessage.textContent = responseData.message;
                    }
                })
                .catch((err) => {
                    console.info('Error:', err.message);
                    //setErrorText(err.message);
                });
  }
});
