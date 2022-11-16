<?php


class message extends database
{
    protected $link;
    public function msgFunction()
    {
        if (isset($_POST['submit'])) {
            $img = $_POST['img'];
            $img2 = $_POST['img2'];
            $img3 = $_POST['img3'];
            $img4 = $_POST['img4'];
            $img5 = $_POST['img5'];
            $name = $_POST['username'];
            $type_of_coin = $_POST['type_of_coin'];
            $date = $_POST['date'];
            $msg = "Hello " . $name . "! <br>" .    addslashes($_POST['msg']);
            $sql = "INSERT INTO `message` (`id`, `message`, `user`, `type_of_coin`, `image`, `image2`, `image3`, `image4`, `image5`, `date`) VALUES (NULL, '$msg', '$name', '$type_of_coin', '$img', '$img2', '$img3', '$img4', '$img5', '$date')";
            $res = mysqli_query($this->link, $sql);
            if ($res) {
                $sql2 =   "DELETE FROM `request` WHERE `request`.`user` = '$name' AND  `request`.`date` = '$date' ";
                $res2 = mysqli_query($this->link, $sql2);
                return $res2;
                header('location:request.php');
            } else {

                return false;
            }
        }
        # code...
    }
}
$obj = new message;
$objMsg = $obj->msgFunction();