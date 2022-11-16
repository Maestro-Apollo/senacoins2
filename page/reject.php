<?php

include('../class/database.php');
class reject extends database
{
    protected $link;
    public function rejectFunction()
    {
        $id = $_GET['id'];
        $sql = "select * from request where id = $id";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            $del =  "DELETE FROM `request` WHERE `request`.`id` = $id";
            $res2 = mysqli_query($this->link, $del);
            header('location:request.php');
            return $res2;
        } else {

            return false;
        }

        # code...
    }
}
$obj = new reject;
$objRej = $obj->rejectFunction();