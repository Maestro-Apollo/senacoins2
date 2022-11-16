<?php
// Turn off error reporting
error_reporting(0);
session_start();


include '../class/database.php';
class coinImg extends database
{

    public function coinFunction()
    {
        $id = $_GET['id'];
        $sql = "SELECT * from data_tbl where id = $id";
        // $sql = "SELECT * from coin_data where item_id = $id ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function switchFunction()
    {
        if (isset($_POST['switch'])) {
            $id = $_GET['id'];
            $user = addslashes(trim($_POST['user']));
            $table = addslashes(trim($_POST['table']));
            $country = addslashes(trim($_POST['country']));

            $sql = "UPDATE `data_tbl` SET `timeperiod` = '$table', user = '$user', code = '$country' WHERE id = $id";
            $res = mysqli_query($this->link, $sql);
            if ($res) {
                header('location:coinswitch.php?id=' . $_GET['id']);
            } else {
                $msg = '<div class="alert w-50 mx-auto  alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong>
              </div>';
                return $msg;
            }
        }

        # code...
    }
}
$obj = new coinImg;
$objFind = $obj->coinFunction();
$objSwitch = $obj->switchFunction();
$row = mysqli_fetch_assoc($objFind);

?>
<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>© Sena Coins - All rights reserved.</title>

    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <style>
    body,
    h1,
    h3,
    p,
    span,
    a,
    button {
        font-family: 'Roboto', sans-serif;
    }

    #footer {
        background: #272833;
        padding: 6em 0;
        text-align: center;
    }

    #footer .icons .icon.alt {
        text-decoration: none;
    }

    #footer .icons .icon.alt:before {
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
        text-transform: none !important;
        font-family: 'Font Awesome 5 Free';
        font-weight: 400;
    }

    #footer .icons .icon.alt:before {
        color: #272833 !important;
        text-shadow: 1px 0 0 rgba(255, 255, 255, 0.5), -1px 0 0 rgba(255, 255, 255, 0.5), 0 1px 0 rgba(255, 255, 255, 0.5), 0 -1px 0 rgba(255, 255, 255, 0.5);
    }

    #footer .copyright {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.8em;
        line-height: 1em;
        margin: 2em 0 0 0;
        padding: 0;
        text-align: center;
    }

    #footer .copyright li {
        border-left: solid 1px rgba(255, 255, 255, 0.3);
        display: inline-block;
        list-style: none;
        margin-left: 1.5em;
        padding-left: 1.5em;
    }

    #footer .copyright li:first-child {
        border-left: 0;
        margin-left: 0;
        padding-left: 0;
    }

    #footer .copyright li a {
        color: inherit;
    }

    .icon {
        text-decoration: none;
        border-bottom: none;
        position: relative;
    }

    .icon:before {
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
        text-transform: none !important;
        font-family: 'Font Awesome 5 Free';
        font-weight: 400;
    }

    @media (max-width: 575.98px) {
        .title {
            font-size: 30px;
        }

        .title2 {
            font-size: 24px;
        }
    }
    </style>
</head>

<body style=" background-color: #1c1d26" onselectstart='return false;'>

    <div class="p-5 text-white text-center">
        <form action="" method="post">
            <h1 class="text-white">Coin ID <?php echo $_GET['id']; ?></h1>
            <div class="text-center">
                <?php if ($objSwitch) { ?>
                <?php echo $objSwitch; ?>
                <?php } ?>
            </div>
            <h3 class="mt-5">Current owner and database</h3>
            <input type="text" class="form-control w-50 d-block mx-auto" placeholder="Current database"
                value="<?php echo $row['timeperiod']; ?>" readonly>
            <input type="text" class="form-control w-50 d-block mx-auto mt-4" placeholder="Current Owner"
                value="<?php echo $row['user']; ?>" readonly>
            <input type="text" class="form-control w-50 d-block mx-auto mt-4" placeholder="Current country"
                value="<?php echo $row['code']; ?>" readonly>
            <h3 class="mt-5">New owner and database</h3>
            <input type="text" name="table" class="form-control w-50 d-block mx-auto" placeholder="New database">
            <input type="text" name="user" class="form-control w-50 d-block mx-auto mt-4" placeholder="New Owner">
            <input type="text" name="country" class="form-control w-50 d-block mx-auto mt-4" placeholder="New country"
                required>
            <input type="submit" name="switch" class="btn font-weight-bold mt-4 btn-lg btn-info" value="Switch">

        </form>



    </div>
    <footer id="footer">
        <div style="margin-bottom:40px">
            <a href="files/minterrordatabase.com - Termini e condizioni del servizio.pdf" target="__blank"
                style="color: #fff;font-weight:600;text-decoration:none;margin-left:20px;margin-right:20px">Terms
                &
                Conditions</a>
            <a href="files/Website_Privacy_Policy_Final.pdf" target="__blank"
                style="color: #fff;font-weight:600;text-decoration:none;margin-left:20px;margin-right:20px">Privacy
                Policy</a>
        </div>
        <ul class="icons">

            <a href="https://www.facebook.com/groups/856622304511279/" class="text-white ml-3 mr-3"><i
                    class="fab fa-facebook-f fa-2x"></i></a>
            <a href="#" class="text-white ml-3 mr-3"><i class="fab fa-2x fa-instagram"></i></a>
            <a href="#" class="text-white ml-3 mr-3"><i class="fas fa-envelope fa-2x"></i></a>


        </ul>
        <ul class="copyright">
            <p class="Copyright">Piattaforma a cura di Alessio Sena - Perito numismatico Specializzato in errori di
                coniazione</p>
            <p>C.C.I.A.A. di Roma, Italia - Iscrizione ruolo N° 2447</p>
            <p>© 2020-2021 Sena Coins - Tutti i diritti riservati</p>
        </ul>
    </footer>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/zoomsl.js"></script>
    <script src="../js/textyle.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".block__pic").imagezoomsl({
            zoomrange: [1, 10],
            cursorshadeborder: '5px solid #000',
            magnifiereffectanimate: 'fadeIn',
            magnifierpos: 'right'
        });
    });
    </script>

    <script>
    document.addEventListener("contextmenu", function(prevent) {
        prevent.preventDefault();
    })
    </script>
    <script>
    $('.demo').textyle({
        callback: function() {

            $(this).css({
                color: 'gold',
                transition: '1s',
                easing: 'swing'

                // more css here
            });
        }
    });
    </script>

</body>

</html>