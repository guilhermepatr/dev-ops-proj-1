<?php
// Processa a operação de exclusão após a confirmação
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Inclui o arquivo de configuração
    require_once "config.php";
    
    // Prepara uma declaração de exclusão
    $sql = "DELETE FROM insumos WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Vincula as variáveis à declaração preparada como parâmetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Define os parâmetros
        $param_id = trim($_POST["id"]);
        
        // Tenta executar a declaração preparada
        if(mysqli_stmt_execute($stmt)){
            // Registros excluídos com sucesso. Redireciona para a página inicial
            header("location: index.php");
            exit();
        } else{
            echo "Algo deu errado. Por favor, tente novamente mais tarde.";
        }
    }
     
    // Fecha a declaração
    mysqli_stmt_close($stmt);
    
    // Fecha a conexão
    mysqli_close($link);
} else{
    // Verifica a existência do parâmetro id
    if(empty(trim($_GET["id"]))){
        // A URL não contém o parâmetro id. Redireciona para a página de erro
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Excluir Insumo</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="logo" id="logo-placeholder">
            <img src="logo.jpg" height="50px" alt="logo">
            </div>
            <h1>Insumos Agrícolas</h1>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-4 mb-3">Excluir Insumo</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Tem certeza de que deseja excluir este insumo?</p>
                            <p>
                                <input type="submit" value="Sim" class="btn btn-danger">
                                <a href="index.php" class="btn btn-secondary">Não</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
