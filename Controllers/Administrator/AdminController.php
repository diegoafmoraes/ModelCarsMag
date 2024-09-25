<?php

namespace Controllers\administrator;

use \Controllers\BaseController;
use \Models\Administrator\AdminModel;

class AdminController extends BaseController
{
    protected $adminUserModel;

    public function __construct()
    {
        parent::__construct();
        $this->adminUserModel = new AdminModel();
    }

    public function index()
    {
        $users = $this->adminUserModel->getAll();
        $this->renderAdm(true, 'Admin Users', 'admin', ['users' => $users]);
    }

    public function viewAll()
    {
        $admins = $this->adminUserModel->getAll();
        echo json_encode([
            "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 0,
            "recordsTotal" => count($admins),
            "recordsFiltered" => count($admins),
            "data" => $admins
        ]);
    }

    public function viewOne($id)
    {
        $user = $this->adminUserModel->getById($id);
        echo json_encode($user);
    }

    public function insert()
    {
        $data = [
            'name' => $_POST['name'],
            'user' => $_POST['username'],
            'password' => $_POST['password']
        ];
        $result = $this->adminUserModel->add($data);
        echo json_encode(['success' => $result, 'message' => $result ? 'User added successfully.' : 'Failed to add user.']);
    }

    public function update()
    {
        $id = $_POST['userId'];
        $data = [
            'name' => $_POST['name'],
            'user' => $_POST['username']
        ];
        if (!empty($_POST['password'])) {
            $data['password'] = $_POST['password'];
        }
        $result = $this->adminUserModel->update($id, $data);
        echo json_encode(['success' => $result, 'message' => $result ? 'User updated successfully.' : 'Failed to update user.']);
    }

    public function delete()
    {
        $id = $_POST['id'];
        $result = $this->adminUserModel->delete($id);
        echo json_encode(['success' => $result, 'message' => $result ? 'User deleted successfully.' : 'Failed to delete user.']);
    }
}
