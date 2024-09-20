<?php
namespace Controllers;

use \Controllers\BaseController;

class HomeController extends BaseController {

	public $title;

	public function __construct() {

		parent::__construct();

	}

	/**
	 * View principal 
	 * 
	 * @return void
	 */
	public function index() {
		$array = array();

		// $urls_seg = explode('/', $this->verURL());
		// $urlsize = count($urls_seg); 
		// $array['urlAtual'] = $urls_seg[$urlsize -1];

		// echo '<pre>'; print_r($this->verURL()); 

/* 		// $usuarios = new Usuarios();
		$array['title'] = parent::viewTitle();
		// $array['listaUsers'] = $usuarios->getAll();
		$array['copy'] = $this->viewCopyright();
 */
		// Carrega o template (Titulo, arq. view, $array de conteudo, mostrar_menu)
		// parent::loadTemplate('TESTE', 'home', $array, true);
		$this->render(true, '', 'home', $array);
	}

	


}