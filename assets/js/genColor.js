/** 
 *  * This function return a color from a sum that is a string
    *
    * @author Gioele Giunta
    * @version 1.3
    * @since 2024-04-23
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

function genColor(character) {
    let sum = 0;
    for (let j = 0; j < character.length; j++) {
        let code = character.charCodeAt(j);

        if (code < 128) {
            sum += code;
        } else {
            sum -= 1;
        }
    }

    let r = ((sum * 14) % 256);
    let g = ((sum * 27) % 256);
    let b = ((sum * 47) % 256);


    let color = ((r << 16) | (g << 8) | b).toString(16);
    while (color.length < 6) {
        color = '0' + color;
    }

    color = "#" + color;
    return color;
}