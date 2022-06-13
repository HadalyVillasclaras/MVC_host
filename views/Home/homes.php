<section><h2>Homes</h2></section>
<section class="lodgings">
    <?php while($h = $homes->fetch()): ?>
        <div class="lodging">
            <div class="thumb"></div>
            <h4><?=$h['Name']?></h4>
        </div> 
    <?php endwhile; ?> 
</section>

 