<?php
    function myAutoloader($class)
    {
        $classe = 'classes/' . $class . "-class" . '.php';
        if (is_file($classe)) {
            require_once $classe;
        }
    }
    spl_autoload_register('myAutoloader');
    
    //

    $insert = new query();
    if(isset($_POST['submit'])){
        $nome = $_POST['cliente'];
        $valor = $_POST['valor'];
        $projeto = $_POST['projeto'];
        $prazo = $_POST['prazo'];
        if(strlen($nome) > 2 && strlen($nome) < 50 && strlen($projeto) > 2 && strlen($projeto) < 100 && strlen($valor) > 0 && strlen($prazo) == 10){
            $insert->create("$nome", "$projeto", $valor, "$prazo");
        }
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
    <script src="js/script.js"></script>
    <title>Criar Cliente</title>
</head>

<body>
    <header>

    </header>
    <main>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="cliente">Nome do cliente</label>
            <input type="text" name="cliente" class="form-control" placeholder="Nome do cliente">
            <label for="valor">Valor Cobrado</label>
            <input type="number" name="valor" step="0.010" value='0.00' class="form-control" id="valor">
            <label for="prazo">Prazo de Entrega</label>
            <input type="date" name="prazo" class="form-control" id="inputDate">
            <label for="projeto">Projeto</label>
            <div class="input-group">
                <textarea class="form-control" aria-label="With textarea" name="projeto" placeholder="Fale sobre o projeto"></textarea>
            </div>
            <input type="submit" value="Registrar" name='submit' class="btn btn-success btn-criar">
            <a href="index.php" class="btn btn-danger btn-criar">Voltar</a>
        </form>
    </main>
</body>

</html>