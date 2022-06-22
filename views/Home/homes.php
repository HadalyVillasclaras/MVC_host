<section><h2>Homes</h2></section>
<section class="lodgings">
    <?php foreach($data as $home): ?>
        <div class="lodging">
            <img class="home-thumbnls" src="<?=BASE_URL . 'assets/img/' . $home['ImageName'];?>">
            <h4><?=$home['Name']?></h4>
        </div> 
    <?php endforeach; ?> 
</section>

  