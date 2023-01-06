<?php

namespace Core\Controller;
use Core\Base\Controller;

use Core\Model\Transaction;
use Core\Model\User;
use Core\Helpers\Helper;


class Accountant extends Controller
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
     * Gets all transaction
     *
     * @return array
     */
    public function index() 
    {
        $this->permissions(['transacation:read']);
       $this->view = 'transaction.index';
       $transaction = new Transaction; // new model item
       
       $this->data['transactions'] = $transaction->get_all_table();
       
       $this->data['count_transaction'] = count($transaction->get_all());

      $all_transaction = $transaction->get_all();
    
        $total = 0;
      foreach($all_transaction as $transaction){
            $total += $transaction->total;

        
      }
        $this->data['total_sales'] = $total;

       
      
       

    }


    /**
     * Gets one transaction
     *
     * @return
     */
    public function single()
    {
        $this->permissions(['transacation:read']);
        $this->view = 'transaction.single';
        $transaction = new Transaction;// new model item
     
       
        $all = $transaction->get_all_table_by_id($_GET['id']);

        
        $this->data['transactions_one']  = $all;
        
    }

 

    /**
     * Updates the  total price
     *
     * @return void
     */
    public function update()
    {
        
        $this->permissions(['transacation:read', 'transacation:update']);


    
        try {
            if(empty($_POST['total']) ){
                throw new \Exception('You need to enter Total Price ');
              
            }
    
            $transaction = new Transaction; // new model item
            
            $new = \htmlspecialchars($_POST['total']);
           
            $_POST['total'] = $new;
           
            
            $transaction->update($_POST);
            
            
            Helper::redirect('/single?id=' . $_POST['id']);
           
            } catch (\Exception $error) {
                $_SESSION['transaction']['Edit_Total_Price'] =  $error->getMessage();
                  
                Helper::redirect('/single?id=' . $_POST['id']);
            }
               

       
    }






    /**
     * Delete the transaction
     *
     * @return void
     */
    public function delete()
    {
        $this->permissions(['transacation:read', 'transacation:delete']);

        $transaction = new Transaction; // new model item
        $transaction->delete($_GET['id']);

        $sql = "DELETE FROM users_transactions WHERE transactions_id=?";
        $stm =  $transaction->connection->prepare($sql);
        $stm->bind_param('i' , $_GET['id']);
        $stm->execute();
        $stm->close();

        Helper::redirect('/accountant');
    }


    /**
     * find transacation of a particular user by username
     *
     * @return array
     */

    public function find_transactions()
    {
        $this->permissions(['transacation:read']);

       
        if(!empty($_GET['username'])){

        $this->view = 'transaction.index';
        $user = new User; // new model user
       
        $carent_user = $user->get_by_username($_GET['username']);

        
        if (!$carent_user) {
            $_SESSION['transaction']['not_find_username'] = "The username you entered does not exist   ";
            Helper::redirect('/accountant');
        }
        
     
        
        $transaction = new Transaction; // new model transaction
        $user_id = $carent_user->id;
     
        $transactions = $transaction->get_transactions_by_logged_in_user($user_id);


         
        $total = 0;
        foreach ($transactions as $key => $value) {
            $total += $value->total;
            $transactions[$key]->display_name =  $carent_user->display_name;
        }

            // var_dump($transactions);
            // die;
        $this->data['count_transaction'] = count($transaction->get_all());
        $this->data['transactions'] =$transactions;
        $this->data['total_sales'] = $total;
    

        
        }else{
        $_SESSION['transaction']['not_find_username'] = "You must enter a username to search for it";
        Helper::redirect('/accountant');
       }
    }

}