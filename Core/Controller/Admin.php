<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\Item;
use Core\Model\User;
use Core\Model\Transaction;

class Admin extends Controller
{
        public function render()
        {
                if (!empty($this->view))
                        $this->view();
        }

        function __construct()
        {
                $this->auth();
               
        }

        public function index()
        {

                // admin
                if (Helper::check_permission(['role:admin'])) {
                        
                        $this->view = 'users.dashboard';

                        $user = new User; // new model user
                        $this->data['count_user'] = count($user->get_all());

                        $user_id = $_SESSION['user']['user_id'];
                        $this->data['user_picture'] = $user->get_by_id( $user_id );


                        $transaction = new Transaction; // new model user
                        $this->data['count_transaction'] = count($transaction->get_all());


                        $item = new Item; // new model item

                        $all_item = $item->get_all();
                        $total_quantity = 0;

                        foreach ($all_item as $item) {

                                $total_quantity += $item->quantity;


                        }

                        $this->data['total_quantity'] = $total_quantity;


                        //total_sales
                        $all_transaction = $transaction->get_all();
    
                       $total = 0;
                       foreach($all_transaction as $transaction){
                      $total += $transaction->total;
                     }
                      $this->data['total_sales'] = $total;

                      
                        // get top five selling_price in database
                        $top = new Item;
                        $top_five = $top->top_five_item();
                    
                        if(!empty( $top_five)){
                           
                           $this->data['five_item'] = $top_five;
                              

                        }

                        return;

                }
            

                //seller
                if (Helper::check_permission(['role:seller'])){
                        
                        $this->view = 'sales.index'; 
                        
                      

                }



                // accountant
                if (Helper::check_permission(['role:accountant'])){
                        
                        $transaction = new Transaction; // new model user
                        $this->data['transactions'] = $transaction->get_all_table();
       
                        $this->data['count_transaction'] = count($transaction->get_all());
                 
                       $all_transaction = $transaction->get_all();
                     
                         $total = 0;
                       foreach($all_transaction as $transaction){
                             $total += $transaction->total;
                 
                         
                       }
                         $this->data['total_sales'] = $total;


                        $this->view = 'transaction.index'; 
                        

                }


                // procurement
                if (Helper::check_permission(['role:procurement'])){
                        $item = new Item; // new model item
                        $this->data['items'] = $item->get_all();
                        $this->data['count'] = count($item->get_all());
                        $this->view = 'items.index'; 
                       

                }


        

             
                
                
              
               
        }
}