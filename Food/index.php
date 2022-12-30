<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_9036";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  
$sql = "
SELECT foods.ID,foods.Name,foods.Img,foods.description,foods.categoryId,food_type.Food_name
FROM foods
INNER JOIN food_type on foods.categoryId=food_type.categoryId
";
$tekrar = 0;
$result = $conn->query($sql);

// $row = $result->fetch_assoc();
// $ID = $row["ID"];
// echo $ID;
// $row = $result->fetch_assoc();
// echo $row["ID"];
// echo $row["Name"];
// echo $row["Img"];
// echo $row["categoryId"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Food</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>



    <!-- Header -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="">Ana Sayfa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Hakkımızda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Servislerimiz</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Referanslarımız</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Bize Ulaşın</a>
            </li>
        </ul>
    </div>
</nav>
    <!-- Container -->
<div class="container-fluid" style="background-color: #E9ECEF !important;">
    <h1>Esnaf Lokantamıza Hoşgeldiniz</h1>
    <p>Lokantalarımızda Türkiye ve Dünya Mutfağından Yemekler bulma şansınız vardır. Afiyet Olsun</p>
</div>

    <!-- Content -->
    <?php
    while($row = $result->fetch_assoc()) {
        if ($tekrar == 0) {
            echo '<div class="row">';
        }
        echo'
        <div class="col">
                <img src="'.$row["Img"].'" alt="">
                <p class="ortala">'.$row["Food_name"].'</p>
                <h4 class="ortala">'.$row["Name"].'</h4>
                <p class="text-middle">'.$row["description"].'</p>
                <a href="detail.php?Veri='.$row["ID"].'">Detay</a>
            </div>
        ';
        // include('dosya.php');    
        $tekrar += 1;
        if ($tekrar > 2) {
            echo "</div>" ;
            $tekrar = 0;
        }
    }
    ?>

    <p class="copyright">Tüm hakları enfes esnaf lokantalarına aittir &copy; Company 2020</p>
</body>
</html>