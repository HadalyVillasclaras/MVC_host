
<?php
    require_once '../autoload.php';

    require_once '../views/header.php';
?>

    <form action="upload_home.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name"><br>
        <label for="city">City:</label>
        <input type="text" name="city" id="city"><br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price"><br>

        <label for="image">Image:</label>
        <input type="file" name="image"  id="image" accept=".png, .jpg, .jpge">
        <p>Max size: 500MB</p>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php

    //esto tiene que estar en el controlador
    if(isset($_POST['submit'])){ 
        $name=$_POST['name'];
        $city=$_POST['city'];
        $price=$_POST['price'];
        $img=$_FILES['image'];

        $homes = new HomesController();
        $homes->SubmitHome($name, $city, $price, $img);
    }

    ?>


    <br><br><br>
    <a class="button" href="index.php">Home</a>

<?php
    require_once '../views/footer.php'; 
?>
