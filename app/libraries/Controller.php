<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Base Controller
 * Loads Models & Views
 */
class Controller
{
    /**
     * Requires Model Class
     * @param string $model
     * @return object
     */
    public function model(string $model, string $host, string $dbname, string $username, string $password, string $tableName): object
    {
        $model = ucwords($model);
        require_once APP_ROOT . "/models/$model.php";

        return new $model($host, $dbname, $username, $password, $tableName);
    }

    /**
     * Requires View Class
     * @param string $view
     * @param array $data
     * @return void
     */
    public function view(string $view, array $data = []): void
    {
        $viewArr = explode('/', $view);
        $entity = $viewArr[0];
        $method = $viewArr[1];
        if (file_exists("../app/views/$view.twig")) {
            $loader = new FilesystemLoader([APP_ROOT."/views/$entity"]);
            $twig = new Environment($loader);
            echo $twig->render("$method.twig", ['data' => $data]);
        } else {
            die("View: $view does not exist");
        }
    }
}