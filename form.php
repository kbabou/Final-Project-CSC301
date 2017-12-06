<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
//include('functions.php');

// Get type of form either add or edit from the URL (ex. form.php?action=add) using the newly written get function
$action = $_GET['action'];

// Get the product id from the URL if it exists using the newly written get function
$prod_id = get('prod_id');

// Initially set $product to null;
$product = null;


if(!empty($prod_id)) {
	$sql = file_get_contents('sql/getProduct.sql');
	$params = array(
		'prod_id' => $prod_id
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$products = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	$product = $products[0];
	
}

// If form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$prod_id = $_POST['prod_id'];
	$prod_code = $_POST['prod_code'];
	$prod_name = $_POST['prod_name'];
	$prod_image = $_POST['prod_image'];
	$price = $_POST['price'];
	
	if($action == 'add') {
		// Insert product
		$sql = file_get_contents('sql/insertProduct.sql');
		$params = array(
			'prod_id' => $prod_id,
			'prod_code' => $prod_code,
			'prod_name' => $prod_name,
            'prod_desc' => $prod_desc,
            'prod_image' => $prod_image,
			'price' => $price
		);
    
		$statement = $database->prepare($sql);
		$statement->execute($params);
		
	}
	
	elseif ($action == 'edit') {
		$sql = file_get_contents('sql/updateProduct.sql');
        $params = array( 
            'prod_id' => $prod_id,
			'prod_code' => $prod_code,
			'prod_name' => $prod_name,
            'prod_image' => $prod_image,
			'price' => $price
        );
        
        $statement = $database->prepare($sql);
        $statement->execute($params);
        

	}
	
	header('location: index.php');
}


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Control Iventory</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/form.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>    
<body>
	<div class="page">
		<h1>Inventory control</h1>
		<form action="" method="POST">
            <div class="rounded">
			<div class="form-element">
				<label>ID:</label>
				<?php if($action == 'add') : ?>
					<input type="text" name="prod_id" class="textbox" value="<?php echo $product['prod_id'] ?>" />
				<?php else : ?>
					<input readonly type="text" name="prod_id" class="textbox" value="<?php echo $product['prod_id'] ?>" />
				<?php endif; ?>
			</div>
			<div class="form-element">
				<label>Code:</label>
				<input type="text" name="code" class="textbox" value="<?php echo $product['prod_code'] ?>" />
			</div>
			
            <div class="form-element">
				<label>Name:</label>
				<input type="text" name="Product name" class="textbox" value="<?php echo $product['prod_name'] ?>" />
			</div>
            
            <div class="form-element">
				<label>Image name:</label>
				<input type="text" name="image" class="textbox" value="<?php echo $product['prod_image'] ?>" />
			</div>
                
            <div class="form-element" action="upload.php" method="post" enctype="multipart/form-data">
            Upload Image:
            <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $product['prod_image'] ?>"/>
            </div>
            
			<div class="form-element">
				<label>Price:</label>
				<input type="number" step="any" name="price" class="textbox" value="<?php echo $product['price'] ?>" />
			</div>
			<div class="form_submit">
				<input type="submit" class="button" />&nbsp;
				<input type="reset" class="button" />
			</div>
                </div>
		</form>
	</div>
</body>
</html>