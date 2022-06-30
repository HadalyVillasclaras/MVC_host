<section class="home-sect" >
    <h3>Our destinations</h3>
    <article class="homes">
        <?php foreach($data as $home): ?>
            <div class="home-thumb">
                <a href="<?= BASE_URL . 'homescontroller/home?id=' . $home['Id']?>">
                    <img src="<?=BASE_URL . 'assets/img/' . $home['ImageFolder'] . '/' . $home['ImageName'];?>">
                    <div class="thumbnl-info">
                        <h5 class="home-thb-title"><?=$home['Name']?></h5> 
                        <p class="home-thb-price" ><?=$home['Price'] . '€ night'?></p> 
                    </div>
                    
                </a>
            </div> 
        <?php endforeach; ?> 
    </article>
</section>

  