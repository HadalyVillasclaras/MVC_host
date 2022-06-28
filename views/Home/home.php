<section class="single-home">
    <div class="home-gallery">
        <img class="home-gallery-thumb" src="<?=BASE_URL . 'assets/img/' . $data['ImageFolder'] . '/' . $data['ImageName'];?>" alt="">
    </div>

    <article class="home-intro">
        <div class="home-info">
        <h2><?=$data['Name']?></h2> 
        <p class="home-desc">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pharetra sollicitudin fringilla. Mauris at lacus est. Morbi id mi in ex vestibulum suscipit quis et neque. Aenean suscipit vel erat et tincidunt. Phasellus suscipit mi id condimentum ultrices. Morbi id blandit lectus, nec sodales erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus vel porttitor urna. Sed sit amet cursus elit.
        </p>
        </div>


        <div class="home-calendar">  
            <form action="<?=BASE_URL . 'bookingscontroller/checkAvailability?id=' . $data['homeId']?>" method="POST">
            <label for="startDate">Checkin: </label>
            <input type="date" name="startDate" placeholder="Start Date" ><br>
            <span class='wrongMsg'>
                <?=$data['startDateError'];?>  
            </span>
            <label for="endDate">Checkout: </label>
            <input type="date" name="endDate" placeholder="End Date"><br>
            <span class='wrongMsg'>
                <?=$data['endDateError'];?>  
            </span>
            <input type="number" name="guests" placeholder="Guests"><br>
            <span class='wrongMsg'>
                <?=$data['guestsError'];?>  
            </span>

            <span class='wrongMsg'>
                <?=$data['reservationError'];?>  
            </span>


            <?php if($data['availableHome'] == true) :?>
               <button href="<?=BASE_URL . 'bookingscontroller/checkout?id=' . $data['homeId']?>">Book it!</button>
            <?php else: ?> 
                <input type="submit" name="check-availability" value="Check availability"><br>
            <?php endif; ?> 


            
        </form>
        </div>

    </article>
</section>