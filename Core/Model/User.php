<?php

namespace Core\Model;

use Core\Base\Model;

class User extends Model
{


    const ADMIN = array(
        "role:admin","role:seller", "role:accountant","role:procurement",
        "item:read", "item:create", "item:update", "item:delete",
        "sales:read", "sales:create", "sales:update", "sales:delete",
        "transacation:read", "transacation:create", "transacation:update", "transacation:delete"
    );

    const SELLER = array(
       "role:seller",
       "sales:read", "sales:create", "sales:update", "sales:delete"
    );

    const ACCOUNTANT = array(
        "role:accountant",
        "transacation:read", "transacation:create", "transacation:update", "transacation:delete"
    );

     const PROCUREMENT = array(
        "role:procurement",
        "item:read", "item:create", "item:update", "item:delete"
    );
 


    public function check_email(string $email)
    {
        $result = $this->connection->query("SELECT * FROM $this->table WHERE email='$email'");
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



    public function get_permissions(): array
    {
        $permissions = array();
        $user = $this->get_by_id($_SESSION['user']['user_id']);
       
        if ($user) {
            // $permissions = \explode(',', $user->permissions);
           $permissions = \unserialize( $user->permissions);//Convert from string to array

        }
        
        return $permissions;
    }



    public function permissions_matching($x)
    {
        $permissions = \unserialize( $x);//Convert from string to array

        $permission = null ;
        switch ( $permissions) {
            case User::ADMIN:
                $permission = "ADMIN" ;
                
                break;
            
            case User::SELLER:
                $permission = "SELLER" ;
               
                break;
            case User::ACCOUNTANT:
                $permission = "ACCOUNTANT" ;
               
                break;
            case User::PROCUREMENT:
                $permission = "PROCUREMENT" ;
               
                break;
        }
        return $permission;

    }


   
}