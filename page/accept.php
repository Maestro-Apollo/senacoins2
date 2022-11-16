<?php

include('../class/database.php');
class accept extends database
{
    protected $link;
    public function acceptFunction()
    {
        $id = $_GET['id'];
        $sql = "select * from request where id = $id";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $type_of_coin = $row['type_of_coin'];
            $year = $row['year'];
            $description = $row['description'];
            $category = $row['category'];
            $sub_category = $row['sub_category'];
            $rarity = $row['rarity'];
            $reference = $row['reference'];
            $bb = $row['bb'];
            $spl = $row['spl'];
            $fdc = $row['fdc'];
            $ecz = $row['ecz'];
            $insert = "INSERT INTO `data_tbl` (`id`, `type_of_coin`, `year`, `description`, `category`, `sub_category`, `rarity`, `reference`, `bb`, `spl`, `fdc`, `ecz`) VALUES (NULL, '$type_of_coin', '$year', '$description', '$category', '$sub_category', '$rarity', '$reference', '$bb', '$spl', '$fdc', '$ecz')";
            $fres = mysqli_query($this->link, $insert);
            echo "Accepted";
            if ($fres) {
                $del =  "DELETE FROM `request` WHERE `request`.`id` = $id";
                $res2 = mysqli_query($this->link, $del);
                if ($res2) {

                    header('location:request.php');

                    echo "Accepted";


                    return $res2;
                } else {

                    header('location:request.php');

                    echo "rejected";

                    return false;
                }
            }
        } else {

            return false;
        }

        # code...
    }
}
$obj = new accept;
$objAcc = $obj->acceptFunction();