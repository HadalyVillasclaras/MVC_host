<section class="reservation-sect">
    <h3>Reservation details</h3>
    <article>
        <h4><?=$data['name'];?>, <?=$data['city'];?></h4>
        <h4><?=$data['start_date'];?> - <?=$data['end_date'];?></h4>
    </article>
    <hr>
    <article>
        <div class="reserv-prices" >
            <p>Price: <?=$data['price'];?> €</p>
            <p>Nights: <?=$data['nights'];?></p>
            <p>Guests: <?=$data['guests'];?></p>
            <p>Total cost: <?=$data['total_cost'];?>€</p>
            <h4>Thank you for your reservation!</h4>
 

        </div>

        <img src="<?=BASE_URL . 'assets/img/homes/' . $data['image_folder'] . '/' . $data['image_name'];?>" alt="">

    </article>

    





</section>