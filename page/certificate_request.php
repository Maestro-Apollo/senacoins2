<?php
session_start();
include '../class/database.php';
if (isset($_SESSION['name'])) {
} else {
    header('location:../index.php');
}
class certificate extends database
{
    public function addFunction()
    {
        if (isset($_POST['id'])) {
            $user = $_SESSION['name'];
            $id = $_POST['id'];
            $details = addslashes(trim($_POST['details']));
            $taken = 0;
            $time = gmdate("l jS \of F Y h:i:s A");
            $sqlFind = "SELECT * from certificate_request where coin_id = $id AND pending = 0 ";
            $resFind = mysqli_query($this->link, $sqlFind);
            $sqlFind2 = "SELECT * from certificate_request where coin_id = $id AND complete = 1 ";
            $resFind2 = mysqli_query($this->link, $sqlFind2);
            if (mysqli_num_rows($resFind) > 0) {
                return '<div class="alert alert-warning" role="alert">
                Pending
              </div>';
            } else if (mysqli_num_rows($resFind2) > 0) {
                return '<div class="alert alert-primary" role="alert">
                Registered
              </div>';
            } else {
                $sql = "INSERT INTO `certificate_request` (`certificate_id`, `username`, `coin_id`, `pending`,`complete`,`submission_date`,`details`) VALUES (NULL, '$user', '$id', '$taken', 0,'$time','$details')";
                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    return '<div class="alert alert-success" role="alert">
                    Thank you! It is now reviewed by admin
                  </div>';
                } else {
                    return '<div class="alert alert-danger" role="alert">
                    Not Added
                  </div>';
                }
            }
        }


        # code...
    }
}
$obj = new certificate;
echo $objCer = $obj->addFunction();