
<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/idiscussforums"><img src="img/coding .jpg"> Codiscuss</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/idiscussforums">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About Us</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Top Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
         $sql = "SELECT category_name,caterory_id from `categories-idiscuss` LIMIT 5";
         $result = mysqli_query($conn,$sql);
         while($row = mysqli_fetch_assoc($result)){
            echo '<a class="dropdown-item" href="thread.php?catid='.$row["caterory_id"].'">'.$row["category_name"].'</a>';
         } 
        // <a class="dropdown-item" href="#">Action</a>
        // <a class="dropdown-item" href="#">Another action</a>
        // <div class="dropdown-divider"></div>
        // <a class="dropdown-item" href="#">Something else here</a>
      echo'</div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contact.php">Contact Us</a>
    </li>
  </ul>
  <div class="row mx-2">';
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
      <input class="form-control mr-sm-2" name="search" type="search" actiion="search.php" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        <p class="text-light my-0 mx-2">Hello, '. $_SESSION['useremail']. ' </p>
        <a href="partials/logout.php" class="btn btn-outline-success ml-2">Logout</a>
        </form>';
  }
  else{ 
    echo '<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#Login Modal">Login</button>
      <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#Sign Up Modal">Signup</button>';
    }
  
    // <form class="form-inline my-2 my-lg-0">
    //     <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    //     <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    // </form>
    // <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#Login Modal">Login</button> 
    // <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#Sign Up Modal">Sign Up</button> 
  
    echo '</div>

</div>
</nav>';

include 'partials/login_modal.php';
include 'partials/signup_modal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '
  <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success!</strong> You are successfully registered
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
?>
