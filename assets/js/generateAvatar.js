/**
 * @file generateAvatar.js
 * @brief Generates a dynamic avatar image based on the provided parameters.
 * @author Gioele Giunta
 * @version 1.0
 * @date 2024-05-05
 * @info The author, Gioele, is going to use the Camel Case for the JavaScript files.
 */

/**
 * @brief Generates a dynamic avatar image based on the provided parameters.
 * @param text The text to be displayed on the avatar.
 * @param foregroundColor The color of the text.
 * @param backgroundColor The color of the background.
 * @returns The generated avatar image as a data URL in the "image/png" format.
 */
function generateAvatar(text, foregroundColor, backgroundColor) {
    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");

    canvas.width = 200;
    canvas.height = 200;

    // Draw background
    context.fillStyle = backgroundColor;
    context.fillRect(0, 0, canvas.width, canvas.height);

    // Draw text
    context.font = "bold 90px Helvetica";
    context.fillStyle = foregroundColor;
    context.textAlign = "center";
    context.textBaseline = "middle";
    context.fillText(text, canvas.width / 2, canvas.height / 2);

    return canvas.toDataURL("image/png");
}