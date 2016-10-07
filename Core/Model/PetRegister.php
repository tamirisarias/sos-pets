<?php
/**
 * @author Tamiris Arias <tamirisariasjustino@gmail.com>
 * @package Core
 * PetRegister class
 */
Class PetRegister extends WException {
    private $transaction;
    private $id;
    private $user_id;
    private $city_id;
    private $nome;
    private $tipo;
    private $raca;
    private $porte;
    private $photo_1;
    private $photo_2;
    private $photo_3;
    private $error = [];
    /**
     * Class Response
     */
    private $response;

    public function __construct(Transaction $transaction,$id = null,$user_id = null,$city_id = null,$nome = null,$tipo = null,$raca = null,$porte = null) {
        $this->setTransaction($transaction);
        $this->setId($id);
        $this->setUserId($user_id);
        $this->setCityId($city_id);
        $this->setNome($nome);
        $this->setTipo($tipo);
        $this->setRaca($raca);
        $this->setPorte($porte);
    }

    private function getTransaction() {
        return $this->transaction;
    }

    private function setTransaction($transaction) {
        $this->transaction = $transaction;
    }

    private function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    private function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    private function getCityId() {
        return $this->city_id;
    }

    public function setCityId($city_id) {
        $this->city_id = $city_id;
    }

    private function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    private function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    private function getRaca() {
        return $this->raca;
    }

    public function setRaca($raca) {
        $this->raca = $raca;
    }

    private function getPorte() {
        return $this->porte;
    }

    public function setPorte($porte) {
        $this->porte = $porte;
    }

    private function getPhoto1() {
        return $this->photo_1;
    }

    public function setPhoto1($photo_1) {
        $this->photo_1 = $photo_1;
    }

    private function getPhoto2() {
        return $this->photo_2;
    }

    public function setPhoto2($photo_2) {
        $this->photo_2 = $photo_2;
    }

    private function getPhoto3() {
        return $this->photo_3;
    }

    public function setPhoto3($photo_3) {
        $this->photo_3 = $photo_3;
    }

    public function getError() {
        return $this->error;
    }

    private function setError($error) {
        $this->error[] = $error;
    }

    private function getResponse() {
        return $this->response;
    }

    public function setResponse(Response $response) {
        $this->response = $response;
    }
    /**
     * retorna um registro
     */
    public function get() {
        $id = $this->getId();

        $sql = "select * from pet where id = ?";
        $sql_value_list = [$id];

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

        if (!empty($result)) {
            if ($result->tipo == '1') {
                $result->tipo_label = 'Cão';

            } else {
                $result->tipo_label = 'Gato';
            }

            if ($result->porte == '1') {
                $result->porte_label = 'Filhote';

            } else {
                $result->porte_label = 'Adulto';
            }

            $this->setCityId($result->city_id);
            $city = $this->cityGet();

            $result->city = $city;

            $this->setUserId($result->user_id);
            $user = $this->userGet();

            $result->user = $user;
        }

        return $result;
    }
    /**
     * retorna um registro de usuario
     */
    public function userGet() {
        $user_id = $this->getUserId();

        $sql = "select * from user where id = ?";
        $sql_value_list = [$user_id];

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
     * retorna registros da tabela photo
     */
    public function photoListing() {
        $id = $this->getId();

        $sql = "select * from photo where pet_id = ? order by `default` asc";
        $sql_value_list = [$id];

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
            $result = $resource_prepare->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $error) {
            return false;

        } catch (Exception $error) {
            return false;
        }

        if (!empty($result)) {
            $result_tmp = [];

            foreach ($result as $key => $item) {
                $result_tmp[$item->nome] = $item;
            }

            $result = $result_tmp;
        }

        return $result;
    }
    /**
     * retorna um registro da tabela city
     */
    public function cityGet() {
        $city_id = $this->getCityId();

        $sql = "select * from city where id = ?";
        $sql_value_list = [$city_id];

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
     * retorna uma lista de registros
     */
    public function listing() {
        $user_id = $this->getUserId();

        $sql_where = [];
        $sql_value_list = [];

        if (!empty($user_id)) {
            $sql_where[] = 'user_id=?';
            $sql_value_list[] = $user_id;
        }

        if (empty($sql_where)) {
            $sql_where = '';

        } else {
            $sql_where = vsprintf('where %s',[implode(' and ',$sql_where)]);
        }

        $sql = vsprintf("select * from pet %s order by id desc",[$sql_where,]);
        $sql_value_list = [$user_id];

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
            $result = $resource_prepare->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $error) {
            return false;

        } catch (Exception $error) {
            return false;
        }

        if (!empty($result)) {
            foreach ($result as $key => $item) {
                $this->setId($item->id);
                $photo = $this->photoListing();

                $result[$key]->photo = $photo;

                $this->setCityId($item->city_id);
                $city = $this->cityGet();

                $result[$key]->city = $city;

                if ($item->tipo == '1') {
                    $result[$key]->tipo_label = 'Cão';

                } else {
                    $result[$key]->tipo_label = 'Gato';
                }

                if ($item->porte == '1') {
                    $result[$key]->porte_label = 'Filhote';

                } else {
                    $result[$key]->porte_label = 'Adulto';
                }
            }
        }

        return $result;
    }
    /**
     * retorna uma lista de registros filtrados
     */
    public function search() {
        $user_id = $this->getUserId();
        $city_id = $this->getCityId();
        $tipo = $this->getTipo();
        $raca = $this->getRaca();
        $porte = $this->getPorte();

        $sql_where = [];
        $sql_value_list = [];

        if (!empty($user_id)) {
            $sql_where[] = 'user_id=?';
            $sql_value_list[] = $user_id;
        }

        if (!empty($city_id)) {
            $sql_where[] = 'city_id=?';
            $sql_value_list[] = $city_id;
        }

        if (!empty($tipo)) {
            $sql_where[] = 'tipo=?';
            $sql_value_list[] = $tipo;
        }

        if (!empty($raca)) {
            $sql_where[] = 'raca=?';
            $sql_value_list[] = $raca;
        }

        if (!empty($porte)) {
            $sql_where[] = 'porte=?';
            $sql_value_list[] = $porte;
        }

        if (empty($sql_where)) {
            $sql_where = '';

        } else {
            $sql_where = vsprintf('where %s',[implode(' and ',$sql_where)]);
        }

        $sql = vsprintf("select * from pet %s order by id desc",[$sql_where,]);

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
            $result = $resource_prepare->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $error) {
            return false;

        } catch (Exception $error) {
            return false;
        }

        if (!empty($result)) {
            foreach ($result as $key => $item) {
                $this->setId($item->id);
                $photo = $this->photoListing();

                $result[$key]->photo = $photo;

                $this->setCityId($item->city_id);
                $city = $this->cityGet();

                $result[$key]->city = $city;

                if ($item->tipo == '1') {
                    $result[$key]->tipo_label = 'Cão';

                } else {
                    $result[$key]->tipo_label = 'Gato';
                }

                if ($item->porte == '1') {
                    $result[$key]->porte_label = 'Filhote';

                } else {
                    $result[$key]->porte_label = 'Adulto';
                }
            }
        }

        return $result;
    }
    /**
     * salva um novo registro
     */
    public function photoSave($name,$path,$default = 0,Transaction $transaction = null) {
        $response = $this->getResponse();

        $id = $this->getId();

        if (empty($transaction)) {
            $transaction = $this->getTransaction();
            $transaction->beginTransaction();
        }

        $resource = $transaction->getResource();

        $sql = "delete from photo where pet_id = ? and nome = ?";
        $sql_value_list = [$id,$name];

        try {
            $resource_prepare = $resource->prepare($sql);

            $transaction_resource_error_info = $resource->errorInfo();

            if ($transaction_resource_error_info[0] != '00000') {
                $this->setError(vsprintf('Erro na remoção da foto "%s"!',[$name,]));

                $transaction->rollBack();

                return false;
            }

            $result = $resource_prepare->execute($sql_value_list);

        } catch (PDOException $error) {
            $this->setError(vsprintf('Erro na remoção da foto "%s"!',[$name,]));

            $transaction->rollBack();

            return false;

        } catch (Exception $error) {
            $this->setError(vsprintf('Erro na remoção da foto "%s"!',[$name,]));

            $transaction->rollBack();

            return false;
        }

        $pdo_query_error_info = $resource_prepare->errorInfo();

        if ($pdo_query_error_info[0] != '00000') {
            $this->setError(vsprintf('Erro na remoção da foto "%s"!',[$name,]));

            $transaction->rollBack();

            return false;
        }

        if (empty($transaction)) {
            $transaction->commit();
        }

        $sql = "insert into photo (`pet_id`,`nome`,`path`,`default`,`status`,`datacriacao`) values (?,?,?,?,?,?)";
        $sql_value_list = [$id,$name,$path,$default,'1',date('Y/m/d H:i:s')];

        try {
            $resource_prepare = $resource->prepare($sql);

            $transaction_resource_error_info = $resource->errorInfo();

            if ($transaction_resource_error_info[0] != '00000') {
                $this->setError(vsprintf('Erro no cadastro da foto "%s"!',[$name,]));

                $transaction->rollBack();

                return false;
            }

            $result = $resource_prepare->execute($sql_value_list);

        } catch (PDOException $error) {
            $this->setError(vsprintf('Erro no cadastro da foto "%s"!',[$name,]));

            $transaction->rollBack();

            return false;

        } catch (Exception $error) {
            $this->setError(vsprintf('Erro no cadastro da foto "%s"!',[$name,]));

            $transaction->rollBack();

            return false;
        }

        $pdo_query_error_info = $resource_prepare->errorInfo();

        if ($pdo_query_error_info[0] != '00000') {
            $this->setError(vsprintf('Erro no cadastro da foto "%s"!',[$name,]));

            $transaction->rollBack();

            return false;
        }

        if (empty($transaction)) {
            $transaction->commit();
        }

        return true;
    }
    /**
     * deleta um registro
     */
    public function delete() {
        $response = $this->getResponse();

        $id = $this->getId();

        $transaction = $this->getTransaction();
        $transaction->beginTransaction();

        $resource = $transaction->getResource();

        $sql = "delete from pet where id = ?";
        $sql_value_list = [$id];

        try {
            $resource_prepare = $resource->prepare($sql);

            $transaction_resource_error_info = $resource->errorInfo();

            if ($transaction_resource_error_info[0] != '00000') {
                $this->setError('Erro na remoção do Pet!');

                $transaction->rollBack();

                return false;
            }

            $result = $resource_prepare->execute($sql_value_list);

        } catch (PDOException $error) {
            $this->setError('Erro na remoção do Pet!');

            $transaction->rollBack();

            return false;

        } catch (Exception $error) {
            $this->setError('Erro na remoção do Pet!');

            $transaction->rollBack();

            return false;
        }

        $pdo_query_error_info = $resource_prepare->errorInfo();

        if ($pdo_query_error_info[0] != '00000') {
            $this->setError('Erro na remoção do Pet!');

            $transaction->rollBack();

            return false;
        }

        $sql = "delete from photo where pet_id = ?";
        $sql_value_list = [$id];

        try {
            $resource_prepare = $resource->prepare($sql);

            $transaction_resource_error_info = $resource->errorInfo();

            if ($transaction_resource_error_info[0] != '00000') {
                $this->setError('Erro na remoção das fotos do Pet!');

                $transaction->rollBack();

                return false;
            }

            $result = $resource_prepare->execute($sql_value_list);

        } catch (PDOException $error) {
            $this->setError('Erro na remoção das fotos do Pet!');

            $transaction->rollBack();

            return false;

        } catch (Exception $error) {
            $this->setError('Erro na remoção das fotos do Pet!');

            $transaction->rollBack();

            return false;
        }

        $pdo_query_error_info = $resource_prepare->errorInfo();

        if ($pdo_query_error_info[0] != '00000') {
            $this->setError('Erro na remoção das fotos do Pet!');

            $transaction->rollBack();

            return false;
        }

        $transaction->commit();

        return true;
    }
    /**
     * salva um novo registro
     */
    public function save() {
        $response = $this->getResponse();

        $id = $this->getId();
        $user_id = $this->getUserId();
        $city_id = $this->getCityId();
        $nome = $this->getNome();
        $tipo = $this->getTipo();
        $raca = $this->getRaca();
        $porte = $this->getPorte();

        if (!empty($id)) {
            $sql = "update pet set city_id = ?, nome = ?, tipo = ?, raca = ?, porte = ? where id = ?";
            $sql_value_list = [$city_id,$nome,$tipo,$raca,$porte,$id];

        } else {
            $sql = "insert into pet (user_id,city_id,nome,tipo,raca,porte,status,datacriacao) values (?,?,?,?,?,?,?,?)";
            $sql_value_list = [$user_id,$city_id,$nome,$tipo,$raca,$porte,'1',date('Y/m/d H:i:s')];
        }

        $transaction = $this->getTransaction();
        $transaction->beginTransaction();
        $resource = $transaction->getResource();

        try {
            $resource_prepare = $resource->prepare($sql);

            $transaction_resource_error_info = $resource->errorInfo();

            if ($transaction_resource_error_info[0] != '00000') {
                $this->setError('Erro no cadastro!');

                $transaction->rollBack();

                return false;
            }

            $result = $resource_prepare->execute($sql_value_list);

        } catch (PDOException $error) {
            $this->setError('Erro no cadastro!');

            $transaction->rollBack();

            return false;

        } catch (Exception $error) {
            $this->setError('Erro no cadastro!');

            $transaction->rollBack();

            return false;
        }

        $pdo_query_error_info = $resource_prepare->errorInfo();

        if ($pdo_query_error_info[0] != '00000') {
            $this->setError('Erro no cadastro!');

            $transaction->rollBack();

            return false;
        }

        $photo_1 = $this->getPhoto1();
        $photo_2 = $this->getPhoto2();
        $photo_3 = $this->getPhoto3();

        if (!empty($photo_1['tmp_name']) || !empty($photo_2['tmp_name']) || !empty($photo_3['tmp_name'])) {
            if (empty($id)) {
                $id = $transaction->lastInsertId();
            }

            $this->setId($id);

            $dir_upload = vsprintf('public/img/pet/%s',[$id,]);

            if (!is_dir($dir_upload)) {
                $mkdir_result = mkdir($dir_upload,0777,true);

                if (empty($mkdir_result)) {
                    $this->setError('Erro no upload de imagens!');

                    $transaction->rollBack();

                    return false;
                }
            }

            $mime_types = [
                'image/pjpeg' => '.jpeg',
                'image/jpeg' => '.jpeg',
                'image/png' => '.png',];

            if (!empty($photo_1['tmp_name'])) {
                if (!in_array($mime_types[$photo_1['type']],['.jpeg','.png'])) {
                    $this->setError('Erro no upload de imagem para foto principal, formato de arquivo incompátivel!');

                } else {
                    $filename = vsprintf('%s/1%s',[$dir_upload,$mime_types[$photo_1['type']]]);

                    $upload = move_uploaded_file($photo_1['tmp_name'],$filename);

                    if (empty($upload)) {
                        $this->setError('Erro no upload de imagem para foto principal!');

                    } else {
                        $photo_save_result = $this->photoSave('1',$filename,'1',$transaction);

                        if (empty($photo_save_result)) {
                            $transaction->rollBack();

                            return false;
                        }
                    }
                }
            }

            if (!empty($photo_2['tmp_name'])) {
                if (!in_array($mime_types[$photo_2['type']],['.jpeg','.png'])) {
                    $this->setError('Erro no upload de imagem para foto 2, formato de arquivo incompátivel!');

                } else {
                    $filename = vsprintf('%s/2%s',[$dir_upload,$mime_types[$photo_2['type']]]);

                    $upload = move_uploaded_file($photo_2['tmp_name'],$filename);

                    if (empty($upload)) {
                        $this->setError('Erro no upload de imagem para foto 2!');

                    } else {
                        $photo_save_result = $this->photoSave('2',$filename,'0',$transaction);

                        if (empty($photo_save_result)) {
                            $transaction->rollBack();

                            return false;
                        }
                    }
                }
            }

            if (!empty($photo_3['tmp_name'])) {
                if (!in_array($mime_types[$photo_3['type']],['.jpeg','.png'])) {
                    $this->setError('Erro no upload de imagem para foto 3, formato de arquivo incompátivel!');

                } else {
                    $filename = vsprintf('%s/3%s',[$dir_upload,$mime_types[$photo_3['type']]]);

                    $upload = move_uploaded_file($photo_3['tmp_name'],$filename);

                    if (empty($upload)) {
                        $this->setError('Erro no upload de imagem para foto 3!');

                    } else {
                        $photo_save_result = $this->photoSave('3',$filename,'0',$transaction);

                        if (empty($photo_save_result)) {
                            $transaction->rollBack();

                            return false;
                        }
                    }
                }
            }
        }

        $transaction->commit();

        return $result;
    }
    /**
     * retorna uma lista de registros
     */
    public function cityListing() {
        $sql = "select * from city order by id asc";

        $transaction = $this->getTransaction();
        $transaction->connect();
        $resource = $transaction->getResource();

        try {
            $resource_prepare = $resource->prepare($sql);

            $transaction_resource_error_info = $resource->errorInfo();

            if ($transaction_resource_error_info[0] != '00000') {
                return false;
            }

            $resource_prepare->execute([]);
            $result = $resource_prepare->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $error) {
            return false;

        } catch (Exception $error) {
            return false;
        }

        if (!empty($result)) {
            $result_tmp = [];

            foreach ($result as $key => $item) {
                if (!array_key_exists($item->estadosigla,$result_tmp)) {
                    $result_tmp[$item->estadosigla] = [$item];

                } else {
                    $result_tmp[$item->estadosigla][] = $item;
                }
            }

            $result = $result_tmp;
        }

        return $result;
    }
}
