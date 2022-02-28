<?php
include_once "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://static.wixstatic.com/media/157734_1e57fd2b60d2447d9dcd9d5613ac2f38.png/v1/fill/w_208,h_95,al_c,q_85,usm_0.66_1.00_0.01/157734_1e57fd2b60d2447d9dcd9d5613ac2f38.webp" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../newstyle">
    <title>Sistemas</title>
</head>
<body>

<!--Menu Principal-->
<nav class="navbar navbar-light" style="background-color: #3c4e71;">
<div class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link" href="../Admissão">Admissão</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../Rescição">Rescisão</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../pesquisa">pesquisa</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../planoProprio">Plano Proprio</a>
        </li>

      </ul>
    </div>
  </div>
</div>
</nav>

<section>
<?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //var_dump($dados);
    ?>
    <h2>Pesquisar</h2>

    <form method="POST" action="">
        <label>Nome: </label>
        <input type="text" name="nome_usuario" placeholder="Digite o nome" value="<?php if(isset($dados['nome_usuario'])){ echo $dados['nome_usuario']; } ?>"><br><br>

        <input type="submit" name="pesqUsuario" id="pesqUsuario"><br><br>
    </form>

    <?php

    if (!empty($dados['pesqUsuario'])) {
        $NomeTitular = "%" . $dados['nome_usuario'] . "%";
        //$nome = "%descrição%";

        $query_usuarios = "SELECT  CPF, NomeBeneficiario, DescricaoTipoPlano, DataInicioVigencia, Seq, Competencia, NomeEmpresa, CodigoGrauDependencia, Sum(ValorFaturado) as Valor FROM dbo.FaturaTaxasUnimed  WHERE NomeTitular LIKE :NomeTitular GROUP BY CPF, NomeBeneficiario, NomeTitular, DescricaoTipoPlano, DataInicioVigencia, Seq, Competencia, NomeEmpresa, CodigoGrauDependencia";
        $result_usuarios = $connection->prepare($query_usuarios);
        $result_usuarios->bindParam(':NomeTitular', $NomeTitular, PDO::PARAM_STR);

        $result_usuarios->execute();

        while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
            //var_dump($row_usuario);
            extract($row_usuario);
            echo "NomeBeneficiario: $NomeBeneficiario <br>";
            echo "CPF: $CPF <br>";
            echo "DescricaoTipoPlano: $DescricaoTipoPlano <br>";
            echo "DataInicioVigencia: $DataInicioVigencia <br>";
            echo "Seq: $Seq <br>";
            echo "Competencia: $Competencia <br>";
            echo "NomeEmpresa: $NomeEmpresa <br>";
            echo "CodigoGrauDependencia: $CodigoGrauDependencia <br>";
            echo "ValorFaturado: $Valor <br>";
            

            echo "<hr>";
        }
    }

    ?>
     
</section>

<!-- Script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>