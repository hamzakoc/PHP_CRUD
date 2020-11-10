<?php
session_start();
include 'config/functions.php';
check_access();



$category = $_COOKIE['category'];

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
    $getfile = file_get_contents('db.json');
    $jsonfile = json_decode($getfile, true);
    $jsonfile = $jsonfile[$category][$id];
   
}

if (isset($_POST["id"])) {
    $id = (int) $_POST["id"];
    $getfile = file_get_contents('db.json');
    $data = json_decode($getfile, true);
    $jsonfile = $data[$category][$id];
    

    $post["title"] = isset($_POST["title"]) ? $_POST["title"] : "";
    $post["description"] = isset($_POST["description"]) ? $_POST["description"] : "";
    $post["price"] = isset($_POST["price"]) ? $_POST["price"] : "";



    if ($jsonfile) {
        unset($data[$category][$id]);
        $data[$category][$id] = $post;
        $data[$category] = array_values($data[$category]);
        file_put_contents("db.json", json_encode($data));
    }
    header("Location: items.php?category=$category");
}


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Hello, world!</title>
  </head>
  <body>
	<!--- TOP NAVIGATION ---->
  <?php include 'navs/admin_navbar.php'?>

	<!--- CONTENT ---->
	<div class="container">
    <div class="row">
      
      <!--- LEFT SIDE --->
      <?php include 'navs/admin_categ.php'?>

      <!--- RIGHT SIDE --->
      <div class="col-md-10">
        <br><br><br>


<!-- echo and data from json -->
    <?php if (isset($_GET["id"])): ?>
    <form action="edit.php" method="POST">

      <input type="hidden"   class="form-control container" value="<?php echo $id ?>" name="id"/>
          <div class="form-group row">
            <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
            
              <input type="text"  class="form-control " id="inputTitle" value="<?php echo $jsonfile["title"] ?>" name="title"/>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>

            <div class="col-sm-10">
                <textarea type="text" class="form-control " id="inputDescription"  
                name="description"><?php echo $jsonfile["description"] ?></textarea>
            </div>
          </div>
          
      
          
          <div class="form-group row">
            <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
              
              <input type="text"  class="form-control" id="inputPrice" value="<?php echo $jsonfile["price"] ?>" name="price"/>
            </div>
          </div>
          
          
          <div class="form-group row">
            <label for="inputPicture" class="col-sm-2 col-form-label">Picture</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="inputPicture">
            </div>
          </div>
          
          
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>

        <?php endif; ?>

      </div>
    </div>
	</div>

	
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  
  </body>
</html>