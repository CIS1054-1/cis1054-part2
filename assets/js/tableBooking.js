document.querySelectorAll('.table-circle.available').forEach(circle => {
    circle.addEventListener('click', () => {
        const tableNumber = circle.dataset.table;
        document.querySelector('#book-table-form input[name="table-number"]').value = tableNumber;
        document.querySelector('#book-table-form').submit();
    });

// Get the date and time input elements
const dateInput = document.querySelector('#book-table-form input[name="date"]');
const timeInput = document.querySelector('#book-table-form input[name="time"]');

// Add an event listener to the date and time inputs
dateInput.addEventListener('input', debounce(updateBookingUrl, 2000));
timeInput.addEventListener('input', debounce(updateBookingUrl, 2000));

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

}
});