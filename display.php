<?php 

include('connection.php');

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
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Author</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          
          $sql = "SELECT * FROM `blog`";
          $res = mysqli_query($conn, $sql);

          if(!$res){
            die(mysqli_error($res));
          }else{
            while($row = mysqli_fetch_assoc($res)){
              echo '<tr>
            <th scope="row">'.$row['title'].'</th>
            <td>'.$row['content'].'</td>
            <td>'.$row['author'].'</td>
            <td><image src="Images/'.$row['image'].'" width="200px" /></td>
            <td class="w-25"><button type="button" class="btn btn-info"><a href="add.php?id='.$row['id'].'">Edit</a></button><button type="button" class="btn btn-danger ms-3"><a href="delete.php?id='.$row['id'].'">Delete</a></button></td>
          </tr>';
            }
          }

          ?>
        </tbody>
      </table>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
