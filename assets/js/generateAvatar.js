/** 
    * generateAvatar 
    *
    * @author Gioele Giunta
    * @version 1.0
    * @since 2024-05-05
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

/**
 *
 * This function return a a image/png created dynamically using the given parameters
 * @param text
 * @param foregroundColor
 * @param backgroundColor
 * @returns color 
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

