<?php

namespace Controllers\Administrator;

use Controllers\BaseController;
use Models\Administrator\LoginAdminModel; // Ajuste para o nome correto do seu Model

class LoginController extends BaseController
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * View principal 
	 * 
	 * @return void
	 */
	public function index()
	{
		// Exibe a página de login
		// $this->render(true, 'Login', 'administrator/login', []);
		$this->loadViewInDashboard('login', []);
	}

	/**
	 * Checks inputed data validity
	 *
	 * @return void
	 */
	public function authenticate() {
		if (!empty($_POST['admin']) && !empty($_POST['password'])) {
			$adminname = $_POST['admin'];
			$password = $_POST['password'];
	
			$adminModel = new LoginAdminModel();
			$admin = $adminModel->validateLogin($adminname);

			// Define o cabeçalho para resposta JSON
			header('Content-Type: application/json');
		
			if ($admin && password_verify($password, $admin->password)) {
				// Login válido, define a sessão
				$_SESSION['admin_logged_in'] = true;
				$_SESSION['admin_name'] = $admin->name;
	
				// Redireciona para o dashboard
				echo json_encode(['success' => true, 'redirect' => BASE_URL . 'administrator/dashboard']);
			} else {
				// Login inválido
				echo json_encode(['success' => false, 'message' => 'Login or Password Incorrect']);
			}
		} else {
			echo json_encode(['success' => false, 'message' => 'Please enter username and password']);
		}
	}
	
	
}
