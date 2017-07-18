<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#fouadApp" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php">Fouad Shop</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="fouadApp">

        <ul class="nav navbar-nav">
                          <li><a href="categories.php">categores</a></li>
                          <li><a href="#">items</a></li>
                          <li><a href="members.php">memebers</a></li>
                          <li><a href="#">comments</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['Username'] ?><span class='caret'</span></a>
                                <ul class='dropdown-menu'>
                                <li ><a href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']?>">Edit profile</a></li>
                                  <li><a href="#">Settings</a></li>
                                  <li><a href="logout.php">Logout</a></li>
                                </ul>
                        </li>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>

