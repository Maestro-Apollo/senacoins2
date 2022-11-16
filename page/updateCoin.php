<?php
class update extends database
{
    protected $link;
    public function updateFun()
    {
        if (isset($_POST['update'])) {
            $id = $_GET['id'];
            $img = time() . '_' . $_FILES['image']['name'];
            $img2 = time() . '_' . $_FILES['image2']['name'];
            $img3 = time() . '_' . $_FILES['image3']['name'];
            $img4 = time() . '_' . $_FILES['image4']['name'];
            $img5 = time() . '_' . $_FILES['image5']['name'];
            // $video = time() . '_' . $_FILES['video']['name'];
            $type_of_coin = $_POST['type_of_coin'];
            $year = $_POST['year'];
            $code = addslashes($_POST['code']);
            $description = addslashes($_POST['description']);
            $category = addslashes($_POST['category']);
            $sub_category = addslashes($_POST['sub_category']);
            $rarity = $_POST['rarity'];
            $reference = $_POST['reference'];
            $bb = $_POST['bb'];
            $spl = $_POST['spl'];
            $fdc = $_POST['fdc'];
            $ecz = $_POST['ecz'];
            $his_period = $_POST['his_period'];
            $target = '../coin_img/' . $img;
            $target2 = '../coin_img/' . $img2;
            $target3 = '../coin_img/' . $img3;
            $target4 = '../coin_img/' . $img4;
            $target5 = '../coin_img/' . $img5;
            // $targetV = '../video/' . $video;

            if (strcmp($his_period, 'UNIONE EUROPEA') == 0) {
                if ($_FILES['image']['name'] == '' && $_FILES['image2']['name'] == '' && $_FILES['image3']['name'] == '' && $_FILES['image4']['name'] == '' && $_FILES['image5']['name'] == '') {
                    $sql = "UPDATE `data_tbl` SET `type_of_coin`='$type_of_coin', `cod_cat` = '$code', `year`='$year',`description`='$description',`category`='$category',`sub_category`='$sub_category',`rarity`='$rarity',`reference`='$reference',`bb`='$spl',`spl`='$fdc',`fdc`='$ecz',`ecz`='',`mb`='$bb' WHERE id = $id";
                } else {
                    $sql = "UPDATE `data_tbl` SET `type_of_coin`='$type_of_coin',`cod_cat` = '$code',`year`='$year',`description`='$description',`category`='$category',`sub_category`='$sub_category',`rarity`='$rarity',`reference`='$reference',`bb`='$spl',`spl`='$fdc',`fdc`='$ecz',`ecz`='',`mb`='$bb',`image`='$img',`image2`='$img2',`image3`='$img3',`image4`='$img4',`image5`='$img5' WHERE id = $id";
                }
            } else {
                $mb = $_POST['mb'];

                if ($_FILES['image']['name'] == '' && $_FILES['image2']['name'] == '' && $_FILES['image3']['name'] == '' && $_FILES['image4']['name'] == '' && $_FILES['image5']['name'] == '') {
                    $sql = "UPDATE `data_tbl` SET `type_of_coin`='$type_of_coin',`cod_cat` = '$code',`year`='$year',`description`='$description',`category`='$category',`sub_category`='$sub_category',`rarity`='$rarity',`reference`='$reference',`bb`='$bb',`spl`='$spl',`fdc`='$fdc',`mb`='$mb',`ecz`='$ecz' WHERE id = $id";
                } else {
                    $sql = "UPDATE `data_tbl` SET `type_of_coin`='$type_of_coin',`cod_cat` = '$code',`year`='$year',`description`='$description',`category`='$category',`sub_category`='$sub_category',`rarity`='$rarity',`reference`='$reference',`bb`='$bb',`spl`='$spl',`fdc`='$fdc',`mb`='$mb',`ecz`='$ecz',`image`='$img',`image2`='$img2',`image3`='$img3',`image4`='$img4',`image5`='$img5' WHERE id = $id";
                }
            }





            $res = mysqli_query($this->link, $sql);
            if ($res) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                move_uploaded_file($_FILES['image2']['tmp_name'], $target2);
                move_uploaded_file($_FILES['image3']['tmp_name'], $target3);
                move_uploaded_file($_FILES['image4']['tmp_name'], $target4);
                move_uploaded_file($_FILES['image5']['tmp_name'], $target5);
                // move_uploaded_file($_FILES['video']['tmp_name'], $targetV);

                $sqlUp = "select * from coin_data where item_id = '$id' ";
                $resUp = mysqli_query($this->link, $sqlUp);
                if (mysqli_num_rows($resUp) > 0) {
                    if ($_FILES['image']['name'] == '' && $_FILES['image2']['name'] == '' && $_FILES['image3']['name'] == '' && $_FILES['image4']['name'] == '' && $_FILES['image5']['name'] == '') {
                        $sql2 = "UPDATE `coin_data` SET  `description`='$description' WHERE `item_id` = '$id' ";
                    } else {
                        $sql2 = "UPDATE `coin_data` SET `image`='$img',`image1`='$img2',`image2`='$img3',`image3`='$img4',`image4`='$img5',`video`=NULL, `description`='$description' WHERE `item_id` = '$id' ";
                    }
                } else {
                    $sql2 = "INSERT INTO `coin_data` ( `image`, `image1`, `image2`, `image3`, `image4`, `video`, `item_id`, `description`) VALUES ( '$img', '$img2', '$img3', '$img4', '$img5', '', '$id', '$description')";
                }

                // $sql2 = "INSERT INTO `coin_data` ( `image`,`image1`,`image2`,`image3`,`image4`, `item_id`,`description`) VALUES ( '$img','$img2','$img3','$img4','$img5', '$id', '$description')";
                // $res2 = mysqli_query($this->link, $sql2);


                $res2 = mysqli_query($this->link, $sql2);

                if ($res2) {
                    // echo "Updated";
                    return $res;
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                } else {
                    return false;
                }
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