/**
 * @file colorGenerator.js
 * @brief Generates a color based on a seed string.
 * @author Gioele Giunta
 * @version 1.3
 * @date 2024-04-25
 * @info The author, Gioele, is going to use the Camel Case for the JavaScript files.
 */

// Select all elements with the .open-title class
const openListTitles = document.querySelectorAll('.open-title');

openListTitles.forEach((title) => {
  // Select the corresponding allergens content
  const openListContent = title.nextElementSibling;

  // Add a click event listener to the title to open/close the list
  title.addEventListener('click', () => {

    // Show/hide the allergens content
    if (openListContent.style.display === 'none') {
        openListContent.style.display = 'block';
    } else {
        openListContent.style.display = 'none';
    }

    // Rotate the arrow
    title.querySelector('.arrow').classList.toggle('open');
  });
});