<?php



namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;




class Authentication extends Controller
{
        private $user = null;

        public function render()
        {
                if (!empty($this->view))
                        $this->view();
        }

        function __construct()
        {
                
        }

        /**
         * Displays login form
         *
         * @return void
         */
        public function login()
        {
                $this->view = 'login';
        }

        /**
         * Login Validation
         *
         * @return void
         */
        public function validate()
        {
                // if user doesn't exists, do not authenticate
                $user = new User();
                $logged_in_user = $user->check_username($_POST['email']);

                
                if (!$logged_in_user) {
                        $this->invalid_redirect();
                }

                if ($_POST['email'] !== $logged_in_user->email){
                        $this->invalid_redirect();
                }

                // if ($_POST['password'] !== $logged_in_user->password)
                if (!\password_verify($_POST['password'], $logged_in_user->password)) {
                        $this->invalid_redirect();
                }


                if (isset($_POST['remember_me'])) {
                      
                        \setcookie('email', $logged_in_user->email, time() + (86400 * 30)); // 86400 = 1 day (60*60*24)
                       
                }

                

                $_SESSION['user'] = array(
                        'username' => $logged_in_user->username,
                        'display_name' => $logged_in_user->display_name,
                        'user_id' => $logged_in_user->id,
                       
                );

                
              

               
                
                Helper::redirect('dashboard');
                
                    
        }

        public function logout()
        {
                \session_destroy();
                \session_unset();
                \setcookie('email', '', time() - 3600); // destroy the cookie by setting a past expiry date
                Helper::redirect('/');
        }

        private function invalid_redirect()
        {
                $_SESSION['error'] = "Invalid Username or Email or Password";
              
                Helper::redirect('/');
                exit;
        }
}
