<header class="home-header">
     
    <img src="<?=BASE_URL?>assets/img/cabecera.png" alt="">
    <h3>Sustainable lodges taking care of the planet </h3>
</header>

<section class="hm-pg-dunlop bg-nopadd" >
    <img src="<?=BASE_URL?>assets/img/dunlap.png" alt="">
</section>

<section class="hm-pg-about" >
    <div>
        <h2>
            About <br>
            koduHost
        </h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pharetra sollicitudin fringilla. Mauris at lacus est. Morbi id mi in ex vestibulum suscipit quis et neque. Aenean suscipit vel erat et tincidunt. Phasellus suscipit mi id condimentum ultrices. Morbi id blandit lectus, nec sodales erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus vel porttitor urna. Sed sit amet cursus elit.
        </p>
        <a href="#" class="btn">Know more about us</a>
    </div>

    <div>
        <img src="<?=BASE_URL?>assets/img/about-us.png" alt="">
    </div>

</section>

<section class="hm-pg-pics">
    <div>
        <img src="<?=BASE_URL?>assets/img/thmb1.png" alt="">
        <img src="<?=BASE_URL?>assets/img/thmb2.png" alt="">
        <img src="<?=BASE_URL?>assets/img/thmb3.png" alt="">
    </div>
    <div>
        <h3>Sustainable vacation destinies</h3>
        <p>
            Aenean suscipit vel erat et tincidunt. Phasellus suscipit mi id condimentum ultrices. Morbi id blandit lectus, nec sodales erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.
        </p>
    </div>

</section>

<section class="hm-pg-landscape bg-nopadd" >
    <img src="<?=BASE_URL?>assets/img/bg-landscp.png" alt="">
</section>

<section class="home-sect" >
    <h3>Our destinations</h3>
    <article class="homes">
        <?php foreach($data as $home): ?>
            <div class="home-thumb">
                <a href="<?= BASE_URL . 'homecontroller/getHome?id=' . $home['id']?>">
                    <img src="<?=BASE_URL . 'assets/img/homes/' . $home['image_folder'] . '/' . $home['image_name'];?>">
                    <div class="thumbnl-info">
                        <h5 class="home-thb-title"><?=$home['name']?></h5> 
                        <p class="home-thb-price" ><?=$home['price'] . '€ night'?></p> 
                    </div>
                    
                </a>
            </div> 
        <?php endforeach; ?> 
    </article>
</section>