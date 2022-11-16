<?php
session_start();
if ($_SESSION['name']) {
} else {
    header('location:index.php');
}
include('../class/database.php');
class code extends database
{
    protected $link;
    public function codeFunction()
    {
        $sql = "select * from code";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function revealFunction($data)
    {
        $key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2), 2, null);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }
}
$obj = new code;
$objCode = $obj->codeFunction();
?>
<!doctype html>
<html lang="en" class="h-100">

<head style="background-color: #1c1d26">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Sticky Footer Navbar Template · Bootstrap</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css
">
    <style>
    h1,
    h3,
    p,
    a,
    span,
    button,
    th,
    td {
        font-family: 'Roboto', sans-serif;
    }
    </style>



</head>

<body class="d-flex flex-column h-100 bg-white">
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Admin Panel</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
                        </li>


                    </ul>

                </div>
            </div>
        </nav>

    </header>

    <!-- Begin page content -->

    <section>

        <div class="container mt-5 mb-5">
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>User</th>
                        <th>Account</th>
                        <th>Status</th>
                        <th>Date <span class="text-muted">(Italy)</span> </th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if ($objCode) { ?>
                    <?php while ($row = mysqli_fetch_assoc($objCode)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $obj->revealFunction($row['code']); ?></td>
                        <td><?php echo $row['user']; ?></td>
                        <td>
                            <?php if ($row['account'] == 0) { ?>
                            <span class="badge badge-pill badge-dark">Standard</span>
                            <?php } ?>
                            <?php if ($row['account'] == 1) { ?>
                            <span class="badge badge-pill badge-primary">Premium</span>
                            <?php } ?>
                        </td>
                        <td><?php if ($row['taken'] == 0) { ?>
                            <span class="badge badge-pill badge-warning">Progress</span>
                            <?php } else { ?>
                            <span class="badge badge-pill badge-success">Taken</span>
                            <?php } ?>
                        </td>
                        <td><?php echo $row['updated']; ?>
                        </td>
                        <td><a class="btn btn-danger"
                                href="switch.php?id=<?php echo $row['id']; ?>&user=<?php echo $row['user']; ?>">Switch
                                to
                                Standard</a></td>

                    </tr>
                    <?php } ?>

                    <?php } ?>


                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>User</th>
                        <th>Account</th>
                        <th>Status</th>
                        <th>Date <span class="text-muted">(Italy)</span> </th>
                        <th>Action</th>

                    </tr>
                </tfoot>
            </table>
        </div>

    </section>







</body>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js
"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "order": [
            [4, "desc"]
        ],
        responsive: true

    });
});
</script>






</html>