<?php

namespace Models\Administrator;

use \Models\BaseModel;

class AdminModel extends BaseModel
{
    protected $table = 'admins';

    public function getAll()
    {
        $sql = $this->db->prepare("SELECT id, name, user FROM " . $this->table . " WHERE deleted_at IS NULL");
        $sql->execute();
        return $sql->rowCount() > 0 ? parent::fetchAll($sql) : [];
    }

    public function getById($id)
    {
        $sql = $this->db->prepare("SELECT id, name, user FROM " . $this->table . " WHERE id = :id AND deleted_at IS NULL");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->rowCount() > 0 ? parent::fetch($sql) : null;
    }

    public function add($data)
    {
        $hid = $this->geraHash(rand());
        $sql = $this->db->prepare("INSERT INTO " . $this->table . " (hid, name, user, password, created_at, updated_at) VALUES (:hid, :name, :user, :password, NOW(), NOW())");
        $sql->bindValue(":hid", $hid);
        $sql->bindValue(":name", $data['name']);
        $sql->bindValue(":user", $data['user']);
        $sql->bindValue(":password", password_hash($data['password'], PASSWORD_DEFAULT));
        return $sql->execute();
    }

    public function update($id, $data)
    {
        $sql = $this->db->prepare("UPDATE " . $this->table . " SET name = :name, user = :user, updated_at = NOW()" . (isset($data['password']) ? ", password = :password" : "") . " WHERE id = :id AND deleted_at IS NULL");
        $sql->bindValue(":name", $data['name']);
        $sql->bindValue(":user", $data['user']);
        $sql->bindValue(":id", $id);
        if (isset($data['password'])) {
            $sql->bindValue(":password", password_hash($data['password'], PASSWORD_DEFAULT));
        }
        return $sql->execute();
    }

    public function delete($id)
    {
        $sql = $this->db->prepare("UPDATE " . $this->table . " SET deleted_at = NOW() WHERE id = :id");
        $sql->bindValue(":id", $id);
        return $sql->execute();
    }
}
