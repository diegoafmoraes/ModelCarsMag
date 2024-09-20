<?php
namespace Components\MetaData;

use \Models\BaseModel;
use \Models\MetaData;

class MetaDataComponent extends BaseModel{

    public static function showMetaData()
    {
        
        // buscar lista do bd
        $menuItems = [
            'Home' => 'home',
            'About' => 'about',
            'New' => 'new',
            'Past Issues' => 'past-issues',
            'Printed Copies' => 'printed-copies',
            'Merchandising' => 'merchandising',
            'Contact' => 'contact',
            'Login' => 'login',
            'Subscribe' => 'subscribe',
        ]; 

        return $menuItems;
    }

    public static function showMetaDataFromDB($pg) {

        $metaData = [];

        $metaData = new MetaData();
        $mdVals = $metaData->metadataDB($pg);
 
        return $mdVals;

    }

}
