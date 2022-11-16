<?php
session_start();
if ($_SESSION['name']) {
} else {
    header('location:../index.php');
}


?>

<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minterrordatabase.com - Standard Page</title>

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
        <div class="text-center pt-4">
            <h1 class="text-white">Confirmation Page</h1>
            <p class="text-white">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quos numquam esse, odit
                veniam odio accusantium
                delectus maiores sed molestiae provident amet? Voluptatem ullam adipisci omnis. Dicta nisi tenetur
                voluptates in deleniti magnam asperiores odit repellat reiciendis, ex dolores a labore. Impedit vitae
                dolores eaque mollitia, error saepe. Cum, autem aspernatur.</p>
            <h4 class="text-white">User Comment</h4>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div id="output"></div>
                    <form action="" id="myForm">
                        <textarea name="details" id="" class="form-control" cols="30" rows="10"></textarea>
                        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
                        <input type="submit" name="submit" class="btn btn-danger btn-block mt-4" value="Confirm">
                    </form>
                </div>
            </div>
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
            url: "certificate_request.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#output').fadeIn().html(response);
                setTimeout(() => {
                    $('#output').fadeOut('slow');
                }, 2000);
            }
        });
    });
})
</script>




</html>