<?php
include('../class/database.php');
class delete extends database
{
    protected $link;
    public function deleteFunction()
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM `certificate_request` WHERE `certificate_request`.`coin_id` = $id";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return $res;
        } else {
            echo "Not Deleted";

            return false;
        }
        # code...
    }
}
$obj = new delete;
$objDelete = $obj->deleteFunction();