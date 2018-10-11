<?php
require_once ('../controller/LoginController.php');
require_once('../controller/CursoController.php');
require_once('../controller/FrequenciaController.php');

$controllerLogin = new LoginController();
$controllerLogin->verificarLogado ();
$controllerLogin->verificaPaginaAdmin();

$controller = new CursoController();
$controller->Processo('carregarTabela');

$f_controller = new FrequenciaController();
$f_controller->Processo('carregarDadosTurma');
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Frequências</title>
    
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
                  <span data-feather="plus-circle"></span>
                </a>
              </h6>

              <li class="nav-item">
                <a class="nav-link" href="CadastroAluno.php">
                  <span><i class="fas fa-plus-circle"></i></span>
                  Add Aluno
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="ListaAlunos.php">
                  <span><i class="fas fa-list-ol"></i></span>
                  Lista de Alunos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Cursos.php">
                  <span><i class="fas fa-book"></i></span>
                  Cursos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Horarios.php">
                  <span><i class="fas fa-clock"></i></span>
                  Horários
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link active shadow rounded" href="Frequencia.php?id=0">
                  <span><i class="fas fa-chart-bar"></i></span>
                  Frequência
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span><i class="fas fa-bullhorn"></i></span>
                  Avisos
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
          <div class="form-row">
            <div class="form-group col-md-12 text-center">
              <h5>Cadastrar Frequência</h5>
            </div>
          </div>
          <!-- <br> -->
          <div class="row">
              <div class="card col">
                <br>
                <form action="../controller/FrequenciaController.php" method="POST" class="form-signin" name="formFrequencia">
                  <input type="hidden" name="method" value="buscarUsuarios">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <select id="inputModalidade" class="form-control" name="modalidadeCurso" required="">
                        <option value="" selected>Selecione uma turma...</option>
                        <?php while ($row = mysqli_fetch_assoc($rs)) { ?>    
                        <option value="<?php echo $row['id_curso']; ?>"><?php echo $row['nome_curso'] . " - " . $row['nome_turma']; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group col-md-2">
                      <button type="submit" class="form-control btn btn-primary">BUSCAR</button>
                      <!-- <a class="btn btn-primary" href="Frequencia.php?id=<?php echo $id_curso; ?>">BURSCAR</a> -->
                    </div>
                  </div>
                </form>
              </div>
          </div>

          <br>

          <br>
          <div class="row">
            <div class="col-md-12">
              <form action="../controller/FrequenciaController.php" method="POST" class="form-signin" name="formFreq">
              <input type="hidden" name="method" value="addFrequencia">
                <div class="form-row">
                  <div class="form-group col-md-8">
                    <h5>Informações:</h5>
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="descricao">Descrição:</label>
                    <textarea class="form-control" rows="2" id="descricao" name="descricao" placeholder="Breve descrição aula ou tema da aula..."></textarea>
                  </div>

                  <div class="form-group col-md-4 offset-md-1">
                    <label for="inputDataAula">Data da aula:</label>
                    <input type="date" class="form-control" id="inputDataAula" name="dataAula" required="">
                  </div>
                </div>
              <hr>
              <div class="table-resposive">
                <table class="table table-bordered table-list table-hover" id="tabela_generica">
                  <thead>
                    <tr>
                      <th scope="col">ALUNO</th>
                      <th scope="col">TURMA</th>
                      <th scope="col">STATUS</th>
                    </tr>
                  </thead>
                  <?php while ($row = mysqli_fetch_assoc($rs_f)) { ?>
                  <tbody>
                    <tr>
                      <input type="hidden" name="id_aluno" value="<?php echo $row['id_usuario'];?>">
                      <!-- <th scope="row"><?php echo $row['id_usuario']; ?></th> -->
                      <td><?php echo $row['nome_usuario']; ?></td>
                      <td><?php echo $row['nome_curso'] . " - " . $row['nome_turma']; ?></td>
                      <td>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="P">
                          <label class="form-check-label" for="inlineRadio1">P</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="F">
                          <label class="form-check-label" for="inlineRadio2">F</label>
                        </div>
                        <!-- <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="status" value="P">
                          <label class="form-check-label" for="inlineCheckbox1">P</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="status" value="F">
                          <label class="form-check-label" for="inlineCheckbox2">F</label>
                        </div> -->
                      </td>
                    </tr>
                  </tbody>
                  <?php } ?>
                </table>
              </div>
                  <br>
                  <button type="submit" class="btn btn-primary">Concluir</button>
              </form>
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