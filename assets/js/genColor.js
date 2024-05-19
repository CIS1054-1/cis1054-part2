/**
 * @file genColor.js
 * @brief Generates a color based on the input string.
 * @author Gioele Giunta
 * @version 1.3
 * @date 2024-04-23
 * @info The author, Gioele, is going to use the Camel Case for the JavaScript files.
 */

/**
 * @brief Generates a color based on the input string.
 * @param character The input string.
 * @return The generated color in hexadecimal format.
 */
function genColor(character) {
    let sum = 0;
    // Summarize all the ASCII charcode together to obtain the sum of the ASCIIs
    for (let j = 0; j < character.length; j++) {
        let code = character.charCodeAt(j);

        if (code < 128) {
            sum += code;
        } else {
            sum -= 1;
        }
    }

    // Use module to transform sum in the range 0-255 for red, green, blue
    let r = ((sum * 14) % 256);
    let g = ((sum * 27) % 256);
    let b = ((sum * 47) % 256);

    // Pack the red, green, and blue color components into a single 32 bit hexadecimal color value
    let color = ((r << 16) | (g << 8) | b).toString(16);
    // Check if the length is at least 6, otherwise fill with 0 (darker)
    while (color.length < 6) {
        color = '0' + color;
    }

    color = "#" + color;
    return color;
}