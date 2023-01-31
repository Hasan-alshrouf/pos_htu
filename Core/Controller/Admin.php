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
                    

                        //get count_user
                        $user = new User; // new model user
                        $this->data['count_user'] = count($user->get_all());

                        
                        //get user_picture
                        $user_id = $_SESSION['user']['user_id'];
                        $this->data['user_picture'] = $user->get_by_id( $user_id );

                        // get  count_transaction
                        $transaction = new Transaction; // new model transaction
                        $this->data['count_transaction'] = count($transaction->get_all());

                        

                        // total_quantity items
                        $item = new Item; // new model item

                        $all_item = $item->get_all();
                        $total_quantity = 0;

                        foreach ($all_item as $item) {

                                $total_quantity += $item->quantity;


                        }

                        $this->data['total_quantity'] = $total_quantity;
 


                       //The quantity in stock for each item
                       
                        $this->data['quantity_item'] = $all_item ;
                       


                        
                      
     


                      
                    // get top five selling_price in database
                        $top = new Item;
                        $top_five = $top->top_five_item();
                        $this->data['five_item'] = $top_five;
                    
                              

                


                        //total_sales
                        $all_transaction = $transaction->get_all();
    
                       $total = 0;
                      
                       foreach($all_transaction as $transaction){
                        $total += $transaction->total;
                       }
                        $this->data['total_sales'] = $total;
                        

                        
                       if(!empty($all_transaction)){

                        // Total sales for each day in the last week
                          $filter = array();
                          $totalMonday = 0;
                          $totalTuesday = 0;
                          $totalWednesday = 0;
                          $totalThursday = 0;
                          $totalFriday = 0;
                          $totalSaturday = 0;
                          $totalSunday = 0;
                

                          $Monday = date('d/m/Y', strtotime("last week Monday"));
                          $Tuesday = date('d/m/Y', strtotime("last week Tuesday"));
                          $Wednesday = date('d/m/Y', strtotime("last week Wednesday"));
                          $Thursday = date('d/m/Y', strtotime("last week Thursday"));
                          $Friday = date('d/m/Y', strtotime("last week Friday"));
                          $Saturday = date('d/m/Y', strtotime("last week Saturday"));
                          $Sunday = date('d/m/Y', strtotime("last week Sunday"));
                          
                          foreach ($all_transaction as $key => $transaction) {
          
                                  $date = new \DateTime($transaction->created_att);
                                  $created_at = $date->format('d/m/Y');
                                 
                                  switch ($created_at) {
                                          case $Monday :
                                                  
                                                  $totalMonday += $transaction->total;

                                                  $filter[0] = (object)array( 

                                                          'id' => "1",
                                                          'day' => "Monday",
                                                          'total' => $totalMonday,
                                                   
                                                      );
                                          
                                                   
                                              break;
                                          
                                          case $Tuesday:
                                                  
                                                  $totalTuesday += $transaction->total;
                                                  $filter[1] = (object)array(  
                                                          'id' => "2",
                                                          'day' => "Tuesday",
                                                          'total' => $totalTuesday,
                                                   
                                                      );
                                             
                                              break;
                                          case $Wednesday:
                                                  
                                                  $totalWednesday += $transaction->total;
                                                  $filter[2] = (object)array(  
                                                          'id' => "3",
                                                          'day' => "Wednesday",
                                                          'total' => $totalWednesday,
                                                   
                                                      );
                                             
                                              break;
                                          case $Thursday:
                                                  
                                                  $totalThursday += $transaction->total;
                                                  $filter[3] = (object)array(  
                                                          'id' => "4",
                                                          'day' => "Thursday",
                                                          'total' => $totalThursday,
                                                   
                                                      );
                                             
                                              break;
                                          case $Friday:
                                                  
                                                  $totalFriday += $transaction->total;
                                                  $filter[4] = (object)array(  
                                                          'id' => "5",
                                                          'day' => "Friday",
                                                          'total' => $totalFriday,
                                                   
                                                      );
                                             
                                              break;
                                          case $Saturday:
                                                  
                                                  $totalSaturday += $transaction->total;
                                                  $filter[5] = (object)array(  
                                                          'id' => "6",
                                                          'day' => "Saturday",
                                                          'total' => $totalSaturday,
                                                   
                                                      );
                                                 
                                              break;
                                          case $Sunday:
                                                  
                                                  $totalSunday += $transaction->total;
                                                  $filter[6] = (object)array(  
                                                          'id' => "7",
                                                          'day' => "Sunday",
                                                          'total' => $totalSunday,
                                                   
                                                      );
                                             
                                              break;
                                      }
                         
                                  }
                             

                              
                                 if(!empty($filter)){
                                       
                                        $this->data['last_week'] =   $filter;
                                 }


                            
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