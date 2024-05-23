/**
 * @file generateAvatar.js
 * @brief Provides functionality for a dropdown menu associated with an avatar image.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2024-05-07
 * @info The author, Gioele, is going to use the Camel Case for the JavaScript files.
 */

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

/**
 * @brief Hides the dropdown menu when the cursor moves out of the dropdown box.
 */
var dropdownMenu = document.getElementById("dropdown-menu");
dropdownMenu.addEventListener("mouseleave", function() {
    hideDropdown();
});

function toggleNavBar() {
    var navbarContainer = document.getElementById("navbar-container-general");
    var navbarToggler = document.querySelector(".navbar-toggler-icon");

    if (navbarContainer.style.display === "flex") {
        navbarContainer.style.display = "none";
        navbarToggler.classList.remove('opened');
    } else {
        navbarContainer.style.display = "flex";
        //Add Class To Have an X instead of the open menu symbol
        navbarToggler.classList.add('opened');
    }
  }