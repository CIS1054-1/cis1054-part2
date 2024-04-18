/** 
 *  * This function return a color from a seed that is a string
    *
    * @author Gioele Giunta
    * @version 1.3
    * @since 2021-02-10
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

function genColor (seed) {
    color = Math.floor((Math.abs(Math.sin(seed) * 16777215)));
    color = color.toString(16);
    // pad any colors shorter than 6 characters with leading 0s
    while(color.length < 6) {
      color = '0' + color;
    }
    console.log("color: " + color);
    return color;
  }
  
  function ascii_code (character) {
  
    // Get the decimal code
    let code = character.charCodeAt(0);
  
    // If the code is 0-127 (which are the ASCII codes,
    if (code < 128) {
  
      // Return the code obtained.
      return code;
  
    // If the code is 128 or greater (which are expanded Unicode characters),
    }else{
  
      // Return -1 so the user knows this isn't an ASCII character.
      return -1;
    };
  };