<?php
include('../class/database.php');
class deleteReturn extends database
{
    protected $link;
    public function deleteReturnFunction()
    {
        $id = $_GET['id'];
        $sql = "Delete from return_msg where id = '$id' ";
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
$obj = new deleteReturn;
$ObjReturn = $obj->deleteReturnFunction();