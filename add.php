<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$name = $_POST['name'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
		
	// checking empty fields
	if(empty($name) || empty($description) || empty($price) || empty($quantity)) {
				
		if(empty($name)) {
			echo "<font color='red'>Product field is empty.</font><br/>";
		}
		
		if(empty($description)) {
			echo "<font color='red'>Description field is empty.</font><br/>";
		}
		
		if(empty($price)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
		}

		if(empty($quantity)) {
			echo "<font color='red'>Quantity field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database		
		$sql = "INSERT INTO Product( name, description, price, quantity) VALUES(:name, :description, :price, :quantity)";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':name', $name);
		$query->bindparam(':description', $description);
		$query->bindparam(':price', $price);
		$query->bindparam(':quantity', $quantity);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
