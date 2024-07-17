<?php
    require_once "classes/query-class.php";
    //
    if(!isset($_GET['id']) || empty($_GET['id'])){
        header('location: index.php');
    }

    $id = $_GET['id'];

    $edit = new editDado();
    $edit->select($id);
    $nome = $edit->nome;
    $valor = $edit->valor;
    $prazo = $edit->prazo;
    $projeto = $edit->projeto;

    if(isset($_POST['submit'])){
        $nome = $_POST['cliente'];
        $valor = $_POST['valor'];
        $projeto = $_POST['projeto'];
        $prazo = $_POST['prazo'];
        
        $edit->editar("$nome", "$projeto", $valor, "$prazo", $id);
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    
    <title>Editar Cliente</title>
</head>

<body>
    <main>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="cliente">Nome do cliente</label>
            <input type="text" name="cliente" class="form-control" placeholder="Nome do cliente" value="<?php echo $nome ?>">
            <label for="valor">Valor Cobrado</label>
            <input type="number" name="valor" step="0.010" class="form-control" id="valor" value="<?php echo $valor ?>">
            <label for="prazo">Prazo de Entrega</label>
            <input type="date" name="prazo" class="form-control" id="inputDate" value="<?php echo $prazo ?>">
            <label for="projeto">Projeto</label>
            <div class="input-group">
                <textarea class="form-control" aria-label="With textarea" name="projeto" placeholder="Fale sobre o projeto"><?php echo $projeto ?></textarea>
            </div>
            <input type="submit" value="Salvar" name='submit' class="btn btn-success btn-editar">
            <a href="index.php" class="btn btn-danger btn-editar">Voltar</a>
        </form>
    </main>
</body>

</html>