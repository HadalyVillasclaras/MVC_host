<?php 
var_dump($_SESSION);
?>

<nav>
    <ul class="menu">
        <li class="logo"><a href="<?=BASE_URL;?>">koduHost</a></li>
        <ul class="logs">
            <li>
                <?php if(isset($_SESSION['email'])) : ?>
                    <a href="<?=BASE_URL;?>userscontroller/logout">Log out</a>
                <?php else : ?>
                    <a href="<?=BASE_URL;?>userscontroller/login">Login</a>
                <?php endif; ?>
            </li>
            <li><a href="<?=BASE_URL;?>userscontroller/register">Register</a></li>
            <li><a href="<?=BASE_URL;?>adminpanel/submithomeform">Submit Home</a></li>
            <li><a href="<?=BASE_URL;?>adminpanel/home">Admin Panel</a></li> 
        </ul> 
    </ul>
</nav> 
