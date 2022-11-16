<?php

if (isset($_GET['continent']) && !empty($_GET['continent'])) {

    include('conn.php');

    $name = $_GET['continent'];
    $sql = "select * from countries where continent_code = '$name' ";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
    } else {
        echo '<option>Not Available</option>';
    }
} else {
    echo "Error";
}