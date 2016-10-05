<?php
/**
 * @author Tamiris Arias <tamirisariasjustino@gmail.com>
 * Class Response, code fragment of project Willer Framework
 * @package Core
 * @property string $body
 * @property integer $code
 * @property array $header
 */
class Response {
    private $body;
    private $code;
    private $header;
    /**
     * Response constructor.
     * @param null $body
     * @param int $code
     */
    public function __construct($body = null, $code = 200) {
        $this->setBody($body);
        $this->setCode($code);
    }
    /**
     * @param $body
     * @return $this
     */
    public function setBody($body) {
        $this->body = $body;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getBody() {
        return $this->body;
    }
    /**
     * @param $code
     * @return $this
     */
    public function setCode($code) {
        $this->code = $code;

        http_response_code($code);

        return $this;
    }
    /**
     * @return mixed
     */
    public function getCode() {
        return $this->code;
    }
    /**
     * @param $header
     * @return $this
     */
    public function setHeader($header) {
        $this->header = $header;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getHeader() {
        return $this->header;
    }
    /**
     * @param $body
     */
    public function render($body) {
        if (!empty($body)) {
            $this->setBody($body);

        } else {
            $body = $this->getBody();
        }

        print $body;
    }
    /**
     * @param $body
     */
    public function renderToJson($body) {
        if (!empty($body)) {
            $this->setBody($body);

        } else {
            $body = $this->getBody();
        }

        $body = json_encode($body,JSON_UNESCAPED_UNICODE);

        header('Content-Type: application/json');

        print $body;
    }
    /**
     * @return mixed
     */
    public static function csrf() {
        $csrf = md5(uniqid(mt_rand(),true));
        $_SESSION["csrf"] = $csrf;

        return $csrf;
    }
    /**
     * @param $url
     */
    public function httpRedirect($url) {
        $code = $this->getCode();

        http_response_code($code);
        header('Location: '.$url);
    }
    /**
     * @return array $_SESSION['flash_message']
     */
    public function getFlashMessage() {
        $flash_message = null;

        if (isset($_SESSION['wf']['flash_message']) && !empty($_SESSION['wf']['flash_message'])) {
            $flash_message = $_SESSION['wf']['flash_message'];

            unset($_SESSION['wf']['flash_message']);
        }

        return $flash_message;
    }
    /**
     * @param $message
     * @return mixed
     */
    public function setFlashMessage($message) {
        if (!isset($_SESSION['wf']['flash_message'])) {
            $_SESSION['wf']['flash_message'] = [$message];

        } else {
            $_SESSION['wf']['flash_message'][] = $message;
        }

        return $this;
    }
}
