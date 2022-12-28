<?php
$con = new mysqli("localhost", "root", "", "loja");
$sql = "select * from tb_roupa";
$resultado = mysqli_query($con, $sql);
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
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../global.css" />

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
			<a href="iconePerfil.php" id="login"><i class="fas fa-user"></i></a>
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
				<a class="navbar-brand" href="./vitrine.php">Fã Camisetas</a>
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

<body id="corpo">

	<div class="container theme-showcase" role="main">
		<div class="row">
			<?php while ($req = mysqli_fetch_assoc($resultado)) { ?>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<a name="detalhes" href="../detalhe/detalhe.php?id_produto=<?php echo $req['pk_id_produto']; ?>">
							<img class="foto" name="imagem" src="<?php echo $req['foto_roupa']; ?>"></a>
						<div class="caption text-center">
							<a name="detalhes" href="../detalhe/detalhe.php?id_produto=<?php echo $req['pk_id_produto']; ?>">
								<h3 name="titulo" id="title"><?php echo $req['nome_roupa']; ?></>
									<h4 name="preco" id="preco">R$ <?php echo $req['vl_produto']; ?></h4>
									<p><a href="../Cesta/cesta.php?add=cesta&id=<?php echo $req['pk_id_produto']; ?>" class="btn btn-primary" role="button" onclick="botaoComprar()" id="btnComprar"> Comprar </a> </p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</body>

<footer>
	<div class="container-fluid padding">
		<div class="row text-center">
			<div>
				<h1>Conheça nossas redes </h1>

				<div id="icones">
					<a href="#"><i class="fab fa-facebook-square"></i></a>
					<a href="#"><i class="fab fa-instagram"></i></a>
					<a href="#"><i class="fab fa-youtube"></i></a>
					<a href="#"><i class="fab fa-pinterest"></i></a>
				</div>


			</div>

			<hr width="100%">

			<div id="pagamento">
				<h1>Formas de pagamento</h1>
				<img src="../imagens_site/imagens/cartoes.png" alt="some" width=250 height=100>
			</div>

			<hr width="100%">

			<div id="slogan">
				© Fã Camisetas - 2022. Todos os direitos reservados.
			</div>
		</div>

	</div>
</footer>

</html>

<script lang="javascript">
	function botaoComprar() { //Funcao para colocar as coisas no carrinho
	}
</script>

<script>
	function fazBusca() {
		window.location.href = "../busca/busca.php?busca=" + document.getElementById('pesquisa').value;
	}
</script>

<?php
mysqli_close($con);
?>