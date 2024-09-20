<?php

namespace Core;

use \Models\MetaData;

class Controller
{

	public function __construct()
	{

		define("VALID_URI", "Home");
	}

	public function prepareMetadata($pg)
	{

		$metaData = [];

		$metaData = new MetaData();
		$mdVals = $metaData->metadataDB($pg);

		return $mdVals;
	}

	// Abre so uma pagina sem template (para gerar um pdf, por ex.)
	public function loadView($viewName, $viewData = array())
	{
		extract($viewData);
		require 'Views/' . $viewName . '.php';
	}

	// Carrega o template geral "default"
	public function loadTemplate($menu, $tit, $viewName, $viewData = array())
	{
		if ($menu) {
			require 'Components/menu/MenuComponent.php';
		}

		require 'Views/template/default_tpl.php';
	}

	// Carrega o template geral "dashboard"
	public function loadAdmTemplate($menu, $tit, $viewName, $viewData = array())
	{
		if ($menu) {
			//require 'Components/menu/MenuComponent.php';
		}

		require 'Views/template/dashboard_tpl.php';
	}

	// Carrega uma view (variavel pela url), dentro do template geral Externo
	public static function loadViewInTemplate($viewName, $viewData = array())
	{
		extract($viewData);
		require 'Views/' . $viewName . '.php';
	}

	// Carrega uma view (variavel pela url), dentro do template geral da Dashboard
	public static function loadViewInDashboard($viewName, $viewData = array())
	{
		extract($viewData);
		require 'Views/administrator/' . $viewName . '.php';
	}

	// Carrega um modulo dentro do template (um cabecalho ou um menu lateral, um rodape)
	public function loadComponent($modName, $viewData = array())
	{
		extract($viewData);
		require 'Components/' . $modName . '.php';
	}

	// Carrega um modulo dentro do template (um cabecalho ou um menu lateral, um rodape)
	public function loadModule($modName, $viewData = array())
	{
		extract($viewData);
		require 'Modules/' . $modName . '.php';
	}

	// Carrega um helper (formatar moeda, datas, etc...)
	public function loadHelper($helperName)
	{
		require 'Helpers/' . $helperName . '.php';
	}
}
