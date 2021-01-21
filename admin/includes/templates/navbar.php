
<nav class="navbar navbar-expand-lg navbar-inverse bb" >
  <a class="navbar-brand" href="dashboard.php"> <?php echo lang('homeAdmin'); ?>   </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#add-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="add-nav">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item">
        <a class="nav-link" href="categories.php"><?php echo lang('categories'); ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="items.php"><?php echo lang('items'); ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="members.php"><?php echo lang('members'); ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('statistics'); ?></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="comments.php"><?php echo lang('comments'); ?></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo lang('logs'); ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="..\index.php">x</a>
          <a class="dropdown-item" href="members.php?do=edit&id=<?php echo $_SESSION['userId']; ?>"> <?php echo lang('editProfile'); ?> </a>
          <a class="dropdown-item" href="#"> <?php echo lang('settings'); ?> </a>
          <a class="dropdown-item" href="logout.php"><?php echo lang('logOut'); ?></a>
        </div>
      </li>
      
    </ul>
  
  </div>
</nav>