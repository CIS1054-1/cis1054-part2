/** 
    * favouriteButtons
    *
    * @author Gioele Giunta
    * @version 1.0
    * @since 2024-05-07
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

var action;


/**
* This function manages the event click of the button
* @param button_id Is required to know on wich button do the add remove class operations
* @param foods_id Is required to know the foods_id to add to favourites
* @param element_id In the favourites list this is required to know witch element remove from the list
*/
function favouriteClick(button_id, foods_id, element_id) {
    var favouriteBtn = document.getElementById(button_id)
    if (favouriteBtn.classList.contains("favourite-pushed")) {
        action = "remove_wishlist.php";
    } else {
        action = "add_wishlist.php";
    }
    // Perform an AJAX call to the PHP script in order to save food in the wishlist
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
                if (favouriteBtn.classList.contains("favourite-pushed")) {
                    favouriteBtn.classList.remove("favourite-pushed");
                    favouriteBtn.classList.add("favourite-button");
                } else {
                    favouriteBtn.classList.remove("favourite-button");
                    favouriteBtn.classList.add("favourite-pushed");
                }
                //If the caller is in the favourites.html so delete the element
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
    

};