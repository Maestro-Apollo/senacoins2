<?php
session_start();
include('../class/database.php');
class update extends database
{
    public function marketPlace()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $username = $_SESSION['name'];
            $sqlFind = "SELECT * from market_tbl where market_coin_id = $id ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                $sqlFind = "SELECT * from data_tbl where id = $id AND user = '$username' ";
                $resFind = mysqli_query($this->link, $sqlFind);
                if (mysqli_num_rows($resFind) > 0) {


                    $details = addslashes(trim($_POST['details']));
                    $price = addslashes(trim($_POST['price']));
                    $country = addslashes(trim($_POST['country']));
                    $city = addslashes(trim($_POST['city']));
                    $s_price = addslashes(trim($_POST['s_price']));

                    $email = addslashes(trim($_POST['email']));
                    $phone = addslashes(trim($_POST['phone']));
                    $whatsapp = addslashes(trim($_POST['whatsapp']));

                    $sql = "UPDATE `market_tbl` SET `title`='',`details`='$details',`price`='$price',`remotely`='',`city`='$city',`country`='$country',`shipping_price`='$s_price',`email`='$email',`phone`='$phone',`whatsapp`='$whatsapp' WHERE `market_coin_id` = $id";
                    $res = mysqli_query($this->link, $sql);
                    if ($res) {
                        $msg = '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Successfully Updated</strong>
  </div>';
                        return $msg;
                    }
                } else {
                    $msg = '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>You are not the owner of this coin</strong>
                  </div>';
                    return $msg;
                }
            } else {
                $msg = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Coin is in the marketplace</strong>
              </div>';
                return $msg;
            }
        }
        # code...
    }
}
$obj = new update;
echo $objInsert = $obj->marketPlace();