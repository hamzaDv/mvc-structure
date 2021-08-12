<?php require APPROOT. '/views/inc/header.php'; ?>

<div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
        <h class="display-3"><?php echo $data['title']; ?></h>
        <p class="lead"><?php echo $data['description']; ?></p>
        <p>Version: <strong><?php echo APPVERSION; ?></strong></p>
    </div>
</div>

<?php require APPROOT. '/views/inc/footer.php'; ?>