<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>i-Discuss-Coding-doubts</title>
</head>

<body>
    <?php include 'partials/dbconnect.php';?>
    <?php include 'partials/header.php';?>

    <!-- slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/slider11.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/slider2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/slider3.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Category starts here -->
    <div class="container my-3">
        <h2 class="text-center mt-4 my-3">Browse Our Categories</h2>
        <div class="row">
            <!-- Fetch all the categories using loop-->
    <?php  
      $sql = "SELECT * FROM `categories-idiscuss`";
      $result = mysqli_query($conn,$sql);  
      while($row = mysqli_fetch_assoc($result)){
        $id = $row['caterory_id'];
        $cat = $row['category_name'];
        $desc = $row['category_description'];
        echo ' 
        <div class="col-md-4 my-2">
          <div class="card" style="width: 18rem;">
            <img src="img/coding2.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><a href="thread.php?catid=' .$id. '">' .$cat. '</a></h5>
              <p class="card-text">' .substr($desc,0,90). '....</p>
              <a href="thread.php?catid=' .$id. '" class="btn btn-primary">Read More</a>
            </div>
          </div>
        </div>';
      }     
    ?>

        </div>
    </div>

    <?php include 'partials/footer.php';?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>