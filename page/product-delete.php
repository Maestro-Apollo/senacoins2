<?php
session_start();
include('../class/database.php');
class update extends database
{
    public function marketPlace()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM `market_tbl` WHERE `market_tbl`.`market_coin_id` = $id";
            $res = mysqli_query($this->link, $sql);
            if ($res) {
                header('location:sells-list.php');
            } else {
                return false;
            }
        }
        # code...
    }
}
$obj = new update;
echo $objInsert = $obj->marketPlace();