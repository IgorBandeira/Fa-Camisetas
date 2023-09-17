<?php
session_start();

if (isset($_POST['entrar'])) :
  $con = new mysqli("localhost", "root", "", "loja");
  $erros = array();
  $email  = $_POST["email"];
  $senha  = ($_POST["senha"]);
  $sql  = "select * from tb_cliente where email='$email' and senha='$senha'";
  //echo $sql;
  $resultado = mysqli_query($con, $sql);
  if ($reg = mysqli_fetch_array($resultado)) {
    $_SESSION["id"] = $reg["pk_id_cliente"];
    $_SESSION["nome"]  = $reg["nome_cliente"];
    echo "<script lang='javascript'>window.location.href='./frontend/vitrine/vitrine.php';</script>";
  } else {
    $erros[] = "<li> Email ou senha estão incorretos </li>";
  }
  mysqli_close($con);
endif;
?>
<html lang="pt-br">

<head>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="icon" type="image/png" sizes="16x16" href="./frontend/imagens_site/imagens/favicon-32x32.png">

  <!-- Bootstrap -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>


  <!--titulo-->
  <title> Fã Camisetas </title>
  <!--icones-->
  <script src="https://kit.fontawesome.com/700cddc25b.js" crossorigin="anonymous"></script>
  <!--CSS-->
  <link rel="stylesheet" href="./frontend/perfil/login_styles.css" />


</head>

<header>
  <div id="cabecalho">
    <!--Imagem logo-->
    <div class='logo'>
      <a href="./frontend/vitrine/vitrine.php"><img src="./frontend/imagens_site/imagens/logo-removebg-preview.png" width=400 height=400></a>
    </div>

    <!--caixa de busca mais nome loja-->
    <div class="col-lg-6">
      <h1>Fã Camisetas</h1>
      <h4>Vista seu lado Fã</h4>
    </div>

    <!--icones perfil e carrinho-->
    <div id="icones_cabecalho">
      <a href="./frontend/vitrine/vitrine.php" id="login" name="b1"><i class="fas fa-store-alt"></i></a>
      <a href="./frontend/cesta/cesta.php" id="carrinho"><i class="fas fa-shopping-basket"></i></a>
    </div>
  </div>
</header>


<body id="corpo" style="background-image: url(https://i.pinimg.com/originals/4b/49/49/4b4949753f3e3caefc41aa8ec35f28f0.gif);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p>
          Já tem cadastro? Faça seu login! 🌟
        </p>
        <div class="container">
          <?php
          if (!empty($erros)) :
            foreach ($erros as $erro) :
              echo "<div class='alert alert-danger'>$erro</div>";
            endforeach;
          endif;
          ?>
          <form action="index.php" style="display: flex;
						flex-direction: column;
						align-items: center;
						justify-content: center;" method="post">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" required="" placeholder="Digite seu email">
            </div>
            <div class="form-group">
              <label for="senha">Senha</label>
              <input type="password" name="senha" id="senha" class="form-control" required="" placeholder="Digite uma senha">
            </div>
            <button type="submit" name="entrar" class="btn btn-primary">Entrar</button>
          </form>
        </div>

      </div>

      <div class="col-md-6">
        <p>Não tem cadastro? 😱</p>
        <a href="./frontend/cadastro/cadastro.php">Cadastre-se</a>
        <form action="">
          <button type="button" style="margin-left: 5%; width: 95%; border: none;" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
            Esqueci minha senha
          </button>
          <div id="voltar">
            <i class="fas fa-store-alt" style="margin-top: 20%; margin-right: 5%; color: red;"></i>
            <a href="./frontend/vitrine/vitrine.php" style="margin-top: 20%;">Voltar para vitrine</a>
          </div>
        </form>
      </div>
    </div>


  </div>

  <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Esqueci minha senha</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
            Mandaremos uma nova senha no seu Email
          </p>
          <div class="container">
            <form action="">
              <div class="form-group" style="width: auto;
              margin-left: auto;">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" required="" placeholder="Digite seu email">
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" style="background-color: rgb(14, 12, 12); border: none;" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" style="background-color: rgb(255, 41, 69); border: none;">Enviar</button>
        </div>
      </div>
    </div>
  </div>



  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>