<?php 
$Id = $_GET["Veri"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_9036";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

$sql = "SELECT * FROM `foods` WHERE Id=$Id";
$sql2 = "SELECT foods.categoryId,food_type.Food_name
FROM foods
INNER JOIN food_type on foods.categoryId=food_type.categoryId";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);
$row = $result->fetch_assoc();
// echo $row["ID"]."<br>";
// echo $row["Name"]."<br>";
// echo $row["Img"]."<br>";
// echo $row["description"]."<br>";
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
    <div class="container">
        <form action="update.php" method="POST">
        <h2>Detay</h2>
        <div class="form-group">
            <label for="">ID</label><br>
            <?php echo '<input readonly class="form-control" value="'.$row["ID"].'" type="text" name="detailID">'; ?>
        </div>
        <div class="form-group">
            <?php echo ' <img style="width: 200px;" src="'.$row["Img"].'" alt=""> ';?><br><br>
            <input name="Img" type="file" class="form-control" id="customFile" />
        </div>
        <div class="form-group">
            <label for="">Yemek Adı</label><br>
            <?php echo '<input class="form-control" value="'.$row["Name"].'" type="text" name="name" id="name">'; ?>
        </div>
        <div class="form-group">
            <label for="">Kategori</label><br>
            <select class="form-control" id="category" name="category">
                <option value="0">Seçiniz</option>
                <?php 
                while($row2 = $result2->fetch_assoc()) {
                    if($row2["categoryId"] == $row["categoryId"]){
                    echo '<option name="category" selected value="'.$row2["categoryId"].'">'.$row2["Food_name"].'</option>';
                }
                    else{
                    echo '<option name="category" value="'.$row2["categoryId"].'">'.$row2["Food_name"].'</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
        <label for="">Açıklama</label><br>
        <?php echo '<textarea name="desc" id="" cols="30" rows="8">'.$row["description"].'</textarea>';?>
        </div>
        <button type="submit" class="btn btn-primary">Gönder</button>
        </form>
    </div>

</body>
</html>