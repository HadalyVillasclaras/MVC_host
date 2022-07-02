<section class="admin-homes">
    <h4>My reservations</h4> 
    <table>
        <tr>
            <th>Home Id</th>
            <th>User Id</th>
            <th>Checkin</th>
            <th>Checkout</th>
            <th>Guests</th>
            <th>Total cost</th>

        </tr> 
        <?php foreach($data as $booking): ?> 
            <tr>
                <td><p><?=$booking['User_id']?></p></td> 
                <td><p><?=$booking['Home_id']?></p></td> 
                <td><p><?=$booking['Start_date']?></p></td> 
                <td><p><?=$booking['End_date']?></p></td> 
                <td><p><?=$booking['Guests']?></p></td> 
                <td><p><?=$booking['Cost']?> €</p></td> 

 
            </tr>
                
        <?php endforeach; ?> 
        
    </table>
 </section>