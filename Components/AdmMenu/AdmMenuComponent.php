<?php
namespace Components\AdmMenu;

use \Models\BaseModel;
use \Models\Menu;

class AdmMenuComponent extends BaseModel
{

    public static function showAdmMenu()
    {

        // buscar lista do bd
        $menuItems = [
            'Admin Users' => 'admin',
            'Permissions' => 'permissions',
            'About' => 'about',
            'Publish' => 'publish',
            'Commercial Banners' => 'commercialBanners',
            'Contact' => 'contact',
            'Subscriptions' => 'subscriptions',
        ];

        return $menuItems;
    }

    public static function showMenuFromDB()
    {

        $menuItems = [];

        $menuItems = new Menu();
        $menuVals = $menuItems->menuitemsDB();

        return $menuVals;
    }

    public static function activePage()
    {

        $ativePage = explode('/', $_SERVER['REQUEST_URI']);
        // echo self::dd($prettyUrl); exit;
        $ativePageFormat = array_filter(array_reverse($ativePage));

        $pgReturn = '';
        switch ($ativePageFormat) {
            case empty($ativePageFormat[0]):
                $pgReturn = 'home';
                break;
            default:
                $pgReturn = $ativePageFormat[0];
                break;
        }
        // echo $pgReturn;
        // exit;

        return $pgReturn;
    }

    public static function exceptPages()
    {

        $menuExcept = [];

        $menuExcept = new Menu();
        $menuAbsPgs = $menuExcept->exceptList();

        return $menuAbsPgs;
    }


    public static function absPages($absLink)
    {

        switch ($absLink):
            case 'printed-copies':
                $menuAbsPgsLink = 'https://google.com.br';
                break;
            case 'merchandising':
                $menuAbsPgsLink = 'https://terra.com.br';
                break;
        endswitch;

        return $menuAbsPgsLink;
    }
}
