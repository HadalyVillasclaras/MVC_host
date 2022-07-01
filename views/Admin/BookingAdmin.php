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

        <?php while($booking = $data->fetch()): ?> 
            <tr>
                <td><p><?=$booking['User_id']?></p></td> 
                <td><p><?=$booking['Home_id']?></p></td> 
                <td><p><?=$booking['Start_date']?></p></td> 
                <td><p><?=$booking['End_date']?></p></td> 
                <td><p><?=$booking['Guests']?></p></td> 
                <td><p><?=$booking['Cost']?> €</p></td> 


               
            
            </tr>
                
        <?php endwhile; ?> 
        
    </table>
 </section>