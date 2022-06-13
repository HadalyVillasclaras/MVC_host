<section><h2>Home management</h2></section>
<button><a href="upload_home.php">Add home</a> </button>
<section class="lodgings">
    <?php while($h = $homes->fetch()): ?>
        
        <div class="lodging">
            <div class="thumb"></div>
            <h4><?=$h['Name']?></h4>
            <a href="">Edit</a>
            <a href="?delete=<?=$h['Price']?>">Delete</a>
        </div> 
    <?php endwhile; ?> 
</section>


<?php 
    //esto tiene que estar e el controlador
    if(isset($_GET['delete'])){
        require_once '../controller/HomesController.php';
        $id = $_GET['delete'];
        echo $id;
        $home = new HomesController();
        $home->DeleteHome($id);
    }


?>