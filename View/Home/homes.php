<section class="home-sect" >
    <h3>Our destinations</h3>
    <article class="homes">
        <?php foreach($data as $home): ?>
            <div class="home-thumb">
                <a href="<?= BASE_URL . 'homecontroller/homeSinglePage?id=' . $home['id']?>">
                    <img src="<?=BASE_URL . 'assets/img/' . $home['image_folder'] . '/' . $home['image_name'];?>">
                    <div class="thumbnl-info">
                        <h5 class="home-thb-title"><?=$home['name']?></h5> 
                        <p class="home-thb-price" ><?=$home['price'] . '€ night'?></p> 
                    </div>
                    
                </a>
            </div> 
        <?php endforeach; ?> 
    </article>
</section>

  