<?php
 
// Cria a conexão com o banco de dados
try {
    $connection = new PDO("sqlsrv:server=; Database=SisplusGestao", "", "");
    $statement = $connection->prepare("SELECT * FROM dbo.FaturaTaxasUnimed;");

    $statement->execute();

    $Tabelas = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}
?>
