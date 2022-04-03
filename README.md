# KV6002-Team-Project

## Description
The system is divided into customer and staff view.
Customers are able to view the offered dishes, which are divided by their categories. Information about the dishes includes: title, their descriptions, images and prices for different variants of the dish. They may specify how many of what dish they would like to order. Before ordering, they may review their order, see the prices of their ordered items, as well as the final price.

Staff side displays the ordered items, categorized by the tables they were ordered from. Information about the orders includes: title, variant of the dish and amount of how many of the same dish was ordered. The active orders are updated every 10 seconds and if new orders arrive, the text of the table to which they belong, changes color to red, so the staff could notice the new orders easier. Once opened, specifically the new orders are colored red (while others remain black), as well. Staff may select which orders have been completed, as well as delete the whole "active table" with all of it's orders.

## Languages
The digital menu is made of HTML/JavaScript in the frontend and PHP in the backend.

Frontend utilizes custom HTML elements, registered through JS, to separate their specific logic from the other components. The components are also easily reusable, which is important in development of such website (multiple menu items, orders, etc...). JS components are chosen over PHP templates, so the client-side rendered pages would appear as a single, running process (as opposed to, i.e. having to refresh the page for new orders to appear). This is important for the staff side, as orders are dynamically updated without refreshing the page.
For the backend, there are 2 PHP pages for orders and dishes which, once opened, check the passed on URL parameters. The specified parameters act as API routes (i.e. http://someurl.com/get_dishes turns into http://someurl.com?get_dishes).
