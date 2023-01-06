<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Model\Item;
use Core\Model\User;

class Sales extends Controller
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
       * Display the HTML form for sales creation
       *
       * @return void
       */
        public function index() 
        {
         $this->permissions(['sales:read' , 'sales:create' ,'sales:delete']);
           $this->view = 'sales.index';
     
          
        
    
        }



         /**
        * Display the HTML form for sales edit
        *
        * @return void
        */
        public function edit() 
        {
         $this->permissions(['sales:update']);
           $this->view = 'sales.edit';
          
        
    
        }

    
        
        

                
}