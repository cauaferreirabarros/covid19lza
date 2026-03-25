<?php require_once '../config.php'; ?>

<?php 
  require_once('functions.php');
?>

<?php include(HEADER_TEMPLATE); ?>

<h2><strong>Buscar formulário epidemiológico</strong></h2>

<form action="editform.php" method="GET" data-toggle="validator" onSubmit="return validarForm(this);">
  <!-- area de campos do form -->
  <hr />
  <div class="row">
    <div class="form-group col-md-3">
      <label for="campo2">Informe seu CPF</label>
      <input type="text" class="form-control" name="cpf" maxLength="14" onkeypress="mascaraCPF(this,cpf);" required>
	  <div class="help-block with-errors"></div>
    </div>
   </div>
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-success">Buscar</button>
      <a href="../index.php" class="btn btn-danger">Cancelar</a>
    </div>
  </div>
</form>

<script>

//---------------------------MASCARA DE CPF---------------------------

function mascaraCPF(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}
 
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
 
function cpf(v){
 
    //Remove tudo o que n?o ? d?gito
    v=v.replace(/\D/g,"")
 
    if (v.length <= 11) { //CPF
 
        //Coloca um ponto entre o terceiro e o quarto d?gitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
 
        //Coloca um ponto entre o terceiro e o quarto d?gitos
        //de novo (para o segundo bloco de n?meros)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
 
        //Coloca um h?fen entre o terceiro e o quarto d?gitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
 
    } else { 
 
        return v
 
    }
 
    return v
 
}

function validarCPF(cpf) {  
    cpf = cpf.replace(/[^\d]+/g,'');    
    if(cpf == '') return false; 
    // Elimina CPFs invalidos conhecidos    
    if (cpf.length != 11 || 
        cpf == "00000000000" || 
        cpf == "11111111111" || 
        cpf == "22222222222" || 
        cpf == "33333333333" || 
        cpf == "44444444444" || 
        cpf == "55555555555" || 
        cpf == "66666666666" || 
        cpf == "77777777777" || 
        cpf == "88888888888" || 
        cpf == "99999999999")
            return false;       
    // Valida 1o digito 
    add = 0;    
    for (i=0; i < 9; i ++)       
        add += parseInt(cpf.charAt(i)) * (10 - i);  
        rev = 11 - (add % 11);  
        if (rev == 10 || rev == 11)     
            rev = 0;    
        if (rev != parseInt(cpf.charAt(9)))     
            return false;       
    // Valida 2o digito 
    add = 0;    
    for (i = 0; i < 10; i ++)        
        add += parseInt(cpf.charAt(i)) * (11 - i);  
    rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11) 
        rev = 0;    
    if (rev != parseInt(cpf.charAt(10)))
        return false;       
    return true;   
}

function validarForm(f) { 
	if (validarCPF(f.cpf.value)==false) { 
		alert ("O campo CPF deve ser válido."); 
		return false; 
	} else  
	return true; 
}

</script>


<?php include(FOOTER_TEMPLATE); ?>