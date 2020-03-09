<?php require APPROOT . '/views/includes/header.php'; ?>
  <a href="<?php echo URLROOT; ?>/posts" class="btn btn-danger"><i class="fa fa-backward"></i> Back</a>

  <div class="card card-body mb-3 mt-3">
    <h4 class="card-title"><?php echo $data['post']->title; ?></h4>
    <div class="bg-light p-2 mb-3">
      written by <strong><?php echo $data['user']->name; ?></strong> on <em><?php echo $data['post']->created_at; ?></em>
    </div>
    <p class="card-text">
      <?php echo $data['post']->body; ?>
    </p>
  </div>

  <?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
    <hr>
    <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>

    <form class="float-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
      <input type="submit" class="btn btn-danger" value="Delete">
    </form>
  <?php endif; ?>

<?php require APPROOT . '/views/includes/footer.php'; ?>