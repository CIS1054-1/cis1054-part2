# Project Overview

## Development Methodology

The project adopted a modular development approach. This proved beneficial in meeting deadlines as it allowed parallel work on separate modules. This avoided delays caused by waiting for other parts to be completed. Compared to methodologies like Agile or Waterfall, the modular approach was better suited for this project's needs.

![Modular Development Chain by DashDev][modular-development-chain]

[modular-development-chain]: https://github.com/PHPMailer/PHPMailer

## Technology Stack

The project is built upon the Twig templating engine, leveraging its features across all platform pages. Key benefits of Twig include:

- **Layout Creation**: Ensures consistent design and structure across pages.
- **Blocks and Loops**: Facilitates dynamic content rendering.
- **Separation of Concerns**: Improves code organization and maintainability by separating PHP and HTML.

This modular approach, combined with Twig's functionalities, contributed to a more manageable and efficient development process. Separable yet interconnected parts allowed for parallel development and easier long-term code maintenance.

The project structure is divided into four main areas:

- **PHP Scripts**: Handle core functionalities.
- **JS Scripts**: Manage client-side interactivity.
- **PHP Pages**: Provide data to templates using Twig.
- **HTML Templates**: Define the presentation layer using Twig.

Each main page (e.g., index, details, favourites) is associated with a corresponding PHP page that fetches data and presents it to the Twig template. This template then extends a generic layout template. Secondary templates (e.g., FoodSlider, NavBar) provide specific functionalities and don't extend the layout template. Some secondary templates might also prepare PHP functions or variables for the main PHP page to populate specific blocks within the layout.

## Security Measures

All PHP scripts that interact with user input (GET, POST methods) implement data sanitization to prevent SQL injections. Additionally, they verify the request type (POST or GET) to ensure it matches the expected type.

Forms incorporate both client-side and server-side validation. This ensures a robust validation process, displaying specific error messages for individual fields or more general errors like connection issues or database insertion errors.

A `.htaccess` file is included to:

- Disable the display of PHP errors and warnings on the server.
- Implement a URL rewriting engine to remove `.php` or `.html` extensions from URLs for a cleaner appearance.
- Redirect non-existent pages to a custom 404 error page featuring a JavaScript game for user entertainment.

The project utilizes PHPMailer for email functionality. A `config.ini` file securely stores sensitive data related to the database and SMTP server.

## Accessibility Testing

The project has been tested for accessibility using the Mozilla Firefox Accessibility Inspector.

ARIA tags are implemented to enhance accessibility for screen readers, and `alt` attributes are used for images to provide textual descriptions. Additionally, `role` attributes are used where necessary to improve the semantic meaning of elements.

## Browser Compatibility

The project has been thoroughly tested on the two most popular browsers in Malta (Chrome, Edge) and Mozilla Firefox, following browser market share statistics (https://gs.statcounter.com/). As Safari is not commonly used in Malta due to the low prevalence of Macs, testing was not conducted on this browser.

## Responsive Design

The project employs a responsive design approach, utilizing generic classes like `flex-row` and `flex-col` for layout purposes. This ensures the website adapts seamlessly to different screen sizes and devices, providing an optimal user experience across various platforms.

## Caching Optimization

The system uses caching techniques designed for each individual piece of content on the site; each image, script, or digital content has different caching times. Furthermore, as there are no personal images of each piece of content, caching is allowed at the CDN or proxy level.

## Caching Optimization and WebP Conversion

All the images, except for the logo, have been converted to the WebP format to enable faster loading and accommodate the commercial use of the platform. However, this choice has generated a problem with a black halo around the WebP images when they are sent in the favorites list via email, as not all email providers can correctly display the WebP format.

Overall, the user experience has been improved thanks to caching optimization and the conversion to WebP. These changes ensure faster page loading and reduced bandwidth consumption, results that are essential for a hypothetical production version of the platform.

## User Guide

Upon first visit, our website will display a cookie banner asking for your consent to use cookies. Accepting cookies is not mandatory for using the site.

From the homepage, you can browse through our various food categories. Each category will lead you to a list of dishes within that category. Clicking on a specific dish will take you to its details page, where you can view information such as allergens and whether the dish is organic.

You can add dishes to your favourites list. However, this feature requires logging in or signing up. Logging in will also allow you to hover over your profile picture to access a dropdown menu with options for the reserved area: Favourites, Book, and Help. These options let you view your favourites list, book a table, or send a complaint.
# Contributors

 - G103L3: Gioele Giunta
 - carlosaalvrz: Carlos Alvarez Martinez