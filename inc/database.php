<?php

mysqli_report(MYSQLI_REPORT_STRICT);

function open_database() {
	try {
		$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		return $conn;
	} catch (Exception $e) {
		echo $e->getMessage();
		return null;
	}
}

function close_database($conn) {
	try {
		mysqli_close($conn);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

/**
*  Insere um registro no BD
*/
function save($data = null) {

  $database = open_database();
  $columns = null;
  $values = null;

  foreach ($data as $key => $value) {
    $columns .= trim($key, "'") . ",";
    $values .= "'$value',";
  }

  //remove a ultima virgula
  $columns = rtrim($columns, ',');
  $values = rtrim($values, ',');
  
  $sql = "INSERT INTO formularios ($columns)" . " VALUES " . "($values);";

  try {
    $database->query($sql);

    $_SESSION['message'] = 'Formulario cadastrado com sucesso.';
    $_SESSION['type'] = 'success';
  
  } catch (Exception $e) { 
  
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  } 

  close_database($database);
}

/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find($cpf = null ) {
  
	$database = open_database();
	$found = null;

	try {
	  if ($cpf) {
	    $sql = "SELECT * FROM formularios WHERE cpf = '" . $cpf . "';";
	    $result = $database->query($sql);
	    
	    if ($result->num_rows > 0) {
	      $found = $result->fetch_assoc();
	    }
	    
	  } else {
	     $found = null;
		}
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  }
	
	close_database($database);
	return $found;
}

/**
 *  Atualiza um registro em uma tabela, por cpf
 */
function update($cpf = 0, $formulario = null) {

  $database = open_database();

  $items = null;

  foreach ($formulario as $key => $value) {
    $items .= trim($key, "'") . "='$value',";
  }

  // remove a ultima virgula
  $items = rtrim($items, ',');

  $sql  = "UPDATE formularios";
  $sql .= " SET $items";
  $sql .= " WHERE cpf= '" . $cpf . "';";

  try {
    $database->query($sql);

    $_SESSION['message'] = 'Registro atualizado com sucesso.';
    $_SESSION['type'] = 'success';

  } catch (Exception $e) { 

    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
  } 

  close_database($database);
}

/**
 *  SQL pra contar as coisas do Informativo
 */
function informativo($diagnostico = null) {
  
	$database = open_database();
	$numero = null;
	$valor = null;

	try {
	    $sql = "SELECT count(diagnostico) AS contador FROM formularios WHERE diagnostico = '" . $diagnostico . "';";
	    $result = $database->query($sql);
		
	    $row= mysqli_fetch_array($result);
		$valor = $row['contador'];
		
	    if ($valor == null) {
	      $numero = 0;
	    }else {
		  $numero = $valor;
	    }
		
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
	}	

	close_database($database);
	return $numero;
	}
	
	
/**
 *  SQL pra contar todos os registros
 */
function all() {
  
	$database = open_database();
	$numero = null;
	$valor = null;

	try {
	    $sql = "SELECT count(cpf) AS contador FROM formularios;";
	    $result = $database->query($sql);
		
	    $row= mysqli_fetch_array($result);
		$valor = $row['contador'];
		
	    if ($valor == null) {
	      $numero = 0;
	    }else {
		  $numero = $valor;
	    }
		
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
	}	

	close_database($database);
	return $numero;
	}

