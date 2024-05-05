-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 05, 2024 alle 23:29
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cis1054-part2`
--
CREATE DATABASE IF NOT EXISTS `cis1054-part2` DEFAULT CHARACTER SET latin2 COLLATE latin2_bin;
USE `cis1054-part2`;

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_bin;

--
-- Dump dei dati per la tabella `categories`
--

INSERT INTO `categories` (`ID`, `name`, `image`) VALUES
(1, 'Chicken', 'chicken.png'),
(2, 'Pizza', 'pizza.png'),
(3, 'Burgers', 'burgers.png'),
(4, 'Pasta', 'pasta.png'),
(5, 'Drinks', 'drinks.png'),
(6, 'Desserts', 'desserts.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `foods`
--

CREATE TABLE `foods` (
  `ID` int(11) NOT NULL,
  `categories_ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `ingredients` text NOT NULL,
  `image` text NOT NULL,
  `price` double NOT NULL,
  `allergies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`allergies`)),
  `time_of_preparation` int(11) NOT NULL,
  `bio` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_bin;

--
-- Dump dei dati per la tabella `foods`
--

INSERT INTO `foods` (`ID`, `categories_ID`, `name`, `ingredients`, `image`, `price`, `allergies`, `time_of_preparation`, `bio`) VALUES
(1, 1, 'Grilled Chicken Caesar Salad', 'This classic salad is packed with flavor and protein. The grilled chicken is tender and juicy, and the Caesar dressing is creamy and flavorful.', 'grilled_chicken_caesar_salad.png', 12.5, '[]', 30, 0),
(2, 1, 'Chicken Tikka Masala', 'A rich and flavorful Indian dish made with tender chicken tikka marinated in a creamy tomato sauce.', 'chicken_tikka_masala.png', 14.95, '[\"Dairy\"]', 45, 1),
(3, 1, 'Chicken Parmesan', 'A classic Italian dish made with breaded and fried chicken cutlets topped with marinara sauce and mozzarella cheese.', 'chicken_parmesan.png', 16.95, '[\"Dairy\", \"Wheat\"]', 45, 0),
(4, 1, 'Chicken Pot Pie', 'A hearty and comforting dish made with chicken, vegetables, and a savory gravy, all encased in a flaky pie crust.', 'chicken_pot_pie.png', 11.5, '[\"Dairy\", \"Wheat\"]', 50, 0),
(5, 1, 'Chicken Fried Rice', 'A quick and easy stir-fry dish made with chicken, rice, eggs, and vegetables, seasoned with soy sauce.', 'chicken_fried_rice.png', 9.95, '[\"Eggs\", \"Soy\"]', 30, 0),
(6, 1, 'Chicken Noodle Soup', 'A classic comfort food made with chicken, noodles, vegetables, and a flavorful broth.', 'chicken_noodle_soup.png', 8.5, '[]', 30, 0),
(7, 1, 'Chicken Wings', 'A game-day favorite made with crispy chicken wings coated in a spicy buffalo sauce and served with a cool ranch dressing.', 'chicken_wings.png', 10, '[]', 20, 0),
(8, 1, 'Chicken Stir-Fry', 'A healthy and flavorful dish made with chicken, vegetables, and a savory stir-fry sauce.', 'chicken_stir_fry.png', 12.5, '[]', 30, 0),
(9, 1, 'Chicken Burrito', 'A tasty and satisfying burrito filled with chicken, rice, beans, cheese, and salsa.', 'chicken_burrito.png', 8.95, '[\"Dairy\", \"Wheat\"]', 30, 0),
(10, 1, 'Chicken Fajitas', 'A sizzling platter of chicken fajitas served with warm tortillas, guacamole, sour cream, and your favorite toppings.', 'chicken_fajitas.png', 14.95, '[]', 35, 0),
(11, 2, 'Margherita Pizza', 'A classic Neapolitan pizza made with simple and fresh ingredients: tomato sauce, mozzarella cheese, and basil.', 'margherita_pizza.png', 11.95, '[\"Dairy\"]', 20, 0),
(12, 2, 'Pepperoni Pizza', 'A crowd-pleasing pizza topped with savory pepperoni.', 'pepperoni_pizza.png', 12.95, '[\"Dairy\", \"Meat\"]', 20, 0),
(13, 2, 'Hawaiian Pizza', 'A sweet and savory pizza with ham, pineapple, and a touch of sweetness from the pineapple.', 'hawaiian_pizza.png', 13.95, '[\"Dairy\", \"Meat\"]', 20, 0),
(14, 2, 'Veggie Pizza', 'A healthy and flavorful pizza loaded with colorful vegetables.', 'veggie_pizza.png', 12.95, '[\"Dairy\"]', 20, 1),
(15, 2, 'BBQ Chicken Pizza', 'A smoky and savory pizza with BBQ sauce, grilled chicken, and red onion.', 'bbq_chicken_pizza.png', 14.95, '[\"Dairy\", \"Meat\"]', 20, 0),
(16, 2, 'Mexican Pizza', 'A fiesta of flavors on a pizza with refried beans, ground beef, salsa, guacamole, and sour cream.', 'mexican_pizza.png', 13.95, '[\"Dairy\", \"Meat\"]', 20, 0),
(17, 2, 'White Pizza', 'A creamy and flavorful pizza made with olive oil, mozzarella cheese, garlic, and herbs.', 'white_pizza.png', 12.95, '[\"Dairy\"]', 20, 0),
(18, 2, 'Spinach and Artichoke Pizza', 'A rich and decadent pizza with alfredo sauce, spinach, artichoke hearts, and mozzarella cheese.', 'spinach_and_artichoke_pizza.png', 14.95, '[\"Dairy\"]', 20, 0),
(19, 2, 'Four Cheese Pizza', 'A cheese lover\'s dream pizza with four different types of cheese: mozzarella, gorgonzola, feta, and parmesan.', 'four_cheese_pizza.png', 15.95, '[\"Dairy\"]', 20, 0),
(20, 2, 'Supreme Pizza', 'The ultimate pizza with all the toppings!', 'supreme_pizza.png', 16.95, '[\"Dairy\", \"Meat\"]', 25, 0),
(21, 3, 'Classic Cheeseburger', 'A timeless classic made with a juicy beef patty, American cheese, lettuce, tomato, onion, and pickle.', 'classic_cheeseburger.png', 10.95, '[\"Dairy\"]', 25, 0),
(22, 3, 'Bacon Cheeseburger', 'A bacon lover\'s dream burger with crispy bacon, American cheese, lettuce, tomato, onion, and pickle.', 'bacon_cheeseburger.png', 12.95, '[\"Dairy\", \"Meat\"]', 25, 0),
(23, 3, 'Mushroom Swiss Burger', 'A savory and flavorful burger with Swiss cheese, sautéed mushrooms, lettuce, tomato, onion, and pickle.', 'mushroom_swiss_burger.png', 13.95, '[\"Dairy\"]', 25, 0),
(24, 3, 'BBQ Burger', 'A smoky and sweet burger with BBQ sauce, bacon, and onion rings.', 'bbq_burger.png', 12.95, '[\"Dairy\", \"Meat\"]', 25, 0),
(25, 3, 'Avocado Burger', 'A healthy and flavorful burger with creamy avocado, lettuce, tomato, onion, and pickle.', 'avocado_burger.png', 13.95, '[\"Dairy\"]', 25, 1),
(26, 3, 'Black Bean Burger', 'A delicious and satisfying vegetarian burger made with a black bean patty, guacamole, salsa, lettuce, tomato, and onion.', 'black_bean_burger.png', 11.95, '[\"Vegetarian\"]', 25, 1),
(27, 3, 'Turkey Burger', 'A lighter and healthier burger made with ground turkey, feta cheese, spinach, tomato, onion, and tzatziki sauce.', 'turkey_burger.png', 12.95, '[\"Dairy\"]', 25, 0),
(28, 3, 'Lamb Burger', 'A flavorful and exotic burger made with ground lamb, hummus, cucumber, tomato, onion, and feta cheese.', 'lamb_burger.png', 14.95, '[\"Dairy\"]', 25, 0),
(29, 3, 'Luau Burger', 'A taste of the tropics on a burger with pineapple, teriyaki sauce, lettuce, tomato, and onion.', 'luau_burger.png', 13.95, '[]', 25, 0),
(30, 3, 'Veggie Burger', 'A hearty and flavorful vegetarian burger made with a quinoa patty, roasted vegetables, lettuce, tomato, onion, and avocado.', 'veggie_burger.png', 12.95, '[\"Vegan\"]', 25, 1),
(31, 4, 'Spaghetti with Meat Sauce', 'A classic Italian dish made with spaghetti and a rich and flavorful meat sauce.', 'spaghetti_with_meat_sauce.png', 11.95, '[\"Dairy\", \"Meat\"]', 30, 0),
(32, 4, 'Lasagna', 'A layered pasta dish filled with ricotta cheese, meat sauce, and mozzarella cheese.', 'lasagna.png', 14.95, '[\"Dairy\", \"Meat\"]', 45, 0),
(33, 4, 'Fettuccine Alfredo', 'A creamy and decadent pasta dish made with fettuccine, butter, Parmesan cheese, and cream.', 'fettuccine_alfredo.png', 12.95, '[\"Dairy\"]', 30, 0),
(34, 4, 'Penne Arrabbiata', 'A spicy and flavorful pasta dish made with penne pasta, tomato sauce, garlic, and red pepper flakes.', 'penne_arrabbiata.png', 10.95, '[]', 30, 0),
(35, 4, 'Macaroni and Cheese', 'A classic comfort food made with macaroni noodles, cheddar cheese, milk, and butter.', 'macaroni_and_cheese.png', 9.95, '[\"Dairy\"]', 30, 0),
(36, 4, 'Ravioli', 'Pasta pockets filled with ricotta cheese and spinach, served with a simple tomato sauce.', 'ravioli.png', 13.95, '[\"Dairy\"]', 35, 0),
(37, 4, 'Gnocchi', 'Soft and pillowy potato dumplings served with a fresh tomato sauce and basil.', 'gnocchi.png', 12.95, '[\"Dairy\"]', 30, 0),
(38, 4, 'Linguine with Clams', 'A light and flavorful pasta dish made with linguine pasta, clams, white wine, garlic, and parsley.', 'linguine_with_clams.png', 15.95, '[\"Seafood\"]', 35, 0),
(39, 4, 'Pesto Pasta', 'A fresh and flavorful pasta dish made with pesto sauce, pine nuts, and Parmesan cheese.', 'pesto_pasta.png', 12.95, '[\"Dairy\", \"Nuts\"]', 30, 0),
(40, 4, 'Carbonara', 'A rich and creamy pasta dish made with eggs, pancetta, Parmesan cheese, and black pepper.', 'carbonara.png', 14.95, '[\"Dairy\", \"Meat\"]', 30, 0),
(41, 5, 'Coca-Cola', 'A classic American soft drink with a refreshing and bubbly taste.', 'coca_cola.png', 2.5, '[]', 5, 0),
(42, 5, 'Pepsi', 'A popular cola alternative with a slightly sweeter taste than Coca-Cola.', 'pepsi.png', 2.5, '[]', 5, 0),
(43, 5, 'Sprite', 'A clear lemon-lime soda with a refreshing and thirst-quenching taste.', 'sprite.png', 2.5, '[]', 5, 0),
(44, 5, 'Dr Pepper', 'A unique and flavorful soda with a blend of 23 flavors.', 'dr_pepper.png', 2.5, '[]', 5, 0),
(45, 5, 'Mountain Dew', 'A citrus-flavored soda with a high caffeine content.', 'mountain_dew.png', 2.5, '[]', 5, 0),
(46, 5, 'Fanta Orange', 'An orange-flavored soda with a sweet and tangy taste.', 'fanta_orange.png', 2.5, '[]', 5, 0),
(47, 5, '7 Up', 'A lemon-lime soda with a slightly sweeter taste than Sprite.', 'seven_up.png', 2.5, '[]', 5, 0),
(48, 5, 'Gatorade', 'A sports drink designed to replenish fluids and electrolytes lost during exercise.', 'gatorade.png', 3.5, '[]', 5, 0),
(49, 5, 'Powerade', 'Another popular sports drink similar to Gatorade.', 'powerade.png', 3.5, '[]', 5, 0),
(50, 5, 'Orange Juice', 'A refreshing and healthy beverage made from freshly squeezed oranges.', 'orange_juice.png', 3, '[]', 10, 1),
(51, 6, 'Chocolate Chip Cookie', 'A classic and delicious cookie made with chewy chocolate chips.', 'chocolate_chip_cookie.png', 2.5, '[\"Dairy\", \"Wheat\"]', 20, 0),
(52, 6, 'Vanilla Ice Cream', 'A smooth and creamy ice cream with a pure vanilla flavor.', 'vanilla_ice_cream.png', 3.5, '[\"Dairy\"]', 15, 0),
(53, 6, 'Apple Pie', 'A warm and comforting dessert made with a flaky pie crust and a sweet and tart apple filling.', 'apple_pie.png', 4.5, '[\"Dairy\", \"Wheat\"]', 45, 0),
(54, 6, 'Chocolate Cake', 'A rich and decadent cake with a deep chocolate flavor.', 'chocolate_cake.png', 5, '[\"Dairy\", \"Wheat\"]', 35, 0),
(55, 6, 'Strawberry Shortcake', 'A light and refreshing dessert made with sweet and juicy strawberries, whipped cream, and flaky shortcake biscuits.', 'strawberry_shortcake.png', 4, '[\"Dairy\"]', 20, 0),
(56, 6, 'Brownies', 'A fudgy and chewy dessert with a rich chocolate flavor.', 'brownies.png', 3.5, '[\"Dairy\", \"Wheat\"]', 30, 0),
(57, 6, 'Cheesecake', 'A creamy and decadent dessert with a smooth and tangy cheesecake filling.', 'cheesecake.png', 5, '[\"Dairy\"]', 45, 0),
(58, 6, 'Chocolate Chip Cookie Dough', 'A sweet and satisfying treat made with raw cookie dough and chocolate chips.', 'chocolate_chip_cookie_dough.png', 3, '[\"Dairy\", \"Wheat\"]', 20, 0),
(59, 6, 'Smoothie', 'A healthy and refreshing drink made with blended fruits, yogurt, milk, and honey.', 'smoothie.png', 4.5, '[\"Dairy\"]', 30, 1),
(60, 6, 'Milkshake', 'A thick and creamy drink made with ice cream, milk, and chocolate syrup.', 'milkshake.png', 5, '[\"Dairy\"]', 25, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `reservations`
--

CREATE TABLE `reservations` (
  `ID` int(11) NOT NULL,
  `users_ID` int(11) NOT NULL,
  `table_number` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `book_duration` double NOT NULL DEFAULT 1.5
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `role` set('user','moderator','admin','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_bin;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`ID`, `name`, `surname`, `email`, `password`, `role`) VALUES
(15, 'Gioele', 'Giunta', 'giunta.gioele0@gmail.com', '28be81190549b2febd04bca0dbbec4afebed4bdba543351ee3f99ac9b006f159e67a61bf7b9b418f7815582e825bdfc5', 'user');

-- --------------------------------------------------------

--
-- Struttura della tabella `wishlists`
--

CREATE TABLE `wishlists` (
  `ID` int(11) NOT NULL,
  `users_ID` int(11) NOT NULL,
  `foods_ID` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_bin;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indici per le tabelle `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `foods`
--
ALTER TABLE `foods`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
