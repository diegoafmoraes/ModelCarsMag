<?php

namespace Controllers;

use \Core\Controller;

/**
 * Base Controller that provides utility methods and properties
 * that can be used across different controllers.
 */
class BaseController extends Controller
{
    public static $getURL;
    public $nomeUser;
    private static $urlSegments;
    private static $title = 'Model Car Racing Magazine';
    private static $copy = "Todos os direitos reservados";
    public $menu;

    /**
     * Initialize controller base properties and methods.
     */
    public function __construct()
    {
        parent::__construct();
        // Initialize the URL segments to empty
        self::$urlSegments = '';
    }

    /**
     * Get or set the title of the view.
     * @param string|null $tit Optional title.
     * @return string The title to be used.
     */
    public function viewTitle($tit = null)
    {
        return $tit ?: self::$title;
    }

    /**
     * Get the copyright text.
     * @return string The copyright text.
     */
    public function viewCopyright()
    {
        return self::$copy;
    }

    /**
     * Set the name of the user.
     * @param string $nuser User's name.
     */
    protected function setNome($nuser)
    {
        $this->nomeUser = $nuser;
    }

    /**
     * Get the name of the user.
     * @return string User's name.
     */
    protected function getNome()
    {
        return $this->nomeUser;
    }

    /**
     * Parse and filter the segments of the current URL.
     * @return array The filtered segments of the URL.
     */
    protected static function urlSegments()
    {
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $pathSegments = explode('/', $urlPath);
        return array_filter($pathSegments);
    }

    /**
     * Get a formatted version of the current URL.
     * @return array Formatted URL segments.
     */
    public function verURL()
    {
        $prettyUrl = explode('/', $_SERVER['REQUEST_URI']);
        return array_filter($prettyUrl);
    }

    /**
     * Generate a complex hash from a given parameter.
     * @param mixed $param The parameter to hash.
     * @return string The generated hash.
     */
    protected function geraHash($param)
    {
        $p1 = md5($param);
        $p2 = sha1($param);
        $p3 = uniqid($param);
        $interval = rand(0, 98765432);

        $str = $p1 . $interval . $p2 . $interval . $p3;

        return substr($str, 0, 198);
    }

    /**
     * Generate Password 
     *
     * @param [type] $pw
     * @return void
     */
    public static function generatePassword($pw)
    {
        return password_hash($pw, PASSWORD_DEFAULT);
    }

    /**
     * Generate a fake name from a given parameter.
     * @param mixed $param The parameter to use.
     * @return string The fake name.
     */
    protected function fakeName($param)
    {
        $p1 = md5($param);
        $p2 = sha1($param);
        $p3 = uniqid($param);
        $interval = rand(0, 98765432);

        $str = $p1 . $interval . $p2 . $interval . $p3;

        return substr($str, 0, 78);
    }

    /**
     * Debugger
     *
     * @param [type] $arr
     * @return void
     */
    public static function dd($arr)
    {

        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        exit;
    }

    /**
     * Render a view within a template.
     * @param bool $menu Whether to include the menu.
     * @param string $titleTXT The title of the page.
     * @param string $view The view to render.
     * @param array $array Additional data for the view.
     */
    protected function render($menu, $titleTXT, $view, $arrayContent)
    {
        // header('Content-Type: text/html; charset=utf-8'); // Garante que o tipo de conteúdo seja HTML
        
        parent::loadTemplate($menu, $titleTXT, $view, $arrayContent);
    }

    /**
     * Render a view within a template.
     * @param bool $menu Whether to include the menu.
     * @param string $titleTXT The title of the page.
     * @param string $view The view to render.
     * @param array $array Additional data for the view.
     */
    protected function renderAdm($menu, $titleTXT, $view, $arrayContent)
    {
        parent::loadAdmTemplate($menu, $titleTXT, $view, $arrayContent);
    }
}
