<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d H:i');

if (isset($_SESSION['id'])) {
	$ind = 0;
	$tg = 0;
	if (count($_SESSION['itens']) > 0) {
		$con = new mysqli("localhost", "root", "", "loja");
		$ind = 0;
		$tg = 0;

		foreach ($_SESSION['itens'] as $idProduto => $quantidade) {
			$sql = "select * from tb_roupa where pk_id_produto = {$idProduto}";
			$resultado = mysqli_query($con, $sql);
			while ($req = mysqli_fetch_assoc($resultado)) {
				$ind += 1;
				$preco = str_replace(',', '.', $req['vl_produto']);
				$tg = $tg + $preco;
				$tl = $preco * $quantidade;
			}
		}

		$id = $_SESSION['id'];
		$sql = "insert into tb_cesta(dt_compra,vl_compra,fk_id_cliente) values('$date', '$tl','$id')";
		mysqli_query($con, $sql);
		$sql = "select * from tb_cesta where pk_id_cesta = (select max(pk_id_cesta) from tb_cesta)";

		$resultado = mysqli_query($con, $sql);
		while ($req = mysqli_fetch_assoc($resultado)) {
			$cesta = $req['pk_id_cesta'];
		}

		foreach ($_SESSION['itens'] as $idProduto => $quantidade) {
			$sql = "select * from tb_roupa where pk_id_produto = {$idProduto}";

			$resultado = mysqli_query($con, $sql);
			while ($req = mysqli_fetch_assoc($resultado)) {
				$ind += 1;
				$preco = str_replace(',', '.', $req['vl_produto']);
				$tg = $tg + $preco;
				$tl = $preco * $quantidade;
				$sql = "insert into tb_itens_cesta(qt_produto,vl_produto,fk_id_cesta,fk_id_produto) values('$quantidade', '$preco','$cesta','$idProduto')";
				mysqli_query($con, $sql);
			}
		}
	}
}
?>

<?php


if (!isset($_SESSION['itens'])) {
	$_SESSION['itens'] = array();
}

if (isset($_GET['add']) && $_GET['add'] == "limparCesta") {
	session_destroy();
	session_unset();

	session_start();
	if (!isset($_SESSION['itens'])) {
		$_SESSION['itens'] = array();
	}
}

if (isset($_GET['add']) && $_GET['add'] == "cesta") {
	$idProduto = $_GET['id'];

	if (!isset($_SESSION['itens'][$idProduto])) {
		$_SESSION['itens'][$idProduto] = 1;
	} else {
		$_SESSION['itens'][$idProduto] += 1;
	}
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="icon" type="image/png" sizes="16x16" href="../imagens_site/imagens/favicon-32x32.png">

	<!--bootstrap-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

	<!--titulo-->
	<title> Fã Camisetas </title>

	<!--icones na página-->
	<script src="https://kit.fontawesome.com/700cddc25b.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="../global.css" />
	<link rel="stylesheet" href="../css/style.css" />

</head>
<header>
	<div id="cabecalho">
		<!--Imagem logo-->
		<div class='logo'>
			<a href="../vitrine/vitrine.php"><img src="../imagens_site/imagens/logo-removebg-preview.png" width=400 height=400></a>

		</div>

		<!--  caixa de busca mais nome loja-->
		<div class="col-lg-6">
			<h1>Fã Camisetas</h1>
			<h4>Vista seu lado Fã</h4>
			<div class="input-group">

				<input id="pesquisa" type="text" class="form-control" placeholder="Pesquise">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" onclick="fazBusca()">OK</button></a>
				</span>
			</div>
		</div>

		<!--icones perfil e carrinho-->
		<div id="icones_cabecalho">
			<a href="../vitrine/iconePerfil.php" id="login"><i class="fas fa-user"></i></a>
			<a href="../Cesta/cesta.php" id="carrinho"><i class="fas fa-shopping-basket"></i></a>
		</div>

	</div>

	<!--MENU-->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../vitrine/vitrine.php">Fã Camisetas</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" class="active" href="#">Vitrine<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="../pag_masculino/pag_masculino.php">Masculino</a></li>
							<li><a href="../pag_feminino/pag_feminino.php">Feminino</a></li>
						</ul>
					</li>
					<li><a href="../Cesta/cesta.php">Carrinho</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../cadastro/cadastro.php"><i class="fas fa-user"></i> Cadastro</a></li>
					<li><a href="../../index.php"><i class="fas fa-sign-in-alt"></i> Entrar</a></li>
				</ul>
			</div>
		</div>
	</nav>

</header>

<body style="background-image: url(https://images3.alphacoders.com/248/248327.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;">

	<div class="container">
		<form action="">
			<div class="form-group">

				<!--Lista dos produtos-->
				<div class=" row" id="prodMax">
					<div class="row" id="P1">
						<div class="form-group col-md-4">
							Produto
						</div>

						<div class="form-group col-md-2">
							Quantidade
						</div>

						<div class="form-group col-md-2">
							Preço
						</div>

						<div class="form-group col-md-2">
							Total
						</div>
						<div class="form-group col-md-2">

						</div>
					</div>

					<div class="row" id="prodMax">
						<?php
						$ind = 0;
						$tg = 0;
						if (count($_SESSION['itens']) > 0) {
							$con = new mysqli("localhost", "root", "", "loja");
							$ind = 0;
							$tg = 0;
							foreach ($_SESSION['itens'] as $idProduto => $quantidade) {
								$sql = "select * from tb_roupa where pk_id_produto = {$idProduto}";
								$resultado = mysqli_query($con, $sql);
								while ($req = mysqli_fetch_assoc($resultado)) {
									$ind += 1;
									$preco = str_replace(',', '.', $req['vl_produto']);
									$tg = $tg + $preco;
									$tl = $preco * $quantidade;
									echo '										
					<div class="row" id="P' . $ind . '">
						
						<div class="form-group col-md-4">
							<input type="text" id="produtoMax_' . $ind . '" class="form-control" value="' . $req['nome_roupa'] . '" readonly=“true”>
						</div>
						
						<div class="form-group col-md-2">
							<input type="number" id="quantidadeMax_' . $ind . '" onchange="calculaTotalPQ" class="form-control"  value="' . $quantidade . '" size="3" maxlength="3" min="1" max="10" step="1">
						</div>
						
						<div class="form-group col-md-2">
							<input type="text" id="precoMax_' . $ind . '" class="form-control" value="' . number_format($preco, 2) . '" readonly=“true”>
						</div>
						
						<div class="form-group col-md-2">
						    <input type="text" id="totalMax_' . $ind . '" class="form-control" value="' . number_format($tl, 2) . '" readonly=“true”> 
						</div>
						
						<div class="form-group col-md-1">
							<a href="../cesta/remover.php?remover=cesta&id=' . $req['pk_id_produto'] . '"><img src="../imagens_site/imagens/tiraCesta.png" width=50 height=40></a>
							<input type="hidden" id="CodMax_' . $ind . '" class="form-control" value="' . $req['pk_id_produto'] . '" readonly=“true”>
						</div>
					</div>';
								}
							}
						}
						?>
					</div>

					<div class="row" id="Po">
						<div class="form-group col-md-4">

						</div>

						<div class="form-group col-md-2">

						</div>

						<div class="form-group col-md-2">

						</div>

						<div class="form-group col-md-2">
							<?php
							echo 'Total <input type="text" id="totalCesta" class="form-control" value="' . number_format($tg, 2) . '" readonly=“true”>'
							?>
						</div>
						<div class="form-group col-md-2">

						</div>
					</div>


					<div class="form-row">
						<div class="form-group col-md-4">
							<button type="button" id="bt6" onclick="finalizarCesta()">Finalizar compra</button>
						</div>

						<div class="form-group col-md-4">
							<a href="../vitrine/vitrine.php"><button type="button" id="bt5">Continuar comprando</button> </a>
						</div>

						<div class="form-group col-md-4">
							<button type="button" id="bt4" onclick="limparCesta()">Limpar</button>
						</div>

					</div>

		</form>
		<br />

	</div>

	<!-- Modal -->


	<div class="modal fade" id="myModalx" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-body">
					<p>Escolha sua roupa, click no botão Comprar e então finalize sua compra!</p>
					<a href="../vitrine/vitrine.php"> <button type="button" id="bt0">Ir as compras</button> </a>
				</div>
			</div>

		</div>
	</div>

	<div class="modal fade" id="myModaly" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-body">
					<p>Faça seu login antes de finalizar suas compras</p>
					<a href="../../index.php"> <button type="button" id="bt0">Fazer login</button> </a>
				</div>
			</div>

		</div>
	</div>

	<div class="modal fade" id="myModalk" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-body">
					<p>Compra realizada com sucesso! </br>
						você receberá um email com a descrição da sua compra, obrigado!</p>
					<button type="button" id="bt0" onclick="limparCesta()">OK</button> </a>
				</div>
			</div>

		</div>
	</div>


	<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<!-- Importando o js do bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script>
		$("#cabecMax").show();
		$("#prodMax").show();
		$("#prodMin").hide();
	</script>

</body>
<footer>
	<div>
		<h1>Conheça nossas redes </h1>

		<div id="icones">
			<a href="#"><i class="fab fa-facebook-square"></i></a>
			<a href="#"><i class="fab fa-instagram"></i></a>
			<a href="#"><i class="fab fa-youtube"></i></a>
			<a href="#"><i class="fab fa-pinterest"></i></a>
		</div>

	</div>

	<hr width="30%">

	<div id="pagamento">
		<h1>Formas de pagamento</h1>
		<img src="../imagens_site/imagens/cartoes.png" alt=”some text” width=250 height=100>
	</div>

	<hr width="30%">

	<div id="slogan">
		© Fã Camisetas - 2022. Todos os direitos reservados.
	</div>
</footer>

</html>

<?php

if (!isset($_SESSION['id'])) {

	echo '
   <script>
			$("#myModaly").modal({show: true});	
	</script>';
} else {

	echo '
   <script>
			$("#myModalk").modal({show: true});	
	</script>';

	session_destroy();
	session_unset();
}
?>

<script type='text/javascript'>
	$(document).on('input', '.form-control', function() {
		calculaTotalPQ();
	});

	function limparCesta() {

		var items = $('[id^=produtoMin_]').length;
		for (var pos = 1; pos <= items; pos++) {
			$("#produtoMin_" + pos.toString()).val("");
			$("#quantidadeMin_" + pos.toString()).val(0);
			$("#precoMin_" + pos.toString()).val("0.00");
			$("#totalMin_" + pos.toString()).val("0.00");
		}

		var items = $('[id^=produtoMax_]').length;
		for (var pos = 1; pos <= items; pos++) {
			$("#produtoMax_" + pos.toString()).val("");
			$("#quantidadeMax_" + pos.toString()).val(0);
			$("#precoMax_" + pos.toString()).val("0.00");
			$("#totalMax_" + pos.toString()).val("0.00");
		}
		$("#totalCesta").val('0.00');

		window.location.href = "../vitrine/vitrine.php";
	}


	$(window).resize(function() {


		if (window.innerWidth <= 768) {
			$("#cabecMax").hide();
			$("#prodMax").hide();
			$("#prodMin").show();

		} else {

			$("#cabecMax").show();
			$("#prodMax").show();
			$("#prodMin").hide();

		}

	}); //

	function calculaTotalPQ() {

		if (window.innerWidth > 768) {

			var items = $('[id^=produtoMax_]').length;
			var subTotalProdutos = 0;

			for (var pos = 1; pos <= items; pos++) {

				var p = $("#precoMax_" + pos.toString()).val();
				var q = $("#quantidadeMax_" + pos.toString()).val();
				var pp = parseFloat(p);
				var qq = parseInt(q);
				var item = "#totalMax_" + pos.toString()
				subTotalProdutos = subTotalProdutos + (pp * qq);
				$(item).val((pp * qq).toFixed(2));
			}
		} else {

			var items = $('[id^=produtoMin_]').length;
			var subTotalProdutos = 0;

			for (var pos = 1; pos <= items; pos++) {

				var p = $("#precoMin_" + pos.toString()).val();
				var q = $("#quantidadeMin_" + pos.toString()).val();
				var pp = parseFloat(p);
				var qq = parseInt(q);
				var item = "#totalMin_" + pos.toString()
				subTotalProdutos = subTotalProdutos + (pp * qq);
				$(item).val((pp * qq).toFixed(2));
			}

		}

		$("#totalCesta").val(subTotalProdutos.toFixed(2));
	}

	function finalizarCesta() {

		if ($("#totalCesta").val() <= 0) {
			$("#myModalx").modal({
				show: true
			});

		} else {

			window.location.href = "../cesta/finalizar.php";
		}
	}
</script>