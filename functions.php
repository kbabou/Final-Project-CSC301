<?php

function query($sqlFilePath,$database,$QueryParams){
	
	$sql = file_get_contents($sqlFilePath);
		$statement = $database->prepare($sql);
		$statement->execute($QueryParams);
	
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	return $results;
}

function searchItems($prod, $database) {
	if (is_null($prod) || strcmp($prod,'') == 0){
		return array();
	}
	
	$params = array(
		'prod' => '%' . $prod . '%'
	);
	
	return query('sql/searchProduct.sql',$database,$params);
}


/*
- Create a function named get() that:
	- takes a parameter holding a $_GET key as a string
	- if the GET variable isset, return the GET variable
	- else return an empty string
*/
function get($var_key){
	return isset($_GET[$var_key])? $_GET[$var_key] : '';
}

function getBookByISBN($ISBN,$database){
	$params = array(
		'ISBN' => $ISBN
	);
	return query('sql/getOneBookByISBN.sql',$database,$params);
}

function getCategoriesForBook($ISBN,$database){
	$params = array(
		'ISBN' => $ISBN
	);
	return query('sql/book-categories.sql',$database,$params);
}

function getAllCategories($database){
	return query('sql/GetCategories.sql',$database,NULL);
}

function getCheckCategories($ISBN,$database){
	$params = array(
		'ISBN' => $ISBN
	);
	return query('sql/getCategoriesCheckedOneBook.sql',$database,$params);
}

function setOrUpdateBookCategories($ISBN, $ListCats, $database){
		clearBookCategories($ISBN, $database);
		
		
		$sql = file_get_contents('sql/insertBookCategory.sql');
		$statement = $database->prepare($sql);
		
		foreach($ListCats as $category) {
			$params = array(
				'isbn' => $ISBN,
				'categoryid' => $category['name']
			);
			$statement->execute($params);
		}
}

function clearBookCategories($ISBN, $database){
	$params = array(
		'ISBN' => $ISBN
	);
	query('sql/clearBookCategories.sql',$database,$params);
}

function updateBook($prod_id, $prod_code, $name, $prod_image, $price ){
	$params = array(
		'prod_id' => $prod_id,
		'prod_code' => $prod_code,
		'name' => $name,
        'prod_image' => $prod_image,
        'price' => $price
	);
	query('sql/updateProduct.sql',$database,$params);
}

//getCustomer(4,database);
function getCustomer($CUSTNMBR,$database){
	$params = array(
		'customerid' => $CUSTNMBR
	);
	return query('sql/getCustomer.sql',$database,$params);
}

?>