<?php
namespace Controllers\administrator;

use \Controllers\BaseController;
use \Models\Administrator\DashboardModel;

class DashboardController extends BaseController {

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

		$array = [];
		// dump para debug de dados
		// parent::dd($array['carouselCovers']);


		// Carrega o template (mostrar_menu, Titulo, arq. view, $array de conteudo)
		// parent::loadTemplate('TESTE', 'home', $array, true);
		$this->renderAdm(true, 'Dashboard', 'dashboard', $array);
	}
}