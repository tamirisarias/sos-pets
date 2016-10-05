<?php
/**
 * @author Tamiris Arias <tamirisariasjustino@gmail.com>
 * @package Core
 * Register class
 */
Class Register extends WException {
    private $transaction;
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    /**
     * Class Response
     */
    private $response;

    public function __construct(Transaction $transaction,$nome = null,$email = null,$senha = null,$telefone = null) {
        $this->setTransaction($transaction);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setTelefone($telefone);
    }

    private function getTransaction() {
        return $this->transaction;
    }

    private function setTransaction($transaction) {
        $this->transaction = $transaction;
    }

    private function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    private function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    private function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    private function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    private function getResponse() {
        return $this->response;
    }

    public function setResponse(Response $response) {
        $this->response = $response;
    }
    /**
     * retorna um registro de usuário
     */
    public function get() {
        $email = $this->getEmail();

        $sql = "select * from user where email = ?";
        $sql_value_list = [$email];

        $transaction = $this->getTransaction();
        $transaction->connect();
        $resource = $transaction->getResource();

        try {
            $resource_prepare = $resource->prepare($sql);

            $transaction_resource_error_info = $resource->errorInfo();

            if ($transaction_resource_error_info[0] != '00000') {
                return false;
            }

            $resource_prepare->execute($sql_value_list);
            $result = $resource_prepare->fetch(PDO::FETCH_OBJ);

        } catch (PDOException $error) {
            return false;

        } catch (Exception $error) {
            return false;
        }

        return $result;
    }
    /**
     * salva um novo registro de usuário
     */
    public function save() {
        $nome = $this->getNome();
        $email = $this->getEmail();
        $senha = $this->getSenha();
        $telefone = $this->getTelefone();

        $result = $this->get();

        if (!empty($result)) {
            $response = $this->getResponse();
            $response->setFlashMessage(vsprintf('O email "%s" ja está cadastro, tente fazer login!',[$email]));

            return false;
        }

        $sql = "insert into user (nome,email,senha,telefone,status,datacriacao) values (?,?,?,?,?,?)";
        $sql_value_list = [$nome,$email,md5($senha),$telefone,'1',date('Y/m/d H:i:s')];

        $transaction = $this->getTransaction();
        $transaction->connect();
        $resource = $transaction->getResource();

        try {
            $resource_prepare = $resource->prepare($sql);

            $transaction_resource_error_info = $resource->errorInfo();

            if ($transaction_resource_error_info[0] != '00000') {
                return false;
            }

            $result = $resource_prepare->execute($sql_value_list);

        } catch (PDOException $error) {
            return false;

        } catch (Exception $error) {
            return false;
        }

        $pdo_query_error_info = $resource_prepare->errorInfo();

        if ($pdo_query_error_info[0] != '00000') {
            return false;
        }

        return $result;
    }
}
