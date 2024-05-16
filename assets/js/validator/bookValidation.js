/** 
 *  * tableBooking this file manage the scripts to click, update calendar and validate the book.html
    *
    * @author Gioele Giunta
    * @version 1.0
    * @since 2024-05-14
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

let tableNumber = -1;
const submitButton = document.getElementById('submit_book');
const form = document.querySelector('#book-table-form');


document.querySelectorAll('.table-circle.available').forEach(circle => {
    circle.addEventListener('click', () => {

        tableNumber = circle.dataset.table;
        document.querySelector('#book-table-form input[name="table-number"]').value = tableNumber;
        //Remove the active class from all the tables
        document.querySelectorAll('.table-circle').forEach(c => c.classList.remove('active'));

        //Add the class to the selected one
        circle.classList.add('active');

        submitButton.disabled = false;
    });
});


submitButton.addEventListener('click', (event) => {
  // Prevent the default form submission
  event.preventDefault();

  if (tableNumber != -1) {
    // If both fields are valid, enable the submit button and submit the form
    submitButton.disabled = false;
    form.submit();
  }
});

// Get the date and time input elements
const dateInput = document.querySelector('#book-table-form input[name="date"]');
const timeInput = document.querySelector('#book-table-form input[name="time"]');

// Add an event listener to the date and time inputs
dateInput.addEventListener('input', debounce(updateBookingUrl, 1000));
timeInput.addEventListener('input', debounce(updateBookingUrl, 1000));

let timeoutId;

function updateBookingUrl() {
  const dateValue = dateInput.value;
  const timeValue = timeInput.value;
  const datetime = `${dateValue} ${timeValue}`;

  // Update the URL with the new datetime parameter
  const url = new URL(window.location.href);
  url.searchParams.set('datetime', datetime);
  window.location.href = url.toString();
}

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
