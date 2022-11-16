<?php
include 'database.php';
class viewData extends database
{
    public function viewFunction()
    {
        $sql = "select * from user_tbl";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            return $res;
        } else {
            return false;
        }

        # code...
    }
}
$obj = new viewData;
$objView = $obj->viewFunction();