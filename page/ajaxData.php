<?php

include('conn.php');
if (isset($_POST['code']) && !empty($_POST['code'])) {

    $query = $db->query("select * from countries where continent_code = " . $_POST['code'] . " ");

    $rowCount = $query->num_rows;
    if ($rowCount > 0) {
        echo '<option>Select country</option>';
        while ($row = $query->fetch_assoc()) {
            echo '<option value="' . $row['code'] . '">' . $row['name'] . '</option>';
        }
    } else {
        echo '<option>Not Country</option>';
    }
}