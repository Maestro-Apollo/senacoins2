<?php
session_start();
include('../class/database.php');
if (isset($_SESSION['admin_user'])) {
} else {
    header('location:../index.php');
}
include 'message.php';
class request extends database
{
    protected $link;
    public function requestFunctionP()
    {
        $sql = "SELECT certificate_request.*,data_tbl.*,premium_user.email FROM `certificate_request` LEFT JOIN data_tbl ON certificate_request.coin_id = data_tbl.id INNER JOIN premium_user ON certificate_request.username = premium_user.username where certificate_request.pending = 0 AND certificate_request.complete = 0";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }

        # code...
    }
    public function requestFunctionS()
    {
        $sql = "SELECT certificate_request.*,data_tbl.*,standard_user.email FROM `certificate_request` LEFT JOIN data_tbl ON certificate_request.coin_id = data_tbl.id INNER JOIN standard_user ON certificate_request.username = standard_user.username where certificate_request.pending = 0 AND certificate_request.complete = 0";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }

        # code...
    }
}
$obj = new request;
$objResP = $obj->requestFunctionP();
$objResS = $obj->requestFunctionS();
?>
<?php

class insertData extends database
{
    protected $link;
    public function insertFunction()
    {

        if (isset($_POST['accept'])) {
            $country = $_POST['country'];
            $his_period = $_POST['his_period'];
            $type_of_coin = $_POST['type_of_coin'];
            $year = $_POST['year'];
            $description = addslashes($_POST['description']);
            $category = addslashes($_POST['category']);
            $sub_category = addslashes($_POST['sub_category']);
            $reference = addslashes($_POST['reference']);
            $img = $_POST['img'];
            $img2 = $_POST['img2'];
            $img3 = $_POST['img3'];
            $img4 = $_POST['img4'];
            $img5 = $_POST['img5'];
            $user = $_POST['user'];
            $date = $_POST['date'];
            $mb = $_POST['mb'];
            $bb = $_POST['bb'];
            $spl = $_POST['spl'];
            $fdc = $_POST['fdc'];
            $ecz = $_POST['ecz'];
            $rarity = $_POST['rarity'];

            if (strcmp($his_period, 'UNIONE EUROPEA') == 0) {
                $sql = "INSERT INTO `data_tbl` (`id`, `cod_cat`, `type_of_coin`, `year`, `description`, `category`, `sub_category`, `rarity`, `reference`, `mb`, `bb`, `spl`, `fdc`, `ecz`, `timeperiod`, `code`, `image`, `image2`, `image3`, `image4`, `image5`, `user`) VALUES (NULL, NULL, '$type_of_coin', '$year', '$description', '$category', '$sub_category', '$rarity', '$reference', '$bb', '$spl', '$fdc', '$ecz', '', '$his_period', '$country', '$img', '$img2', '$img3', '$img4', '$img5', '$user')";
            } else {
                $sql = "INSERT INTO `data_tbl` (`id`, `cod_cat`, `type_of_coin`, `year`, `description`, `category`, `sub_category`, `rarity`, `reference`, `mb`, `bb`, `spl`, `fdc`, `ecz`, `timeperiod`, `code`, `image`, `image2`, `image3`, `image4`, `image5`, `user`) VALUES (NULL, NULL, '$type_of_coin', '$year', '$description', '$category', '$sub_category', '$rarity', '$reference', '$mb', '$bb', '$spl', '$fdc', '$ecz', '$his_period', '$country', '$img', '$img2', '$img3', '$img4', '$img5', '$user')";
            }


            $res = mysqli_query($this->link, $sql);
            if ($res) {

                $sqlFind = "select * from data_tbl where type_of_coin = '$type_of_coin' AND category = '$category' AND sub_category = '$sub_category' AND timeperiod = '$his_period' AND user = '$user'  AND image = '$img' ";
                $resFind = mysqli_query($this->link, $sqlFind);
                $rowFind = mysqli_fetch_assoc($resFind);

                $item_id = $rowFind['id'];

                $sqlRecord = "INSERT INTO `data_record` (`record_id`, `item_id`, `created`) VALUES (NULL, '$item_id', CURRENT_TIMESTAMP)";
                mysqli_query($this->link, $sqlRecord);


                $sqlC = "INSERT INTO `coin_data` (`id`, `image`, `image1`, `image2`, `image3`, `image4`, `video`, `item_id`, `description`) VALUES (NULL, '$img', '$img2', '$img3', '$img4', '$img5', '', '$item_id', '$description')";
                $resC = mysqli_query($this->link, $sqlC);
                if ($resC) {
                } else {
                    return false;
                }




                $del = "DELETE FROM `request` WHERE user = '$user' AND  `request`.`historical period` = '$his_period' AND type_of_coin = '$type_of_coin' AND `date` = '$date' ";
                $resD = mysqli_query($this->link, $del);
                if ($resD) {
                    $msg = "Your coin is Accepted! Thank you!";
                    $sql4 = "INSERT INTO `return_msg` (`id`, `user`, `msg`) VALUES (NULL, '$user', '$msg')";
                    $res4 = mysqli_query($this->link, $sql4);
                    if ($res4) {
                        header('location:request.php');
                        return $msg;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                echo "Not Added";
                return false;
            }
        }
        # code...
    }
}
$Objin = new insertData;
$ObjInsert = $Objin->insertFunction();


?>
<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minterrordatabase.com</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body style="background-color: #1c1d26">
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container">
            <a class="navbar-brand text-light" href="../index.php"></a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="javascript:history.back()">Home <span
                                class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>




    <section>
        <?php if ($objResP) { ?>
        <?php while ($row = mysqli_fetch_assoc($objResP)) { ?>
        <div class="jumbotron text-center">
            <form action="" method="post">

                <div class="row">
                    <div class="col-md-6 text-center">
                        <input name="user" style="background-color: #fff"
                            class=" mx-auto mb-3 text-center form-control w-50" value="<?php echo $row['user']; ?>"
                            readonly>
                        <input style="background-color: #fff" class=" mx-auto mb-3 text-center form-control w-50"
                            value="<?php echo $row['email']; ?>" readonly>
                        <input type="text" style="visibility: hidden;
                        position:absolute" name="img" value="<?php echo $row['image']; ?>">
                        <input type="text" style="visibility: hidden;
                        position:absolute" name="img2" value="<?php echo $row['image2']; ?>">
                        <input type="text" style="visibility: hidden;
                        position:absolute" name="img3" value="<?php echo $row['image3']; ?>">
                        <input type="text" style="visibility: hidden;
                        position:absolute" name="img4" value="<?php echo $row['image4']; ?>">
                        <input type="text" style="visibility: hidden;
                        position:absolute" name="img5" value="<?php echo $row['image5']; ?>">

                        <img style="width: 40%;" src="../coin_img/<?php echo $row['image']; ?>" class="block__pic"
                            alt="" data-title="<?php echo $row['type_of_coin'];  ?>"
                            data-help="<?php echo $row['timeperiod'];  ?>">
                        <img style="width: 40%;" src="../coin_img/<?php echo $row['image2']; ?>" class="block__pic"
                            alt="" data-title="<?php echo $row['type_of_coin'];  ?>"
                            data-help="<?php echo $row['timeperiod'];  ?>">
                        <img style="width: 40%;" src="../coin_img/<?php echo $row['image3']; ?>" class="block__pic"
                            alt="" data-title="<?php echo $row['type_of_coin'];  ?>"
                            data-help="<?php echo $row['timeperiod'];  ?>">
                        <img style="width: 40%;" src="../coin_img/<?php echo $row['image4']; ?>" class="block__pic"
                            alt="" data-title="<?php echo $row['type_of_coin'];  ?>"
                            data-help="<?php echo $row['timeperiod'];  ?>">
                        <img style="width: 40%;" src="../coin_img/<?php echo $row['image5']; ?>" class="block__pic"
                            alt="" data-title="<?php echo $row['type_of_coin'];  ?>"
                            data-help="<?php echo $row['timeperiod'];  ?>">
                        <textarea name="" class="form-control w-75 mx-auto mt-4 bg-white" id="" cols="30" rows="10"
                            readonly><?php echo $row['details'];  ?></textarea>
                    </div>
                    <div class="col-md-6 text-left">

                        <div class="row">
                            <div class="col-md-6">

                                <label for="">Country</label>

                                <input name="country" type="text" class="form-control mb-3"
                                    value="<?php echo $row['code']; ?>">
                                <label for="">Historical Period</label>

                                <input name="his_period" type="text" class="form-control mb-3"
                                    value="<?php echo $row['timeperiod']; ?>">
                                <label for="">Type Of Coin</label>

                                <input name="type_of_coin" type="text" class="form-control mb-3"
                                    value="<?php echo $row['type_of_coin']; ?>">
                                <label for="">Year</label>

                                <input name="year" type="text" class="form-control mb-3"
                                    value="<?php echo $row['year']; ?>">
                                <label for="">MB</label>

                                <input name="mb" type="text" class="form-control mb-3"
                                    value="<?php echo $row['mb']; ?>">
                                <label for="">Rarity</label>

                                <input name="rarity" type="text" class="form-control mb-3"
                                    value="<?php echo $row['rarity']; ?>">
                                <label for="">SPL</label>

                                <input name="spl" type="text" class="form-control mb-3"
                                    value="<?php echo $row['spl']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="">Description</label>

                                <input name="description" type="text" class="form-control mb-3"
                                    value="<?php echo $row['description']; ?>">
                                <label for="">Category</label>

                                <input name="category" type="text" class="form-control mb-3"
                                    value="<?php echo $row['category']; ?>">
                                <label for="">Sub Category</label>

                                <input name="sub_category" type="text" class="form-control mb-3"
                                    value="<?php echo $row['sub_category']; ?>">
                                <label for="">Reference</label>

                                <input name="reference" type="text" class="form-control mb-3"
                                    value="<?php echo $row['reference']; ?>">
                                <label for="">BB</label>

                                <input name="bb" type="text" class="form-control mb-3"
                                    value="<?php echo $row['bb']; ?>">
                                <label for="">FDC</label>

                                <input name="fdc" type="text" class="form-control mb-3"
                                    value="<?php echo $row['fdc']; ?>">

                                <label for="">ECZ</label>

                                <input name="ecz" type="text" class="form-control mb-3"
                                    value="<?php echo $row['ecz']; ?>">

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <p style="margin-bottom: 8px; ">Submitted Date</p>
                                <input type="text" name="date" class="form-control" style="background-color:#fff"
                                    value="<?php echo $row['submission_date']; ?>" readonly>
                            </div>
                        </div>



                    </div>
                </div>



                <hr class="my-4">

                <a class="btn btn-success btn-lg" href="complete.php?id=<?php echo $row['id']; ?>">Mark as Complete</a>
                <a class="btn btn-danger btn-lg" href="delete_certificate.php?id=<?php echo $row['id']; ?>">Reject</a>
                <!-- <a class="btn btn-danger btn-lg" href="mailto:<?php echo $row['email']; ?>">Email</a> -->





            </form>

        </div>
        <?php } ?>
        <?php }
        if ($objResS) { ?>
        <?php while ($row = mysqli_fetch_assoc($objResS)) { ?>
        <div class="jumbotron text-center">
            <form action="" method="post">

                <div class="row">
                    <div class="col-md-6 text-center">
                        <input name="user" style="background-color: #fff"
                            class=" mx-auto mb-3 text-center form-control w-50" value="<?php echo $row['user']; ?>"
                            readonly>
                        <input style="background-color: #fff" class=" mx-auto mb-3 text-center form-control w-50"
                            value="<?php echo $row['email']; ?>" readonly>
                        <input type="text" style="visibility: hidden;
                        position:absolute" name="img" value="<?php echo $row['image']; ?>">
                        <input type="text" style="visibility: hidden;
                        position:absolute" name="img2" value="<?php echo $row['image2']; ?>">
                        <input type="text" style="visibility: hidden;
                        position:absolute" name="img3" value="<?php echo $row['image3']; ?>">
                        <input type="text" style="visibility: hidden;
                        position:absolute" name="img4" value="<?php echo $row['image4']; ?>">
                        <input type="text" style="visibility: hidden;
                        position:absolute" name="img5" value="<?php echo $row['image5']; ?>">

                        <img style="width: 40%;" src="../coin_img/<?php echo $row['image']; ?>" class="block__pic"
                            alt="" data-title="<?php echo $row['type_of_coin'];  ?>"
                            data-help="<?php echo $row['timeperiod'];  ?>">
                        <img style="width: 40%;" src="../coin_img/<?php echo $row['image2']; ?>" class="block__pic"
                            alt="" data-title="<?php echo $row['type_of_coin'];  ?>"
                            data-help="<?php echo $row['timeperiod'];  ?>">
                        <img style="width: 40%;" src="../coin_img/<?php echo $row['image3']; ?>" class="block__pic"
                            alt="" data-title="<?php echo $row['type_of_coin'];  ?>"
                            data-help="<?php echo $row['timeperiod'];  ?>">
                        <img style="width: 40%;" src="../coin_img/<?php echo $row['image4']; ?>" class="block__pic"
                            alt="" data-title="<?php echo $row['type_of_coin'];  ?>"
                            data-help="<?php echo $row['timeperiod'];  ?>">
                        <img style="width: 40%;" src="../coin_img/<?php echo $row['image5']; ?>" class="block__pic"
                            alt="" data-title="<?php echo $row['type_of_coin'];  ?>"
                            data-help="<?php echo $row['timeperiod'];  ?>">
                        <textarea name="" class="form-control w-75 mx-auto mt-4 bg-white" id="" cols="30" rows="10"
                            readonly><?php echo $row['details'];  ?></textarea>
                    </div>
                    <div class="col-md-6 text-left">

                        <div class="row">
                            <div class="col-md-6">

                                <label for="">Country</label>

                                <input name="country" type="text" class="form-control mb-3"
                                    value="<?php echo $row['code']; ?>">
                                <label for="">Historical Period</label>

                                <input name="his_period" type="text" class="form-control mb-3"
                                    value="<?php echo $row['timeperiod']; ?>">
                                <label for="">Type Of Coin</label>

                                <input name="type_of_coin" type="text" class="form-control mb-3"
                                    value="<?php echo $row['type_of_coin']; ?>">
                                <label for="">Year</label>

                                <input name="year" type="text" class="form-control mb-3"
                                    value="<?php echo $row['year']; ?>">
                                <label for="">MB</label>

                                <input name="mb" type="text" class="form-control mb-3"
                                    value="<?php echo $row['mb']; ?>">
                                <label for="">Rarity</label>

                                <input name="rarity" type="text" class="form-control mb-3"
                                    value="<?php echo $row['rarity']; ?>">
                                <label for="">SPL</label>

                                <input name="spl" type="text" class="form-control mb-3"
                                    value="<?php echo $row['spl']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="">Description</label>

                                <input name="description" type="text" class="form-control mb-3"
                                    value="<?php echo $row['description']; ?>">
                                <label for="">Category</label>

                                <input name="category" type="text" class="form-control mb-3"
                                    value="<?php echo $row['category']; ?>">
                                <label for="">Sub Category</label>

                                <input name="sub_category" type="text" class="form-control mb-3"
                                    value="<?php echo $row['sub_category']; ?>">
                                <label for="">Reference</label>

                                <input name="reference" type="text" class="form-control mb-3"
                                    value="<?php echo $row['reference']; ?>">
                                <label for="">BB</label>

                                <input name="bb" type="text" class="form-control mb-3"
                                    value="<?php echo $row['bb']; ?>">
                                <label for="">FDC</label>

                                <input name="fdc" type="text" class="form-control mb-3"
                                    value="<?php echo $row['fdc']; ?>">

                                <label for="">ECZ</label>

                                <input name="ecz" type="text" class="form-control mb-3"
                                    value="<?php echo $row['ecz']; ?>">

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <p style="margin-bottom: 8px; ">Submitted Date</p>
                                <input type="text" name="date" class="form-control" style="background-color:#fff"
                                    value="<?php echo $row['submission_date']; ?>" readonly>
                            </div>
                        </div>



                    </div>
                </div>



                <hr class="my-4">

                <a class="btn btn-success btn-lg" href="complete.php?id=<?php echo $row['id']; ?>">Mark as Complete</a>
                <a class="btn btn-danger btn-lg" href="delete_certificate.php?id=<?php echo $row['id']; ?>">Reject</a>
                <!-- <a class="btn btn-danger btn-lg" href="mailto:<?php echo $row['email']; ?>">Email</a> -->





            </form>

        </div>
        <?php } ?>

        <?php } else { ?>
        <div class="jumbotron text-center">

            <h1 class="display-4">No pending requests.</h1>

            <hr class="my-4">


        </div>

        <?php } ?>
    </section>









    <script src="../js/jquery-3.3.1.min.js">
    </script>
    <script src="../js/popper.min.js">
    </script>
    <script src="../js/bootstrap.min.js">
    </script>
    <script src="../js/zoomsl.js"></script>
    <script>
    $(document).ready(function() {
        $(".block__pic").imagezoomsl({
            zoomrange: [1, 10],
            cursorshadeborder: '5px solid #000',
            magnifiereffectanimate: 'fadeIn',
            magnifierpos: 'left'
        });
    });
    </script>






</body>

</html>