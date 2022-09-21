<!-- http://localhost/idiscussforums/ -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>i-Discuss-Coding-doubts</title>
</head>

<body>
    <?php include 'partials/dbconnect.php';
          include 'partials/header.php';
    ?>
    <!-- <?php
    $sql = "SELECT * FROM `categories-idiscuss`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
       $cat_name = $row['category_name'];
       $cat_desc = $row['category_description']; 
       echo '<div class="container mt-4 mr-3">
        <div class="jumbotron bg-dark " style="width:900px; height:500px;">

            <h1 class="display-4" style="color:white">Learn completely about '.$cat_name.' with our articles and questions asked
                by your peers</h1>
            <p class="lead" style="color:white">C++ is a general-purpose programming language created by Bjarne
                Stroustrup as an extension of the C programming language, or "C with Classes".</p>
            <hr class="my-4">
            <p style="color:white">It uses utility classes for typography and spacing to space content out within the
                larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div> ';
    }

    ?> 
    we can't use this as we only want that category's jumbotron to be dispalyed whose category id is being clicked on 
    this will result in dispalying all category's junbotron.Right way is done below
    -->

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories-idiscuss` WHERE caterory_id=$id";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
       $cat_name = $row['category_name'];
       $cat_desc = $row['category_description']; 
    }
    ?>
    
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads_questions` (`thread_title`, `thread_desc`, `threadCategory_id`, `threadUser_id`, `timestamp`) VALUES ('$th_title', '$th_desc','$id','$sno',current_timestamp())"; 
        $result = mysqli_query($conn,$sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your thread has been added! Please wait for community to respond
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
        }
    } 
    ?>
    
    <div class="container mt-4 mr-3">
        <div class="jumbotron jumbotron-fluid mx-auto" style="width:900px">
            <div class="container">
                <h2 class="display-5 text-center">Learn completely about <?php echo $cat_name ?> with our articles
                and questions asked
                by your peers</h2>
                <p class="lead h6 text-center"><?php echo $cat_desc ?></p>
            </div>
        </div>
    </div>
    <hr>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<div class="container mr-3">
        <div class="alert alert-info" role="alert" style="width:100%;">
            <h2 class="text-center">Ask A Doubt!</h2>
        </div>
        <form action= "'. $_SERVER["REQUEST_URI"]. '"   method="post">
            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <div class="form-group">
                <label for="exampleInputEmail1">Doubt Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep the Title as short and crisp as possible</small>
            </div>
            <input type="hidden" name="sno" value="' .$_SESSION["sno"]. '">

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Elaborate your problem here</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    }
    else{
        echo '
        <div class="container">
            <h2 class="text-center">Ask A Doubt!</h2>
            <p class="lead text-center">You are not logged in. Please login to be able to start a Discussion</p>
        </div>';
    }
   ?>
    

    <hr>
    <div class="container mr-3 mb-5">
        <h3 class= mb-2" style="color:rgb(128, 0, 0)"><u>Browse Questions Related to Your Doubt</u></h3>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads_questions` WHERE threadCategory_id=$id";
        $result = mysqli_query($conn,$sql);
        $noresult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noresult = false;
            $id = $row['thread_id'];
            $ques_title = $row['thread_title'];
            $desc = $row['thread_desc']; 
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['threadUser_id'];

            $sql2 = "SELECT user_email FROM `users` WHERE user_id ='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '
            <div class="media mt-3">
                <img class="mr-3" src="img/user.jpg" alt="Generic placeholder image">
                <div class="media-body">'.
                    '<h5 class="mt-0"><a class="text-dark" href="threadQuestionDescription.php?threadid=' . $id . '">'.$ques_title.'</a></h5>
                    '.$desc.' </div>'.'<p class="font-weight-bold my-0">Asked By: '.$row2['user_email'].' at '. $thread_time. '
                    </p>'.
            '</div>';
        }
        if($noresult){
            echo ' <div class="alert alert-warning" role="alert" style="width:500px;">
            <h4> No Discussions Found <br> Start One Now(ask a doubt)</h4>

          </div>';
        }
        ?>
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