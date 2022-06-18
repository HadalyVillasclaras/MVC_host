 <!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/styles.css">
    <title>koduHost</title>
</head>
<body> 
    <nav>
        <ul class="menu">
            <li class="logo"><a href="<?=base_url();?>">koduHost</a></li>
            <ul class="logs">
                <li><a href="login.php">Login</a></li>
                <li><a href="<?=base_url();?>UsersController/signUp">Sign Up</a></li>
                <li><a href="upload_home.php">Submit Home</a></li>
                <li><a href="<?=base_url();?>AdminPanelController/home">Admin Panel</a></li> 
            </ul> 
        </ul>
    </nav>
   