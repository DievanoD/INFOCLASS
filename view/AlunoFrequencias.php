<?php
require_once ('../controller/LoginController.php');
require_once('../controller/FrequenciaController.php');
$controllerLogin = new LoginController();

$controllerLogin->verificarLogado ();
$controllerLogin->verificaPaginaAluno();

$f_controller = new FrequenciaController();
$f_controller->ProcessoFrequenciaAluno('carregaFrequenciaAluno', $controllerLogin->getDadosUser("id"));
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Painel Aluno</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/tabela.css" rel="stylesheet">

    <link href="fontawesome-5.3.1/css/all.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> -->

  </head>
  <body>
    <!-- <nav class="navbar navbar-dark fixed-top bg-dark p-0 shadow"> -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center" href="#">
        INFO CLASS
        <img src="imagens/notebook.png"  class="mx-2" width="30" height="30" class="d-inline-block align-top" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse  justify-content-md-end" id="navbarsExampleDefault">        
        <ul class="navbar-nav px-4">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $login = $controllerLogin->getDadosUser("nome");?></a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="../controller/Logout.php">Sair</a>
              </div>
            </li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>PAINEL DE CONTROLE</span>
                <a class="d-flex align-items-center text-muted" href="#">
                  <!-- <span data-feather="plus-circle"></span> -->
                </a>
              </h6>

              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span><i class="fas fa-star"></i></span>
                  Notas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active shadow rounded" href="AlunoFrequencias.php">
                  <span><i class="fas fa-chart-bar"></i></span>
                  Frequência
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span><i class="fas fa-clock"></i></span>
                  Horários
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span><i class="fas fa-archive"></i></span>
                  Arquivos
                </a>
              </li>

            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Utilidades</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <!-- <span data-feather="plus-circle"></span> -->
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span><i class="fas fa-question-circle"></i></span>
                  Ajuda
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span><i class="fas fa-info"></i></span>
                  Sobre
                </a>
              </li>
              
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <br>
          <div class="row">
            <div class="col">
              <div class="alert alert-success" role="alert">
                Bem vindo <strong><?php echo $login = $controllerLogin->getDadosUser("nome");?></strong>, dê uma olhada nas suas frequências!
              </div>
            </div>  
          </div>

          <br>

          <div class="row">
            <div class="col-md-3">
              <div class="card">
                <!-- <div class="d-inline"> -->
                  <!-- <div class="form-group"> -->
                    <center><label class="lead">Total de Aulas:</label></center>
                    <center><label class="display-4"><?php echo $total_aulas;?></label></center>
                  <!-- </div> -->
                  
                <!-- </div> -->
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <center><label class="lead">Presenças:</label></center>
                <center><label class="display-4"><?php echo $presenca;?></label></center>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <center><label class="lead">Faltas:</label></center>
                <center><label class="display-4"><?php echo $falta;?></label></center>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <center><label class="lead">Porcentagem Presença:</label></center>
                <center><label class="display-4"><?php echo $porcentagem;?></label><label class="h4">%</label></center>
              </div>
            </div>

          </div>

          <br><br>

          <div class="row">
            <div class="col">
              <div class="table-responsive">
                <table class="table table-bordered table-list table-hover" id="tabela_generica">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">DATA DA AULA</th>
                      <th scope="col">DESCRIÇÃO</th>
                      <th scope="col">STATUS</th>
                    </tr>
                  </thead>
                  <?php $cont = 0; ?>
                  <?php while ($row = mysqli_fetch_assoc($rs_f)) { ?>
                  <?php $cont++; ?>
                  <tbody>
                    <tr>
                      <th scope="row"><?php echo $cont; ?></th>
                      <td><?php echo $row['descricao']; ?></td>
                      <td><?php echo $row['data']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                    </tr>
                  </tbody>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>

        </main>

      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>