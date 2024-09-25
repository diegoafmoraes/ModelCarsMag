<?php

namespace Models\Administrator;

use \Models\BaseModel;

class LoginAdminModel extends BaseModel
{
    /**
     * Checks Login and Password and returns True or False
     *
     * @param string $admin
     * @return object|null
     */
    public function validateLogin($admin)
    {
        $sql = "SELECT * FROM admins WHERE user = :admin AND deleted_at IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':admin', $admin);
        $stmt->execute();
        return parent::fetch($stmt); // Retorna o objeto com user e password hash
    }


    public function authenticate()
    {
        if (!empty($_POST['admin']) && !empty($_POST['password'])) {
            $username = $_POST['admin'];
            $password = $_POST['password'];

            $userModel = new AdminModel();
            $admin = $this->validateLogin($username);

            if ($admin && password_verify($password, $admin->password)) {
                // Login válido, define a sessão
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_name'] = $admin->name;

                // Retorna JSON de sucesso
                echo json_encode(['success' => true]);
            } else {
                // Login inválido
                echo json_encode(['success' => false, 'message' => 'Login or Password Incorrect']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Please enter username and password']);
        }
    }
}
