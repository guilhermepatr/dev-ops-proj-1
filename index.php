<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Insumos Agrícolas</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="estilo.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="logo" id="logo-placeholder">
            <img src="logo.jpg" height="50px" alt="logo">
            </div>
            <h1>Insumos Agrícolas</h1>
        </header>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex align-items-center justify-content-between mt-3 mb-3">
                        <h2 class="mb-0">Lista de Insumos</h2>
                        <a href="create.php" class="btn-custom"><i class="fa fa-plus"></i> Adicionar Novo Insumo</a>
                    </div>

<?php
// Inclui o arquivo de configuração
require_once "config.php";

// Executa a consulta para obter os insumos
$sql = "SELECT * FROM insumos";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo '<table class="table table-bordered table-striped">';
            echo "<thead>";
                echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Nome do Produto</th>";
                    echo "<th>Tipo do Material</th>";
                    echo "<th>Quantidade</th>";
                    echo "<th>Valor</th>";
                    echo "<th>Ação</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>"; // Corrigido para 'nome'
                    echo "<td>" . $row['tipo'] . "</td>"; // Corrigido para 'tipo'
                    echo "<td>" . $row['quantidade'] . "</td>";
                    echo "<td>R$ " . number_format($row['valor'], 2, ',', '.') . "</td>";
                    echo "<td>";
                        echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="Visualizar" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                        echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Editar" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                        echo '<a href="delete.php?id='. $row['id'] .'" title="Excluir" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                    echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";                            
        echo "</table>";
        mysqli_free_result($result);
    } else{
        echo '<div class="alert alert-danger"><em>Nenhum registro encontrado.</em></div>';
    }
} else{
    echo "Erro ao tentar executar a consulta.";
}

mysqli_close($link);
?>






                </div>
            </div>        
        </div>
    </div>
</body>
</html>
