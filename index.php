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

    $amountClientes = $amountPrazo = $amountForaPrazo = $amountCompletado = 0;

    $read = new query();

    $dados = $read->read();
    if($dados != "Sem dados por agora"){
        foreach ($dados as $dado) {
            $amountClientes += 1;
        }
    }

    //

    $prazo = $read->prazo();
    if ($prazo != "Sem dados por agora") {
        foreach ($prazo as $dado) {
            $amountPrazo += 1;
        }
    }

    //

    $prazoEncerrado = $read->prazoEncerrado();
    if ($prazoEncerrado != "Sem dados por agora") {
        foreach ($prazoEncerrado as $dado) {
            $amountForaPrazo += 1;
        }
    }

    //

    $completado = $read->completado();
    if ($completado != "Sem dados por agora") {
        foreach ($completado as $dado) {
            $amountCompletado += 1;
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <header>
        <a href="create.php" class="btn btn-primary btn-criar">Criar Registro</a>
    </header>
    <main>
        <h2 class="title">Clientes (<?php echo $amountClientes ?>)</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scape='col'>Nome:</th>
                    <th scape='col'>Valor:</th>
                    <th scape='col'>Prazo:</th>
                    <th scape='col'>Projeto:</th>
                    <th scape='col'>Status:</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dados = $read->read();
                // var_dump($dados);
                if ($dados == "Sem dados por agora") {
                    echo "<tr>
                            <td></td>
                            <td></td>
                            <td>Sem dados por agora</td>
                            <td></td>
                            <td></td>
                        </tr>";
                } else {
                    foreach ($dados as $dado) {
                        echo "<tr id='column'>
                                <td>" . $dado['nome'] . "</td>
                                <td>R$" . $dado['valor'] . "</td>
                                <td>" . $dado['prazo'] . "</td>
                                <td>" . $dado['projeto'] . "</td>
                                <td>" . $dado['status'] . "</td>
                                <input style='display:none;' id='id' type='text' value='" . $dado['id'] . "'>
                                <td>
                                    <a href='classes/delete.php?id=" . $dado['id'] . "' class='btn btn-danger'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href='editar.php?id=" . $dado['id'] . "' class='btn btn-primary'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                            <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href='classes/completed.php?id=" . $dado['id'] . "' class='btn btn-success'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>
                                        <path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0'/>
                                    </svg>
                                    </a>
                                </td>
                            </tr>";
                    }
                }
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
    <span class="line"></span>
    <section>
        <h2 class="title">Perto do Prazo (<?php echo $amountPrazo ?>)</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scape='col'>Nome:</th>
                    <th scape='col'>Valor:</th>
                    <th scape='col'>Prazo:</th>
                    <th scape='col'>Projeto:</th>
                    <th scape='col'>Status:</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $prazo = $read->prazo();
                // var_dump($dados);
                if ($prazo == "Sem dados por agora") {
                    echo "<tr>
                                <td></td>
                                <td></td>
                                <td>Sem dados por agora</td>
                                <td></td>
                                <td></td>
                            </tr>";
                } else {
                    foreach ($prazo as $dado) {
                        echo "<tr id='column'>
                                    <td>" . $dado['nome'] . "</td>
                                    <td>R$" . $dado['valor'] . "</td>
                                    <td>" . $dado['prazo'] . "</td>
                                    <td>" . $dado['projeto'] . "</td>
                                    <td>" . $dado['status'] . "</td>
                                    <td>
                                        <a href='classes/delete.php?id=" . $dado['id'] . "' class='btn btn-danger'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <a href='editar.php?id=" . $dado['id'] . "' class='btn btn-primary'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <a href='classes/completed.php?id=" . $dado['id'] . "' class='btn btn-success'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>
                                            <path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0'/>
                                        </svg>
                                        </a>
                                    </td>
                                </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </section>
    <span class="line"></span>
    <section>
        <h2 class="title">Fora do Prazo (<?php echo $amountForaPrazo ?>)</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scape='col'>Nome:</th>
                    <th scape='col'>Valor:</th>
                    <th scape='col'>Prazo:</th>
                    <th scape='col'>Projeto:</th>
                    <th scape='col'>Status:</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $prazoEncerrado = $read->prazoEncerrado();
                // var_dump($prazoEncerrado);
                if ($prazoEncerrado == "Sem dados por agora") {
                    echo "<tr>
                                <td></td>
                                <td></td>
                                <td>Sem dados por agora</td>
                                <td></td>
                                <td></td>
                            </tr>";
                } else {
                    foreach ($prazoEncerrado as $dado) {
                        echo "<tr id='column'>
                                    <td>" . $dado['nome'] . "</td>
                                    <td>R$" . $dado['valor'] . "</td>
                                    <td>" . $dado['prazo'] . "</td>
                                    <td>" . $dado['projeto'] . "</td>
                                    <td>" . $dado['status'] . "</td>
                                    <td>
                                        <a href='classes/delete.php?id=" . $dado['id'] . "' class='btn btn-danger'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <a href='editar.php?id=" . $dado['id'] . "' class='btn btn-primary'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <a href='classes/completed.php?id=" . $dado['id'] . "' class='btn btn-success'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>
                                            <path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0'/>
                                        </svg>
                                        </a>
                                    </td>
                                </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </section>
    <span class="line"></span>
    <section>
        <h2 class="title">Projetos Concluídos (<?php echo $amountCompletado ?>)</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scape='col'>Nome:</th>
                    <th scape='col'>Valor:</th>
                    <th scape='col'>Prazo:</th>
                    <th scape='col'>Projeto:</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dados = $read->completado();
                // var_dump($prazoEncerrado);
                if ($dados == "Sem dados por agora") {
                    echo "<tr>
                                <td></td>
                                <td></td>
                                <td>Sem dados por agora</td>
                                <td></td>
                            </tr>";
                } else {
                    foreach ($dados as $dado) {
                        echo "<tr id='column'>
                                    <td>" . $dado['nome'] . "</td>
                                    <td>R$" . $dado['valor'] . "</td>
                                    <td>" . $dado['prazo'] . "</td>
                                    <td>" . $dado['projeto'] . "</td>
                                    <td>
                                        <a href='classes/delete.php?id=" . $dado['id'] . "' class='btn btn-danger'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </section>
</body>

</html>