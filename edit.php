<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$name=$_POST['name'];
	$description=$_POST['description'];
	$price=$_POST['price'];	
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
			echo "<font color='red'>Stock field is empty.</font><br/>";
		}

	} else {	
		//updating the table
		$sql = "UPDATE Product SET name=:name, description=:description, price=:price, quantity=:quantity WHERE id=:id";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':name', $name);
		$query->bindparam(':description', $description);
		$query->bindparam(':price', $price);
		$query->bindparam(':quantity', $quantity);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM Product WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$product = $row['pname'];
	$descr = $row['pdesc'];
	$price = $row['pprice'];
	$stock = $row['pstock'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Product Name</td>
				<td><input type="text" name="pname" value="<?php echo $product;?>"></td>
			</tr>
			<tr> 
				<td>Product Description</td>
				<td><input type="text" name="pdesc" value="<?php echo $descr;?>"></td>
			</tr>
			<tr> 
				<td>Product Price</td>
				<td><input type="text" name="pprice" value="<?php echo $price;?>"></td>
			</tr>
			<tr> 
				<td>Product Quantity</td>
				<td><input type="text" name="pstock" value="<?php echo $stock;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
