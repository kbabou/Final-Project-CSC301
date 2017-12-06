<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

// Get search term from URL using the get function
$prod = get('search-term');

// Get a list of products using the searchProducts function
$products = searchItems($prod, $database);


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">

  	<title>Shoping Cart</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/search.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
    
    <!-- A link to the logout.php file -->
		<p>
			<a href="logout.php" class = "link">Log Out</a>
		</p>
    <p>
        <a href="http://csweb.hh.nku.edu/csc301/babouk1/myProject/form.php" class = "link">Add Item</a>
		</p>
    
        
	<div class="wrap">
        <div class="search">
		<h1 align="center" >A.T.C.I</h1>
		<form method="GET">
			<input type="text" class="searchTerm" name="search-term" placeholder="Enter product name ..." />
            <input type="submit" class="searchButton"> <i class="fa fa-search"></i>
		</form><br><br>
            
            <div id="shopping-cart">
<div class="txt-heading">Shopping Cart <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a></div>
            
                <?php
if(isset($products)){
    $item_total = 0;
?>	
                
                  <table cellpadding="10" cellspacing="1">
<tbody>
    <tr>
        <th style="text-align:left;"><strong>Code</strong></th>
        <th style="text-align:left;"><strong>Name</strong></th>
        <th style="text-align:right;"><strong>Quantity</strong></th>
        <th style="text-align:right;"><strong>Price</strong></th>
        <th style="text-align:center;"><strong>Action</strong></th>
    </tr>	
                <?php		
    foreach ($products as $item) :
		?>
            <tr>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["prod_code"]; ?></strong></td>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["prod_name"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$item["price"]; ?></td>
				<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Remove Item</a></td>
            </tr>
    
    
    
    <?php
        $item_total += ($item["price"]*$item["quantity"]);
        endforeach;
		?>
    

    <tr>
        <td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
    </tr>
    
    </tbody>
        </table>
     <?php
}
?>        
                </div>
            
            <div id="product-grid">
	<div class="txt-heading">Products</div>
		<?php foreach($products as $product) : ?>
			<div class="product-item">
			<form method="post" action="index.php?action=add&code=<?php echo $product["prod_code"]; ?>">
			<div class="product-image"><img src="<?php echo $product["prod_image"]; ?>"></div>
			<div><strong><?php echo $product["prod_name"]; ?></strong></div>
			<div class="product-price"><?php echo "$".$product["price"]; ?></div>
			<div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
		<?php endforeach; ?>
    </div>
	
            </div>
         <font size="2">Alle Trading Company International Inc</font> 
             </div>
    
</body>
</html>