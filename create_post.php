<!DOCTYPE html>
<html lang="en">

<head>
    <title>bookxchange</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Christine Nguyen Tanner Summers Giovanni Hernandez David Ghermezi">
    <meta name="description" content="The solution for buying and selling textbooks.">
    <meta name="keywords" content="bookxchange christine nguyen tanner summers giovanni hernandez david ghermezi">
    <!-- CSS -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/createPost.css">
    <!-- JavaScript -->
    <script src="includes/js/jquery1.11.1/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>


    <?php

    require_once ('includes/php/db_util.php');

    session_start();
    $db_connection = new DBUtilities();


    if(!isset($_SESSION['USER_ID']) || !isset($_SESSION['FINGER_PRINT']))
    {
        header('Location:' . site_root);
    }
    else {

        $user_id = $_SESSION['USER_ID'];

        if (!empty($_POST['ISBN']) && !empty($_POST['Price']) && !empty($_POST['Condition']) && !empty($_POST['Contact'])) {
            // add entry into DB

            $post_results = $db_connection->addPost($user_id, $_POST['ISBN'], $_POST['Title'], $_POST['Author'], $_POST['Edition'], $_POST['Class'], $_POST['Price'], $_POST['Contact'], $_POST['Comments'], $_POST['Condition'])

            if ($post_results['condition'])
            {
                header('Location:' . site_root);
            }
            else
            {
                echo '<h3 style="background-color:red;"> An Error has occurred. Please try agian later </h3>';
            }
        }
    }

    ?>

    <div id="wrapper-content">
        <div class="container">
            <h1>Add New Book</h1>

            <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
                <?php if(isset($_POST['ISBN'])) { if(empty($_POST['ISBN'])) { echo '<h3 style="background-color:red;"> Please enter the ISBN number </h3>'; } } ?>
                <div class="form-group">
                    <input type="text" name="ISBN" class="form-control" id="inputISBN" aria-describedby="enterISBNOfBook" placeholder="ISBN**">
                </div>
                <div class="form-group">
                    <input type="text" name="Title" class="form-control" id="inputTitle" aria-describedby="enterTitleOfBook" placeholder="Title">
                </div>
                <div class="form-group">
                    <input type="text" name="Class" class="form-control" id="inputClass" aria-describedby="enterClass" placeholder="Class Used For">
                </div>
                <div class="form-group">
                    <input type="text" name="Author" class="form-control" id="inputAuthor" aria-describedby="enterAuthor" placeholder="Author">
                </div>
                <div class="form-group">
                    <input type="text" name="Edition" class="form-control" id="inputEdition" aria-describedby="enterEdition" placeholder="Edition">
                </div>
                <?php if(isset($_POST['Price'])) { if(empty($_POST['Price'])) { echo '<h3 style="background-color:red;">  Please enter the book\'s price </h3>'; } } ?>
                <div class="form-group">
                    <input type="number" name="Price" class="form-control" id="inputPrice" aria-describedby="enterPrice" placeholder="Price**">
                </div>
                <div class="form-group">
                    <label for="condition">Condition</label>
                    <?php if(isset($_POST['Condition'])) { if(empty($_POST['Condition'])) { echo '<h3 style="background-color:red;">  Please enter the book\'s condition </h3>'; } } ?>
                    <select class="form-control" id="condition" name="Condition">
                        <option value="Select_one" disabled selected>Select one</option>
                        <option value="New">New</option>
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Acceptable">Acceptable</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Comments">Comments</label>
                    <small id="commentsHelp" class="form-text text-muted">Is there anything you want to say about your book, method of contact, etc.?</small>
                    <textarea class="form-control" id="Comments" rows="3" name="Comments"></textarea>
                </div>
                <div class="form-group">
                    <label for="Contact">How do you want buyers to contact you?</label>
                    <small id="contactHelp" class="form-text text-muted">You can select multiple options with Shift + Click.</small>
                    <?php if(isset($_POST['Contact'])) { if(empty($_POST['Contact'])) { echo '<h3 style="background-color:red;"> Please enter the contact information </h3>'; } } ?>
                    <textarea class="form-control" id="contact" rows="2" name="Contact"></textarea>

                </div>
                <button type="submit" class="btn btn-default btn-transparent">Submit</button>
            </form>
        </div>
    </div>
    
</body>

</html>