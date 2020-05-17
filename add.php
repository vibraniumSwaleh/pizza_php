<?php

//    if (isset($_GET['submit'])){
//        echo 'Your email is: ' . $_GET['email'].'<br/>';
//        echo 'Your pizza is: ' . $_GET['title'].'<br/>';
//        echo 'Your ingredients are: ' . $_GET['ingredients'];
//    }

include ('config/db_config.php');

$email = $title = $ingredients = '';
$errors = array('email'=>'','title'=>'','ingredients'=>'');

if (isset($_POST['submit'])) {
//        echo 'Your email is: ' . htmlspecialchars($_POST['email']).'<br/>';
//        echo 'Your pizza is: ' . htmlspecialchars($_POST['title']).'<br/>';
//        echo 'Your ingredients are: ' . htmlspecialchars($_POST['ingredients']);

    //check mail
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required!' . '<br/>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be valid' . '<br/>';
        }
//        else {
//            echo 'Your email is: ' . htmlspecialchars($_POST['email']) . '<br/>';
//        }
    }

    //check pizza
    if (empty($_POST['title'])) {
        $errors['title'] = 'Pizza is required!' . '<br/>';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] =  'Pizza title must be letters and spaces only' . '<br/>';
        }
//        else {
//            echo 'Your pizza is: ' . htmlspecialchars($_POST['title']) . '<br/>';
//        }
    }

    //check ingredients
    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'Ingredients are required!' . '<br/>';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = 'Ingredients must be letters and spaces and comma separated only' . '<br/>';
        }
//        else {
//            echo 'Your ingredients are: ' . htmlspecialchars($_POST['ingredients']) . '<br/>';
//        }

        if (array_filter($errors)){

        }else{
            $email = mysqli_real_escape_string($config_connection, $_POST['email']);
            $title = mysqli_real_escape_string($config_connection, $_POST['title']);
            $ingredients = mysqli_real_escape_string($config_connection, $_POST['ingredients']);

            //sql
			$sql_string = "INSERT INTO pizzas(title,email,ingredients) VALUES(
							'$email', 
							'$title', 
							'$ingredients')";

			//save to db & check
			if(mysqli_query($config_connection, $sql_string)){
                header('Location: index.php');
			}else{
			echo 'query error: ' . mysqli_error($config_connection);
			}

        }

    }
}

?>

<!DOCTYPE html>
<html>

<?php include 'template/header.php' ?>

<section class="container grey-text">
	<h4 class="center">Add a Pizza</h4>
	<form class="white" action="add.php" method="POST">
		<label>Your Email:</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>
		<label>Pizza Title:</label>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title)?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>
		<label>Ingredients (comma separated):</label>
		<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
        <div class="red-text"><?php echo $errors['ingredients']; ?></div>
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>
<?php include 'template/footer.php' ?>

</html>
