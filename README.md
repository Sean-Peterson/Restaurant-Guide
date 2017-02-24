# _Restaurant Guide_

#### _This website allows the user to discover the best restaurants in Portland and add their favorites to the list._

#### By _**Zach Swanson and Sean Peterson**_


## Description

_Restaurant Guide allows the user to search the best restaurants in Portland listed out by cuisine. The user can also add cuisine types and add restaurants into any cuisine. The restaurants have name, price, description, and cuisine type variables_

## Setup/Installation Requirements

* In terminal run the following commands:

1. _Fork and clone this repository onto your desktop from_ [gitHub](https://github.com/Sean-Peterson/restaurant-guide).
2. Open chrome and enter localhost:8888/phpmyadmin
3. Click on Import, Choose File, desktop/restaurant-guide/data/restaurant_guide.sql.zip
4. Ensure [composer](https://getcomposer.org/) is installed on your computer.
5. Navigate to the root directory of the project in which ever CLI shell you are using and run the command: `composer install`.
6. To run tests enter `composer test` in terminal.
7. Create a local server in the /web directory within the project folder using the command: `php -S localhost:8000` (assuming you are using macOS - commands are different on other operating systems).
8. Open the directory http://localhost:8000/ in any standard web browser.

## Specifications

1. Home page lists all cuisine types, user selects a cuisine and app navigates to that cuisine's page

2. On homepage user inputs new cuisine type and clicks Add. App adds new cuisine to list of cuisines.

3. On a cuisine page, user inputs the details of a restaurant and app adds it to the list for that cuisine

4. On a cuisine page, user clicks edit and app displays edit cuisine page

5. On edit cuisine page, user inputs new name. App changes cuisine name to new name

6. On edit cuisine page, user clicks delete this cuisine and app deletes the cuisine

8. On edit cuisine page, user clicks back link and app navigates back to cuisine page

9. On a cuisine page, user clicks a restaurant and app navigates to the restaurant's page

10. On a restaurant page, user clicks edit and app takes them to edit restaurant page

11. On edit restaurant page, user inputs new name, price and description. App changes restaurant name to new name

12. On edit restaurant page, user clicks delete this restaurant and app deletes the restaurant

13. On edit restaurant page, user clicks back link and app navigates back to restaurant page

14. On restaurant page, user clicks home and app navigates them back to home page

## Known Bugs

_None so far._

## Support and contact details

_Please contact zjswanson@gmail.com or seanpeterson11@gmail.com with concerns or comments._

## Technologies Used

* _HTML_
* _CSS_
* _PHP_
* _PHPUnit_
* _Composer_
* _Silex_
* _Twig_
* _MySQL_

### License

*MIT license*

Copyright (c) 2017 **_Zach Swanson Sean Peterson_**
