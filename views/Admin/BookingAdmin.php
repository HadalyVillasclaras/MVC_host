<section class="admin-homes">
    <h4>Reservation management</h4>
     

    <table>
        <tr>
            <th>Home Id</th>
            <th>User Id</th>
            <th>Checkin</th>
            <th>Checkout</th>
            <th>Guests</th>
            <th>Total cost</th>

        </tr>

        <?php foreach($data as $reservation): ?> 
            <tr>
                <td><p><?=$reservation['user_id']?></p></td> 
                <td><p><?=$reservation['home_id']?></p></td> 
                <td><p><?=$reservation['start_date']?></p></td> 
                <td><p><?=$reservation['end_date']?></p></td> 
                <td><p><?=$reservation['guests']?></p></td> 
                <td><p><?=$reservation['cost']?> €</p></td> 


               
            
            </tr>
                
        <?php endforeach; ?> 
        
    </table>
 </section>