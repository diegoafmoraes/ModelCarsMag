<?php
namespace Controllers;

use \Controllers\BaseController;
use \Models\PastIssues;

class Past_IssuesController extends BaseController {

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

		// $usuarios = new Usuarios();
		// $array['listaUsers'] = $usuarios->getAll();
        $covers = new PastIssues();
        $array['magCovers'] = $covers->magCovers();
		

		// Carrega o template (Titulo, arq. view, $array de conteudo, mostrar_menu)
		// parent::loadTemplate('TESTE', 'home', $array, true);
		$this->render(true, 'Past Issues', 'past-issues', $array);
	}

	


}