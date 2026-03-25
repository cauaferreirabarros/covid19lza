<?php require_once '../config.php'; ?>
<?php 
  require_once('functions.php'); 
  edit();
?>

<?php include(HEADER_TEMPLATE);
?>

<h2>Atualizar formulário epidemiológico</h2>
<p class="font-italic">Antes de enviar a edição, verifique todas as informações do formulário.</p>

<form action="editform.php?cpf=<?php echo $_GET['cpf'] ?>" method="POST" onSubmit="return validarForm(this);">
	<hr />
	<div class="row">
		<div class="form-group col-md-3">
		  <label for="cpf">CPF</label>
		  <input type="text" class="form-control" name="formulario['cpf']" maxLength="14" onkeypress="mascaraCPF(this,cpf)" value="<?php echo $formulario['cpf']; ?>" required>
		  <div class="help-block with-errors"></div>
		</div>
		
		<div class="form-group col-md-7">
		  <label for="nome">Nome Completo</label>
		  <input type="text" class="form-control" name="formulario['nome']" value="<?php echo $formulario['nome']; ?>" required>
		  <div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="row">
    <div class="form-group col-md-1">
      <label for="idade">Idade</label>
      <input type="text" class="form-control" name="formulario['idade']" value="<?php echo $formulario['idade']; ?>" required>
	  <div class="help-block with-errors"></div>
    </div>
	
	<div class="form-group col-md-2">
      <label for="sexo">Sexo</label>
		<select class="form-control" id="sexo" name="formulario['sexo']" value="<?php echo $formulario['sexo']; ?>">
			<option>Feminino</option>
			<option>Masculino</option>
		</select>
    </div>
	<div class="form-group col-md-2">
      <label for="telefone">Telefone</label>
      <input type="text" class="form-control" name="formulario['telefone']" maxlength="15" value="<?php echo $formulario['telefone']; ?>" required>
	  <div class="help-block with-errors"></div>
    </div>
	
	<div class="form-group col-md-5">
      <label for="endereco">Endereço</label>
      <input type="text" class="form-control" name="formulario['endereco']" value="<?php echo $formulario['endereco']; ?>" required>
	  <div class="help-block with-errors"></div>
    </div>
  </div>
  
  <div class="row">
    <div class="form-group col-md-3">
      <label for="bairro">Bairro</label>
      <input type="text" class="form-control" name="formulario['bairro']" value="<?php echo $formulario['bairro']; ?>" required>
	  <div class="help-block with-errors"></div>
    </div>
    
    <div class="form-group col-md-2">
      <label for="cep">CEP</label>
      <input type="text" class="form-control" name="formulario['cep']" maxlength="10" onkeypress="mascaraCEP(this,cep);" value="<?php echo $formulario['cep']; ?>" required>
	  <div class="help-block with-errors"></div>
    </div>
	
    <div class="form-group col-md-3">
      <label for="cidade">Município</label>
      <input type="text" class="form-control" name="formulario['cidade']" placeholder="Luziânia" disabled>
	  <div class="help-block with-errors"></div>
    </div>
   
    <div class="form-group col-md-1">
      <label for="estado">Estado</label>
      <input type="text" class="form-control" name="formulario['estado']" placeholder="GO" disabled>
    </div>  
		<div class="help-block with-errors"></div>
  </div>
  
	<div class="row">
	  <div class="form-group col-md-4">
      <label for="exame">Fez exame nos últimos 15 dias e deu positivo?</label>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="exame" value='sim'>
			<label class="form-check-label" for="exame">
			Sim
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="exame" value='nao' checked>
			<label class="form-check-label" for="exame">
			Não
			</label>
		</div>
	</div>
	<div class="form-group col-md-6">
      <label for="curado">Você já fez algum exame no qual obteve positivo e após isso realizou mais dois exames (com intervalo de 24h entre cada um deles) com resultados negativos?</label>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="curado" value='sim'>
				<label class="form-check-label" for="curado">
					Sim, estou curado!
				</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="curado" value='nao' checked>
				<label class="form-check-label" for="curado">
					Não, preciso me cuidar.
				</label>
		</div>
	</div>
	</div>
	<div class="row">
	
	<div class="form-group col-md-3">
		<label for="contatosuspeito">Teve contato com algum infectado nos últimos 15 dias?</label>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="contatosuspeito" value='sim'>
				<label class="form-check-label" for="exampleRadios3">
				Sim
				</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="contatosuspeito" value='nao' checked>
				<label class="form-check-label" for="exampleRadios4">
				Não
				</label>
			</div>
	</div>
	<div class="form-group col-md-9">
      <label for="sintomas">Quais destes sintomas você sentiu nos últimos 15 dias?</label>
	  <div class="row">
	   <div class="form-group col-md-2">
		<div class="form-check">
			<input class="form-check-input" name="sintomas[]" type="checkbox" value="Febre">
				<label class="form-check-label" for="sintomas">
					Febre
				</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" name="'sintomas[]" type="checkbox" value="Cansaço">
				<label class="form-check-label" for="sintomas">
					Cansaço
				</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" name="sintomas[]" type="checkbox" value="Tosse seca">
				<label class="form-check-label" for="sintomas">
					Tosse seca
				</label>
		</div>
	   </div>
	   <div class="form-group col-md-4">
		<div class="form-check">
			<input class="form-check-input" name="sintomas[]" type="checkbox" value="Dificuldade para respirar">
				<label class="form-check-label" for="sintomas">
					Dificuldade para respirar
				</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" name="sintomas[]" type="checkbox" value="Coriza">
				<label class="form-check-label" for="sintomas">
					Coriza
				</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" name="sintomas[]" type="checkbox" value="Dor de garganta">
				<label class="form-check-label" for="sintomas">
					Dor de garganta
				</label>
		</div>
		</div>
		<div class="form-group col-md-3">
		<div class="form-check">
			<input class="form-check-input" name="sintomas[]" type="checkbox" value="Dor de cabeça">
				<label class="form-check-label" for="sintomas">
					Dor de cabeça
				</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" name="sintomas[]" type="checkbox" value="Perda de paladar">
				<label class="form-check-label" for="sintomas">
					Perda do paladar
				</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" name="sintomas[]" type="checkbox" value="Perda de olfato">
				<label class="form-check-label" for="sintomas">
					Perda do olfato
				</label>
		</div>
		</div>
		</div>
	</div>
  </div>
  
  <div class="form-check">
		<input class="form-check-input" name="TermoDeUso" type="checkbox" value="sim" data-error="Você concorda com os termos de uso?" required>
			<label class="form-check-label" for="termo">
				Ao marcar esta opção você aceita os <a href="" data-toggle="modal" data-target="#modalExemplo"> Termos de Uso</a>.
			</label>
			<div class="help-block with-errors"></div>
  </div>
  
	<!-- Modal -->
	<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Termos de uso</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body text-justify">
			Ao aceitar este Termo de Uso, você concorda em:<br>
			<ul>
				<li> Conceder a localização geográfica do endereço informado no formulário epidemiológico;
				<li> Conceder licença para fins de utilização das suas informações às autoridades de saúde à nível municipal, estadual e federal SE e SOMENTE SE solicitado por elas.
			</ul>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
		  </div>
		</div>
	  </div>
	</div>
  
	
 </div> 
  
  <div id="actions" class="row" style="text-align: center;">
    <div class="col-md-12">
      <button type="submit" class="btn btn-success">Enviar</button>
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


//---------------------------MASCARA DE CEP---------------------------

function mascaraCEP(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}
 
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
 
function cep(v){
 
    //Remove tudo o que n?o ? d?gito
    v=v.replace(/\D/g,"")
 
    if (v.length <= 8) { //CEP
 
        //Coloca um ponto entre o terceiro e o quarto d?gitos
        v=v.replace(/(\d{2})(\d)/,"$1.$2")
 
        //Coloca um h?fen entre o terceiro e o quarto d?gitos
        v=v.replace(/(\d{3})(\d{1,3})$/,"$1-$2")
 
    } else {
 
        return v
 
    }
 
    return v
 
}

function validarCEP(cep) {  
    cep = cep.replace(/[^\d]+/g,'');    
    if(cep == '') return false; 
    // Elimina ceps invalidos conhecidos    
    if (cep.length != 8 || 
        cep == "00000000" || 
        cep == "11111111" || 
        cep == "22222222" || 
        cep == "33333333" || 
        cep == "44444444" || 
        cep == "55555555" || 
        cep == "66666666" || 
        cep == "77777777" || 
        cep == "88888888" || 
        cep == "99999999")
            return false;             
    return true;   
}

function validarForm(f) { 
	if (validarCPF(f.cpf.value)==false) { 
		alert ("O campo CPF deve ser válido."); 
		return false; 
	}
	return true; 
} 
</script>

<?php include(FOOTER_TEMPLATE); ?>