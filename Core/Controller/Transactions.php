<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Model\Item;
use Core\Model\Transaction;
use Core\Helpers\Tests;





class Transactions extends Controller
{
        use Tests;
        protected $http_code = 200;
        protected $request_body;
    
        protected $response_schema = array(
                "success" => true, // to privde the response status
                "message_code" => "",
                "body" =>  [],
                "total" =>  ""
            );

        public function render()
        {
                
                header("Content-Type: application/json");
                http_response_code($this->http_code);
                echo json_encode($this->response_schema);

               

        
        }

        public function __construct()
        {
                $this->auth();
               

                $this->request_body = (array) json_decode(file_get_contents("php://input" ));

                // total sales
                $transaction = new Transaction;
                $user_id = $_SESSION['user']['user_id'];
                $all_transaction = $transaction->get_transactions_by_logged_in_user( $user_id);
            
                
                $filter_transaction = array();
              if(!empty($all_transaction)){
                foreach ($all_transaction as $transaction) {

                        $date = new \DateTime($transaction->created_att);
                        $created_at = $date->format('d/m/y');
                        $date_today = date('d/m/y');

                        if ($created_at == $date_today) {
                                $filter_transaction[] = $transaction;
                        }
                }
    
                $total = 0;
                foreach($filter_transaction as $transaction){
                $total += $transaction->total;

                }
                $this->response_schema['total_sales']= $total ;

              }
               
        }



        
    /**
     * GET all item name in database
     *
     * @return array
     */
        public function index()
        {
              
              
                try{
                     
                        $item = new Item; 
                        $items = $item->get_all();
                        
                       
                        

                     

                        if (empty($items)) {
                                $this->http_code = 404;
                                throw new \Exception('No item were found!');
                        }
                        
                        $this->response_schema['body']= $items ; 
                        $this->response_schema['message_code']= "items_collected";
                        
                        
            
            
                    } catch (\Exception $error) {
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();
                        
                    }
            
                

   

        }



      /**
      * GET all transactions in database
      *
      * @return array
      */
        public function git_transaction(){

                
             try {

                $item_user = new Transaction; 
                $user_id = $_SESSION['user']['user_id'];
                $items = $item_user->get_transactions_by_logged_in_user( $user_id);
                
                

                if (empty($items)) {
                        $this->http_code = 404;
                        throw new \Exception('No items were found!');
                }
                
                $filter_items = array();
                foreach ($items  as $item) {
                 
                        $date = new \DateTime($item->created_att);
                        $created_at = $date->format('d/m/y');
                        $date_today  =  date('d/m/y');
       
                        if($created_at ==  $date_today ){
                                $filter_items[] = $item;
                        }
                        $this->response_schema['body']= $filter_items ; 
                        $this->response_schema['message_code']= "items_collected";
       
                       
                    }
             } catch (\Exception $error) {
                $this->response_schema['success'] = false;
                $this->response_schema['message_code'] = $error->getMessage();


             }





             
    
        
        
        }



        
      /**
      * GET information of the selected item
      *
      * @return array
      */
        public function quantity()
        {

                 try {
                        
                    
                 $id = $this->request_body['id'];
                 $item = new Item; 
                   
                 if (empty($id)) {
                        $this->http_code = 422;
                        throw new \Exception('id_param_not_found!');
                  
                }
                $items = $item->get_by_id($id);

                if (empty($items)) {
                        $this->http_code = 404;
                        throw new \Exception('No items were found!');

                }


                $this->response_schema['body'][] = $items;
                $this->response_schema['message_code']= "items_collected";


                 }catch (\Exception $error) {
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();
        
         

                 }
               
            
               
              
        }




        /**
         * create_transaction in two table
         * @return void
         */
        public function create_transaction()
        {

                $api = new Transaction; 
                $itemm = new Item;
                self::check_if_empty($this->request_body);
             

                 // change quantity in database
                 
                 $item_id = $this->request_body['item_id'];


                try {

                if (empty($item_id)) {
                        $this->http_code = 422;
                        throw new \Exception('id_param_not_found!');
                  
                }   

                $item = $itemm->get_by_id($item_id);

                if (empty($item)) {
                        $this->http_code = 404;
                        throw new \Exception('No items were found!');

                }
                $quantity_item = $item->quantity;
                $quntity_item_create = $this->request_body['quntity_item'];         
                $new_quantity = $quantity_item - $quntity_item_create;


                // UPDATE quantity in the table items
                $sql = "UPDATE items SET quantity='$new_quantity' WHERE id=$item_id";
                $itemm->connection->query($sql);    


                // if ( $quntity_item_create != 0)
                
                // create transaction On the  transaction table
                $api->create($this->request_body);



                // git alst id transaction from the transaction table
                $last_transaction = $api->get_by_id($api->connection->insert_id);
                $last_transaction_id = $last_transaction->id;
                $user_id = $_SESSION['user']['user_id'];
          


                // create transaction On the  users_transactions table
                $stmt =  $api->connection->prepare("INSERT INTO users_transactions (user_id, transactions_id) VALUES (? , ?)");
                $stmt->bind_param('ii', $user_id,$last_transaction_id); // bind the params per data type 
                $stmt->execute(); // execute the statement on the DB   
                $stmt->close();
             

                // Send the last id create
                $this->response_schema['body'] = $last_transaction_id;

                $this->response_schema['message_code'] = "post_created_successfuly";
               
          


                 } catch (\Exception $error) {
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();


                 }
                 
 
                
        }



      /**
      * GET information of the selected item to be edit
      *
      * @return array
      */
        public function edit_transaction()
        {
            
            
                try {

                 $item = new Transaction; 
                 $id = $this->request_body['id'];
            
              
                 if (empty($id)) {
                         $this->http_code = 422;
                         throw new \Exception('id_param_not_found!');
                   
                 }
                 
                 $items = $item->get_item_to_be_edit( $id);          
                 if (empty($items)) {
                         $this->http_code = 404;
                         throw new \Exception('No items were found!');
         
                 }         
                 $this->response_schema['body'] = $items ;
                 $this->response_schema['message_code']= "items_collected";         
                }catch (\Exception $error) {
                $this->response_schema['success'] = false;
                $this->response_schema['message_code'] = $error->getMessage();
         
         
                }


              
              
         
        
                
               
            
        }



        /**
         * save edit transaction in two table
         * @return void
         */
        public function save_update_transaction(){
                
                
                $api = new Transaction; 
                $transaction = new Transaction;
                self::check_if_empty($this->request_body);

                try {

                        // change quantity in database
                
                 $id = $this->request_body['id'];         
                 if (empty($id)) {
                         $this->http_code = 422;
                         throw new \Exception('id_param_not_found!');
                   
                 }            
                 
                 $result = $transaction ->get_item_to_be_edit( $id);
               
                 if (empty($result)) {
                         $this->http_code = 404;
                         throw new \Exception('No items were found!');
         
                 }         
                 $item_id =$result[0]->id; //item id in table items
                 
                $all_quantity_item = $result[0]->quantity; // all quantity item in table items         
                $old_quantity_item = $result[0]->quntity_item; //old item quantity         
                $new_quntity_item = $this->request_body['quntity_item']; //new item quantity         
                if(!isset($this->request_body['quntity_item']))
                {
                 $this->http_code = 422;
                 throw new \Exception('quntity_item_not_found');
         
                }
                         
                
                if($new_quntity_item > $old_quantity_item){
                 $final_quntity_item =  $all_quantity_item - ($new_quntity_item - $old_quantity_item);
                 }
                 else{                  
                 $final_quntity_item =  $all_quantity_item + ($old_quantity_item - $new_quntity_item);    
                 }     
                     
                 // UPDATE quantity in the table items
                 $sql = "UPDATE items SET quantity=? WHERE id=$item_id";
            
                 $stmt = $transaction->connection->prepare($sql);
                 $stmt->bind_param('i', $final_quntity_item);
                 $stmt->execute();
                 $stmt->close();         
               // UPDATE quantity in the table transaction
                 $api->update($this->request_body);
                 $this->response_schema['message_code'] = "post_created_successfuly";
                 
                 
                } catch (\Exception $error) {
                        $this->response_schema['message_code'] = "post_was_not_created";
                        $this->http_code = 421;
                }
                
                
            
        }





        /**
         * delete transaction in two table
         * @return void
         */
        public function delete_transaction(){

                $item = new Transaction; 
                try {
                        
                 $id = $this->request_body['id'];          
                 if (empty($id)) {
                         $this->http_code = 422;
                         throw new \Exception('id_param_not_found!');
                   
                 }  
                 
                 $result = $item->get_item_to_be_edit( $id);
          
                 if (empty($result)) {
                         $this->http_code = 404;
                         throw new \Exception('No items were found!');
          
                 }            
                         
                $item_id =$result[0]->id; //item id in table items

                $all_quantity_item = $result[0]->quantity; // all quantity item in table items

                $old_quantity_item = $result[0]->quntity_item; //old item quantity

                $final_quntity_item = $all_quantity_item + $old_quantity_item;


                 // UPDATE quantity in the table items   
                $sql = "UPDATE items SET quantity=? WHERE id=$item_id";
                   
                $stmt =  $item->connection->prepare($sql);
                $stmt->bind_param('i', $final_quntity_item);
                $stmt->execute();
                $stmt->close();



               $sql2 = "DELETE FROM transactions WHERE id=?";
               $stmt =  $item->connection->prepare($sql2);
               $stmt->bind_param('i', $id);
               $stmt->execute();
               $stmt->close();

            

               $sql2 = "DELETE FROM users_transactions WHERE transactions_id=?";
               $stmt =  $item->connection->prepare($sql2);
               $stmt->bind_param('i', $id);
               $stmt->execute();
               $stmt->close();

                
                }  catch (\Exception $error) {
                        $this->response_schema['message_code'] = "post_was_not_created";
                        $this->http_code = 421;
                }
                
          
            
              
        


                
             
               
        }


        public function quntity_item(){
                $one = new Item;
                $quntity_and_nameitem = array();

                $all_item = $one->get_all();
                $quntity_item = 0;    
                foreach ($all_item as $item) {
                       
                        $one_item = $one->get_item($item->id);
                             
                         
                       if(!empty($one_item)){
                        foreach ($one_item as $value) {
                        
                                 $quntity_item += $value->quntity_item;
                                
                                }
                                
                                $quntity_and_nameitem[] =(object) array(  
                                        'id'=> $value->id,
                                        'name' =>  $item->name ,
                                        'total_quntity' => $quntity_item,
                                 
                                    );
        
                       }
                       $quntity_item = null;  
                       
               

                }

                $this->response_schema['body'] = $quntity_and_nameitem ;    
            
         
        }


      


        

                
}