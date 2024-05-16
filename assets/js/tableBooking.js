let tableNumber = false;
const submitButton = document.getElementById('submit');

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
