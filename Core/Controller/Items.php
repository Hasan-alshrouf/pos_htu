<?php

namespace Core\Controller;
use Core\Base\Controller;

use Core\Model\Item;
use Core\Model\User;
use Core\Helpers\Helper;


class Items extends Controller
{

    
    public function render()
    {
        if(!empty($this->view))
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
     * Gets all items
     *
     * @return array
     */
    public function index() 
    {
        $this->permissions(['item:read']);
       $this->view = 'items.index';
       $item = new Item; // new model item

       $selected_items= $item->get_all();
       $this->data['count'] = count($item->get_all());


          // htmlspecialchars all item
          $all_items = array () ;
          $all = array () ;
            foreach ( $selected_items as  $items) {
              
              
              foreach ($items as $key => $user) {
                $all_items[$key] = \htmlspecialchars($user);
                
             }
              $all[] = (object)$all_items;
   
            }
            
  
         
          
            $this->data['items'] = (object)$all;
           

     
        
    }
        

   


    /**
     * Gets one items
     *
     * @return
     */
    public function single()
    {
        $this->permissions(['item:read']);
        $this->view = 'items.single';
        $item = new Item; // new model item
        $carent_item = $item->get_by_id($_GET['id']);

      

        $created_at = new \DateTime($carent_item->created_at);
        $updated_at = new \DateTime($carent_item->updated_at);

        $carent_item->created_at = $created_at->format('d/M/Y');
        $carent_item->updated_at = $updated_at->format('d/M/Y');

        // htmlspecialchars all item
        $all_item = array () ;
         foreach ( $carent_item as $key =>  $item) {

            $all_item[$key ] = \htmlspecialchars($item );

         }
 
        $this->data['item_one'] = (object)$all_item;
        
    }




    /**
     * Display the HTML form for item creation
     *
     * @return void
     */
    public function create()
    {
        $this->permissions(['item:create']);
        $this->view = 'items.create';

       
    }

    



    /**
     * Creates new item
     *
     * @return void
     */
    public function store()
    {
        $this->permissions(['item:create']);
       
       
    try {
        if(empty($_POST['name']) || empty($_POST['cost']) ||  empty($_POST['selling_price']) || empty($_POST['quantity']) ){
            throw new \Exception('You need to enter some information');
          
        }

        $item = new Item; // new model item
        $item->create($_POST);
        Helper::redirect('/items');

    } catch (\Exception $error) {
        $_SESSION['item']['create_items'] =  $error->getMessage();
          
        Helper::redirect('/items/create');
    }
       
   

     
   

    }

    


    /**
     * Display the HTML form for item update
     *
     * @return void
     */
    public function edit()
    {
        
        $this->permissions(['item:read', 'item:update']);
        $this->view = 'items.edit';
        $item = new Item; // new model item

       
        $carent_item = $item->get_by_id($_GET['id']);
       
      
        $this->data['item_one'] = $carent_item;
        
    }





    /**
     * Updates the item
     *
     * @return void
     */
    public function update()
    {
        
        $this->permissions(['item:read', 'item:update']);

        // var_dump($_POST);
        // die;
        
        try {
            if(empty($_POST['name']) || empty($_POST['cost']) ||  empty($_POST['selling_price']) || empty($_POST['quantity']) ){
                throw new \Exception('You need to enter some information');
              
            }
    
            $item = new Item; // new model item
            $item->update($_POST);
            Helper::redirect('/item?id=' . $_POST['id']);
    
        } catch (\Exception $error) {
            $_SESSION['item']['create_items'] =  $error->getMessage();
              
            Helper::redirect('/items/edit?id=' . $_POST['id']);
        }
           
       





       
        
        
     
    }






    /**
     * Delete the item
     *
     * @return void
     */
    public function delete()
    {
        $this->permissions(['item:read', 'item:delete']);

        $item = new Item; // new model item
        $item->delete($_GET['id']);
        Helper::redirect('/items');
    }


     /**
     * find item by name
     *
     * @return array
     */

    public function find_item()
    {
        $this->permissions(['item:read']);
     
        if(!empty($_GET['name'])){
        $this->view = 'items.single';
        $item = new Item; // new model item
      
        $carent_item = $item->get_by_name($_GET['name']);
         
        if (!$carent_item) {
            $_SESSION['item']['not_find_item'] = "The name item you entered does not exist   ";
            Helper::redirect('/items');
        }
        
        $date = new \DateTime($carent_item->created_at);
        $carent_item->created_at = $date->format('d/M/Y');
        
        $this->data['item_one'] = $carent_item;
       }else{
            
            $_SESSION['item']['not_find_item'] = "You must enter a name item to search for it";
        Helper::redirect('/items');
       }
    }

}