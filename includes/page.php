<?php

namespace Page;

class oPage
{
    public static $sTitle = '&Uuml;bersicht';
    public static $sType = '';

    public function __construct()
    {

    }

    /**
     * Get the page title
     * 
     * @return string
     */
    public static function sGetTitle()
    {

        switch (self::$sType) {
            case 'erstellen':
                self::$sTitle = 'Artikel erstellen';
                break;
            case 'bearbeiten':
                self::$sTitle = 'Artikel bearbeiten';
                break;
            case 'loeschen':
                self::$sTitle = 'Artikel löschen';
                break;
            case 'suche':
                self::$sTitle = 'Suche';
                break;
            case 'statistik':
                self::$sTitle = 'Statistik';
                break;
            case 'uebersicht':
            default:
                self::$sTitle = '&Uuml;bersicht';
        }

        return self::$sTitle;
    }

    /**
     * Set the page type
     * 
     * @return void
     */
    public static function vSetType()
    {
        self::$sType = $_GET['type'] ?? 'uebersicht';
    }

    /**
     * Get the page data
     * 
     * @return array
     */
    public static function aGetPageData()
    {
        self::vSetType();

        $aData = [
            'sTitle' => self::sGetTitle(),
            'sType' => self::$sType
        ];

        return $aData;
    }
}
