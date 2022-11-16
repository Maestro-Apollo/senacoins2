<?php
session_start();
include 'database.php';
class login extends database
{

    protected $link;

    public function loginFunction()
    {
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            $sql = "Select * from prem_user_tbl where username = '$username' AND email = '$email' AND $password = '$password' ";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                header('location:premium_page.php');
                $_SESSION['name'] = $username;
                return $res;
            } else {
                header('location:../index.php');
                return false;
            }
            // $img = $_FILES['image']['name'];
            // $target = "user_img/". time().'_'.$img;
        }
        # code...
    }
}
$obj = new login;
$objLog = $obj->loginFunction();