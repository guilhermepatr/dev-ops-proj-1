<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM insumos WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                // Fetch result row as an associative array
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field values
                $name = $row["nome"];
                $type = $row["tipo"];
                $quantity = $row["quantidade"];
                $value = $row["valor"];
            } else{
                // Redirect to error page if id is invalid
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Redirect to error page if id parameter is missing
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Insumo</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="logo" id="logo-placeholder"></div> <!-- Espaço para o logo -->
            <h1>Insumos Agrícolas</h1>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Visualizar Insumo</h1>
                    <div class="form-group">
                        <label>Nome do Produto</label>
                        <p><b><?php echo $name; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Tipo do Material</label>
                        <p><b><?php echo $type; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Quantidade</label>
                        <p><b><?php echo $quantity; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Valor</label>
                        <p><b>R$ <?php echo number_format($value, 2, ',', '.'); ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Voltar</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
