<?php
// Inclui o arquivo de configuração
require_once "config.php";

// Define variáveis e inicializa com valores vazios
$nome_produto = $tipo_material = $quantidade = $valor = "";
$nome_produto_err = $tipo_material_err = $quantidade_err = $valor_err = "";

// Processa os dados do formulário quando o formulário é submetido
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valida o nome do produto
    $input_nome_produto = trim($_POST["nome_produto"]);
    if(empty($input_nome_produto)){
        $nome_produto_err = "Por favor, insira o nome do produto.";
    } else {
        $nome_produto = $input_nome_produto;
    }
    
    // Valida o tipo do material
    $input_tipo_material = trim($_POST["tipo_material"]);
    if(empty($input_tipo_material)){
        $tipo_material_err = "Por favor, selecione o tipo do material.";     
    } else {
        $tipo_material = $input_tipo_material;
    }
    
    // Valida a quantidade
    $input_quantidade = trim($_POST["quantidade"]);
    if(empty($input_quantidade)){
        $quantidade_err = "Por favor, insira a quantidade.";     
    } elseif(!ctype_digit($input_quantidade)){
        $quantidade_err = "Por favor, insira um valor inteiro positivo.";
    } else {
        $quantidade = $input_quantidade;
    }
    
    // Valida o valor
    $input_valor = trim($_POST["valor"]);
    if(empty($input_valor)){
        $valor_err = "Por favor, insira o valor do produto.";     
    } elseif(!is_numeric($input_valor)){
        $valor_err = "Por favor, insira um valor numérico.";
    } else {
        $valor = $input_valor;
    }
    
    // Verifica erros de entrada antes de inserir no banco de dados
    if(empty($nome_produto_err) && empty($tipo_material_err) && empty($quantidade_err) && empty($valor_err)){
        // Prepara uma declaração de inserção
        $sql = "INSERT INTO insumos (nome_produto, tipo_material, quantidade, valor) VALUES (?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Vincula as variáveis à declaração preparada como parâmetros
            mysqli_stmt_bind_param($stmt, "ssii", $param_nome_produto, $param_tipo_material, $param_quantidade, $param_valor);
            
            // Define os parâmetros
            $param_nome_produto = $nome_produto;
            $param_tipo_material = $tipo_material;
            $param_quantidade = $quantidade;
            $param_valor = $valor;
            
            // Tenta executar a declaração preparada
            if(mysqli_stmt_execute($stmt)){
                // Registro criado com sucesso. Redireciona para a página inicial
                header("location: index.php");
                exit();
            } else{
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
         
        // Fecha a declaração
        mysqli_stmt_close($stmt);
    }
    
    // Fecha a conexão
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Insumo</title>
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
                    <h2 class="mt-4">Adicionar Novo Insumo</h2>
                    <p>Preencha este formulário para adicionar um novo insumo ao banco de dados.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nome do Produto</label>
                            <input type="text" name="nome_produto" class="form-control <?php echo (!empty($nome_produto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nome_produto; ?>">
                            <span class="invalid-feedback"><?php echo $nome_produto_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Tipo do Material</label>
                            <select name="tipo_material" class="form-control <?php echo (!empty($tipo_material_err)) ? 'is-invalid' : ''; ?>">
                                <option value="" disabled <?php echo empty($tipo_material) ? 'selected' : ''; ?>>Selecione o tipo de material</option>
                                <option value="Ração" <?php echo $tipo_material == 'Ração' ? 'selected' : ''; ?>>Ração</option>
                                <option value="Equipamento" <?php echo $tipo_material == 'Equipamento' ? 'selected' : ''; ?>>Equipamento</option>
                                <option value="Remédio" <?php echo $tipo_material == 'Remédio' ? 'selected' : ''; ?>>Remédio</option>
                                <option value="Outros" <?php echo $tipo_material == 'Outros' ? 'selected' : ''; ?>>Outros</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $tipo_material_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantidade</label>
                            <input type="text" name="quantidade" class="form-control <?php echo (!empty($quantidade_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $quantidade; ?>">
                            <span class="invalid-feedback"><?php echo $quantidade_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Valor</label>
                            <input type="text" name="valor" class="form-control <?php echo (!empty($valor_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $valor; ?>">
                            <span class="invalid-feedback"><?php echo $valor_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-success" value="Enviar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
