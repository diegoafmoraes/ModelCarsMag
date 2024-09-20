<?php
namespace Components\Menu;

use \Models\BaseModel;
use \Models\Menu;

class MenuComponent extends BaseModel
{

    public static function showMenu()
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
