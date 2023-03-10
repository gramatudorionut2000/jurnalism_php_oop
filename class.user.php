<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'oop');

class User{
public $db;
public function __construct(){
$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if(mysqli_connect_errno()) {
echo "Error: Nu se poate conecta la bd.";
 exit;
}

}
/*** inregistrare ***/
public function reg_user($name,$username,$password,$email, $role){
    if($role=='Cititor')
    {
        $activated=1;
    }
    else{
        $activated=0;
    }
$password = md5($password);
$sql="SELECT * FROM users WHERE username='$username' OR email='$email'";
//verific dacae username or email sunt in bd
$check = $this->db->query($sql) ;
$count_row = $check->num_rows;
//daca username nu este in tabel
if ($count_row == 0){
    $sql1="INSERT INTO users SET name='$name', username='$username', password='$password', email='$email', role='$role', activated='$activated' ";
    $result = mysqli_query($this->db,$sql1) or
    die(mysqli_connect_errno()."Nu pot insera");
     return $result;
    }
    else { return false;}
    }
    /*** Login ***/
    public function check_login($emailusername, $password){
     $password = md5($password);
    $sql2="SELECT id, role from users WHERE email='$emailusername' or username='$emailusername' and password='$password' and activated='1' ";
    //verific daca username exista
     $result = mysqli_query($this->db,$sql2);
     $user_data = mysqli_fetch_array($result);
     $count_row = $result->num_rows;
     if ($count_row == 1) {
     // folosesc sesiune
     $_SESSION['login'] = true;
     $_SESSION['uid'] = $user_data['id'];
     $_SESSION['urole'] =$user_data['role'];
     return true;
     }
     else{
     return false;
    }
     }
     /*** afisare username sau fullname ***/
     public function get_fullname($uid){
     $sql3="SELECT username FROM users WHERE id = $uid";
     $result = mysqli_query($this->db,$sql3);
     $user_data = mysqli_fetch_array($result);
     echo $user_data['username'];
     }
     /*** start session ***/
     public function get_session(){
     return @$_SESSION['login'];
     }
     public function user_logout() {
     $_SESSION['login'] = FALSE;
     session_destroy();
     }
    }
?>