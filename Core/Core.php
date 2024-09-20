<?php

namespace Core;

class Core
{

    public function run()
    {
        $url = '/';
        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

        $params = array();
        $prefix = '\Controllers\\'; // Inicializa o prefixo no início para evitar erro

        if (!empty($url) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url);

            // Verifica se o primeiro segmento da URL é 'administrator'
            if ($url[0] == 'administrator') {
                $prefix = '\Controllers\administrator\\'; // Atualiza o prefixo para 'administrator'
                array_shift($url); // Remove 'administrator' da URL para pegar o controlador

                // Verifica se o usuário está tentando acessar a página de login
                if (empty($url) || $url[0] !== 'login') {
                    // Sessão já iniciada
                    // session_start(); // Inicia sessão para verificar
                    if (!isset($_SESSION['admin_logged_in'])) {
                        header('Location: ' . BASE_URL . 'administrator/login');
                        exit;
                    }
                }
            }

            $currentController = (!empty($url[0]) ? $url[0] : 'HomeController') . 'Controller';
            array_shift($url);

            $currentAction = !empty($url) ? array_shift($url) : 'index';
            $params = $url;
        } else {
            // Caso a URL esteja vazia, redireciona para o 'HomeController'
            $currentController = 'HomeController';
            $currentAction = 'index';
        }

        $currentController = ucfirst($currentController);

        // Atualiza o caminho para o controlador, verificando se está na subpasta
        if (
            !file_exists('Controllers/' . $currentController . '.php') &&
            !file_exists('Controllers/administrator/' . $currentController . '.php')
        ) {
            $currentController = 'NotfoundController';
            $currentAction = 'index';
            $prefix = '\Controllers\\'; // Define o prefixo de volta ao padrão caso o controlador não seja encontrado
        }

        // Verifica se o método existe no controlador
        if (!method_exists($prefix . $currentController, $currentAction)) {
            $currentController = 'NotfoundController';
            $currentAction = 'index';
            $prefix = '\Controllers\\'; // Ajusta o prefixo de volta ao padrão
        }

        // Instancia o controlador correto
        $newController = $prefix . $currentController;
        $c = new $newController();

        // Chama a ação com os parâmetros
        call_user_func_array(array($c, $currentAction), $params);
    }
}
