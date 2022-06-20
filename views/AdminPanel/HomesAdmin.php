<section>
    <h2>Home management</h2>
</section>

<button><a href="<?=base_url();?>AdminPanelController/submitHomeForm">Add home</a> </button>

<section class="lodgings">
    <?php while($h = $homes->fetch()): ?>
        
        <div class="lodging">
            <img class="home-thumbnls" <?php echo 'src="' . base_url() . 'assets/img/' . $h['ImageName'] . '"';?>>
            <h4><?=$h['Name']?></h4>
            <a href="?edit=<?=$h['Id']?>">Edit</a>
            <a href="?delete=<?=$h['Id']?>">Delete</a>
        </div> 
    <?php endwhile; ?> 
</section>

 