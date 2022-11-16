<?php
session_start();
if ($_SESSION['name']) {
} else {
    header('location:../index.php');
}
include('../class/database.php');
class coinSell extends database
{
    public function showCoin()
    {
        $id = $_GET['id'];
        $sql = "SELECT * from market_tbl left join data_tbl on market_tbl.market_coin_id = data_tbl.id where market_tbl.market_coin_id = $id ";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function marketPlace()
    {
        $id = $_GET['id'];
        $username = $_SESSION['name'];
        $sqlFind = "SELECT * from market_tbl where market_coin_id = $id ";
        $resFind = mysqli_query($this->link, $sqlFind);
        if (mysqli_num_rows($resFind) > 0) {
            $sqlFind = "SELECT * from data_tbl where id = $id AND user = '$username' ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) === 0) {
                $msg = '<div class="jumbotron jumbotron-fluid bg-danger">
                <div class="container">
                  <h1 class="display-4 text-white text-center">You are not the owner of this coin</h1>
                </div>
              </div>';
                return $msg;
            }
        } else {
            $msg = '<div class="jumbotron jumbotron-fluid bg-danger">
            <div class="container">
              <h1 class="display-4 text-white text-center">Coin Is not in marketplace</h1>
            </div>
          </div>';
            return $msg;
        }
        # code...
    }
}
$obj = new coinSell;
$objSell = $obj->showCoin();
$row = mysqli_fetch_assoc($objSell);
$objInsert = $obj->marketPlace();

?>

<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minterrordatabase.com - </title>

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
        <?php if ($objInsert) { ?>
        <?php echo $objInsert; ?>
        <?php } else { ?>
        <div class="text-center pt-4">

            <h5 class="text-light font-weight-bold">Provide Information
            </h5>

        </div>
        <form id="myForm">
            <div class="">
                <div class="row ">
                    <div class="col-md-6 offset-lg-3 mb-3 bg-white p-4">
                        <div id="output2" class="fixed-top"></div>
                        <div class="row">
                            <div class="col-md-6 offset-lg-3 mb-4">
                                <a target="__blank" href="coinimg.php?id=<?php echo $_GET['id']; ?>"><img
                                        class="img-fluid" src="../coin_img/<?php echo $row['image']; ?>"
                                        alt="sena coins" onerror='this.style.display = "none"'>
                                </a>
                            </div>
                        </div>
                        <!-- <label for="firstName" class="mt-4">Add Title</label>
                        <input type="text" name="title" class="form-control mb-3" id="firstName" placeholder=""
                            value="<?php echo $row['title']; ?>" required> -->
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <label for="">Add Text</label>
                        <textarea name="details" id="" class="form-control mb-3" cols="30" rows="10"
                            placeholder="Write your text here" required><?php echo $row['details']; ?></textarea>
                        <label for="">Price</label>
                        <input type="number" name="price" class="form-control mb-3" value="<?php echo $row['price']; ?>"
                            id="" placeholder="Enter your price" required>
                        <h4 class="font-weight-bold">Shipping Information</h4>
                        <label for="">Country</label>
                        <input type="text" name="country" class="form-control mb-3"
                            value="<?php echo $row['country']; ?>" id="" placeholder="Country Name" required>
                        <label for="">City</label>
                        <input type="text" value="<?php echo $row['city']; ?>" name="city" class="form-control mb-3"
                            id="" placeholder="City Name" required>
                        <label for="">Shipping Price</label>
                        <input type="text" name="s_price" class="form-control mb-3"
                            value="<?php echo $row['shipping_price']; ?>" id="" placeholder="Enter your shipping price"
                            required>
                        <h4 class="font-weight-bold">Personal Information</h4>


                        <label for="">Email</label>
                        <input type="email" value="<?php echo $row['email']; ?>" name="email" class="form-control mb-3"
                            id="" placeholder="Enter your email address" required>
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control mb-3" value="<?php echo $row['phone']; ?>"
                            id="" placeholder="Enter your phone number" required>
                        <label for="">WhatsApp</label>
                        <input type="text" value="<?php echo $row['whatsapp']; ?>" name="whatsapp"
                            class="form-control mb-3" id="" placeholder="Enter your WhatsApp number" required>
                        <input type="submit" name="submit" class="btn btn-success btn-lg" value="Update">

                    </div>
                </div>
            </div>
        </form>
        <?php } ?>

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
$('#myForm').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "coinsell-edit-update.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            $('#output2').fadeIn().html(response);

        }
    });
});
</script>


</html>