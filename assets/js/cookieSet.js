/**
 * @file cookieSet.js
 * @brief Manages the setting and checking of cookies on the website.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2024-05-07
 * @info The author, Gioele, is going to use the Camel Case for the JavaScript files.
 */

/**
 * @brief Sets a cookie with the given name, value, and expiration date.
 * 
 * @param cname The name of the cookie.
 * @param cvalue The value of the cookie.
 * @param exdays The number of days until the cookie expires.
 */
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/**
 * @brief Checks if a cookie with the given name is set.
 * 
 * @param cname The name of the cookie to check.
 * @return true if the cookie is set, false otherwise.
 */
function checkCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
         if (c.indexOf(name) == 0) {
            return true;
        }
    }
    return false;
}

// If checkCookie returns true, hide the cookie banner; otherwise, show the banner
if (checkCookie("cookieAllow")) {
    document.getElementById("cookie-banner").style.display = "none";
} else {
    document.getElementById("cookie-banner").style.display = "block";
}

/**
 * @brief Manages the event click of the "Accept" button.
 */
document.getElementById("accept-btn").addEventListener("click", function() {
    setCookie("cookieAllow", "true", 365); // Set cookie with a days of 365 days 
    document.getElementById("cookie-banner").style.display = "none";
});