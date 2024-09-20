<?php
namespace Models;

use \Models\BaseModel;

class MetaData extends BaseModel {

    public function metadataDB($pg)
    {

        $array = [];

        $sql = $this->db->prepare("SELECT * FROM pages
                                   WHERE slug = '$pg' ");
/*         $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company); */
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = parent::fetch($sql);
        }

        return $array;
    }
}
