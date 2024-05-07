/** 
    * menuList
    *
    * @author Gioele Giunta
    * @version 1.2
    * @since 2024-05-07
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

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