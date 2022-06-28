<section>
    <h2>Home management</h2>
    <?php if(isLoggedIn()):?>
            <h3>Hola, <?=$_SESSION['name'];?></h3>
    <?php endif; ?>
</section>

<button><a href="<?=BASE_URL;?>homescontroller/submitHome">Add home</a> </button>

<section class="lodgings">
    <?php while($home = $data->fetch()): ?>
        
        <div class="lodging"> 
            <img class="home-thumbnls" src="<?=BASE_URL . 'assets/img/' . $home['ImageFolder'] . '/' . $home['ImageName'];?>">
            <h4><?=$home['Name']?></h4>
            <a href="<?= BASE_URL . 'homescontroller/edithome?edit=' . $home['Id']?>">Edit</a>
            <a href="<?= BASE_URL . 'homescontroller/deletehome?delete=' . $home['Id']?>">Delete</a>
        </div> 
    <?php endwhile; ?> 
</section>

 