<nav>
    
    <ul class="menu" >
        <li class="logo"><a href="<?=BASE_URL;?>"><img src="<?=BASE_URL;?>assets/img/kodu_logo.png" alt=""></a></li>
        <button id="toggle-menu" class="btn">Menu</button>
        <ul class="logs" id="navbar-menu">
            <li class="navbar-li" >
                <?php if(isset($_SESSION['email'])) : ?>
                    <a href="<?=BASE_URL;?>usercontroller/logout">Log out</a>
                <?php else : ?>
                    <a href="<?=BASE_URL;?>usercontroller/login">Login</a>
                <?php endif; ?>
            </li>
            <li class="navbar-li"><a href="<?=BASE_URL;?>homecontroller/allhomes">Destinations</a></li> 
            <li class="navbar-li"><a href="<?=BASE_URL;?>usercontroller/register">Register</a></li> 

            <li class="navbar-li"><a href="<?=BASE_URL;?>usercontroller/mypanel">My Panel</a></li> 
        </ul> 
    </ul>
</nav> 

