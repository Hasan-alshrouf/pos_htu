<?php

namespace Core\Model;
use Core\Base\Model;

class Item extends Model 
{
    public function top_five_item()
    {
        $data = array();
        $result = $this->connection->query("SELECT * FROM items ORDER BY selling_price DESC LIMIT 5");
        
        if ($result) {
           
            if ($result->num_rows > 0) {
               while($row = $result->fetch_object()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function  get_item(int $id)
    {
       
        $stmt = $this->connection->prepare("
        SELECT *
        FROM transactions  
        INNER JOIN  
        items  
        ON  
        transactions.item_id = ?
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





}