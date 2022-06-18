<section><h2>Home management</h2></section>
<button><a href="upload_home.php">Add home</a> </button>
<section class="lodgings">
    <?php while($h = $homes->fetch()): ?>
        
        <div class="lodging">
            <img class="home-thumbnls" <?php echo 'src="' . '../public/assets/img/' . $h['ImageName'] . '"';?>>
            <h4><?=$h['Name']?></h4>
            <a href="?edit=<?=$h['Id']?>">Edit</a>
            <a href="?delete=<?=$h['Id']?>">Delete</a>
        </div> 
    <?php endwhile; ?> 
</section>


<?php 
    //esto tiene que estar e el controlador
    if(isset($_GET['delete'])){
        require_once '../controller/HomesController.php';
        $id = $_GET['delete'];
        $home = new HomesController();
        $home->DeleteHome($id);
    }

    if(isset($_GET['edit'])){
        require_once '../controller/HomesController.php';
        $id = $_GET['edit'];
        $home = new HomesController();
        $home->EditHome($id);
    }

    

?>