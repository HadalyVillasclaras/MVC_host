<section class="edit-hm-sect" >
    <form action="" method="POST" enctype="multipart/form-data">
        <legend><h3>Edit form</h3></legend>
        <a class="close-btn" href="<?=BASE_URL;?>userscontroller/mypanel">X</a>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?=$data['Name'];?>"><br>
        <label for="city">City:</label>
        <input type="text" name="city" id="city" value="<?=$data['City'];?>"><br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="<?=$data['Price'];?>"><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept=".png, .jpg, .jpge" value="<?=$data['ImageName'];?>">
        <p>Max size: 500MB</p>
        <br>
        <input class="btn" type="submit" name="submit" value="Edit">
    </form>

</section>


  