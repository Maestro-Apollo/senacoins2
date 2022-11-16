<?php
include('../class/database.php');
class switchClass extends database
{
    protected $link;
    public function switchFunction()
    {
        $user = $_GET['user'];

        $sql2 = "select * from premium_user where username = '$user' ";
        $res2 = mysqli_query($this->link, $sql2);
        if ($res2) {
            $rowName = mysqli_fetch_assoc($res2);
            $fname = $rowName['fname'];
            $lname = $rowName['lname'];
            $email = $rowName['email'];
            $password = $rowName['password'];
            $address1 = $rowName['address1'];
            $country = $rowName['country'];
            $image = $rowName['image'];

            $sqlName = "select * from standard_user where username = '$user' ";

            $resName = mysqli_query($this->link, $sqlName);
            if (mysqli_num_rows($resName) > 0) {
                echo "Already In Standard Account";
            } else {
                $sql4 = "DELETE from premium_user where username = '$user' ";
                mysqli_query($this->link, $sql4);

                $sql3 = "INSERT INTO `standard_user` (`id`, `fname`, `lname`, `username`, `email`, `password`, `address1`, `address2`, `country`, `state`, `zip`, `image`) VALUES (NULL, '$fname', '$lname', '$user', '$email', '$password', '$address1', NULL, '$country', '', '', '$image')";
                mysqli_query($this->link, $sql3);



                header('location:premium_users_list.php');
            }
        } else {
            echo "Already in Standard Account";
        }
    }
}
$obj = new switchClass;
$objSwitch = $obj->switchFunction();