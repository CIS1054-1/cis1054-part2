 /** 
    * cookieSet
    *
    * @author Gioele Giunta
    * @version 1.0
    * @since 2024-05-07
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/
 
 
/**
 * Set the initial COOKIE in this way all the others cookie can be saved
 * 
 * @param {string} cname - The name of the cookie
 * @param {string} cvalue - The value of the cookie
 * @param {number} exdays - The number of days until the cookie expires
 */
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/**
 * Check if cookie is already set, if it is true proceed without displaying the banner, else display the banner
 * 
 * @param {string} cname - The name of the cookie to check
 * @returns {boolean} - Returns true if the cookie is set, otherwise false
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
 * This function manages the event click of the button
 */
document.getElementById("accept-btn").addEventListener("click", function() {
    setCookie("cookieAllow", "true", 365); // Set cookie with a days of 365 days 
    document.getElementById("cookie-banner").style.display = "none";
});