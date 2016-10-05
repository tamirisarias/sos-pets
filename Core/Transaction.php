<?php
/**
 * @author Tamiris Arias <tamirisariasjustino@gmail.com>
 * Class Transaction, code fragment of project Willer Framework
 * @package Core
 * @property mixed $resource
 * @property string $database
 * @property integer $last_insert_id
 * @property string $database_path
 */
class Transaction extends WException {
    private $resource;
    private $database;
    private $last_insert_id;
    private $database_path;
    /**
     * Transaction constructor.
     * @param null $database
     */
    public function __construct($database = null) {
        if (empty(defined('DATABASE_PATH'))) {
            throw new WException('constant DATABASE_PATH not defined');
        }

        $this->setDatabasePath(DATABASE_PATH);

        if (empty(defined('DATABASE'))) {
            throw new WException('constant DATABASE not defined');
        }

        $this->setDatabase(DATABASE);

        if (empty($database)) {
            $database = $this->getDatabase();

            $this->setDatabase($database);
        }

        $database_path = $this->getDatabasePath();

        if (!file_exists($database_path)) {
            throw new WException(vsprintf('database path dont find in "%s"',[$database_path,]));
        }

        $database_path = json_decode(file_get_contents($database_path),true);
        $this->setDatabasePath($database_path);

        if (empty($database_path)) {
            throw new WException(vsprintf('json encode error in database path "%s"',[$this->getDatabasePath(),]));
        }

        if (!array_key_exists($database,$database_path)) {
            throw new WException(vsprintf('database "%s" dont find in object "%s"',[$database,print_r($database_path,true),]));
        }

        if (!array_key_exists('driver',$database_path[$database])) {
            throw new WException(vsprintf('database driver key not registered in database object "%s"',[print_r($database_path,true)]));
        }

        $this->setDatabase($database);
    }
    /**
     * @return mixed
     */
    public function getResource() {
        return $this->resource;
    }
    /**
     * @param $resource
     */
    protected function setResource($resource) {
        $this->resource = $resource;

        return $this;
    }
    /**
     * @return string
     */
    public function getDatabase() {
        return $this->database;
    }
    /**
     * @param $database
     * @return $this
     */
    protected function setDatabase($database) {
        $this->database = $database;

        return $this;
    }
    /**
     * @return string
     */
    public function getDatabasePath() {
        return $this->database_path;
    }
    /**
     * @param $database_path
     */
    protected function setDatabasePath($database_path) {
        $this->database_path = $database_path;

        return $this;
    }
    /**
     * @return int
     */
    public function getLastInsertId() {
        return $this->last_insert_id;
    }
    /**
     * @param $id
     */
    protected function setLastInsertId($id) {
        $this->last_insert_id = $id;

        return $this;
    }
    /**
     * @return mixed
     * @throws WException
     */
    public function getDatabaseInfo() {
        $database = $this->getDatabase();
        $database_path = $this->getDatabasePath();

        if (!array_key_exists($database,$database_path)) {
            throw new WException(vsprintf('database "%s" dont find in object "%s"',[$database,print_r($database_path,true),]));
        }

        return $database_path[$database];
    }
    /**
     * @return $this
     * @throws Exception
     * @throws WException
     */
    public function connect() {
        $database_info = $this->getDatabaseInfo();

        if (!in_array($database_info['driver'],['mysql','pgsql','sqlite'])) {
            throw new WException(vsprintf('database driver "%s" not registered',[$database_info['driver'],]));
        }

        try {
            if (in_array($database_info['driver'],['mysql','pgsql'])) {
                $pdo = new PDO(vsprintf('%s:host=%s;port=%s;dbname=%s',[$database_info['driver'],$database_info['host'],$database_info['port'],$database_info['name']]),$database_info['user'],$database_info['password']);

            } else if ($database_info['driver'] == 'sqlite') {
                $pdo = new PDO(vsprintf('%s:%s',[$database_info['driver'],$database_info['host']]));
            }

            if ($database_info['driver'] == 'mysql') {
                if ($database_info['autocommit'] == 0) {
                    $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,0);

                } else if ($database_info['autocommit'] == 1) {
                    $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
                }
            }

            if (array_key_exists('debug',$database_info)) {
                if ($database_info['debug'] == 0) {
                    $pdo->setAttribute(PDO::ATTR_ERRMODE,0);

                } else if ($database_info['debug'] == 1) {
                    $pdo->setAttribute(PDO::ATTR_ERRMODE,1);
                }
            }

        } catch (PDOException $error) {
            throw $error;

        } catch (Exception $error) {
            throw $error;
        }

        $this->setResource($pdo);

        return $this;
    }
    /**
     * @return $this
     * @throws Exception
     * @throws WException
     */
    public function beginTransaction() {
        $this->connect();
        $resource = $this->getResource();

        try {
            $resource->beginTransaction();

        } catch (PDOException $error) {
            throw $error;

        } catch (Exception $error) {
            throw $error;
        }

        return $this;
    }
    /**
     * @return $this
     * @throws Exception
     */
    public function commit() {
        $resource = $this->getResource();

        if (!empty($resource)) {
            try {
                $this->resource->commit();

            } catch (PDOException $error) {
                throw $error;

            } catch (Exception $error) {
                throw $error;
            }
        }

        return $this;
    }
    /**
     * @return $this
     * @throws Exception
     */
    public function rollBack() {
        $resource = $this->getResource();

        if (!empty($resource)) {
            try {
                $this->resource->rollBack();

            } catch (PDOException $error) {
                throw $error;

            } catch (Exception $error) {
                throw $error;
            }
        }

        return $this;
    }
    /**
     * @param null $sequence_name
     * @return int
     * @throws Exception
     */
    public function lastInsertId($sequence_name = null) {
        $resource = $this->getResource();

        try {
            $this->setLastInsertId($resource->lastInsertId($sequence_name));

        } catch (PDOException $error) {
            throw $error;

        } catch (Exception $error) {
            throw $error;
        }

        return $this->getLastInsertId();
    }
}
