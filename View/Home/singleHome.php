<section class="single-home">

    <article class="sngl-hm-intro">
        <div>
            <h2><?=$data['Name']?></h2> 
            <p class="home-desc">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pharetra sollicitudin fringilla. Mauris at lacus est. Morbi id mi in ex vestibulum suscipit quis et neque. Aenean suscipit vel erat et tincidunt. Phasellus suscipit mi id condimentum ultrices. Morbi id blandit lectus, nec sodales erat. 
             </p>
             <h4>5 guests 2 bedrooms 5 beds 1 bath</h4>
        </div>

        <img src="<?=BASE_URL . 'assets/img/homes/' . $data['ImageFolder'] . '/' . $data['ImageName'];?>" alt="">
    </article>

<hr>
    <article class="sngl-hm-two">
        <div>
            <h4>Prices</h4>
            <p>
                <?=$data['Price']?>€ per night <br>
                Week discount: 12%<br>
                Month discount: 20%<br>
                Extra people: 30€ per night
            </p>

            <h4>Check-In & Check-Out</h4>
            <p>
                Check-in: After 4:00 pm <br>
                Check-out: Before 11:00 am
            </p>
        </div>
        <div>  
            <form class="booking-form" action="<?=BASE_URL . 'reservationcontroller/checkAvailability?id=' . $data['homeId']?>" method="POST">
                 <h3>Check availability </h3>
            
                <label for="startDate"></label>
                <input type="date" name="startDate" placeholder="Start Date" value="<?=$data['startDate'];?>"><br>
                <span class='wrongMsg'>
                    <?=$data['errorFeedback'];?>  
                </span>
                <label for="endDate"></label>
                <input type="date" name="endDate" placeholder="End Date" value="<?=$data['endDate'];?>"><br>
                <span class='wrongMsg'>
                    <?=$data['errorFeedback'];?>  
                </span>
                <input type="number" name="guests" placeholder="Guests" value="<?=$data['guests'];?>"><br>
                <span class='wrongMsg'>
                    <?=$data['errorFeedback'];?>  
                </span>

                <!-- Availability feedback and total price -->
                <span class='wrongMsg'>
                    <?=$data['reservationFeedback'];?>  
                </span>

                


                <?php if($data['availableHome'] == true) :?>
                    <div class="home-totalcost">
                        <p>Total cost: <?=$data['Price'];?>€ x <?=$data['Nights'];?> nights = <?=$data['totalCost'];?>€</p>
                    </div>

                    <a class="btn" href="<?=BASE_URL . 'reservationcontroller/checkout?id=' . $data['homeId'] . '&checkin=' .  $data['startDate'] . '&checkout=' .  $data['endDate'] . '&guests=' .  $data['guests']?>">Book it!</a>
                <?php else: ?> 
                    <input class="btn" type="submit" name="check-availability" value="Check availability"><br>
                <?php endif; ?> 
            </form>
        </div>
    </article>
        

</section>