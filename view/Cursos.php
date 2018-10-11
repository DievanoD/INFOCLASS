<?php
require_once ('../controller/LoginController.php');
require_once('../controller/CursoController.php');

$controllerLogin = new LoginController();
$controllerLogin->verificarLogado ();
$controllerLogin->verificaPaginaAdmin();

$controller = new CursoController();
$controller->Processo('carregarTabela');
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Cursos</title>

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
                <a class="nav-link active shadow rounded" href="Cursos.php">
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
                <a class="nav-link" href="Frequencia.php?id=0">
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
          <div class="row">
            
              <div class="card col">
                <br>
                <form action="../controller/CursoController.php" method="POST" class="form-signin" name="formCurso">
                  <input type="hidden" name="method" value="addCurso">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputNomeCurso">Nome do Curso</label>
                      <input type="text" class="form-control" id="inputNomeCurso" name="nomeCurso" placeholder="Nome do Curso" required="">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="inputTurma">Turma</label>
                      <input type="text" class="form-control" id="inputTurma" name="nomeTurma" placeholder="Turma, Ex: 1º ano, 3º Período, etc.." required="">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="inputModalidade">Modalidade</label>
                      <select id="inputModalidade" class="form-control" name="modalidadeCurso" required="">
                        <option value="" selected>Selecione um item...</option>
                        <option value="integrado">Integrado</option>
                        <option value="concomitante">Concomitante</option>
                        <option value="superior">Superior</option>
                      </select>
                    </div>

                    <div class="form-group col-md-2">
                      <label class="invisible" for="inputCpf">lbl_none</label>
                      <button class="form-control btn btn-primary">CADASTRAR</button>
                    </div>
                  </div>
                </form>
              </div>
            
          </div>

          <br><br>

          <div class="row">
            <div class="col">
              <div class="h4 text-center">
                Cursos Cadastrados
              </div>
              <br>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="table-resposive">
                <table class="table table-striped table-bordered table-list table-hover" id="tabela_generica">
                  <thead>
                    <tr>
                      <!-- <th scope="col">ID</th> -->
                      <th scope="col">NOME DO CURSO</th>
                      <th scope="col">TURMA</th>
                      <th scope="col">MODALIDADE</th>
                      <th><i class="fas fa-cog"></i></th>
                    </tr>
                  </thead>
                  <?php while ($row = mysqli_fetch_assoc($rs)) { ?>
                  <tbody>
                    <tr>
                      <!-- <th scope="row"><?php echo $row['id_curso']; ?></th> -->
                      <td><?php echo $row['nome_curso']; ?></td>
                      <td><?php echo $row['nome_turma']; ?></td>
                      <td><?php echo $row['modalidade_curso']; ?></td>
                      <td><a class="btn btn-danger mx-2" href="../controller/DeleteCurso.php?id=<?php echo $row['id_curso'];?>" role="button"><i class="fas fa-trash"></i></a></td>
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