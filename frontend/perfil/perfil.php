<?php
session_start();
if (isset($_SESSION['id']) == false) {
	header("location: ../../index.php");
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
			<a href="../../index.php" id="login"><i class="fas fa-user"></i></a>
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

<body id="corpo" style="background-image: url(https://images2.alphacoders.com/805/805177.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center">
	<div class="perfil">
		<h1>Gerenciamento do usuário</h1>
		Olá <?php echo $_SESSION["nome"] ?>
	</div>
	<div class="container">
		<form method="post" action="perfil.php">
			<div class="row no-gutters">
				<div class="col-12 col-sm-6 col-md-8">
					<input type="number" id="codigo" name="codigo" style=" display: none;" /><br />
					Nome:<input type="text" id="nome" name="nome" /><br />
					Email:<input type="email" id="email" name="email" /><br />
					Senha:<input type="password" id="senha" name="senha" /><br />
					CPF:<input type="text" id="cpf" name="cpf" /><br />
					Telefone:<input type="text" id="telefone" name="telefone" /><br />
				</div>
				<div class="col-6 col-md-4">
					<button name="b3">Alterar</button>
					<button name="b4">Remover</button>
					<button name="b5">Sair</button>
				</div>
			</div>
		</form>

	</div>
	<?php
	if (isset($_POST["b3"])) alterar();
	if (isset($_POST["b4"])) remover();
	if (isset($_POST["b5"])) {
		$_SESSION["id"] = NULL;
		echo "<script lang='javascript'>window.location.href='../vitrine/vitrine.php';</script>";
	}

	?>

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

<script>
	function fazBusca() {
		window.location.href = "../busca/busca.php?busca=" + document.getElementById('pesquisa').value;
	}
</script>

<?php

$codigo = $_SESSION['id'];
$con = new mysqli("localhost", "root", "", "loja");
$sql = "select * from tb_cliente where pk_id_cliente='$codigo'";
$resultado = mysqli_query($con, $sql);
$reg = mysqli_fetch_array($resultado);
$nome = $reg["nome_cliente"];
$email = $reg["email"];
$senha = $reg["senha"];
$cpf = $reg["cpf"];
$telefone = $reg["telefone"];


echo "<script lang='javascript'>";
echo "codigo.value='$codigo';";
echo "nome.value='$nome';";
echo "email.value='$email';";
echo "senha.value='$senha';";
echo "cpf.value='$cpf';";
echo "telefone.value='$telefone';";
echo "</script>";

mysqli_close($con);

function alterar()
{
	$codigo = $_POST["codigo"];
	$nome	= $_POST["nome"];
	$email	= $_POST["email"];
	$senha	= $_POST["senha"];
	$cpf    = $_POST["cpf"];
	$telefone = $_POST["telefone"];
	$con = new mysqli("localhost", "root", "", "loja");
	$sql = "update tb_cliente set nome_cliente='$nome', email='$email', senha='$senha', cpf='$cpf', telefone='$telefone' where pk_id_cliente='$codigo'";
	mysqli_query($con, $sql);
	mysqli_close($con);
	echo "<div class='alert alert-success'><b>Registro alterado com sucesso!</b></div>";
}

function remover()
{
	$con = new mysqli("localhost", "root", "", "loja");
	$sql = "delete from tb_itens_cesta";
	$_SESSION['id'] = null;
	$_SESSION['nome'] = null;
	mysqli_query($con, $sql);
	mysqli_close($con);

	$codigo = $_POST["codigo"];
	$con = new mysqli("localhost", "root", "", "loja");
	$sql = "delete from tb_cliente where pk_id_cliente='$codigo'";
	$_SESSION['id'] = null;
	$_SESSION['nome'] = null;
	mysqli_query($con, $sql);
	mysqli_close($con);

	echo "<script lang='javascript'>window.location.href='../vitrine/vitrine.php';</script>";
}

?>