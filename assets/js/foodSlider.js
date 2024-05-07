/** 
    * foodSlider 
    *
    * @author Gioele Giunta, Carlos Alvarez
    * @version 1.2
    * @since 2024-05-07
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

document.addEventListener("DOMContentLoaded", function() {
    /*
        The code above colorize every slide-body of the code using genColor
    */
    var slideBodies = document.querySelectorAll('.slider-container .slide-body');

    slideBodies.forEach(function(slideBody) {
        var categoryName = slideBody.parentElement.querySelector('.slide-name h1.title').innerText;
        slideBody.style.backgroundColor = genColor(categoryName);
    });

    /*
        The code above make sure that slider arrow are visible and working well
    */
    var sliderContainer = document.querySelector('.slider-container');
    var slide = document.querySelector('.slide');
    var sliderPrev = document.querySelector('.slider-prev');
    var sliderNext = document.querySelector('.slider-next');
    var slideBodies = document.querySelectorAll('.slide').length;
    var visibleElements = Math.floor(sliderContainer.offsetWidth / slide.offsetWidth);
    var scrolledElements = 4;

    //I am sure that if visibleElements are less than slides, are the one on the right that are invisible
    
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

    sliderPrev.addEventListener('click', function() {
        var newSlidesNumber = scrolledElements % visibleElements;
        scrolledElements -= newSlidesNumber;
        sliderContainer.scrollLeft -= scrolledElements * slide.offsetWidth;
        toggleArrows();
    });
    sliderNext.addEventListener('click', function() {
        var newSlidesNumber = slideBodies % scrolledElements;
        scrolledElements += newSlidesNumber;
        sliderContainer.scrollLeft += scrolledElements * slide.offsetWidth;
        toggleArrows();
    });

    toggleArrows();
});