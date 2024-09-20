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

        // Retorno
        $ret = [];

        $sql = "SELECT * FROM admins WHERE user = :admin";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':admin', $admin);
        $stmt->execute();

        // Preparação para o retorno
        if($stmt->rowCount() > 0) {
            $ret = parent::fetch($stmt); // Retorna o objeto com user e password hash
        } 

        return $ret;

    }

    /**
     * Find Users bu Login Data
     *
     * @param [type] $user
     * @param [type] $password
     * @return void
     */
    public function getUserByLogin($user, $password)
    {
        $sql = "SELECT id, user FROM admins WHERE user = :user AND password = :password LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":user", $user);
        $stmt->bindValue(":password", $password);
        $stmt->execute();

        // Utilizando o método fetch da classe BaseModel
        return parent::fetch($stmt);
    }
}
