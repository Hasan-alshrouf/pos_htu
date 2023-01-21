<?php
session_start();

// use Core\Helpers\Fake;
use Core\Router;
use Core\Model\User;





spl_autoload_register(function ($class_name) {
    if (strpos($class_name, 'Core') === false)
        return;
    $class_name = str_replace("\\", '/', $class_name); // \\ = \
    $file_path = __DIR__ . "/" . $class_name . ".php";
    require_once $file_path;
   
});


if (isset($_COOKIE['email']) && !isset($_SESSION['user'])) { // check if there is email cookie.
    // log in the user automatically
    
    $user = new User(); // get the user model
    $logged_in_user = $user->get_by_email($_COOKIE['email']); // get the user by email
    

    $_SESSION['user'] = array( // set up the user session that idecates that the user is logged in. 
        'username' => $logged_in_user->username,
        'display_name' => $logged_in_user->display_name,
        'user_id' => $logged_in_user->id,
    
    );
}



// For web administrators
Router::get('/', "authentication.login"); // Displays the login form
Router::get('/logout', "authentication.logout"); // Logs the user out
Router::post('/authenticate', "authentication.validate"); // validate the login form


// athenticated
Router::get('/dashboard', "admin.index"); // Displays the admin dashboard


//users
Router::get('/users', "users.index"); // list of users (HTML)
Router::get('/user', "users.single"); // Displays single user (HTML)
Router::get('/user/find', "users.find_user"); //find the users by username (PHP)
Router::get('/users/create', "users.create"); // Display the creation form (HTML)
Router::post('/users/store', "users.store"); // Creates the users (PHP)
Router::get('/users/edit', "users.edit"); // Display the edit form (HTML)
Router::post('/users/update', "users.update"); // Updates the user (PHP)
Router::get('/users/delete', "users.delete"); // Delete the user (PHP)


// Items
Router::get('/items', "items.index"); // list of items (HTML)
Router::get('/item', "items.single"); // Displays single item (HTML)
Router::get('/item/find', "items.find_item"); //find the item by name (PHP)
Router::get('/items/create', "items.create"); // Display the creation form (HTML)
Router::post('/items/store', "items.store"); // Creates the items (PHP)
Router::get('/items/edit', "items.edit"); // Display the edit form (HTML)
Router::post('/items/update', "items.update"); // Updates the items (PHP)
Router::get('/items/delete', "items.delete"); // Delete the item (PHP)


//my_Profile
Router::get('/profile', "users.profile"); // Displays profile of user (HTML)
Router::post('/profile/update', "users.update_profile"); // Updates the profile  of user (PHP)
Router::post('/profile/update/picture', "users.update_picture");  // Updates the picture profile  of user (PHP)


// sales
Router::get('/sales', "sales.index"); // Display the creation form (HTML)
Router::get('/sales/edit', "sales.edit"); // Display the edit form (HTML)


// transactions api 
Router::get('/sales_api', "Transactions.index"); 
Router::get('/sales_api/git_transaction', "Transactions.git_transaction"); 
Router::post('/sales_api/quantity', "Transactions.quantity"); 
Router::post('/sales_api/create_transaction', "Transactions.create_transaction"); 
Router::post('/sales_api/edit_transaction', "Transactions.edit_transaction"); 
Router::PUT('/sales_api/save_update_transaction', "Transactions.save_update_transaction");
Router::DELETE('/sales_api/delete_transaction', "Transactions.delete_transaction");
Router::get('/sales_api/quntity_item', "Transactions.quntity_item");


// accountant
Router::get('/accountant', "accountant.index"); // list of Transactions (HTML)
Router::get('/single', "accountant.single"); // Displays single Transactions  (HTML)
Router::post('/accountant/update', "accountant.update"); // Updates the Transactions (PHP)
Router::get('/accountant/delete', "accountant.delete"); // Delete Transactions (PHP)
Router::get('/accountant/find', "accountant.find_transactions"); //find transacation of a particular user by username(PHP)



Router::redirect();