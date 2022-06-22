<section class="admin-panel">
    
    <h2>Admin panel</h2>
<br>

    <div class="welcome-msg">
        <?php if(isLoggedIn()):?>
            <h3>Hola, <?=$_SESSION['name'];?></h3>
        <?php endif; ?>
    </div>

    <ul>
        <li><a href="<?=BASE_URL;?>adminpanel/homespanel">- Manage Homes</a></li><br>
        <li><a href="home-mgmt.php">- Manage Users</a></li>
    </ul>
 
        

</section>