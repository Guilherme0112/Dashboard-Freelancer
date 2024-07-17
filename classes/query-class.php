<?php
    include "Conexao-class.php";
    class query extends Conexao{

        public function create($nome, $projeto, $valor, $prazo){
            $ins = $this->conexao->query("INSERT INTO clientes values (DEFAULT, '$nome', '$projeto', $valor, '$prazo', DEFAULT, DEFAULT)");
            if($ins){
                header('location: index.php');
            }
        }
        public function read(){
            $reads = $this->conexao->query("SELECT *, date_format(prazo, '%d/%m/%Y') FROM clientes WHERE status = 'Em andamento'");
            if($reads->rowCount() == 0){
                return "Sem dados por agora";
            } else {
                $dados = array();
                while($linhas = $reads->fetch(PDO::FETCH_ASSOC)){

                    $id = $linhas['idclientes'];
                    $nome = $linhas['nomeCliente'];
                    $valor = number_format($valor = $linhas['valor'], 2, ',', '.');
                    $prazo = $linhas["date_format(prazo, '%d/%m/%Y')"];
                    $projeto = $linhas['projeto'];
                    $status = $linhas['status'];

                    $dados[] = array(
                        'id' => $id,
                        'nome' => $nome,
                        'valor' => $valor,
                        'prazo' => $prazo,
                        'projeto' => $projeto,
                        'status' => $status
                    );
                }
                return $dados;
            }
        }
        public function prazoEncerrado(){
            date_default_timezone_set('America/Sao_Paulo');
            $dataAtual = new DateTime();
            $dataAtual->format('Y-m-d');
            $dataAtual = $dataAtual->format('Y-m-d');

            $prazos = $this->conexao->query("SELECT *, date_format(prazo, '%d/%m/%Y') FROM clientes WHERE status != 'Concluído' AND prazo < '$dataAtual'");
            if($prazos->rowCount() == 0){
                return "Sem dados por agora";
            } else {
                $dados = array();
                while($linhas = $prazos->fetch(PDO::FETCH_ASSOC)){
                    $id = $linhas['idclientes'];
                    $nome = $linhas['nomeCliente'];
                    $valor = number_format($valor = $linhas['valor'], 2, ',', '.');
                    $prazo = $linhas["date_format(prazo, '%d/%m/%Y')"];
                    $projeto = $linhas['projeto'];
                    $status = $linhas['status'];

                    $dados[] = array(
                        'id' => $id,
                        'nome' => $nome,
                        'valor' => $valor,
                        'prazo' => $prazo,
                        'projeto' => $projeto,
                        'status' => $status
                    );
                }
                return $dados;
            }
        }
        public function completado(){
            $prazos = $this->conexao->query("SELECT *, date_format(prazo, '%d/%m/%Y') FROM clientes WHERE status = 'Concluído'");
            if($prazos->rowCount() == 0){
                return "Sem dados por agora";
            } else {
                $dados = array();
                while($linhas = $prazos->fetch(PDO::FETCH_ASSOC)){

                    $id = $linhas['idclientes'];
                    $nome = $linhas['nomeCliente'];
                    $valor = number_format($valor = $linhas['valor'], 2, ',', '.');
                    $prazo = $linhas["date_format(prazo, '%d/%m/%Y')"];
                    $projeto = $linhas['projeto'];
                    $status = $linhas['status'];

                    $dados[] = array(
                        'id' => $id,
                        'nome' => $nome,
                        'valor' => $valor,
                        'prazo' => $prazo,
                        'projeto' => $projeto,
                        'status' => $status
                    );
                }
                return $dados;
            }
        }
        public function totalGanho(){
            $totalsoma = 0;
            $total = $this->conexao->query("SELECT * FROM clientes WHERE status = 'Concluído'");
            if($total->rowCount() == 0){
                return "R$0,00";
            } else {
                while($linhas = $total->fetch(PDO::FETCH_ASSOC)){
                    $preco = $linhas['valor'];
                    $totalsoma += $preco;
                }
                return "R$".number_format($totalsoma, 2, ',', '.');
            }
        }
        public function delete($id){
            $queryDel = $this->conexao->query("SELECT * FROM clientes WHERE idclientes = $id");
            if($queryDel->rowCount() == 0){

            } else {
                $del = $this->conexao->query("DELETE FROM clientes WHERE idclientes = $id");
                if($del){
                    header('location: ../index.php');
                }
            }
        }
        public function valueStatus(){
            $query = $this->conexao->query("SELECT valor FROM clientes WHERE status = 'Em Andamento'");
            if($query->rowCount() == 0){

                return "R$0,00";
            } else {
                $total = 0;
                while($linhas = $query->fetch(PDO::FETCH_ASSOC)){
                    $valor = $linhas['valor'];
                    $total += $valor;
                }
                return "R$".number_format($total, 2, ',', '.');
            }
        }
        public function prazo(){

            date_default_timezone_set('America/Sao_Paulo');
            $dataAtual = new DateTime();
            $dataAtual->format('Y-m-d');
            $dataAtual->modify('+2 days');
            $prazo = $dataAtual->format('Y-m-d');

            // convert to string for query 

            $dataAtual = $dataAtual->format('Y-m-d');
            $prazo = $prazo;

            $queryPrazo = $this->conexao->query("SELECT *, date_format(prazo, '%d/%m/%Y') FROM clientes WHERE prazo BETWEEN '$dataAtual' AND '$prazo' AND status = 'Em Andamento'");
            if($queryPrazo->rowCount() == 0){
                return "Sem dados por agora";
            } else {
                $pertoDoPrazo = array();
                while($i = $queryPrazo->fetch(PDO::FETCH_ASSOC)){
                    $id = $i['idclientes'];
                    $nome = $i['nomeCliente'];
                    $valor = number_format($valor = $i['valor'], 2, ',', '.');
                    $prazo = $i["date_format(prazo, '%d/%m/%Y')"];
                    $projeto = $i['projeto'];
                    $status = $i['status'];

                    $pertoDoPrazo[] = array(
                        'id' => $id,
                        'nome' => $nome,
                        'valor' => $valor,
                        'prazo' => $prazo,
                        'projeto' => $projeto,
                        'status' => $status
                    );
                }
            }
            return $pertoDoPrazo;
        }
    }
    class editDado extends Conexao{
        public $nome;
        public $valor;
        public $prazo;
        public $projeto;
        public $status;

        public function select($id){
            $sel = $this->conexao->query("SELECT *, date_format(prazo, '%Y-%m-%d') FROM clientes WHERE idclientes = $id");
            if($sel->rowCount() == 0){
                header('location: index.php');
            } else {
                while($linhas = $sel->fetch(PDO::FETCH_ASSOC)){
                    $this->nome = $linhas['nomeCliente'];
                    $this->valor = number_format($linhas['valor'], 2);
                    $this->prazo = $linhas["date_format(prazo, '%Y-%m-%d')"];
                    $this->projeto = $linhas['projeto'];
                    $this->status = $linhas['status'];
                }
            }
        }
        public function editar($nome, $projeto, $valor, $prazo, $id){
            if(strlen($nome) > 2 && strlen($nome) < 50 && strlen($projeto) > 2 && strlen($projeto) < 100 && strlen($valor) > 0 && strlen($prazo) == 10){
                $update = $this->conexao->query("UPDATE clientes SET nomeCliente = '$nome', projeto='$projeto', valor=$valor, prazo='$prazo' WHERE idclientes = $id");
                if($update){
                    header('location: index.php');
                }
            }
        }
        public function completed($id){
            $queryVerification = $this->conexao->query("SELECT * FROM clientes WHERE idclientes = $id");
            if($queryVerification->rowCount() >= 1){
                $completed = $this->conexao->query("UPDATE clientes SET status = 'Concluído' WHERE idclientes = $id");
                if($completed){
                    header('location: ../index.php');
                }
            }
        }
    }
?>