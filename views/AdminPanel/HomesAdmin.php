<section>
    <h2>Home management</h2>
</section>

<button><a href="<?=BASE_URL;?>AdminPanel/submitHomeForm">Add home</a> </button>

<section class="lodgings">
    <?php while($home = $data->fetch()): ?>
        
        <div class="lodging"> 
            <img class="home-thumbnls" src="<?=BASE_URL . 'assets/img/' . $home['ImageName'];?>">
            <h4><?=$home['Name']?></h4>
            <a href="?edit=<?=$home['Id']?>">Edit</a>
            <a href="?delete=<?=$home['Id']?>">Delete</a>
        </div> 
    <?php endwhile; ?> 
</section>

 