<?php
    function myAutoloader($class) {
        $classe = 'classes/' . $class . "-class" . '.php';
        if (is_file($classe)) {
          require_once $classe;
        }
      }
      spl_autoload_register('myAutoloader');
      
      //

      $read = new query();

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Dashboard</title>
</head>
<body>
    <header>
        <a href="create.php" class="btn btn-primary btn-criar">Criar Registro</a>
    </header>
    <main>
        <table  class="table">
            <thead>
                <tr>
                    <th scape='col'>#</th>
                    <th scape='col'>Nome:</th>
                    <th scape='col'>Valor:</th>
                    <th scape='col'>Prazo:</th>
                    <th scape='col'>Projeto:</th>
                    <th scape='col'>Status:</th>
                    <th scape='col'></th>
                    <th scape='col'></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    echo $read->read();
                ?>
           </tbody>
        </table>
    </main>
    <section>
        <div class='box-info'>
        <h3>Total ganho</h3>
        <h1>
            <?php echo $read->totalGanho() ?>
        </h1>
        </div>
        <div class='box-info' style='background-color: rgb(50, 230, 50);'>
            <h3>Total a ganhar</h3>
            <h1>
                <?php echo $read->valueStatus() ?>
            </h1>
        </div>
    </section>
</body>
</html>