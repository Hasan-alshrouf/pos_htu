<?php

namespace Core\Model;
use Core\Base\Model;

class Transaction extends Model 
{


    public function  get_transactions_by_logged_in_user(int $user_id)
    {
       
        $stmt = $this->connection->prepare("
        SELECT *
        FROM users_transactions  
        INNER JOIN  
        transactions  
        ON  
        users_transactions.user_id = ?
        AND
        users_transactions.transactions_id = transactions.id
    
        INNER JOIN  
        items  
        ON  
        transactions.item_id =items.id ");

       
           
        $stmt->bind_param('i', $user_id); // bind the params per data type 
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        
        $stmt->close();
                        
        
        if ($result) {
            $item = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                      $item[] = $row;
                }
                return $item;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function  get_item_to_be_edit(int $id)
    {
       
        $stmt = $this->connection->prepare("
        SELECT *
        FROM transactions  
        INNER JOIN  
        items  
        ON  
        transactions.id = ?
        AND
        transactions.item_id = items.id");

        $stmt->bind_param('i', $id); // bind the params per data type 
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        
        $stmt->close();
                   
        
        if ($result) {
            $item = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                      $item[] = $row;
                }
                return $item;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



    public function  get_all_table()
    {
       
        $result = $this->connection->query("
        SELECT *
        FROM transactions  
        INNER JOIN  
        items  
        ON  
        transactions.item_id = items.id
        INNER JOIN 
        users_transactions
        ON  
          transactions.id = users_transactions.transactions_id
          INNER JOIN 
          users
          ON 
           users_transactions.user_id = users.id");

        
                   
        
        if ($result) {
            $item = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                      $item[] = $row;
                }
                return $item;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



    public function  get_all_table_by_id($id)
    {
        // var_dump( $id);
        // die;
       
        $stmt = $this->connection->prepare("
        SELECT *
        FROM transactions  
        INNER JOIN  
        items
        ON 
        transactions.id = ?
        AND  
        transactions.item_id = items.id
        INNER JOIN 
        users_transactions
        ON  
          transactions.id = users_transactions.transactions_id
          INNER JOIN 
          users
          ON 
           users_transactions.user_id = users.id");

      
           $stmt->bind_param('i', $id); // bind the params per data type 
           $stmt->execute(); // execute the statement on the DB
           $result = $stmt->get_result(); // get the result of the execution
           
           $stmt->close();
                   
        
        if ($result) {
            $item = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                      $item[] = $row;
                }
                return $item;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


  
 

}