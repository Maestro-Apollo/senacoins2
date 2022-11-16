<?php
include '../class/database.php';
class standard extends database
{

    protected $link;

    public function sUserfunction()
    {
        $name = $_GET['name'];
        $sql = "select id, cod_cat, type_of_coin , year , description , category , sub_category, reference, image from data_tbl where timeperiod = '$name'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new standard;
$objsUser = $obj->sUserfunction();