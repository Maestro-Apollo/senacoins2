<?php
include('../class/database.php');
class search extends database
{
    public function searchFunction()
    {
        if (isset($_POST['username'])) {
            $user = addslashes(trim($_POST['username']));
            $sql1 = "SELECT * from premium_user where username = '$user' ";
            $res1 = mysqli_query($this->link, $sql1);
            $sql2 = "SELECT * from standard_user where username = '$user' ";
            $res2 = mysqli_query($this->link, $sql2);
            if (mysqli_num_rows($res1) > 0 || mysqli_num_rows($res2) > 0) {
                echo '<p class="text-success text-left font-weight-bold">Username matched!</p>';
            } else {
                echo '<p class="text-danger text-left font-weight-bold">Not Register User</p>';
            }
        }
        # code...
    }
}
$obj = new search;
echo $obj->searchFunction();