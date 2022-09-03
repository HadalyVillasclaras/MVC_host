<section class="login-sect">
    <form action="<?=BASE_URL?>usercontroller/login" method="POST">
        <legend><h3>Login form</h3></legend>
        <label for=""><input type="email" name="email" id="email" placeholder="Email*"></label><br>
        <span class='wrongMsg'><?=$data['emailError'];?></span>
        <label for=""><input type="password" name="password" id="password" placeholder="Password*"></label><br>
        <span class='wrongMsg'><?=$data['passError'];?></span>
        
        <p class="options">Not register yet? 
            <a href="<?=BASE_URL;?>usercontroller/register">Create an account!</a> 
        </p>
        
        <input class="btn" type="submit" id="login" name="login" value="Login">
    </form>
</section>


 
 