<?php

namespace Models\Administrator;

use \Models\BaseModel;

class AboutModel extends BaseModel
{
    protected $table = 'about';

    public function getAll()
    {
        $sql = $this->db->prepare("SELECT id, leftTxtBlock, rightTxtBlock FROM " . $this->table . " WHERE deleted_at IS NULL");
        $sql->execute();
        return $sql->rowCount() > 0 ? parent::fetchAll($sql) : [];
    }

    public function getById($id)
    {
        $sql = $this->db->prepare("SELECT leftTxtBlock, rightTxtBlock FROM " . $this->table . " WHERE id = :id AND deleted_at IS NULL");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->rowCount() > 0 ? parent::fetch($sql) : null;
    }

    public function add($data)
    {
        $hid = $this->geraHash(rand());
        $sql = $this->db->prepare("INSERT INTO " . $this->table . " (hid, leftTxtBlock, rightTxtBlock, created_at, updated_at) VALUES (:hid, :leftTxtBlock, :rightTxtBlock, NOW(), NOW())");
        $sql->bindValue(":hid", $hid);
        $sql->bindValue(":leftTxtBlock", $data['leftTxtBlock']);
        $sql->bindValue(":rightTxtBlock", $data['rightTxtBlock']);
        return $sql->execute();
    }

    public function update($id, $data)
    {
        $sql = $this->db->prepare("UPDATE " . $this->table . " SET leftTxtBlock = :leftTxtBlock, rightTxtBlock = :rightTxtBlock, updated_at = NOW() WHERE id = :id AND deleted_at IS NULL");
        $sql->bindValue(":leftTxtBlock", $data['leftTxtBlock']);
        $sql->bindValue(":rightTxtBlock", $data['rightTxtBlock']);
        $sql->bindValue(":id", $id);
        return $sql->execute();
    }

    public function delete($id)
    {
        $sql = $this->db->prepare("UPDATE " . $this->table . " SET deleted_at = NOW() WHERE id = :id");
        $sql->bindValue(":id", $id);
        return $sql->execute();
    }
}
