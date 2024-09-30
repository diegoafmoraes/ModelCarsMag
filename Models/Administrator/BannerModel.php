<?php

namespace Models\Administrator;

use Models\BaseModel;

class BannerModel extends BaseModel
{
    public function getAll()
    {
        $sql = "SELECT * FROM banners";
        return parent::fetchAll($sql);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM banners WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return parent::fetch($stmt);
    }

    public function insertBanner($data)
    {
        $sql = "INSERT INTO banners (page_id, banner_name, area, image) VALUES (:page_id, :banner_name, :area, :image)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function updateBanner($id, $data)
    {
        $sql = "UPDATE banners SET page_id = :page_id, banner_name = :banner_name, area = :area, image = :image WHERE id = :id";
        $data[':id'] = $id;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function deleteBanner($id)
    {
        $sql = "DELETE FROM banners WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
