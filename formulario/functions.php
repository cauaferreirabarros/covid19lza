<?php

//require_once('../config.php');
//require_once(DBAPI);

$formularios = null;
$formulario = null;

/**
 *  Submeter formulario
 */
function add() {
	
	require_once('../config.php');
	require_once(DBAPI);
		
	if (!empty($_POST['formulario'])) {
	
		$formulario = $_POST['formulario'];
		$formulario['cidade'] = "Luziânia";
		$formulario['estado'] = "GO";
		$tamanho = count($_POST['sintomas']);
		
		if (($_POST['exame']) == "sim"){
			$formulario['diagnostico'] = "Infectado";
		} else if (($_POST['curado']) == "sim"){
			$formulario['diagnostico'] = "Curado";
		} else if (($_POST['contatosuspeito']) == "sim"){
			$formulario['diagnostico'] = "Suspeito";
		} else if ($tamanho >= 3){
			$formulario['diagnostico'] = "Suspeito";
		} else if (($tamanho == 2) && ((in_array("Febre", ($_POST['sintomas']))) || (in_array("Tosse seca", ($_POST['sintomas']))) || (in_array("Dificuldade para respirar", ($_POST['sintomas']))))){
			$formulario['diagnostico'] = "Suspeito";
		} else {
			$formulario['diagnostico'] = "indefinido";
		}
		
		save($formulario);
		header('location: ../index.php');
	}
}

/**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {
	
	require_once('../config.php');
	require_once(DBAPI);

  if (isset($_GET['cpf'])) {

	$cpf = $_GET['cpf'];

    if (isset($_POST['formulario'])) {

        $formulario = $_POST['formulario'];
	    $formulario['cidade'] = "Luziânia";
		$formulario['estado'] = "GO";
		$tamanho = count($_POST['sintomas']);
		
		if (($_POST['exame']) == "sim"){
			$formulario['diagnostico'] = "Infectado";
		} else if (($_POST['curado']) == "sim"){
			$formulario['diagnostico'] = "Curado";
		} else if (($_POST['contatosuspeito']) == "sim"){
			$formulario['diagnostico'] = "Suspeito";
		} else if ($tamanho >= 3){
			$formulario['diagnostico'] = "Suspeito";
		} else if (($tamanho == 2) && ((in_array("Febre", ($_POST['sintomas']))) || (in_array("Tosse seca", ($_POST['sintomas']))) || (in_array("Dificuldade para respirar", ($_POST['sintomas']))))){
			$formulario['diagnostico'] = "Suspeito";
		} else {
			$formulario['diagnostico'] = "indefinido";
		}
		update($cpf, $formulario);
		header('location: ../index.php');
    } else {
      global $formulario;
      $formulario = find($cpf);
    } 
  } else {
    header('location: ../index.php');
  }
}

