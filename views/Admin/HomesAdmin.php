
 <section class="admin-homes">
    <h4>Homes management</h4>
    
    <a class="btn admin-addhm" href="<?=BASE_URL;?>homescontroller/submitHome">Add new home</a>

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
                <td><img src="<?=BASE_URL . 'assets/img/' . $home['ImageFolder'] . '/' . $home['ImageName'];?>"></td> 
                <td><p><?=$home['Name']?></p></td> 
                <td><p><?=$home['City']?></p></td> 
                <td><p><?=$home['Price']?> €</p></td> 
                <td>
                    <a href="<?= BASE_URL . 'homescontroller/edithome?edit=' . $home['Id']?>">Edit</a>
                    <a href="<?= BASE_URL . 'homescontroller/deletehome?delete=' . $home['Id']?>">Delete</a>
                </td>
            
            </tr>
                
        <?php endwhile; ?> 
        
    </table>
 </section>


