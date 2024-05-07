/** 
    * generateAvatar 
    *
    * @author Gioele Giunta
    * @version 1.0
    * @since 2024-05-07
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

/**
 * @brief Displays the dropdown menu when hovering over the image.
 */
function showDropdown() {
    var dropdownMenu = document.getElementById("dropdown-menu");
    dropdownMenu.style.display = "block";
}

/**
 * @brief Hides the dropdown menu when moving the mouse away from the image.
 */
function hideDropdown() {
    var dropdownMenu = document.getElementById("dropdown-menu");
    dropdownMenu.style.display = "none";
}

/**
 * @brief Toggles the visibility of the dropdown menu when the image is clicked.
 */
function toggleDropdown() {
    var dropdownMenu = document.getElementById("dropdown-menu");
    if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
        dropdownMenu.style.display = "block";
    } else {
        dropdownMenu.style.display = "none";
    }
}

/**
 * @brief Closes the dropdown menu if clicked elsewhere on the page.
 */
document.addEventListener("click", function(event) {
    var dropdownMenu = document.getElementById("dropdown-menu");
    var profileImage = document.getElementById("profile_image");
    var target = event.target;
    if (!dropdownMenu.contains(target) && target !== profileImage) {
        dropdownMenu.style.display = "none";
    }
});
