<section><h2>Homes</h2></section>
<section class="lodgings">
    <?php while($h = $homes->fetch()): ?>
        <div class="lodging">
            <img class="home-thumbnls" <?php echo 'src="' . '../public/assets/img/' . $h['ImageName'] . '"';?>>
            <h4><?=$h['Name']?></h4>
        </div> 
    <?php endwhile; ?> 
</section>

 