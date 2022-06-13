<h2>Signup!</h2>

<form action="index.php?controller=Users&action=saveUser" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name"><br>
    <label for="surname">Surname:</label>
    <input type="text" name="surname" id="surname"><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"><br>
    <label for="password">Password:</label>
    <input type="text" name="password" id="password"><br>
    
    <input type="submit" name="submit" value="Submit">


</form>