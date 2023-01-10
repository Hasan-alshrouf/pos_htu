<?php

namespace Core\Base;

class Model 
{
    public $connection;
    public $table;

    public function __construct()
    {
        $this->connection(); // connection is ready
        $this->relate_table();
    }

    public function __destruct()
    {
        $this->connection->close();
    }


    //get all data 
    public function get_all(): array
    {
        $data = array();
        $result = $this->connection->query("SELECT * FROM $this->table");
      

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }


     //get one data  by id 
    public function get_by_id($id)
    {
      
      
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id=?"); // prepare the sql statement
        $stmt->bind_param('i', $id); // bind the params per data type 
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        
        $stmt->close();
     
        return $result->fetch_object();
        
    }

   //get one data  by name from table items
    public function get_by_name($name)
    {
       
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE name=?"); // prepare the sql statement
        $stmt->bind_param('s', $name); // bind the params per data type
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        
        $stmt->close();

        if ($result) {
           
            if ($result->num_rows > 0) {
                return $result->fetch_object();
            } else {
                return false;
            }
        } else {
            return false;
        }
       
    }

//get one data  by username from table users
    public function get_by_username($username)
    {
       
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE username=?"); // prepare the sql statement
        $stmt->bind_param('s', $username); // bind the params per data type
        $stmt->execute(); // execute the statement on the DB
        $result = $stmt->get_result(); // get the result of the execution
        
        $stmt->close();

        if ($result) {
           
            if ($result->num_rows > 0) {
                return $result->fetch_object();
            } else {
                return false;
            }
        } else {
            return false;
        }
       
    }

  
  


    public function create($data)
    {
     

        $keys = '';
        $values = '';
        $value_arr = array();
        $data_types = '';

        foreach ($data as $key => $value) {
           

            if ($key != \array_key_last($data)) {
                $keys .= $key . ', ';
                $values .= "?, ";
         
            } else {
                $keys .= $key;
                $values .= "?";
            }

            switch ($key) {
                case 'id':
                case 'cost':
                case 'selling_price':
                case 'quantity':
                case 'item_id':
                case 'quntity_item':
                case 'total':
                case 'phone':
                case 'user_id':
                case 'transactions_id':
                    $data_types .= "i";
                   
                    break;

                default:
                    $data_types .= "s";
                  
                    break;
            }
            
            $value_arr[] = $value;
        } 
        
        $sql = "INSERT INTO $this->table ($keys) VALUES ($values)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param($data_types, ...$value_arr);
        $stmt->execute();
        $stmt->close();
        
    }




    public function update($data)
    {
        $set_values = '';
        $id = 0;
        $value_arr = array();
        $data_types = '';
       
        foreach ($data as $key => $value) {
            
            if ($key == 'id') {
                $id = $value;
                continue;
            }
            if ($key != \array_key_last($data)) {
                 

                $set_values .= "$key=?, ";

              
           
            } else {
             
                $set_values .= "$key=?";
            }

            switch ($key) {
                case 'id':
                case 'cost':
                case 'selling_price':
                case 'quantity':
                case 'item_id':
                case 'quntity_item':
                case 'total':
                case 'phone':
                case 'user_id':
                case 'transactions_id':
                    $data_types .= "i";
                   
                    break;

                default:
                    $data_types .= "s";
                  
                    break;
            }

            $value_arr[] = $value;
        }
     
  
      
        $sql = "UPDATE $this->table 
        
            SET $set_values
            WHERE id=$id
        ";
       
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param($data_types, ...$value_arr);
        $stmt->execute();
        $stmt->close();

      
    }



    
        // delete one data by id 
        public function delete($id)
        {
           

        $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id=?");
            $stmt->bind_param('i', $id); // bind the params per data type 
           $stmt->execute(); // execute the statement on the DB
           $result = $stmt->get_result(); // get the result of the execution
           
           $stmt->close();
            return $result;
            
        }




    protected function connection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pos_htu";

        // Create connection
        $this->connection = new \mysqli($servername, $username, $password, $database);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }


    
    protected function relate_table()
    {
        $table_name = \get_class($this);

       
        $table_name_arr = \explode('\\', $table_name);
        
        $class_name = $table_name_arr[\array_key_last($table_name_arr)]; // $table_name_arr[2]
      
        $final_clas_name = \strtolower($class_name) . "s";
       
        $this->table = $final_clas_name;
       
    }
}