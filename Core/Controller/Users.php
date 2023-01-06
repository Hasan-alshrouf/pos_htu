<?php

namespace Core\Controller;

use Core\Base\Controller;
use  Core\Base\View;
use Core\Model\User;
use Core\Helpers\Helper;

class Users extends Controller
{

     public function render()
     {
             if (!empty($this->view))
                     $this->view();
     }

     function __construct()
     {
             $this->auth();
             $user = new User; // new model user
         

             $user_id = $_SESSION['user']['user_id'];
             $this->data['user_picture'] = $user->get_by_id( $user_id );
     }

     /**
     * Gets all users
     *
     * @return array
     */
    public function index()
    {
        $this->permissions(['role:admin']);
       $this->view = 'users.index';
       $user = new User; // new model user
       $selected_users = $user->get_all();
       $this->data['count'] = count($user->get_all());
        
       
         // htmlspecialchars all item
         $all_users = array () ;
        $all = array () ;
          foreach ( $selected_users as   $users) {
            // var_dump($users);
            
            foreach ($users as $key => $user) {
              $all_users[$key] = \htmlspecialchars($user);
              
           }
            $all[] = (object)$all_users;
 
          }
          

       
        
          $this->data['users'] = (object)$all;
         
    

    }


    /**
     * Gets one users
     *
     * @return array
     */
    public function single()
    {
        $this->permissions(['role:admin']);
        $this->view = 'users.single';
        $user = new User; // new model user
        $carent_user = $user->get_by_id($_GET['id']);
   
        
        $date = new \DateTime($carent_user->created_at);
        $carent_user->created_at = $date->format('d/M/Y');

        $carent_user->permissions = $user->permissions_matching($carent_user->permissions);

     
          // htmlspecialchars all item
         $all_users = array () ;
          foreach ( $carent_user as $key =>  $user) {
 
            $all_users[$key ] = \htmlspecialchars($user);
 
          }
  
         $this->data['user_one'] = (object)$all_users;
         
       
       
      

    }




    /**
     * Display the HTML form for user creation
     *
     * @return void
     */
    public function create()
    {
        $this->permissions(['role:admin']);

        $this->view = 'users.create';
        
    }




    /**
     * Creates new user
     *
     * @return void
     */
    public function store()
    {
        $this->permissions(['role:admin']);
    
    try {

        if(empty($_POST['email']) || empty($_POST['username']) ||  empty($_POST['display_name']) || empty($_POST['password']) || empty($_POST['role'])){
            throw new \Exception('You need to enter some information');
          
        }

        $user = new User; // new model user
        $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT); //encryption
       
        $permission = null ;
        switch ($_POST['role']) {
            case 'admin':
                $permission = User::ADMIN ;
                
                break;
            
            case 'seller':
                $permission = User::SELLER ;
               
                break;
            case 'accountant':
                $permission = User::ACCOUNTANT ;
               
                break;
            case 'procurement':
                $permission = User::PROCUREMENT ;
               
                break;
        }

        unset($_POST['role']); // destroys role
        $_POST['permissions'] = \serialize($permission);
      
        $user->create($_POST);
        Helper::redirect('/users');

    } catch (\Exception $error) {
        $_SESSION['user']['create_users'] =  $error->getMessage();
          
        Helper::redirect('/users/create');
    }



    }

    


    /**
     * Display the HTML form for user update
     *
     * @return void
     */
    public function edit()
    {
        $this->permissions(['role:admin']);
        $this->view = 'users.edit';
        $user = new User; // new model user
        $carent_user = $user->get_by_id($_GET['id']);
        
        $this->data['user_one'] = $carent_user;
        
    }





    /**
     * Updates the user
     *
     * @return void
     */
    public function update()
    {
        $this->permissions(['role:admin']);


        
    try {
        if(empty($_POST['email']) || empty($_POST['username']) ||  empty($_POST['display_name']) || empty($_POST['role']) ){
            throw new \Exception('You need to enter some information');
          
        }

        $user = new User; // new model user
        //process role 
        $permission = null ;
        switch ($_POST['role']) {
            case 'admin':
                $permission = User::ADMIN ;
                
                break;
            
            case 'seller':
                $permission = User::SELLER ;
               
                break;
            case 'accountant':
                $permission = User::ACCOUNTANT ;
               
                break;
            case 'procurement':
                $permission = User::PROCUREMENT ;
               
                break;
        }
        
        unset($_POST['role']); // destroys role
        $_POST['permissions'] = \serialize($permission);
        
        $user->update($_POST);
        
        Helper::redirect('/user?id='.$_POST['id']);
        

    } catch (\Exception $error) {
        $_SESSION['user']['create_users'] =  $error->getMessage();
          
        Helper::redirect('/users/edit?id=' .$_POST['id']);
    }
       


    }



    /**
     * Delete the user
     *
     * @return void
     */
    public function delete()
    {
        
        $this->permissions(['role:admin']);
        $user = new User; // new model user
        $user->delete($_GET['id']);
        Helper::redirect('/users');
    }



    /**
     *  Display the HTML form for user profile
     *
     * @return void
     */
    public function profile()
    {
        // $this->permissions(['user:read', 'user:update']);
        $this->view = 'my_profile';
        $user = new User; // new model user
       
        $carent_user = $user->get_by_id( $_SESSION['user']['user_id']);   
        
        $date = new \DateTime($carent_user->created_at);
        $carent_user->created_at = $date->format('d/M/Y');

        $carent_user->permissions = $user->permissions_matching($carent_user->permissions);

        $this->data['user_one'] = $carent_user;
        
    }



    public function update_profile()
    {
        
        $user = new User; // new model user
        // var_dump($_POST);
        // die;
        $user->update($_POST);
        Helper::redirect('/profile');

    }


    public function update_picture()
    {
        
        // $file_name = '';
        if (!empty($_FILES)) {
            $targetDir =  "resources/img/" ;
            $fileName = basename($_FILES["picture"]["name"]);
           
            $user = new User;
       
            move_uploaded_file($_FILES['picture']['tmp_name'],  $targetDir. $fileName);
            if (!empty($fileName)) {
                $user_id = $_SESSION['user']['user_id'];
                $sql = "UPDATE users SET picture='$fileName' WHERE id=$user_id";
                $user->connection->query($sql);
                $carent_user = $user->get_by_id($_SESSION['user']['user_id']);
                $this->data['user_one'] = $carent_user;

                Helper::redirect('/profile');
            }else{
                $carent_user = $user->get_by_id($_SESSION['user']['user_id']);
                $this->data['user_one'] = $carent_user;

                Helper::redirect('/profile');
            }

          }
        }





     /**
     * find user by username
     *
     * @return array
     */
        public function find_user()
        {
            $this->permissions(['role:admin']);
            if(!empty($_GET['username'])){
            $this->view = 'users.single';
            $user = new User; // new model user
          
            $carent_user = $user->get_by_username($_GET['username']);
            if (!$carent_user) {
                $_SESSION['user']['not_find_user'] = "The username you entered does not exist   ";
                Helper::redirect('/users');
            }
            
            $date = new \DateTime($carent_user->created_at);
            $carent_user->created_at = $date->format('d/M/Y');
            
            $carent_user->permissions = $user->permissions_matching($carent_user->permissions);
            $this->data['user_one'] = $carent_user;
           }else{
            $_SESSION['user']['not_find_user'] = "You must enter a username to search for it";
            Helper::redirect('/users');
           }
        }
    
    
}