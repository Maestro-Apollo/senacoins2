<!DOCTYPE html>
<html>
<head>
<title>Contatti</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300&display=swap" rel="stylesheet">
<style>
table {
    display: block;
    width: 50em;
    max-width: 100%;
    position: relative;
	font-size: 15px;
	font-family: 'Jost', sans-serif;
	width: 86%;
    margin-left: 7%;
    margin-right: 7%;
	text-align: center;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
<body>
<table>
<tr style="font-size: 20px;">
<th>Id</th>
<th>Nome</th>
<th>email</th>
<th>Azienda</th>
<th>Messaggio</th>
<th>Origine</th>
<th>Timestamp</th>
</tr>
<?php
$conn = mysqli_connect("localhost", "algoretico", "Algoretico@2020", "algoretico");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, name, email, subject, body, source, day_time FROM algoretico";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["subject"] . "</td><td>" . $row["body"] . "</td><td>". $row["source"]. "</td><td>". $row["day_time"]. "</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();

	
   ?>
 </select>
</table>
</body>
</html>