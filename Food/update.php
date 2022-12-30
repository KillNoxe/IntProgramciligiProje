<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_9036";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$DetailId = $_POST['detailID'];
$Name = $_POST['name'];
$desc = $_POST['desc'];
$categoryId = $_POST{'category'};

if (!$_POST['Img']) {
    $sql="SELECT Img FROM `foods` WHERE Id=$categoryId";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $Image = $row["Img"];
    echo $Image;
}else{
$Image = "img/".$_POST['Img'];
}

$sqlUpdate = "UPDATE foods SET Name = '$Name', Img = '$Image', description = '$desc', categoryId = '$categoryId' WHERE ID='$DetailId'";

if ($conn->query($sqlUpdate) === TRUE) {
    echo "Update Başarılı";
  } else {
    echo "Error updating record: " . $conn->error;
  }

header('Location: index.php');
?>