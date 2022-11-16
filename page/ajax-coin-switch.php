<?php
session_start();
include('../class/database.php');
class search extends database
{
    public function searchFunction()
    {
        if ($_POST['username'] === '') {
            return '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Please find user!</strong>
          </div>';
        }
        if (isset($_POST['username'])) {
            $main_user = $_SESSION['name'];
            $user = addslashes(trim($_POST['username']));
            $reference = addslashes(trim($_POST['reference']));
            $id = $_POST['id'];
            $market_id = $_POST['market_id'];
            $sql1 = "SELECT * from premium_user where username = '$user' ";
            $res1 = mysqli_query($this->link, $sql1);
            $sql2 = "SELECT * from standard_user where username = '$user' ";
            $res2 = mysqli_query($this->link, $sql2);
            if (mysqli_num_rows($res1) > 0 || mysqli_num_rows($res2) > 0) {

                $sqlFind = "SELECT * from market_tbl where username = '$main_user' AND market_id = $market_id AND market_coin_id = $id ";
                $resFind = mysqli_query($this->link, $sqlFind);
                if (mysqli_num_rows($resFind) > 0) {
                    $sql = "UPDATE data_tbl SET user = '$user', reference = '$reference' where id = $id ";
                    $res = mysqli_query($this->link, $sql);
                    if ($res) {
                        $sql3 = "DELETE FROM `market_tbl` WHERE `market_tbl`.`market_id` = '$market_id'";
                        $res3 = mysqli_query($this->link, $sql3);
                        if ($res3) {
                            return ' <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong>
                          </div>';
                        } else {
                            return false;
                        }
                    } else {
                        return '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Your coin is not in marketplace!</strong>
                      </div>';
                    }
                } else {
                    return '<div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Your coin is switched to new user</strong>
                      </div>';
                }
            } else {
                return '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>User not found!</strong>
              </div>';
            }
        }
        # code...
    }
}
$obj = new search;
echo $obj->searchFunction();