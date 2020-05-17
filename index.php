<?php

//$pp1 = [1, 2, 3, 4];
//$pp1[1] = 99;
//array_push($pp1, 5);
//print_r($pp1);

//$products = [
//    ['name' => 'shiny star', 'price' => 20],
//    ['name' => 'green shell', 'price' => 10],
//    ['name' => 'red shell', 'price' => 15],
//    ['name' => 'gold coin', 'price' => 5],
//    ['name' => 'lightning bolt', 'price' => 40],
//    ['name' => 'banana skin', 'price' => 2]
//];

//foreach ($products as $product){
//	if ($product['name'] === 'lightning bolt'){
//		break;
//	}
//	if ($product['price'] > 15){
//		continue;
//	}
//	echo $product['name'] . '<br/>';
//}

//function sayHello($name = 'shaun'){
//	echo "Hello $name";
//}
// sayHello("Mario");
//function productBuy($product){
//	return "{$product['name']} cost ${product['price']} to buy";
//}
//$buy = productBuy($product[1]);
//
//echo $buy;
//	include ('ninjas.php');
//	require ('ninjas.php');

include ('config/db_config.php');
//query for all entries
$sql = 'SELECT id, title, ingredients FROM pizzas ORDER BY created_at';
//make query & get results
$sql_results = mysqli_query($config_connection, $sql);
//fetch resulting row as an array
$pizzas = mysqli_fetch_all($sql_results, MYSQLI_ASSOC);
//free results from memory
mysqli_free_result($sql_results);
//close connection to bd
mysqli_close($config_connection);
//print array results
//print_r($pizzas);
//explode(',',$pizzas[0]['ingredients']);
?>

<!DOCTYPE html>
<html>

<?php include 'template/header.php' ?>
<h4 class="center grey-text">Pizzas!</h4>
<div class="container">
	<div class="row">
        <?php foreach ($pizzas as $pizza) : ?>
			<div class="col s6 md3">
				<div class="card" z-depth-0>
					<div class="card-content center">
						<h6><?php echo htmlspecialchars($pizza['title']) ?></h6>
						<ul>
                            <?php foreach (explode(',', $pizzas[0]['ingredients']) as $ing) : ?>
								<li><?php echo htmlspecialchars($ing) ?></li>
                            <?php endforeach; ?>
						</ul>
					</div>
					<div class="card-action right-align">
						<a class="brand-text" href="#">more info</a>
					</div>
				</div>
			</div>
        <?php endforeach; ?>
	</div>
</div>
<?php include 'template/footer.php' ?>

</html>