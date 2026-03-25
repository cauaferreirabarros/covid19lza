<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>

<?php include(HEADER_TEMPLATE); ?>
<?php $db = open_database(); ?>

<?php if ($db) : ?>

<?php 
	
	function diaglatlong(){
		
		$database = open_database();
		$found = null;

		try {
			$sql = "SELECT diagnostico, latitude, longitude FROM `formularios` WHERE diagnostico <> 'indefinido'";
			$result = $database->query($sql);
			$found = $result;
		
		} catch (Exception $e) {
		  $_SESSION['message'] = $e->GetMessage();
		  $_SESSION['type'] = 'danger';
		}
		close_database($database);
		return $found;		
	}
	
?>

<?php 
	$info = diaglatlong();
	$arrayDiagnostico[] = null;
	$arrayLatitude[] = null;
	$arrayLongitude[] = null;
	
	//echo $info;
	if ($info) {
		/* fetch associative array */
		$i = 0;
		while ($row = $info->fetch_assoc()) {
			//printf ("%s (%s) (%s)\n", $row["diagnostico"], $row["latitude"], $row["longitude"]);
				$arrayDiagnostico [$i] = $row["diagnostico"];
				$arrayLatitude [$i] = $row["latitude"];
				$arrayLongitude [$i] = $row["longitude"];
				$i = $i +1;
		}
	}
	$tamanho = sizeof($arrayDiagnostico);
	//foreach ($arrayDiagnostico as $conteudo){
	//	echo($conteudo);
	//	echo " ";
	//}
	
?>

<div class="row">
	<b>Legenda do mapa:</b>
</div>
<div class="row">
	<div class="text-primary col-md-3">
		<b>Azul:</b> Unidades de saúde
	</div>
	<div class="text-warning col-md-4">
		<b>Laranja:</b> Suspeitos de contaminação
	</div>
	<div class="text-danger col-md-2">
		<b>Vermelho:</b> Infectados 
	</div>
	<div class="text-success col-md-2">
		<b>Verde:</b> Curados 
	</div>
	<br>
</div>

<div id="map" style="width: 100%; height: 480px;"></div>

<script>

	var 
		mbUrl1= 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=<AT>',
	    mbUrl2 = 'http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}';

		var maparua  = L.tileLayer(mbUrl1, {id: 'mapbox.streets', maxZoom: 20}),
        mapasatelite  = L.tileLayer(mbUrl2, {subdomains:['mt0','mt1','mt2','mt3'], maxZoom: 20});

		var map = L.map('map', {
			center: [-16.247025, -47.931149], 
			zoom: 14,
			layers: [maparua, mapasatelite]
		});
		
		// -----MAPA DE CONTÁGIO-----
		// ICONES DE CONTÁGIO
		
		// ADICIONANDO OS PONTOS DE CONTÁGIO
		
		var curado = L.AwesomeMarkers.icon({
		icon: 'user',
		prefix: 'fa',
		markerColor: 'green'
		});
		
		var infectado = L.AwesomeMarkers.icon({
		icon: 'user',
		prefix: 'fa',
		markerColor: 'red'
		});
		
		var suspeito = L.AwesomeMarkers.icon({
		icon: 'user',
		prefix: 'fa',
		markerColor: 'orange'
		});
		
		var array_marker = [];
		var arrayDiagnostico2 = JSON.parse('<?php echo json_encode($arrayDiagnostico) ?>');
		var arrayLatitude2 = JSON.parse('<?php echo json_encode($arrayLatitude) ?>');
		var arrayLongitude2 = JSON.parse('<?php echo json_encode($arrayLongitude) ?>');
		var tamanho2 = "<?php echo $tamanho ?>";
		
		for(var i = 0; i < tamanho2; i++){
			if (arrayDiagnostico2[i] == "Curado"){
				var iconezinho = curado;
			} else if (arrayDiagnostico2[i] == "Infectado"){
				var iconezinho = infectado;
			} else {
				var iconezinho = suspeito;
			}
			array_marker[i]= L.marker([arrayLatitude2[i],arrayLongitude2[i]], {title: arrayDiagnostico2[i] , icon: iconezinho}).bindPopup('<b>'+arrayDiagnostico2[i]+'</b>');
		}
		
		var contagios  = L.layerGroup(array_marker);
		
		
		// -----MAPA DAS UNIDADES DE SAÚDE-----
		// ICONES DAS UNIDADES DE SAÚDE
		
		var US = L.AwesomeMarkers.icon({
			icon: 'plus-square',
			prefix: 'fa',
			markerColor: 'blue'
			});
			
		// ADICIONANDO PONTOS DAS UNIDADES DE SAÚDE	
		
		var US1= L.marker([-16.251550, -47.951275], {title:'Santa Luzia', icon: US}).bindPopup("<b>Hospital Santa Luzia</b><br>Rede particular<br>Atendimento: 24h<br>Telefone: (61) 3622-9600<br>Endereço: Praça Raimundo de Araújo Melo, 114 - Centro.<br><a href='https://www.google.com.br/maps/place/Hospital+Santa+Luzia/@-16.2569051,-47.9515105,15z/data=!4m5!3m4!1s0x93599825f7e81951:0xc890ddcf8e9c3a56!8m2!3d-16.2515191!4d-47.9511809' target='_blank'>Como chegar</a>"),
			US2= L.marker([-16.252206, -47.915804], {title:'UPA', icon: US}).bindPopup("<b>UPA II - José Paulo Boni</b><br>Rede pública<br>Atendimento 24h<br>Telefone: (61) 3620-0132<br>Endereço: R. Joaquim Nabuco, s/n - Parque Estrela Dalva II.<br><a href='https://www.google.com/maps/place/UPA+II+%22Jos%C3%A9+Paulo+Boni%22+Luzi%C3%A2nia/@-16.252206,-47.9164007,18z/data=!4m5!3m4!1s0x9359978ea2ce26c9:0x950e253dd6847150!8m2!3d-16.2523759!4d-47.9157523' target='_blank'>Como chegar</a>"),
			US3= L.marker([-16.265702, -47.955338], {title:'CAIS', icon: US}).bindPopup("<b>CAIS - Centro de Assistência Integrado da Saúde</b><br>Rede pública<br>Atendimento: Segunda a sexta das 8h às 18h<br>Telefone: (61) 3906-3583<br>Endereço: R. Isac Gonçalves, S/n - St. Fumal.<br><a href='https://www.google.com/maps/place/CAIS+-+Centro+de+Assist%C3%AAncia+Integrado+da+Sa%C3%BAde/@-16.2631095,-47.9581703,16.81z/data=!4m5!3m4!1s0x9359985deaaa10ab:0xa0792c434b2fb341!8m2!3d-16.2660533!4d-47.9552391' target='_blank'>Como chegar</a>"),
			US4= L.marker([-16.257420, -47.959497], {title:'CEME', icon: US}).bindPopup("<b>Clinica CEME</b><br>Rede particular<br>Atendimento: Segunda a sexta das 7h às 18h<br>Telefone: (61) 3011-6060<br>Endereço: Av. Santa Maria - St. Aeroporto.<br><a href='https://www.google.com/maps/place/CEME/@-16.25742,-47.9600442,19z/data=!4m5!3m4!1s0x93599857bcd1146b:0x49750d9ed7c1e4e6!8m2!3d-16.2575104!4d-47.9595783' target='_blank'>Como chegar</a>"),
			US5= L.marker([-16.261779, -47.960817], {title:'Posto de Saúde Setor Aeroporto', icon: US}).bindPopup("<b>Posto de Saúde - Setor Aeroporto</b><br>Rede pública<br>Atendimento: Segunda a sexta das 8h às 17h<br>Telefone: (61) 3622-1471<br>Endereço: Av. Central, 628-672 - St. Fumal.<br><a href='https://www.google.com/maps/place/Posto+de+Sa%C3%BAde+Setor+Aeroporto/@-16.2617255,-47.961374,19z/data=!3m1!4b1!4m5!3m4!1s0x9359985886233a69:0x21fecbefbb029965!8m2!3d-16.2617255!4d-47.9608268' target='_blank'>Como chegar</a>"),
			US6= L.marker([-16.245579, -47.960599], {title:'Posto de Saúde Setor Norte Maravilha', icon: US}).bindPopup("<b>Posto de Saúde - Setor Norte Maravilha</b><br>Rede pública<br>Atendimento: <br>Telefone: <br>Endereço: R. Guanabara, 299-353 - St. Pres. Kennedy.<br><a href='https://www.google.com/maps/place/PSF+-+Setor+Norte+Maravilha/@-16.246379,-47.9638087,16z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x0:0x751d30b1eea7ae25!8m2!3d-16.2457264!4d-47.9606465' target='_blank'>Como chegar</a>"),
			US7= L.marker([-16.237866, -47.947898], {title:'Posto de Saúde Alto das Caraibas', icon: US}).bindPopup("<b>Posto de Saúde - Alto das Caraibas</b><br>Rede pública<br>Atendimento: <br>Telefone: (61) 3622-8033<br>Endereço: St - Alto das Caraíbas.<br><a href='https://www.google.com/maps/place/Posto+de+Sa%C3%BAde+PSF+-+Alto+das+Caraibas/@-16.2378945,-47.9565409,15z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x0:0xfa17fbb412e5fb3a!8m2!3d-16.2379842!4d-47.9479408' target='_blank'>Como chegar</a>"),
			US8= L.marker([-16.227896, -47.932475], {title:'Posto de Saúde Jardim Luzilia', icon: US}).bindPopup("<b>Posto de Saúde - Jardim Luzilia</b><br>Rede pública<br>Atendimento: <br>Telefone: <br>Endereço: Jardim Luzilia.<br><a href='https://www.google.com/maps/place/Posto+de+Sa%C3%BAde+Jardim+Luzilia/@-16.2278953,-47.9499847,14z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x0:0xe92870257d715d64!8m2!3d-16.2278762!4d-47.9324806' target='_blank'>Como chegar</a>"),
			US9= L.marker([-16.207050, -47.926259], {title:'Posto de Saúde Parque Alvorada', icon: US}).bindPopup("<b>Posto de Saúde - Parque Alvorada</b><br>Rede pública<br>Atendimento: <br>Telefone: (61) 3906-3042<br>Endereço: Parque Alvorada I.<br><a href='https://www.google.com/maps/place/Posto+de+Sa%C3%BAde+Parque+Alvorada/@-16.2072021,-47.9280587,17.25z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x0:0x1899078781f3749a!8m2!3d-16.2070303!4d-47.926286' target='_blank'>Como chegar</a>"),
			US10= L.marker([-16.235414, -47.907362], {title:'Posto de Saúde  do Copaibas', icon: US}).bindPopup("<b>Posto de Saúde do Copaibas</b><br>Rede pública<br>Atendimento: Segunda a sexta das 8h às 17h<br>Telefone: (61) 3906-3336<br>Endereço: R. Sete, 10b - Parque Estrela Dalva III.<br><a href='https://www.google.com/maps/place/Posto+de+saude+do+copaibas/@-16.23455,-47.9057873,14.54z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x0:0x6294a6e773ba8aaa!8m2!3d-16.2353188!4d-47.9073429' target='_blank'>Como chegar</a>"),
			US11= L.marker([-16.261003, -47.932045], {title:'Posto de Saúde Setor Leste', icon: US}).bindPopup("<b>Posto de Saúde - Setor Leste</b><br>Rede pública<br>Atendimento: <br>Telefone: <br>Endereço: St. Leste.<br><a href='https://www.google.com/maps/place/Posto+de+Sa%C3%BAde/@-16.2610028,-47.9404254,15z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x0:0x341306a838212caf!8m2!3d-16.260843!4d-47.9321104' target='_blank'>Como chegar</a>"),
			US12= L.marker([-16.255788, -47.941984], {title:'Posto de Saúde Vila Juracy', icon: US}).bindPopup("<b>Posto de Saúde - Vila Juracy</b><br>Rede pública<br>Atendimento: <br>Telefone: <br>Endereço: Vila Juracy.<br><a href='https://www.google.com/maps/place/Posto+De+Sa%C3%BAde/@-16.2610028,-47.9404254,15z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x0:0xa372d74c45a2dc13!8m2!3d-16.255773!4d-47.9419702' target='_blank'>Como chegar</a>"),
			US13= L.marker([-16.182329, -47.938457], {title:'Unidade de Saúde da Família Sol Nascente', icon: US}).bindPopup("<b>Unidade de Saúde da Família - Sol Nascente</b><br>Rede pública<br>Atendimento: Segunda a sexta das 8h às 17h<br>Telefone: <br>Endereço: R. 14, 658-682 - Sol Nascente.<br><a href='https://www.google.com/maps/place/Unidade+de+Sa%C3%BAde+da+Fam%C3%ADlia/@-16.1823336,-47.9406023,17z/data=!3m1!4b1!4m8!1m2!2m1!1sPosto+de+sa%C3%BAde!3m4!1s0x93599a696e4450d9:0xe4d0b2a2de0bf935!8m2!3d-16.1823336!4d-47.9384136' target='_blank'>Como chegar</a>"),
			US14= L.marker([-16.159728, -47.938250], {title:'Unidade Básica de Saúde da Família Mingone I', icon: US}).bindPopup("<b>Unidade Básica de Saúde <br>da Família - Mingone I</b><br>Rede pública<br>Atendimento: Segunda a sexta das 8h às 17h<br>Telefone: <br>Endereço: R. 13, 137 - Parque Industrial Mingone.<br><a href='https://www.google.com/maps/place/UBSF+MINGONE+I/@-16.1597387,-47.9385779,19.71z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x93599b3d437c8a55:0xae80e3210e30d816!8m2!3d-16.1597021!4d-47.9382537' target='_blank'>Como chegar</a>"),
			US15= L.marker([-16.152041, -47.932998], {title:'Posto de saúde Parque Mingone II', icon: US}).bindPopup("<b>Posto de saúde - Parque Mingone II</b><br>Rede pública<br>Atendimento: Segunda a sexta das 8h às 17h<br>Telefone<br>Endereço: R. 42 - Parque Industrial Mingone.<br><a href='https://www.google.com/maps/place/Posto+de+sa%C3%BAde+Parque+Mingone+II/@-16.1521369,-47.9339778,18z/data=!3m1!4b1!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x93599b0bad501b3f:0x9487ce4b72c87059!8m2!3d-16.1521369!4d-47.9330576' target='_blank'>Como chegar</a>"),
			US16= L.marker([-16.148937, -47.945776], {title:'Policlínica Saúde & Vida', icon: US}).bindPopup("<b>Policlínica Saúde & Vida</b><br>Rede particular<br>Atendimento: Segunda a sexta das 7h às 18h<br>Telefone: (61) 3603-1704<br>Endereço: Av. Lucena Roriz - Jardim do Inga.<br><a href='https://www.google.com/maps/place/Policl%C3%ADnica+Sa%C3%BAde+%26+Vida/@-16.1481028,-47.9450647,16.63z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x0:0x6b78454221776eaf!8m2!3d-16.1488823!4d-47.945838' target='_blank'>Como chegar</a>"),
			US17= L.marker([-16.148510, -47.943682], {title:'Posto de Saude Do Ped IX', icon: US}).bindPopup("<b>Posto De Saude - Ped IX</b><br>Rede pública<br>Atendimento: Segunda a sexta das 7h às 17h<br>Telefone: (61) 3623-1409<br>Endereço: R. 5, 160 - Parque Napolis B.<br><a href='https://www.google.com/maps/place/Posto+De+Saude+Do+Ped+IX/@-16.14851,-47.9442292,19z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x93599ac0e525f265:0xc2cc77a32346ed98!8m2!3d-16.1484476!4d-47.9435983' target='_blank'>Como chegar</a>"),
			US18= L.marker([-16.140467, -47.933583], {title:'Posto de Saúde Jardim Marília', icon: US}).bindPopup("<b>Posto de Saúde - Jardim Marília</b><br>Rede pública<br>Atendimento: Segunda a sexta das 8h às 17h<br>Telefone: <br>Endereço: Av. Marília, 480-504 - Cidade Jardim Marilia.<br><a href='https://www.google.com/maps/place/Posto+De+Sa%C3%BAde+-+Jardim+Mar%C3%ADlia/@-16.1404879,-47.9344118,16.35z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x0:0xe793f7ae7a6022c2!8m2!3d-16.1404007!4d-47.9335588' target='_blank'>Como chegar</a>"),
			US19= L.marker([-16.130914, -47.948904], {title:'Unidade de Saúde Jardim Planalto', icon: US}).bindPopup("<b>Unidade de Saúde - Jardim Planalto</b><br>Rede pública<br>Atendimento: <br>Telefone: <br>Endereço: Rua 16 Quadra 42 Lote 19 - Jardim Planalto.<br><a href='https://www.google.com/maps/place/Unidade+Sa%C3%BAde+da+Fam%C3%ADlia/@-16.1308814,-47.948867,18.79z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x0:0xfb8f27095c3cb40c!8m2!3d-16.130854!4d-47.9488504' target='_blank'>Como chegar</a>"),
			US20= L.marker([-16.126877, -47.963779], {title:'Unidade de Saúde da Família Ipê', icon: US}).bindPopup("<b>Unidade de Saúde da Família - Ipê</b><br>Rede pública<br>Atendimento: Segunda a sexta das 7h às 17h<br>Telefone:<br>Endereço: R. 20 - Jardim Zuleika.<br><a href='https://www.google.com/maps/place/Unidade+de+Sa%C3%BAde+da+Fam%C3%ADlia+-+Ip%C3%AA/@-16.1255754,-47.9597352,14.83z/data=!4m8!1m2!2m1!1sposto+de+sa%C3%BAde!3m4!1s0x0:0x168350f8faf8e960!8m2!3d-16.126933!4d-47.9638249' target='_blank'>Como chegar</a>"),
			US21= L.marker([-16.246649, -47.913087], {title:'Hospital Regional de Luziânia', icon: US}).bindPopup("<b>Hospital Regional de Luziânia</b><br>Rede pública<br>Atendimento: EM OBRAS<br>Telefone: (61) 3906-3148<br>Endereço: Av. Alfredo Nasser, s/n - Parque Estrela Dalva VII.<br><a href='https://www.google.com/maps/place/Hospital+Regional+de+Luzi%C3%A2nia/@-16.2464694,-47.9124012,16.98z/data=!4m5!3m4!1s0x93599826026ddcef:0xca5419d789005a62!8m2!3d-16.2464642!4d-47.9132572' target='_blank'>Como chegar</a>"),
			US22= L.marker([-16.281637, -47.867455], {title:'Posto de Saúde do Jardim São Paulo', icon: US}).bindPopup("<b>Posto de Saúde - Jardim São Paulo</b><br>Rede pública<br>Atendimento: <br>Telefone: <br>Endereço: Jardim São Paulo<br><a href='https://www.google.com.br/maps/place/Posto+de+saude/@-16.2816885,-47.8669138,16.25z/data=!4m5!3m4!1s0x9359bd95d64c4e77:0x9f8297c1fb70d4f6!8m2!3d-16.281606!4d-47.8673284' target='_blank'>Como chegar</a>"),
			US23= L.marker([-16.114200, -47.973205], {title:'Posto de Saúde Parque Marajó', icon: US}).bindPopup("<b>Posto de Saúde - Parque Marajó</b><br>Rede pública<br>Atendimento: <br>Telefone: <br>Endereço: R. Seis - Parque Marajo, Valparaíso de Goiás - GO.<br><a href='https://www.google.com.br/maps/place/Posto+de+saude+ESF+Maraj%C3%B3/@-16.1141987,-47.9732085,18.54z/data=!4m8!1m2!2m1!1sposto+de+saude!3m4!1s0x935984ef05ef6713:0x8543931e0661f077!8m2!3d-16.1141865!4d-47.9732213' target='_blank'>Como chegar</a>");
			//US24= L.marker([-16.0, -47.0], {title:'Posto de Saúde', icon: US}).bindPopup("<b>Posto de Saúde - </b><br>Rede pública<br>Atendimento<br>Telefone<br>Endereço: <br><a href='LINK' target='_blank'>Como chegar</a>");
			
		var USs  = L.layerGroup([US1,US2,US3,US4,US5,US6,US7,US8,US9,US10,US11,US12,US13,US14,US15,US16,US17,US18,US19,US20,US21,US22,US23]);
		
		var baseMaps = {
			"<b>Rua</b>": maparua,
			"<b>Sat&eacutelite</b>": mapasatelite
		};
		
		var groupedOverlays = {
			"<b>Camadas</b>": {"<b>Contágio</b>": contagios,
			"<b>Unidades de Saúde</b>": USs}
		};
		
		L.control.groupedLayers(baseMaps,groupedOverlays).addTo(map);
		
		var searchLayer = L.layerGroup([US1,US2,US3,US4,US5,US6,US7,US8,US9,US10,US11,US12,US13,US14,US15,US16,US17,US18,US19,US20,US21,US22,US23]);
		contagios.addTo(map);
		USs.addTo(map);
		map.addControl( new L.Control.Search({layer: searchLayer}));
		
		
		
</script>

<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>