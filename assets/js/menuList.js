/**
 * @file menuList.js
 * @brief Applies dynamic coloring to the menu item images based on the item name.
 * @author Gioele Giunta
 * @version 1.2
 * @date 2024-05-07
 * @info The author, Gioele, is going to use the Camel Case for the JavaScript files.
 */

document.addEventListener("DOMContentLoaded", function() {
    /*
        The code above colorize every item-image of the code using genColor
    */
    var menuImages = document.querySelectorAll('.item-image');
    menuImages.forEach(function(menuImage) {   
        var categoryName = menuImage.parentElement.querySelector('.item-info h3.item-name').innerText;
        menuImage.style.backgroundColor = genColor(categoryName);
    });
});