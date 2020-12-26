<?php  
	// VERIFIER SI IMAGE BIEN RECUE
	
	if (isset($_FILES['image']) && $_FILES['image'] ['error'] == 0) 
		{

			// VARIABLE
			 $error = 1;

			// TAILLE
			if ($_FILES['image']['size'] <= 3000000) 
			{
				// EXTENSION
				$informationsImage = pathinfo($_FILES['image']['name']);
				$extensionImage = $informationsImage['extension'];
				$extensionArray = array('png', 'jpg', 'jpeg', 'gif');
				if (in_array($extensionImage, $extensionArray)) 
				{
					$adress = 'uploads/'.time().rand().'.'.$extensionImage;

					move_uploaded_file($_FILES['image']['tmp_name'], $adress);
					$error = 0;
				}
			}
		}
?>
<!DOCTYPE html>
<html>
	<head>
		 <link rel="shortcut icon" href="favicon.png">
		<meta charset="utf-8">
		<title>Anteste|Hébergeur d'image</title>
	</head>
	<style type="text/css">
		html, body {margin: 0; font-family: georgia;}
		header { text-align: center;color: white; background: red; }
		button { margine:auto; margin-top: 10px;}
		h1 { margin-top:0px; text-align: center; }
		.contener { width: 500px; margin: auto; }
		article { margin-top: 50px; background: #f7f7f7; padding: 10px;}
		#presentation-picture { text-align: center; border: solid;1px; border-radius: 30px;}
		#image { max-width: 100px }
	</style>
	<body>
		<!-- HEADER -->
		<header>
			<H2>PHOTOSHOOT</H2>
		</header>
		<!-- FORMULAIRE -->
		<div class="contener">
			<article> 
				<h1>Hébergez une image</h1>

				<?php  
					if (isset($error) && $error == 0) 
					{
						echo '<div id="presentation-picture">
								<img src="'.$adress.'" id="image"/><br />

							<input type="text" value="https://www.anteste.yo.fr/image-hoster/'.$adress.'" />
								</div>';
					}
					else if (isset($error) && $error == 1) 
					{
						echo'Votre image ne peut pas être héberger. Vérifiez son extension et sa taille (maximum 3 MO).';
					}
				?>

				<form method="post" action="index.php" enctype="multipart/form-data">
					<p>
						<input type="file" required name="image">
						<div style="text-align:center;">
						<button type="submit">Héberger</button>
						</div>
					</p>
				</form>
			</article>
		</div>
	</body>
</html>