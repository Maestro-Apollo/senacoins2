<?php

include('../class/database.php');
class reject extends database
{
    protected $link;
    public function rejectFunction()
    {
        $id = $_GET['id'];
        $sql = "select * from certificate_request where certificate_id = $id";
        $res = mysqli_query($this->link, $sql);
        if ($res) {

            $sql =  "UPDATE `certificate_request` SET `pending`= 1,`complete`= 1 WHERE coin_id = $id ";
            $res2 = mysqli_query($this->link, $sql);
            if ($res2) {
                header('location:certificate_request_list.php');
            }
        } else {

            return false;
        }

        # code...
    }
}
$obj = new reject;
$objRej = $obj->rejectFunction();