<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Welcome
Welcome to the backend side of the reBBit prject.

## Description
This projects serves as an API for the front end version in VUE for the yowl project. It contains models that are linked to a local mysql database, controllers that interact with this data, as well as routes that enables the front end to interact with the API and unitary tests which were implemented to test that basic functionalities work.

## Launch the backend 
- Make sure to be connected to local mysql socket: "mysql -u username -p" then enter your password
    -> In case the mysql service is not active, use "sudo service mysql restart" or "sudo /etc/init.d/mysql restart"
- To launch the server, use "php artisan serve", make sure composer is up to date with "composer update" in your project directory

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### Routes
/*-- Users --*/
/users": regroups all users
/users/{id}"/users/{id}/admin/status": fetches the admin status of a certain user
/users/{id}/age": fetches the age of a certain user
"/usersWithUsername/{username}": fetches a user depending on its username
/AddUser": post method to add a user
/AddUserTest": test method with default values
/Login: handles login (checks that user has verified email and that the user input matches the database)
/User/{id}/Modify": modify a user depending on a certain user id
/users/{id}/ValidateAccount": triggers validate account method for a certain user
"/DeleteUser/{id}": delete a certain user with delete request

/*-- Posts --*/
"/posts": regroups all posts
"/posts/{id}": fetches a precise post
"/posts/filteredByAuthor/{id}": fetches all posts per author id
"/posts/filteredByCategory/{id}": fetches all posts per category id
"/posts/search/{search}": fetches posts depending on search item
"/GetPostsAuthors": fetches all post author Ids
"/GetPostAuthor/{id}": fetches certain post author with ID
"/GetPostCategories": fetches all post categories
"/PostsPerCategory/{categoryId}": fetches all posts that have a certain category
"/FilterByCategoryTitle/{title}": regroups posts that have a ceratin category title
"/getTop3PostAuthorId": fetches top 3 authors with the most posts
"/AddPost": post request to add a post
"/CreatePost": test method for request above
"/posts/delete/{id}": delete a precise post
"/posts/deletePerCategory/{categoryId}": delete all posts per category

/*-- Categories --*/
"/categories": fetches all categories
"/categories/{id}": fetches a precise category
"/categoryFromTitle/{input}": fetches categories depending on a title input
"/AddCategory": post method to add a category
"/categories/modify/{id}": modify a certain category
"categories/delete/{id}": delete a certain category

/*-- Comments --*/
"/comments": fetches all comments
"/comments/{id}": fetches a precise comment with ID
"/posts/{id}/comments/": fetches all the comments for a certain post
"/posts/{id}/comments/count": fetches the comments count for a certain post
"/GetTopComments": regroups the top 3 author_ids that have the most comments of all posts
"/post/{post_id}/addComment/{userId}": enables to update a certain comment
"/comments/{commentId}/update/{userId}": updates a certain comment depending on the user id (only update the comment if you are the author)
"comments/{id}/deleteAdmin": delete a certain comment
"comments/{postId}/{userId}/{commentId}": fetch a precise comment from a certain post from a certain user
"comments/deletePerPost/{postId}": delete all comments per post (handle when post is deleted to delete all comments that belong to it)
"comments/deletePerUser/{userId}": delete all comments per user (handle when user is deleted to delete all of its comments)

/*-- Verify email --*/
"/validateAccount/{id}": triggers validate account method for a specific user to update its email_verified_status so it validates the account


## Authors
 - Nathan Delmarche
 - Matis Chahbazian 
 - Raphaël Sood