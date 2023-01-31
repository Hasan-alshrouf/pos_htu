<?php

namespace Core\Base;
use Core\Model\User;
use Core\Helpers\Helper;


abstract class Controller 
{
    abstract public function render();


    protected $view =null ;  // التمبلت اللي بدي اعرض عليه 
    protected $data = array() ; // البيانات اللي بدي اعرضها على التمبلت 

    protected function  view()
    {
        new View ($this->view , $this->data);
    }


    
// Verify that the user login
    protected function auth()
    {
        if (!isset($_SESSION['user'])) {
            Helper::redirect('/');
        }
    }

    
    protected function permissions(array $permissions_set)
    {
        $this->auth();
        // $permissions_set = ['role:admin']
        // Collect user permissions from the DB
        $user = new User;
        $assigned_permissions = $user->get_permissions();
        // check if the user has all the permissions_set
     
        foreach ($permissions_set as $permission) {
            if (!in_array($permission, $assigned_permissions)) {
     
       
                Helper::redirect('/dashboard');
            }
        }
        // if any of the permission sets are not assigned to the user, redirect to the dashboard
    }
    













}