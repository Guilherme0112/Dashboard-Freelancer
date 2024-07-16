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
            $html = null;
            $reads = $this->conexao->query("SELECT *, date_format(prazo, '%d/%m%Y') FROM clientes");
            if($reads->rowCount() == 0){
                return "<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td> Sem dados por agora</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>";
            } else {
                while($linhas = $reads->fetch(PDO::FETCH_ASSOC)){
                    $id = $linhas['idclientes'];
                    $nome = $linhas['nomeCliente'];
                    $valor = number_format($valor = $linhas['valor'], 2, ',', '.');
                    $prazo = $linhas["date_format(prazo, '%d/%m%Y')"];
                    $projeto = $linhas['projeto'];
                    $status = $linhas['status'];

                    $html .= "<tr id='column'>
                                <td>$id</td>
                                <td>$nome</td>
                                <td>R$$valor</td>
                                <td>$prazo</td>
                                <td>$projeto</td>
                                <td>$status</td>
                                <input style='display:none;' id='id' type='text' value='$id'>
                                <td>
                                    <a href='delete.php?id=$id' class='btn btn-danger'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href='editar.php?id=$id' class='btn btn-primary'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                            <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>";
                    }
                return $html;
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
                    header('location: index.php');
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
    }
?>