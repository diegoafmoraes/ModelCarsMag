<?php

namespace Controllers\Administrator;

use Controllers\BaseController;
use Models\Administrator\BannerModel;

class BannerController extends BaseController {
    protected $bannerModel;

    public function __construct() {
        $this->bannerModel = new BannerModel();
    }

    public function insert() {
        // Lógica para processar o upload e chamar o método de inserção
    }

    public function update($id) {
        // Lógica para processar o upload e chamar o método de atualização
    }

    public function delete($id) {
        $result = $this->bannerModel->deleteBanner($id);
        echo json_encode($result);
    }

    public function viewAll() {
        $banners = $this->bannerModel->getAll();
        // Renderizar a view com os banners
    }
}
