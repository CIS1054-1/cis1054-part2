/**
 * @file foodSlider.js
 * @brief Implements a food slider functionality on the website.
 * @author Gioele Giunta, Carlos Alvarez
 * @version 1.2
 * @date 2024-05-07
 * @info The author, Gioele, is going to use the Camel Case for the JavaScript files.
 */

// Executed when the DOM content is loaded
document.addEventListener("DOMContentLoaded", function() {
    /*
     * The code above colorize every slide-body of the code using genColor
     */
    var slideBodies = document.querySelectorAll('.slider-container .slide-body');

    slideBodies.forEach(function(slideBody) {
        var categoryName = slideBody.parentElement.querySelector('.slide-name h1.title').innerText;
        slideBody.style.backgroundColor = genColor(categoryName);
    });

    /*
     * The code above makes sure that slider arrows are visible and working well
     */
    var sliderContainer = document.querySelector('.slider-container');
    var slide = document.querySelector('.slide');
    var sliderPrev = document.querySelector('.slider-prev');
    var sliderNext = document.querySelector('.slider-next');
    var slideBodies = document.querySelectorAll('.slide').length;
    var visibleElements = Math.floor(sliderContainer.offsetWidth / slide.offsetWidth);
    var scrolledElements = 4;

    // Ensure that if visibleElements are less than slides, the ones on the right are invisible

    /**
     * @brief Toggles the visibility of the previous and next arrows based on the current scroll position.
     */
    function toggleArrows() {
        if (scrolledElements == slideBodies) {
            sliderNext.style.display = 'none';
            sliderPrev.style.display = 'block';
        } else if (scrolledElements == visibleElements) {
            sliderPrev.style.display = 'none';
            sliderNext.style.display = 'block';
        } else {
            sliderNext.style.display = 'block';
            sliderNext.style.display = 'block';
        }
    }

    /**
     * @brief Handles the click event of the previous arrow.
     */
    sliderPrev.addEventListener('click', function() {
        var newSlidesNumber = scrolledElements % visibleElements;
        scrolledElements -= newSlidesNumber;
        sliderContainer.scrollLeft -= scrolledElements * slide.offsetWidth;
        toggleArrows();
    });

    /**
     * @brief Handles the click event of the next arrow.
     */
    sliderNext.addEventListener('click', function() {
        var newSlidesNumber = slideBodies % scrolledElements;
        scrolledElements += newSlidesNumber;
        sliderContainer.scrollLeft += scrolledElements * slide.offsetWidth;
        toggleArrows();
    });

    toggleArrows();
});