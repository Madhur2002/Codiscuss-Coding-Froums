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

    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads_questions` WHERE thread_id=$id";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
       $title = $row['thread_title'];
       $desc = $row['thread_desc']; 
       $thread_user_id = $row['threadUser_id'];

       $sql2 = "SELECT user_email FROM `users` WHERE user_id ='$thread_user_id'";
       $result2 = mysqli_query($conn, $sql2);
       $row2 = mysqli_fetch_assoc($result2);
       $posted_by = $row2['user_email'];
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // $comment = $_POST['comment']; 
        // $comment = str_replace("<", "&lt;", $comment);
        // $comment = str_replace(">", "&gt;", $comment);
        $sno = $_POST["sno"];
        $discussion_desc = $_POST['desc'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$discussion_desc','$id','$sno',current_timestamp())"; 
        $result = mysqli_query($conn,$sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your comment has been added!
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

                <h2 class="display-5 text-center">Doubt Title : <?php echo $title;?></h2>
                <p class="lead h6 text-center">Description : <?php echo $desc; ?></p>
                <!-- <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the
                    larger container.</p>
                    <p class="lead"> </p>
                    <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
                <p class="mt-4 mb-0 text-center lead">Posted By : <?php echo "<b>$posted_by</b>"?></p>
            </div>
        </div>
    </div>
    <hr>


    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '
    <div class="container mr-3">
        <div class="alert alert-info" role="alert" style="width:100%;">
            <h2 class="text-center">Post your Comment Related to the Doubt</h2>
        </div>
        <form action= "'. $_SERVER["REQUEST_URI"]. '"   method="post">
            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Write your Answer</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                <input type="hidden" name="sno" value="' .$_SESSION["sno"]. '">
            </div>
            <button type="submit" class="btn btn-success">Post</button>
        </form>
    </div>';
    }
    else{
        echo '
        <div class="container">
            <h2 class="text-center">Post your Comment Related to the Doubt</h2>
            <p class="lead text-center">You are not logged in. Please login to be able to post comments</p>
        </div>';
    }

    ?>
    <hr>
    <div class="container mr-3">
        <h3 class="mt-4">DISCUSSIONS</h3>
        <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($conn,$sql);
            $noresult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noresult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $comment_time = $row['comment_time'];
                $thread_user_id = $row['comment_by'];

                $sql2 = "SELECT user_email FROM `users` WHERE user_id ='$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo '
                <div class="media mt-3">
                    <img style="width:50px height:50px" class="mr-3" src="img/user.jpg" alt="Generic placeholder image">
                    <div class="media-body">
                     <h6 class="my-0">by '. $row2['user_email'] .' at '.$comment_time.'</h6>
                        '.$content.'
                    </div>
                </div>';
            }
            if($noresult){
                echo ' 
                <div class="alert alert-warning" role="alert" style="width:500px;">
                   <h4> No Comments Found <br> Post One Now!</h4>
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