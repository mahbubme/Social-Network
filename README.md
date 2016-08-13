# Social Network

A simple social networking system that makes use of PHP ( learning project ) .

[View Demo](http://mahbub.me/project/social-network/)

## Deploying ( Heroku )

Install the [Heroku Toolbelt](https://toolbelt.heroku.com/).

```sh
$ git clone https://github.com/mahbubme/Social-Network.git # or clone your own fork
$ cd Social-Network
$ heroku create
$ git push heroku master
$ heroku open
```

or

Deploy to a web server


1) [Download](https://github.com/mahbubme/Social-Network/archive/master.zip) the repository

2) Extract the downloaded file

3) Inside the main directory there is a folder named 'src'. 
You should upload 'src' directory's files to the server.


## Documentation

Before running the application you have to follow the instructions given here:


1) You need to add the database information in the following file

```sh
/includes/connection.php
```

2) [Download](http://mahbub.me/project/social_network.sql.zip) the empty database file and import it to the database which you have created for this project.


3) Change the default admin email by adding your email to get the notification about new user registration. File location is:

```sh
/user_insert.php 
line 51
```

4) You should change the site URL in the email templates, see the '/templates/email/' folder.


5) To see the admin panel change a user_role to 'admin' from the database 'users' table. After the project link add '/admin'. It will prompt you to login as a admin by using the email and password who has the 'admin' user role.

```sh
http://example.com/admin/
```