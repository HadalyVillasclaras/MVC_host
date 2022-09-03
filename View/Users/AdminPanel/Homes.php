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

        <?php while($home = $data->fetch()): ?> 
            <tr>
                <td><img src="<?=BASE_URL . 'assets/img/' . $home['image_folder'] . '/' . $home['image_name'];?>"></td> 
                <td><p><?=$home['name']?></p></td> 
                <td><p><?=$home['city']?></p></td> 
                <td><p><?=$home['price']?> €</p></td> 
                <td>
                    <a href="<?= BASE_URL . 'homecontroller/edithome?edit=' . $home['id']?>">Edit</a>
                    <a class="delete" href="<?= BASE_URL . 'homecontroller/deletehome?delete=' . $home['id']?>">Delete</a>
                </td>
            
            </tr>
                
        <?php endwhile; ?> 
        
    </table>
 </section>