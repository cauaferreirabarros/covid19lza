<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>

<?php include(HEADER_TEMPLATE); ?>
<?php $db = open_database(); ?>

<?php if ($db) : ?>


<header>
	<div class="row">
		<div class="col-sm-6">
			<h2><strong>Informativo</strong></h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-dark" href="formulario\form.php"><i class="far fa-file-alt"></i> Preencha o formulário</a>
			<a class="btn btn-dark" href="formulario\busca.php"><i class="fa fa-pencil-square-o"></i> Edite seu formulário</a>
	    </div>
	</div>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['message']; ?>
	</div>
	<?php clear_messages(); ?>
<?php endif; ?>

<hr>

<div class="accordion" id="accordionExample">
  <div class="card border-info">
    <div class="card-header" style="text-align: center;" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <strong>Informe epidemiológico</strong>
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
		<div class="alert alert-warning" role="alert">
			<b>Casos suspeitos: <?php echo informativo("Suspeito"); ?></b>
		</div>
		<div class="alert alert-danger" role="alert">
			<b>Casos confirmados: <?php echo informativo("Infectado"); ?></b>
		</div>
		<div class="alert alert-success" role="alert">
			<b>Curas confirmadas: <?php echo informativo("Curado"); ?></b>
		</div>
		<div class="alert alert-dark" role="alert">
			<b>Óbitos confirmados: 3</b>
		</div>
		<div class="row">
			<i>&nbsp;&nbsp Total de formulários preenchidos: <b><?php echo all(); ?></b></i>
		</div>
      </div>

    </div>
  </div>
    <div class="card border-info">
    <div class="card-header" style="text-align: center;" id="headingSix">
      <h5 class="mb-0">
        <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
          <strong>Sintomas do coronavírus (COVID-19)</strong>
        </button>
      </h5>
    </div>
    <div id="collapseSix" class="collapse text-justify" aria-labelledby="headingSix" data-parent="#accordionExample">
      <div class="card-body">
        Dentre os sintomas mais comuns da COVID – 19 estão a febre, o cansaço e a tosse seca. Entretanto, alguns outros sintomas podem ser observados, 
		como dores, congestão nasal, corrimento nasal, dor de garganta, diarreia, perda do paladar, perda do olfato e dificuldade para respirar. 
      </div>
    </div>
  </div>
  <div class="card border-info">
    <div class="card-header" style="text-align: center;" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <strong>Como se proteger do coronavírus (COVID-19)</strong>
        </button>
      </h5>
    </div>

    <div id="collapseTwo" class="collapse text-justify" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
	  
		Esteja atento às principais medidas de prevenção de contração e disseminação do coronavírus (COVID - 19): 
		<ul>
			<li> Higienize suas mãos fazendo uso do sabão e da água ou de um higienizador à base de álcool;
			<li> Mantenha o distanciamento mínimo de 1 metro das pessoas;
			<li> Evite tocar em seus olhos, nariz e boca. Ao tossir, cubra a boca e o nariz com a parte interna do cotovelo ou com um lenço;
			<li> Fique em isolamento domiciliar e siga as recomendações das autoridades de vigilância sanitária locais e nacionais.
		</ul>
      </div>
    </div>
  </div>
  <div class="card border-info">
    <div class="card-header" style="text-align: center;" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <strong>Como é transmitido o coronavírus (COVID-19)</strong>
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse text-justify" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
		A transmissão acontece de duas principais formas:	
        <ul>
			<li> De pessoa para pessoa através de pequenas gotículas do nariz ou da boca que se espalham quando o contaminado tosse ou espirra;
			<li> De objetos ou superfícies contaminadas por essas gotículas para pessoas através de seus olhos, nariz ou boca.
		</ul>
      </div>
    </div>
  </div>
  <div class="card border-info">
    <div class="card-header" style="text-align: center;" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <strong>Recomendações para infectados</strong>
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse text-justify" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body">
		Se você está infectado com o coronavírus, atente-se para as seguintes recomendações:
        <ul>
			<li> Fique em isolamento domiciliar;
			<li> Faça uso das máscaras de proteção;
			<li> Higienize as superfícies por onde passar, como por exemplo, vaso sanitário, pia, entre outros. A desinfecção pode ser feita com água sanitária ou com álcool;
			<li> Tenha atenção quanto aos itens de uso pessoal. Garanta que só você tenha acesso a eles;
			<li> Mantenha os ambientes arejados;
			<li> Se você mora com outras pessoas, elas também deverão ficar em isolamento e observação.
		</ul> 
      </div>
    </div>
  </div>
  <div class="card border-info">
    <div class="card-header" style="text-align: center;" id="headingFive">
      <h5 class="mb-0">
        <button class="btn btn-info collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          <strong>Fontes</strong>
        </button>
      </h5>
    </div>
    <div id="collapseFive" class="collapse text-justify" aria-labelledby="headingFive" data-parent="#accordionExample">
      <div class="card-body">
        O SIG Covid – 19 é um sistema colaborativo e conta com a contribuição da população. Seu objetivo é auxiliar o controle de pessoas suspeitas, infectadas e curadas de COVID – 19 na cidade de Luziânia – GO 
		através de um mapa interativo. Além disso, o mapa também traz a localização das principais unidades de saúde do município. As informações nele encontradas foram retiradas das seguintes fontes oficiais:
		<br>Organização Pan-Americana da Saúde (OPAS/OMS). Endereço eletrônico: <a href="https://www.paho.org/bra/" target="_blank">< https://www.paho.org/bra/ >.</a>
		<br>Ministério da Saúde. Endereço eletrônico: <a href="https://coronavirus.saude.gov.br/" target="_blank">< https://coronavirus.saude.gov.br/ >.</a>
		<br>Secretaria Municipal de Saúde de Luziânia. Endereço eletrônico: <a href="http://luziania.go.gov.br/secretaria-municipal-de-saude/" target="_blank">< http://luziania.go.gov.br/secretaria-municipal-de-saude/ >.</a>
      </div>
    </div>
  </div>

</div>
</div>

<?php else : ?>
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
	</div>

<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>