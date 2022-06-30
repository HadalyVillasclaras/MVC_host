<section class="reservation-sect">
    <h3>Reservation details</h3>
    <article>
        <h4><?=$data['Name'];?>, <?=$data['City'];?></h4>
        <h4><?=$data['startDate'];?> - <?=$data['endDate'];?></h4>
    </article>
    <hr>
    <article>
        <div class="reserv-prices" >
            <p>Price: <?=$data['Price'];?> €</p>
            <p>Nights: <?=$data['Nights'];?></p>
            <p>Guests: <?=$data['Guests'];?></p>
            <p>Total cost: <?=$data['totalCost'];?>€</p>
            <h4>Thank you for your reservation!</h4>
 

        </div>

        <img src="<?=BASE_URL . 'assets/img/' . $data['ImageFolder'] . '/' . $data['ImageName'];?>" alt="">

    </article>

    





</section>