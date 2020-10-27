<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #630c48;">
  <a class="navbar-brand" href="index.php">FILMS.KZ</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php
        if(ONLINE){
      ?>
        <li class="nav-item">
          <a class="nav-link" href="profile.php"><?php echo $_SESSION['CURRENT_USER']['full_name']; ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="addfilm.php">Add Film</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Sign Out</a>
        </li>
      <?php
        }else{
      ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Sign In</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
      <?php
        }
      ?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>