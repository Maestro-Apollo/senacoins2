<?php
include('../class/database.php');
class update extends database
{
    protected $link;
    public function updateFun()
    {
        if (isset($_POST['update'])) {
            $id = $_GET['id'];
            $type_of_coin = $_POST['type_of_coin'];
            $year = $_POST['year'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $sub_category = $_POST['sub_category'];
            $rarity = $_POST['rarity'];
            $reference = $_POST['reference'];
            $bb = $_POST['bb'];
            $spl = $_POST['spl'];
            $fdc = $_POST['fdc'];
            $ecz = $_POST['ecz'];
            $sql = "UPDATE `data_tbl` SET `type_of_coin`='$type_of_coin',`year`='$year',`description`='$description',`category`='$category',`sub_category`='$sub_category',`rarity`='$rarity',`reference`='$reference',`bb`='$bb',`spl`='$spl',`fdc`='$fdc',`ecz`='$ecz' WHERE $id";

            $res = mysqli_query($this->link, $sql);
            if ($res) {
                header('location:admin.php');
                echo "Updated";
                return $res;
            } else {
                echo "Not Updated";
                return false;
            }
        }
        # code...
    }
}
$obj = new update;
$objSub = $obj->updateFun();