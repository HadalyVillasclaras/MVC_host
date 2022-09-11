<section class="admin-homes">
    <h3>Hello, <?='e'//$data['userInfo']['first_name'] ?? '';?></h3>
</section>


<section class="admin-homes">
    <h4>Homes management</h4>
    
    <a class="btn admin-addhm" href="<?=BASE_URL;?>homecontroller/addHome">Add new home</a>

    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>City</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>

        <?php while($home = $data['homes']->fetch()): ?> 
            <tr>
                <td><img src="<?=BASE_URL . 'assets/img/homes/' . $home['image_folder'] . '/' . $home['image_name'];?>"></td> 
                <td><p><?=$home['name']?></p></td> 
                <td><p><?=$home['city']?></p></td> 
                <td><p><?=$home['price']?> €</p></td> 
                <td>
                    <a href="<?= BASE_URL . 'homecontroller/updateHome?edit=' . $home['id']?>">Edit</a>
                    <a class="delete" href="<?= BASE_URL . 'homecontroller/deletehome?delete=' . $home['id']?>">Delete</a>
                </td>
            
            </tr>
                
        <?php endwhile; ?> 
        
    </table>
 </section>

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

        <?php foreach($data['reservations'] as $reservation): ?> 
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