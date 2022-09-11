<section class="edit-hm-sect">
    <form action="" method="POST">
        <legend><h3>Delete confirmation</h3></legend>
        <p>Are you sure you want to delete <?=$data['name'];?>?</p>
        <p><i>You can't undo this action</i></p>
        <a class="btn" href="<?=BASE_URL;?>mypanelcontroller">Cancel</a>
        <input class="btn" type="submit" name="delete" id="delete" value="Delete">
    </form>
</section>