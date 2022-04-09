# Before we begin
Please note that there are two folders here which are Account and FoodMenuManagement. The main subsystem that I am working
on is the Food Menu Management System which all the files will be included within the FoodMenuManagement folder.

Account folder contains one of the shared elements that will be included in the overall system that I have volunteered to developed for the team.
The folder contains files to the Login page interface and API to handle authentication. Team members may access the API to check if the user 
has already logged in or retrieve user account type to limit access to certain features.

## Food Menu Management System
A subsystem for KV6002 Team Project module for Team 30 developed by Teck Xun Tan (W20003691).


## Subsystem Description
The subsystem has been divided into two separate views which are Customer and Administrator view.

## Administrator View (Food Management and Logging Features)
The Administrator side of the subsystem is considered as the significantly essential part of the subsystem as the restaurant administrator 
will be using this feature most of the time to manage the food/dish items that will be displayed on the menu. Restaurant administrator will
add, edit and remove (manage) food item from the menu and make changes directly to the database. Other than that, restaurant owner has
also requested to include a system logging (event log) feature where all the changes made towards the menu will be recorded into the log where
the business manager will be able to access and review a list of logs containing who and what has been changed if the have spotted incorrect
or vandalised data within the subsystem.

## Customer View
The Customer side of the subsystem will consist of a menu where it will show all the food/dishes currently available in the restaurant where
customer will be able to access directly from the homepage anywhere without requiring to scanning the QR to access the menu.

## Subsystem Ethical Consideration
As per requested by the stakeholder, the administrator side of the Food Menu Management System will only be accessible by
certain user with specific user type to avoid potential data vandalism. In this case, employees such as waiters and chefs 
will not have the authorisation to access the administrator side of the system, but instead restaurant administrator will 
be able to access the subsystem and make changes to the food menu.