<?php 

include('connection.php');

$title = "";
$author = "";
$content = "";
$image = "";

if(isset($_GET['id'])){
  $id = $_GET['id'];

  $sql2 = "SELECT * FROM `blog` WHERE id= $id";

  $res2 = mysqli_query($conn, $sql2);

  if($res2){
    $row = mysqli_fetch_assoc($res2);

    $title = $row['title'];
    $author = $row['author'];
    $content = $row['content'];
    $image = $row['image'];
  }
}

if(isset($_POST['submit'])){
  $title = $_POST['title'];
  $content = $_POST['content'];
  $author = $_POST['author'];

  // Check if a new image is uploaded
  if(!empty($_FILES['image']['name'])){
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = "Images/".$file_name;

    // Upload new image
    if(move_uploaded_file($tempname, $folder)){
      echo "Image uploaded";
    }else{
      die("Failed to upload image.");
    }
  } else {
    // If no new image is uploaded, keep the old image
    $file_name = $image;
  }

  // Update the query
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "UPDATE `blog` SET `title`='$title', `content`='$content', `author`='$author', `image`='$file_name' WHERE id=$id";
  } else {
    // Insert new blog post with image
    $sql = "INSERT INTO `blog`(`title`, `content`, `author`, `image`) VALUES ('$title', '$content', '$author', '$file_name')";
  }

  $res = mysqli_query($conn, $sql);

  if($res){
    header('Location: display.php');
  } else {
    die(mysqli_error($conn));
  }
}



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
  <?php 
    include('navbar.php');
    ?>
    <div class="container">
      <h1>Add Blog</h1>
      <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value=<?php echo $title ?>>
        </div>
        <div class="mb-3">
          <div>
          <label for="content" class="form-label">Content</label>
          </div>
          <!-- <input type="text" class="form-control" id="content" name="content"> -->
           <textarea name="content" rows="10" cols="100"><?php echo $content ?></textarea>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" value=<?php echo $author ?>>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" value="<?php echo $image ?>">
          </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
