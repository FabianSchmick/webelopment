<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" href="[@favicon]">
	<title>[@title]</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Styles -->
	<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- font awesome cdn -->
	<link rel="stylesheet" type="text/css" href="[@main.css]">
	<link rel="stylesheet" type="text/css" href="[@custom.css]">
</head>
<body>
	<div id="header">
		[& path="header.tpl" ]
	</div>
	<div class="container">
		<div id="main" class="">
			[@content]
		</div>
	</div>
	<footer></footer>

	<!-- JavaScripts-->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> <!-- jQuery cdn -->
	<script type="text/javascript" src="[@main.js]"></script>

	<script type="text/javascript">
		$( document ).ready(function() {
			addClassActiveToNav();
		});
	</script>
</body>
</html>