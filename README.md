##Candystore

Candy Store website built with CodeIgniter. CSC309 Assignment

The main page is located at the index.php. The way we have it set up, the index.php is not shown in the url so instead of showing localhost:nnnn/candystore/index.php/user/login it will show localhost:nnnn/candystore/user/login. For this to work the base_url has to be set on the config file as well as the index_page has to be set to an empty string.

##Controllers

There are 4 controllers, of which 3 are important

admin.php -> Where all the admin stuff goes (add new products, edit new products, view products, view orders, delete orders and customers, etc.)

candystore.php -> Where all the functionality of the candystore in the eyes of the customer goes (View products, add products to cart, change quantity of products, view cart, enter payment information, pay, print receipt, etc.)

user.php -> this is where everything related to accounts goes (Creating new accounts, logging in, logging out, etc.)

landing.php -> just to serve the landing page

##Models

Tried to keep everything that has to do with the db in the models through helper functions so that the controller only maniuplates the data it receives in the way it is needed.

Each tables has it's own file. Pretty self-explanatory when looking at it


##Views

The views are divided into 4 main folders, where three coincide with their respective controllers

admin/ -> this is where all the admin views are

candystore/ -> this is where all the candystore views are. This is what users see

templates/ -> This is where the footer and headers are kept so that they are the same for all. There are two types of headers and footers, although the footers weren't really built upon. But it is set up in a way where u change only one file to change the footer for all (same for headers)

user/ -> Where the login and signup pages are (didn't style since ran out of time)

index.php contains the landing page

style.css is the one and only css file for the whole website. That way only one http call is made and caching of the file helps speed up the website

##Admin

When starting on a new database, there is no admin. To be an admin all one has to do is have a user with an 'admin' username and then they are directed directly to the appropiate part of the website. only a user with 'admin' username can access all of the admin pages

##Extras

Emails are sent to the email they used to signup with

Cart is saved in the cookies

Everything else is just as the instructions said it should. There shouldn't be any problems you run into. All forms are appropiately validated.


##STUDENTS
name => Jaime Barriga
cdf_account => c3barrig
student_number => 998057123

name=> Jianhao Fang
cdf_account => g3fjh
student_number => 997464300




