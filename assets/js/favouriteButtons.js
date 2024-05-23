/**
 * @file favouriteButtons.js
 * @brief Manages the functionality of the favorite buttons on the website.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2024-05-07
 * @info The author, Gioele, is going to use the Camel Case for the JavaScript files.
 */

var action;

/**
 * @brief Handles the click event of the favorite buttons.
 * 
 * @param button_id The ID of the button that was clicked.
 * @param foods_id The ID of the food item associated with the button.
 * @param element_id The ID of the element to be removed from the favorites list (if applicable).
 */
function favouriteClick(button_id, foods_id, element_id) {
    var favouriteBtn = document.getElementById(button_id)
    if (favouriteBtn.classList.contains("favourite-pushed")) {
        action = "remove_wishlist.php";
    } else {
        action = "add_wishlist.php";
    }

    // Perform an AJAX call to the PHP script to save/remove the food from the wishlist
    const recipeUrl = 'server/scripts/' + action;
    const postBody = {
      foods_id: foods_id,
    };
    const requestMetadata = {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(postBody)
    };
    fetch(recipeUrl, requestMetadata)
        .then((response) => {
            return response.json(); 
        })
        .then((responseData) => {
            console.log("Response:", responseData);
            if (responseData.status === "true") {
                // Toggle the button class to reflect the new state
                if (favouriteBtn.classList.contains("favourite-pushed")) {
                    favouriteBtn.classList.remove("favourite-pushed");
                    favouriteBtn.classList.add("favourite-button");
                    //Refresh favourites.php if the remaining item are 0, in order to display the 0 favourites items page
                    if(responseData.remaining == 0){
                        window.location.reload();
                    }
                } else {
                    favouriteBtn.classList.remove("favourite-button");
                    favouriteBtn.classList.add("favourite-pushed");
                }

                // If the caller is on the favorites.html page, delete the element from the list
                if(element_id != null){
                    var elementRmv = document.getElementById(element_id);

                    if (elementRmv) {
                        var parentElement = elementRmv.parentNode;
                        parentElement.removeChild(elementRmv);
                    }
                }
            } else {
              generalErrorMessage.textContent = responseData.message;
            }
        })
        .catch((err) => {
            console.info('Error:', err.message);
        });
}