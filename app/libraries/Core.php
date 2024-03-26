<?php

/**
 * App Core Class
 * Creates URL & loads Core Controller
 * URL TEMPLATE - /controller/method/parameters
 */
class Core
{
    /**
     * Default Controller
     * @var string
     */
    protected string $currentController = 'Trades';
    /**
     * Controller Instance
     * @var object
     */
    protected object $controllerInstance;
    /**
     * Default Method
     * @var string
     */
    protected string $currentMethod = 'index';
    /**
     * Params method's array (optional)
     * @var array
     */
    protected array $params = [];
    /**
     * Generated by getUrl method
     * @var array
     */
    protected array $url;

    public function __construct()
    {
        $this->url = $this->getUrl();
        echo '<pre>';
        print_r($this->url);
        // controller logic
        $this->controllerInstance = $this->getController();

        // method logic
        $this->currentMethod = $this->getMethod();


        // parameters logic
        $this->params = $this->getParams();

        //
        call_user_func_array([$this->controllerInstance, $this->currentMethod], $this->params);
    }

    /**
     * Generates URL by exploding $_GET by '/'
     * @return array
     */
    public function getUrl(): array
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = rtrim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return array();
    }

    /**
     * Returns controller
     * Gets the first element of "exploded" array
     * @return object
     */
    public function getController(): object
    {
        if (isset($this->url[1])) {
            $controller = ucwords($this->url[1]);
            unset($this->url[1]);
            if (file_exists("../app/controllers/{$controller}.php")) {
                $this->currentController = $controller;
            }
        }
        require_once "../app/controllers/{$this->currentController}.php";
        $this->controllerInstance = new $this->currentController;
        return $this->controllerInstance;
    }

    /**
     * Returns method
     * @return string
     */
    public function getMethod(): string
    {
        if (isset($this->url[2])) {
            $method = $this->url[2];
            unset($this->url[2]);
            if (method_exists($this->controllerInstance, $method)) {
                $this->currentMethod = $method;
            }
        }
        return $this->currentMethod;
    }

    /**
     * Return method's params (optional)
     * @return array
     */
    public function getParams(): array
    {
        return $this->url ? array_values($this->url) : [];
    }
}