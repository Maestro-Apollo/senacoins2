<?php
session_start();
if ($_SESSION['name']) {
} else {
    header('location:../index.php');
}
include('../class/database.php');
class sellerCoinSwitch extends database
{
    public function sellerFunction()
    {
        $id = $_GET['id'];
        $market_id = $_GET['market_id'];
        $username = $_SESSION['name'];
        $sqlFind = "SELECT * from market_tbl where market_coin_id = $id AND username = '$username' AND market_id = $market_id ";
        $resFind = mysqli_query($this->link, $sqlFind);
        if (mysqli_num_rows($resFind) == 0) {
            $msg = '<div class="jumbotron jumbotron-fluid bg-danger">
            <div class="container">
              <h1 class="display-4 text-white text-center">This is not your coin</h1>
            </div>
          </div>';
            return $msg;
        }
        # code...
    }
}
$obj = new sellerCoinSwitch;
$objSwitch = $obj->sellerFunction();


?>

<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minterrordatabase.com - Premium DB list</title>

    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">


    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">



    <style>
    body,
    h1,
    h3,
    p,
    a,
    span,
    button {
        font-family: 'Roboto', sans-serif;
    }

    a.dropdown-item.text-dark.bg-dark {
        display: block !important;
    }

    div#exampleModal {
        opacity: 1 !important;
    }

    @media only screen and (max-width: 600px) {
        .p-5 {
            padding: 0rem !important;
        }

        .col-md-12.kami {
            margin: 0px auto !important;
            padding: 0 !important;
        }

        .container-fluid {
            padding: 0px !important;
        }
    }
    </style>

</head>

<body style="background-color: #1c1d26">
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#"><?php echo $_SESSION['name']; ?></a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="javascript:history.back()">Home</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="p-3">
        <div class="p-5 text-white text-center">
            <?php if (isset($objSwitch)) { ?>
            <?php echo $objSwitch; ?>
            <?php } else { ?>
            <form id="myForm">

                <div class="text-center">
                    <!-- <?php if ($objSwitch) { ?>
    <?php echo $objSwitch; ?>
    <?php } ?> -->
                </div>

                <div class="row">
                    <div class="col-md-6 offset-lg-3">
                        <h3 class="mt-5">New owner & Reference</h3>
                        <div id="output2"></div>
                        <input type="text" id="username" name="username" class="form-control  mt-4"
                            placeholder="New Owner" required>
                        <div id="output"></div>

                        <input type="text" name="reference" class="form-control  mt-4" placeholder="Reference" required>
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <input type="hidden" name="market_id" value="<?php echo $_GET['market_id']; ?>">
                        <!-- <p class="text-left">User is found!</p> -->

                        <input type="submit" name="switch" class="btn font-weight-bold mt-4 btn-lg btn-info"
                            value="Switch">
                    </div>
                </div>

            </form>
            <?php } ?>




        </div>
    </div>








</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="../js/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>



<script src="../js/wow.js"></script>
<script>
new WOW().init();
</script>

<script>
$(document).ready(function() {

    $('#myForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "ajax-coin-switch.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                $('#output2').fadeIn().html(response);

            }
        });
    });
})
</script>
<script>
$(document).ready(function() {
    $('#username').keyup(function() {
        let username = $(this).val().trim();
        if (username.length != '') {
            $.ajax({
                type: 'POST',
                url: 'user_search.php',
                data: {
                    username: username
                },
                dataType: 'text',
                success: function(response) {
                    $('#output').html(response);
                },
            });
        } else {
            $('#output').html('');

            // $('#output').html(response);

        }
    });
});
</script>


</html>