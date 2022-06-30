<section class="register-sect">
    <form action="<?=BASE_URL?>userscontroller/register" method="POST">
        <legend><h3>Register form</h3></legend>
        <label for="name"></label>
        <input type="text" name="name" id="name" placeholder="Name"><br>
        <label for="surname"></label>
        <input type="text" name="surname" id="surname" placeholder="Surname"><br>

        <label for="email"></label>
        <input type="text" name="email" id="email" placeholder="Email"><br>
        <span class='wrongMsg'>
            <?=$data['emailError'];?>  
        </span>
            
        <label for="password"></label>
        <input type="text" name="password" id="password" placeholder="Password"><br>
        <span class='wrongMsg'>
            <?=$data['passError'];?>  
        </span>

        <label for="confirmPassword"></label>
        <input type="text" name="confirmPassword" id="confirmPassword" placeholder="Repeat password"><br>
        <span class='wrongMsg'>
            <?=$data['confirmPassError'];?>  
        </span>

        <input class="btn" type="submit" id="register" name="register" value="Register" >


    </form>


</section>

