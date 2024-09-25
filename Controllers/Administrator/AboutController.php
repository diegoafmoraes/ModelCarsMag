<?php

namespace Controllers\administrator;

use \Controllers\BaseController;
use \Models\Administrator\AboutModel;

class AboutController extends BaseController
{
    protected $aboutModel;

    public function __construct()
    {
        parent::__construct();
        $this->aboutModel = new AboutModel();
    }

    public function index()
    {

        $texts = $this->aboutModel->getAll();
        $this->renderAdm(true, 'About Texts', 'about', ['texts' => $texts]);
    }

    public function viewAll()
    {
        $texts = $this->aboutModel->getAll();
        echo json_encode([
            "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 0,
            "recordsTotal" => count($texts),
            "recordsFiltered" => count($texts),
            "data" => $texts
        ]);
    }

    public function viewOne($id)
    {
        $text = $this->aboutModel->getById($id);
        echo json_encode($text);
    }

    public function insert()
    {

        $data = [
            'leftTxtBlock' => $_POST['leftTxtBlock'],
            'rightTxtBlock' => $_POST['rightTxtBlock']
        ];

        $result = $this->aboutModel->add($data);
        $message = $result ? 'Text added successfully.' : 'Failed to add text.';
        echo json_encode(['success' => $result, 'message' => $message]);
    }

    public function update()
    {
        $id = $_POST['id'];
        $data = [
            'leftTxtBlock' => $_POST['leftTxtBlock'],
            'rightTxtBlock' => $_POST['rightTxtBlock']
        ];
        $result = $this->aboutModel->update($id, $data);
        $message = $result ? 'Text updated successfully.' : 'Failed to update text.';
        echo json_encode(['success' => $result, 'message' => $message]);
    }

    public function delete()
    {
        $id = $_POST['id'];
        $result = $this->aboutModel->delete($id);
        $message = $result ? 'Text deleted successfully.' : 'Failed to delete text.';
        echo json_encode(['success' => $result, 'message' => $message]);
    }
}
