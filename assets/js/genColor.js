/** 
 *  * This function return a color from a seed that is a string
    *
    * @author Gioele Giunta
    * @version 1.3
    * @since 2021-02-10
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

function genColor(seed) {
    console.log("Sum: " + seed);
    let r = ((seed * 19) % 256);
    let g = ((seed * 31) % 256);
    let b = ((seed * 47) % 256);
    console.log("r " + r);
    console.log("g " + g);
    console.log("b " + b);

    let color = ((r << 16) | (g << 8) | b).toString(16);
    while (color.length < 6) {
        console.log("color1: " + color);
      color = '0' + color;
    }
    console.log("color: " + color);
    return "#" + color;
  }
  
  
  
  /* 
        This is a recursive function to analyze and sum every character of a word
        @param character string
        @param i recursive index
        @param sum the current sum starts from 0
  */
  function ascii_code (i, character, sum) {
    console.log("Index  " + i)
    if(character.length > i){
        let code = character.charCodeAt(i);
        i++;
        console.log("Index2  " + i)

        // If the code is 0-127 (which are the ASCII codes,
        if (code < 128) {
            // Sum + code so the color change
            ascii_code(i, character, sum+code);
        // If the code is 128 or greater (which are expanded Unicode characters),
        }else{
            // Sum -1 so the color change
            ascii_code(i++, character, sum-1);
        };
    }else{
        return sum;
    }
};