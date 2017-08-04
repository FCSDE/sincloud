<?php require('_app/Config.inc.php');$read = new Read;?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Teste PHP</title>
		<meta name="description" content="Teste"/>
		<meta name="author" content="Carlos Santos" />			
		<meta name="keywords" content="teste, painel, php">
		<meta name="robots" content="index,follow">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	</head>
		<body style="background: #f1f1f1;margin-top: 20px;">			
			<div class="container" style="background: #fff; border: 1px solid #f9f9f9; padding: 20px">
				<div class="row">
					<div class="col-md-12">
						<?php
						$get = filter_input(INPUT_GET,'p');					
						if($get=='listagem'){require('listagem.php'); 					
						}else{require('novo.php');}
						?>				
					</div>
				</div>
			</div>
		</body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/controller.js"></script>
		<script type="text/javascript">	
		$('body').on('click', '[data-edd]', function(){	$('.edd_agenda'+$(this).attr('data-edd')).toggle();});
		</script>
</html>