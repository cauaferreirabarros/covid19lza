<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Covid-19 Luziânia</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap.min.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" /> 
	<link rel="stylesheet" href="css/leaflet-search.css" />
	<link rel="stylesheet" href="css/Leaflet.Coordinates-0.1.5.css"/>
	<link rel="stylesheet" href="css/leaflet.groupedlayercontrol.min.css"/>
	<link rel="stylesheet" href="css/leaflet.awesome-markers.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" />
	
	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>	
	<script src="js/leaflet-search.js"></script>
	<script src="js/Leaflet.Coordinates-0.1.5.min.js"></script>
	<script src="js/leaflet.groupedlayercontrol.min.js"></script>
	<script src="js/leaflet.awesome-markers.js"></script>
	
	<script src="js/validator.min.js"></script>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="<?php echo BASEURL; ?>index.php"><img src="<?php echo BASEURL; ?>/images/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent" >
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo BASEURL; ?>index.php">INFORMATIVO <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo BASEURL; ?>MapaDeContagio.php">MAPA DE CONTÁGIO</a>
      </li>
    </ul>
  </div>
</nav>

<br/>


    <main class="container">