/**
 * @file generalSignValidator.js
 * @brief This is a multifunctional General Sign Validator, working for SignUp and SignIn thankfull to the href in the submit button.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2024-04-23
 * @info The author, Gioele, is going to use the Camel Case for the JavaScript files.
 */

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

/**
 * @brief Validates the name input field.
 * @return true if the name is valid, false otherwise.
 */
function validateName() {
    // To avoid an error during sign-in
    if (nameInput == undefined) {
        return true;
    }

    // Required check
    if (nameInput.value.length == 0) {
        // Change the name-error classed p
        nameErrorMessage.textContent = 'The Name is Required!';
        submitButton.disabled = true;
        return false;
    }

    // No errors, enable the submit button
    nameErrorMessage.textContent = '';
    submitButton.disabled = false;
    return true;
}

/**
 * @brief Validates the surname input field.
 * @return true if the surname is valid, false otherwise.
 */
function validateSurname() {
    // To avoid an error during sign-in
    if (surnameInput == undefined) {
        return true;
    }

    // Required check
    if (surnameInput.value.length == 0) {
        // Change the surname-error classed p
        surnameErrorMessage.textContent = 'The Surname is Required!';
        submitButton.disabled = true;
        return false;
    }

    // No errors, enable the submit button
    surnameErrorMessage.textContent = '';
    submitButton.disabled = false;
    return true;
}

/**
 * @brief Validates the email input field.
 * @return true if the email is valid, false otherwise.
 */
function validateEmail() {
    // Required check
    if (emailInput.value.length == 0) {
        // Change the email-error classed p
        emailErrorMessage.textContent = 'The Email is Required!';
        submitButton.disabled = true;
        return false;
    }

    // Check if the email has the pattern xxxx@xxx.xx
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(emailInput.value.trim())) {
        // Change the email-error classed p
        emailErrorMessage.textContent = 'Invalid email. Must contain an @!';
        submitButton.disabled = true;
        return false;
    }

    // No errors, enable the submit button
    emailErrorMessage.textContent = '';
    submitButton.disabled = false;
    return true;
}

/**
 * @brief Validates the password input field.
 * @return true if the password is valid, false otherwise.
 */
function validatePassword() {
    // Required check
    if (passwordInput.value.length == 0) {
        // Change the password-error classed p
        passwordErrorMessage.textContent = 'The Password is Required!';
        submitButton.disabled = true;
        return false;
    }

    // Check if the password contains at least one special character, one number, and is between 8 and 16 characters
    const passwordPattern = /^(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-zA-Z]).{8,16}$/;
    if (!passwordPattern.test(passwordInput.value.trim())) {
        // Change the password-error classed p
        passwordErrorMessage.textContent = 'Password must be between 8 and 16 characters, contain at least one special character (!@#$&*), and at least one number.';
        submitButton.disabled = true;
        return false;
    }

    // No errors, enable the submit button
    passwordErrorMessage.textContent = '';
    submitButton.disabled = false;
    return true;
}

// Event listeners for validation, to run in real-time
if (nameInput != null) { nameInput.addEventListener('input', validateName); }
if (surnameInput != null) { surnameInput.addEventListener('input', validateSurname); }
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
            });
    }
});