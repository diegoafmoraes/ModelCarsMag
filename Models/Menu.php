<?php

namespace Models;

use \Models\BaseModel;

class Menu extends BaseModel
{

    public function menuitemsDB()
    {

        $array = [];

        $sql = $this->db->prepare("SELECT * FROM menutopo");
        /*         $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company); */
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = parent::fetchAll($sql);
        }

        return $array;
    }

    public function exceptList()
    {

        $except = array();

        $except = [
            'printed-copies',
            'merchandising'
        ];

        return $except;
    }
}
