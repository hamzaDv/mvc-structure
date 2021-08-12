<?php require APPROOT. '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT ?>/posts/index" class="btn btn-light"> <i class="fa fa-backward"></i> Back</a>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
            <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary float-right">
                <i class="fa fa-pencil"></i> Add Post
            </a>
    </div>
</div>
    <h1><?php echo $data['post']->title; ?></h1>
    <div class="bg-secondary text-white p-2 mb-3">
        Written By <?php echo $data['user']->name; ?>
        on <?php echo $data['post']->postDate ?>
    </div>
    <p class=""><?php echo $data['post']->body; ?></p>

<?php if ($data['post']->user_id === $_SESSION['user_id']){?>
    <hr>
    <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->postId; ?>" class="btn btn-dark">
        <i class="fa fa-edit"></i>Edit
    </a>
    <form class="float-right" action="<?php echo URLROOT;?>/posts/delete/<?php echo $data['post']->postId ?>" method="POST">

        <input type="hidden" name="postId" value="<?php echo $data['post']->postId; ?>"  />

        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
<?php }?>
<?php require APPROOT. '/views/inc/footer.php'; ?>