<?php
    require_once '../autoload.php';
    require_once '../views/header.php';
?>
    
    <form action="" method="POST">
        <legend>Log-in</legend>
        <label for=""><input type="email" name="email" id="email" placeholder="Introduce tu email"></label><br>
        <label for=""><input type="password" name="pass" id="pass" placeholder="Password"></label><br>
        
        
        <input type="submit" name="login" value="Login">
    </form>
 
<?php
    require_once '../views/footer.php'; 
?>