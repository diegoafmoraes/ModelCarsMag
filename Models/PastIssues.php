<?php
namespace Models;

use \Models\BaseModel;

class PastIssues extends BaseModel {

    public function magCovers()
    {

        $array = [];

        $sql = $this->db->prepare("SELECT * FROM mags");
/*         $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company); */
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = parent::fetchAll($sql);
        }

        return $array;
    }
}
