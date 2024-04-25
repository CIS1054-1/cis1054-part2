/** 
 *  * This function return a color from a seed that is a string
    *
    * @author Gioele Giunta
    * @version 1.3
    * @since 2024-04-25
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

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