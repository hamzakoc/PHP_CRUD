<?php
$category = $_COOKIE['category'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
    <title>Add Items</title>
</head>
<body>

<?php include 'navs/admin_navbar.php'?>


<form action="add.php" method="POST">
    <div class="form-group container">
        
        <input type="hidden"   class="form-control container" value="<?php echo $id ?>" name="id"/>
        <br><br>
        <label for="title">Title</label>
        <input type="text" class="form-control container" id="title" name="title" />
        <br><br>
        <label for="description">Description </label>
        <input type="text" class="form-control container" id="description" name="description" />
   
       <br><br>
        <label for="price">Price</label>
        <input type="text" class="form-control container"  id="price" name="price" />
        <br><br>
   
        <br><br>
        <label >Select Category</label>
       <select name="category">  
            <option value="computers">Computers</option> 
            <option value="monitors">Monitors</option> 
            <option value="tablets">Tablets</option> 
            <option value="cellphones">Cellphones</option> 
            <option value="watches">Watches</option> 
        
        </select> 
        <br><br>
        <input type="submit" name="add"/>
        </div>
    </form>

<?php

//Take values from url and send if statement. 
//Read json file and add related values to category.

if (isset($_POST["add"])) {

    $category = $_REQUEST['category'];

    $database = json_decode(file_get_contents('db.json'), true);

    unset($_POST["add"]);

    $database[$category] = array_values($database[$category]);

    array_push($database[$category], $_POST);

    file_put_contents("db.json", json_encode($database));

    header("Location: items.php?category=$category");
}
?>

    
</body>
</html>



