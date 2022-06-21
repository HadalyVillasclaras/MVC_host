<section>
    <h2>Home management</h2>
</section>

<button><a href="<?=base_url();?>AdminPanel/submitHomeForm">Add home</a> </button>

<section class="lodgings">
    <?php while($home = $data->fetch()): ?>
        
        <div class="lodging">
            <img class="home-thumbnls" <?php echo 'src="' . base_url() . 'assets/img/' . $home['ImageName'] . '"';?>>
            <h4><?=$home['Name']?></h4>
            <a href="?edit=<?=$home['Id']?>">Edit</a>
            <a href="?delete=<?=$home['Id']?>">Delete</a>
        </div> 
    <?php endwhile; ?> 
</section>

 