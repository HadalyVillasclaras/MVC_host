<nav>
    <ul class="menu">
        <li class="logo"><a href="<?=BASE_URL;?>"><img src="<?=BASE_URL;?>assets/img/kodu_logo.png" alt=""></a></li>
        <ul class="logs">
            <li>
                <?php if(isset($_SESSION['email'])) : ?>
                    <a href="<?=BASE_URL;?>userscontroller/logout">Log out</a>
                <?php else : ?>
                    <a href="<?=BASE_URL;?>userscontroller/login">Login</a>
                <?php endif; ?>
            </li>
            <li><a href="<?=BASE_URL;?>homescontroller/allhomes">Destinations</a></li> 
            <li><a href="<?=BASE_URL;?>userscontroller/register">Register</a></li> 

            <li><a href="<?=BASE_URL;?>userscontroller/mypanel">My Panel</a></li> 
        </ul> 
    </ul>
</nav> 

