<?php
/**
 * @author Tamiris Arias <tamirisariasjustino@gmail.com>
 * @package Core
 * Session class
 */
Class Session extends WException {
    private $transaction;
    private $email;
    private $senha;

    public function __construct(Transaction $transaction,$email = null,$senha = null) {
        $this->setTransaction($transaction);
        $this->setEmail($email);
        $this->setSenha($senha);
    }

    private function getTransaction() {
        return $this->transaction;
    }

    private function setTransaction($transaction) {
        $this->transaction = $transaction;
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
    /**
     * Retorna a sessão do usuário
     */
    public function getUser() {
        return $_SESSION['user'];
    }
    /**
     * Verifica se o usuário está logado
     */
    public function isLoggedIn() {

    }
    /**
     * Encerra a sessão
     */
    public function logout() {
        session_destroy();

        unset($_SESSION);
    }
    /**
     * Efetua o processo de login
     */
    public function loginInit() {
        $email = $this->getEmail();
        $senha = $this->getSenha();

        $sql = "select * from user where email = ? and senha = ?";
        $sql_value_list = [$email,md5($senha)];

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
            $result = $resource_prepare->fetchAll();

        } catch (PDOException $error) {
            return false;

        } catch (Exception $error) {
            return false;
        }

        $pdo_query_error_info = $resource_prepare->errorInfo();

        if ($pdo_query_error_info[0] != '00000') {
            return false;
        }

        if (empty($result)) {
            session_destroy();

            return false;
        }

        $result = $result[0];

        $_SESSION['user'] = $result;

        return true;
    }
}
