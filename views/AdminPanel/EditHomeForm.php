

<form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?=$homeToEdit['Name'];?>"><br>
        <label for="city">City:</label>
        <input type="text" name="city" id="city" value="<?=$homeToEdit['City'];?>"><br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="<?=$homeToEdit['Price'];?>"><br>

        <label for="image">Image:</label>
        <input type="file" name="image"  id="image" accept=".png, .jpg, .jpge" value="<?=$homeToEdit['ImageName'];?>">
        <p>Max size: 500MB</p>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>

  