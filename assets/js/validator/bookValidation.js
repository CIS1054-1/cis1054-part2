/**
 * @file tableBooking.js
 * @brief This file manages the scripts to click, update the calendar, and validate the book.html page.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2024-05-14
 * @info The author, Gioele, is going to use the Camel Case for the JavaScript files.
 */

/**
 * @var tableNumber
 * @brief Represents the number of the table selected by the user.
 *        Initially set to -1 to indicate no table is selected.
 */
let tableNumber = -1;

/**
 * @var submitButton
 * @brief Represents the submit button on the book.html form.
 */
const submitButton = document.getElementById('submit_book');

/**
 * @var form
 * @brief Represents the book.html form.
 */
const form = document.querySelector('#book-table-form');

/**
 * @brief Adds a click event listener to each available table circle on the page.
 *        When a table circle is clicked, it sets the `tableNumber` variable to the
 *        corresponding table number, updates the form input field, and enables the
 *        submit button.
 */
document.querySelectorAll('.table-circle.available').forEach(circle => {
    circle.addEventListener('click', () => {
        tableNumber = circle.dataset.table;
        document.querySelector('#book-table-form input[name="table-number"]').value = tableNumber;
        document.querySelectorAll('.table-circle').forEach(c => c.classList.remove('active'));
        circle.classList.add('active');
        submitButton.disabled = false;
    });
});

/**
 * @brief Adds a click event listener to the submit button on the book.html form.
 *        When the submit button is clicked, it prevents the default form submission,
 *        checks if a table has been selected, and if so, enables the submit button and
 *        submits the form.
 */
submitButton.addEventListener('click', (event) => {
    event.preventDefault();
    if (tableNumber != -1) {
        submitButton.disabled = false;
        form.submit();
    }
});

/**
 * @brief Adds event listeners to the date and time input fields on the book.html form.
 *        When the user types into either of these fields, it updates the URL with the
 *        new date and time parameters using the `updateBookingUrl()` function.
 */
const dateInput = document.querySelector('#book-table-form input[name="date"]');
const timeInput = document.querySelector('#book-table-form input[name="time"]');
dateInput.addEventListener('input', debounce(updateBookingUrl, 1000));
timeInput.addEventListener('input', debounce(updateBookingUrl, 1000));

/**
 * @brief Updates the URL with the new date and time parameters.
 *        It retrieves the values from the date and time input fields,
 *        creates a new URL object, sets the 'datetime' parameter, and
 *        updates the window's location with the new URL.
 */
function updateBookingUrl() {
    const dateValue = dateInput.value;
    const timeValue = timeInput.value;
    const datetime = `${dateValue} ${timeValue}`;
    const url = new URL(window.location.href);
    url.searchParams.set('datetime', datetime);
    window.location.href = url.toString();
}

/**
 * @brief A debounce function that delays the execution of the provided function
 *        for a specified delay time. This is used to prevent excessive updates
 *        to the URL when the user is typing in the date and time input fields.
 * @param func The function to be executed after the delay.
 * @param delay The delay time in milliseconds.
 * @return A new function that will execute the provided function after the delay.
 */
function debounce(func, delay) {
    return function() {
        const context = this;
        const args = arguments;
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
            func.apply(context, args);
        }, delay);
    };
}