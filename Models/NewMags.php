<?php
namespace Models;

use \Models\BaseModel;

class NewMags extends BaseModel {

    public function getAllMags()
    {

        $array = [];

        $sql = $this->db->prepare("SELECT * FROM mags");
/*      Não tenho os binds aqui porque não vou fazer filtro algum. Somente a seleção de todos os registros.
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company); */
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = parent::fetchAll($sql);
        }

        return $array;
    }
}
