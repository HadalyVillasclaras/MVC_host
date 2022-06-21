 
    
    <form action="<?=BASE_URL?>userscontroller/login" method="POST">
        <legend>Log-in</legend>
        <label for=""><input type="email" name="email" id="email" placeholder="Email*"></label><br>
        <span class='wrongMsg'>
             <?=$data['emailError'];?>  
        </span>
        <label for=""><input type="password" name="pass" id="pass" placeholder="Password*"></label><br>
        <span class='wrongMsg'>
             <?=$data['passError'];?>  
        </span>
        
        <input type="submit" id="login" name="login" value="Login">

        <p class="options">Not register yet? 
            <a href="<?=BASE_URL;?>userscontroller/register">Create an account!</a> 
        </p>
    </form>
 
 