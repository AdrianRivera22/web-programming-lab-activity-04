<?php

    require_once "../classes/library.php";
    $bookObj = new Book();
    $book =["title"=>"","author" => "", "genre"=>"", "pub_year" => ""];
    $errors=["title"=>"","author" => "", "genre"=>"", "pub_year" => ""];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $book["title"] = trim(htmlspecialchars($_POST["title"]));
        $book["author"] = trim(htmlspecialchars($_POST["author"]));
        $book["genre"] = trim(htmlspecialchars($_POST["genre"]));
        $book["pub_year"] = trim(htmlspecialchars($_POST["pub_year"]));

        if(empty($book["title"])){
            $errors["title"] = "Title is required";
        }

        if(empty($book["author"])){
            $errors["author"] = "Author is required";
        }

        if(empty($book["genre"])){
            $errors["genre"] = "Genre is required";
        }

        if(empty($book["pub_year"])){
            $errors["pub_year"] = "Publication Year is required";
        } else if(!is_numeric($book["pub_year"] && ($book["pub_year"]) > 2026)){
            $error["pub_year"] = "Publication Year must be a number and is not from the future.";
        }

        if(empty(array_filter($errors))){
            $bookObj-> title = $book["title"];
            $bookObj->author = $book["author"];
            $bookObj->genre = $book["genre"];
            $bookObj->pub_year = $book["pub_year"];

            if($bookObj->addBook()){
                header("Location: viewBook.php");
            } else {
                echo "failed";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <style>
        label { display: block;}
        span, .error { color:red; margin: 0;}
    </style>
</head>
<body>
    <h1>Add Book</h1>
    <form action="" method="post">
        <label for="">Field With<span>*</span> is required</label>
        <label for="title">Title:<span>*</span></label>
        <input type="text" name="title" id="title" value="<?= $book["title"] ?>">
            <p class="error"><?= $errors["title"]?></p>

        <label for="author">Author:<span>*</span></label>
        <input type="text" name="author" id="author" value="<?= $book["author"]?>">
            <p class="error"><?= $errors["author"]?></p>

        <label for="genre">Genre:<span>*</span></label>
        <select name="genre" id="genre" value="<?= $book["genre"]?>">
            <option value="">--SELECT GENRE--</option>
            <option value="History" <?($book["genre" == "History"])? "selected": ""?>>History</option>
            <option value="Science" <?($book["genre" == "Science"])? "selected": ""?>>Science</option>
            <option value="Fiction" <?($book["genre" == "Fiction"])? "selected": ""?>>Fiction</option>
        </select>
            <p class="error"><?= $errors["genre"]?></p>

        <label for="pub_year">Published Year:<span>*</span></label>
        <input type="number" name="pub_year" id="pub_year" value="<?= $book["pub_year"]?>">
            <p class="error"><?= $errors["pub_year"]?></p>
        <input type="submit" value="Save Book">
    </form>
</body>
</html>