
<?php 

class Users extends Controller{

    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function index(){

  
       $this->login();
      


       
    }

    public function register(){
        // Check if logged in
        if($this->isLoggedIn()){
          redirect('dashboard');
        }
  
        // Check if POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Sanitize POST
          $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          $data = [
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
            'username_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
            'searchTerm'=>''
          ];
  
          // Validate email
          if(empty($data['email'])){
              $data['email_err'] = 'Please enter an email';
              // Validate name
              if(empty($data['name'])){
                $data['name_err'] = 'Please enter a name';
              }
          } else{
            // Check Email
            if($this->userModel->findUserByEmail($data['email'])){
              $data['email_err'] = 'Email is already taken.';
            }

            if($this->userModel->findUserByusername($data['username'])){
                $data['username_err'] = 'Username is already taken.';

            }
          }
  
          // Validate password
          if(empty($data['password'])){
            $password_err = 'Please enter a password.';     
          } elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'Password must have atleast 6 characters.';
          }
  
          // Validate confirm password
          if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Please confirm password.';     
          } else{
              if($data['password'] != $data['confirm_password']){
                  $data['confirm_password_err'] = 'Password do not match.';
              }
          }
           
          // Make sure errors are empty
          if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
            // SUCCESS - Proceed to insert
  
            // Hash Password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
  
            //Execute
            if($this->userModel->register($data)){
              // Redirect to login
              redirect('users/login');
            } else {
              die('Something went wrong');
            }
             
          } else {
            // Load View
            $this->view('users/register', $data);
          }
        } else {
          // IF NOT A POST REQUEST
  
          // Init data
          $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'username_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
            'searchTerm'=>''
            
          ];
  
          // Load View
          $this->view('users/register', $data);
        }
      }

    public function login(){

        if($this->isLoggedIn()){
            redirect('dashboard');
          }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data=['username' => '', 'password' => '', 'error'=>'', 'session'=>'','searchTerm'=>'', 'username_err'=>'', 'password_err'=>''];

            $data['username'] = trim($_POST['username']);
            $data['password']=trim($_POST['password']);

            if(empty($data['username'])){
                $data['username_err']='Please enter username';
                $this->view('users/login', $data);

            }
            if(empty($data['password'])){
 
                $data['password_err']='Please enter password ';
                $this->view('users/login', $data);
            }if(!empty($data['username']) && !empty($data['password'])){
                $user = $this->userModel->checkUsername($data['username']);
                if(!empty($user)){

                    $verify_user = $this->userModel->verifyUser($user->username);
                    if(password_verify($data['password'], $verify_user->password)){

                        $this->createUserSession($verify_user);
                    }else{
                        $data['error']='Password wrong, please try again';
                        $this->view('users/login', $data);
                    }
                }else{
                   
                    $data['error'] = 'Username doesnot Exists';
                    $this->view('users/login', $data);
                }
            }
        }else{

            $data=['username' => '', 'password' => '', 'error'=>'', 'session'=>'','searchTerm'=>'', 'username_err'=>'', 'password_err'=>''];

            $this->view('users/login', $data);

        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        
        redirect('dashboard');
      }


      
    // Check Logged In
    public function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
          return true;
        } else {
          return false;
        }
      }

      // Logout & Destroy Session
    public function logout(){
        unset($_SESSION['user_id']);
        
        session_destroy();
        redirect('users/login');
      }


}

?>