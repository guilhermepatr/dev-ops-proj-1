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

// Define variables and initialize with empty values
$name_err = $type_err = $quantity_err = $value_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["nome"]);
    if(empty($input_name)){
        $name_err = "Por favor, insira o nome do produto.";
    } else{
        $name = $input_name;
    }
    
    // Validate type
    $input_type = trim($_POST["tipo"]);
    if(empty($input_type)){
        $type_err = "Por favor, insira o tipo do material.";     
    } else{
        $type = $input_type;
    }
    
    // Validate quantity
    $input_quantity = trim($_POST["quantidade"]);
    if(empty($input_quantity)){
        $quantity_err = "Por favor, insira a quantidade.";     
    } elseif(!ctype_digit($input_quantity)){
        $quantity_err = "Por favor, insira um valor inteiro positivo.";
    } else{
        $quantity = $input_quantity;
    }
    
    // Validate value
    $input_value = trim($_POST["valor"]);
    if(empty($input_value)){
        $value_err = "Por favor, insira o valor.";     
    } elseif(!is_numeric($input_value)){
        $value_err = "Por favor, insira um valor numérico.";
    } else{
        $value = $input_value;
    }
    
    // Check input errors before updating in database
    if(empty($name_err) && empty($type_err) && empty($quantity_err) && empty($value_err)){
        // Prepare an update statement
        $sql = "UPDATE insumos SET nome=?, tipo=?, quantidade=?, valor=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssidi", $param_name, $param_type, $param_quantity, $param_value, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_type = $type;
            $param_quantity = $quantity;
            $param_value = $value;
            $param_id = trim($_GET["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Insumo</title>
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
                    <h1 class="mt-5 mb-3">Atualizar Insumo</h1>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . trim($_GET["id"])); ?>" method="post">
                        <div class="form-group">
                            <label>Nome do Produto</label>
                            <input type="text" name="nome" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Tipo do Material</label>
                            <input type="text" name="tipo" class="form-control <?php echo (!empty($type_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $type; ?>">
                            <span class="invalid-feedback"><?php echo $type_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantidade</label>
                            <input type="text" name="quantidade" class="form-control <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $quantity; ?>">
                            <span class="invalid-feedback"><?php echo $quantity_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Valor</label>
                            <input type="text" name="valor" class="form-control <?php echo (!empty($value_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $value; ?>">
                            <span class="invalid-feedback"><?php echo $value_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Atualizar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
