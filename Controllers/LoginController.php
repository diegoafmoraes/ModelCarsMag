<?php
namespace Controllers;

use \Controllers\BaseController;

class LoginController extends BaseController {

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

		// $mags = new NewMags();
		// $array['carouselCovers'] = $mags->getAllMags();
		// parent::dd($array['carouselCovers']);
        
		// Carrega o template (Titulo, arq. view, $array de conteudo, mostrar_menu)
		// parent::loadTemplate('TESTE', 'home', $array, true);
		$this->render(true, 'administrator/Login', 'login', $array);
	}	


}