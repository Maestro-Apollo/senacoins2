<?php
include('../class/database.php');
class delete extends database
{
    protected $link;
    public function deleteFunction()
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM `data_tbl` WHERE `data_tbl`.`id` = $id";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return $res;
        } else {

            return false;
        }
        # code...
    }
}
$obj = new delete;
$objDelete = $obj->deleteFunction();