 
 
    <form action="<?=BASE_URL . 'homescontroller/submitHome' ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name"><br>
        <span class='wrongMsg'>
             <?=$data['nameError'];?>  
        </span>
        <label for="city">City:</label>
        <input type="text" name="city" id="city"><br>
        <span class='wrongMsg'>
             <?=$data['cityError'];?>  
        </span>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price"><br>

        <label for="image">Image:</label>
        <input type="file" name="image"  id="image" accept=".png, .jpg, .jpge">
        <p>Max size: 500MB</p>
        <span class='wrongMsg'>
             <?=$data['imgError'];?>  
        </span>
        <br>
        <input type="submit" name="submit" value="Submit">
        <span class='wrongMsg'>
             <?=$data['submitFeedback'];?>  
        </span>
    </form>

    <?php

    //esto tiene que estar en el controlador
    

    ?>


    <br><br><br>
    <a class="button" href="index.php">Home</a>

 