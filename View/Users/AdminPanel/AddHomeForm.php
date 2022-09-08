<section class="submit-hm-sect">
    <form action="<?=BASE_URL . 'homecontroller/addHome' ?>" method="POST" enctype="multipart/form-data">
        <legend><h3>Submit form</h3></legend>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name"><br>
        <span class='wrongMsg'>
             <?php
             echo $errors['homeName'] ?? '';?>  
        </span>
        <label for="city">City:</label>
        <input type="text" name="city" id="city"><br>
        <span class='wrongMsg'>
             <?=$errors['city'] ?? '';?>  
        </span>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price"><br>

        <label for="image">Image:</label>
        <input type="file" name="image"  id="image" accept=".png, .jpg, .jpge">
        <p>Max size: 500MB</p>
        <span class='wrongMsg'> 
        </span>
        <br>
        <input class="btn"  type="submit" name="submit" value="Submit">
        <span class='wrongMsg'>
             <?=$data['feedBack'] ?? '';?>  
        </span>
    </form>
</section>

   