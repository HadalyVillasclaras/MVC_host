<section><h2>Our destinations</h2></section>
<section class="lodgings">
     
    <?php foreach($data as $home): ?>
        <div class="lodging">
            <a href="<?= BASE_URL . 'homescontroller/home?id=' . $home['Id']?>">
                <img class="home-thumbnls" src="<?=BASE_URL . 'assets/img/' . $home['ImageFolder'] . '/' . $home['ImageName'];?>">
                <h4><?=$home['Name']?></h4> 
                <h4><?=$home['Price'] . '€ night'?></h4> 
            </a>
        </div> 
    <?php endforeach; ?> 
</section>

  