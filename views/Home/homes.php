<section><h2>Homes</h2></section>
<section class="lodgings">
    <?php while($home = $data->fetch()): ?>
        <div class="lodging">
            <img class="home-thumbnls" <?php echo 'src="' . '../public/assets/img/' . $home['ImageName'] . '"';?>>
            <h4><?=$home['Name']?></h4>
        </div> 
    <?php endwhile; ?> 
</section>

 