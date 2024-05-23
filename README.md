# cis1054-part2
Part 2: Dynamic Web Application

# Project Overview

The project followed a modular development approach, which proved helpful in meeting the established deadlines. Working on separate modules in parallel allowed progress to continue without getting blocked while waiting for other parts to be completed. This modular method was more suitable than methodologies like Agile or Waterfall in this context.

Additionally, the project is based on the Twig engine, leveraging its potential across all pages of the platform. Key features of this framework include:

- **Creating a Layout**: Ensures consistent design and structure across pages.
- **Use of Blocks and Loops**: Facilitates dynamic content rendering.
- **Separation of PHP and HTML**: Enhances code organization and maintainability.

### Modular Approach

The modular approach, combined with these practices, contributed to making the development process more manageable and efficient. Having separable but interconnected parts facilitated parallel work and long-term code maintenance. By dividing the project into smaller, self-contained modules, team members could focus on specific areas without needing detailed knowledge of the entire system.

For example, one team member could work on the user authentication module, while another focused on the data visualization component. Each module had clear interfaces and responsibilities, making integration straightforward once individual parts were completed.

### Twig Engine

The Twig engine was central to the project's architecture. Twig is a templating engine for PHP, designed to be fast, secure, and flexible. It allows for the separation of logic and presentation, making the code cleaner and easier to manage.

#### Creating a Layout

A consistent layout across different pages was achieved using Twig's layout feature. 

This layout can then be extended by other templates. For example, a homepage template (index.html.twig).

### PHP Scripts and Security

The project is divided into four main areas: PHP scripts, JS scripts, PHP pages, and HTML templates. Each main page, such as index, details, favorites, etc., is associated with a PHP page that provides incoming information via Twig and an HTML page that extends a generic Layout template. Secondary templates like FoodSlider, NavBar, etc., do not extend the Layout template but provide specific blocks. Some of them also prepare PHP functions or variables for the main PHP page to provide specific data for the blocks.

Every PHP script that reads data from the session, GET, or POST methods sanitizes the input using functions to avoid SQL injections.

Additionally, each PHP script checks the request type (POST or GET) to ensure it matches the expected type, enhancing security and robustness.
Form Validation

Forms include both client-side and server-side validation, displaying specific errors for individual fields or more generic errors like connection issues or database insertion errors. 