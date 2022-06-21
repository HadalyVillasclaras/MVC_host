<h2>Signup!</h2>

<form action="<?=BASE_URL?>userscontroller/register" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name"><br>
    <label for="surname">Surname:</label>
    <input type="text" name="surname" id="surname"><br>

    <label for="email">Email:</label>
    <input type="text" name="email" id="email"><br>
    <span class='wrongMsg'>
             <?=$data['emailError'];?>  
        </span>
        
    <label for="password">Password:</label>
    <input type="text" name="password" id="password"><br>
    <span class='wrongMsg'>
             <?=$data['passError'];?>  
    </span>

    <label for="confirmPassword">Confirm Password:</label>
    <input type="text" name="confirmPassword" id="confirmPassword"><br>
    <span class='wrongMsg'>
             <?=$data['confirmPassError'];?>  
    </span>

    <input type="submit" id="register" name="register" value="Register">


</form>