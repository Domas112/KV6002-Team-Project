# Feedback Subsystem

## Description
The system is divided into Feedback Form(Customer side) and Customer Feedback(Staff side).
Customers are able to submit the feedback of their recent experience. They can choose to submit the feedback anonymous and and required fields are mentioned with a red star symbol above them. They can also upload the image of the food ordered when they vissited the restaurant. User has submit rating, review and Net Promoter Score. Profanity filter is applied to the review field to prevent the users from being verbally abusive in case if the reviews gets public in the future, also the suggestions box doesn't have filter as it will be a private feedback. Still if the staff finds out the data provided abusive or offensive or the customer requests to delte thier feedback from database, delete button is provided to delete the entries.

Staff side of the Customer Feedback is the data gathered from customer through the feedback and represented in the form of the table for easy to understand and have quick look in the busy environment of the restaurant. Staff can delete the query if they find anything disturbing or abusive in the table. 

## Languages
The Feedback form and Customer Feedback pages is made of HTML/JavaScript/CSS in the frontend and PHP in the backend.

Frontend utilizes custom HTML elements, registered through JS to separate their specific logic from the other components and CSS file to apple specific styles and Bootstrap for the uniformity in the design. The components are also easily reusable, which is important in development of such website.

For the backend, there are 3 extra PHP pages for deleting feedback in the table and adding feedback into the table through feedaback form.
