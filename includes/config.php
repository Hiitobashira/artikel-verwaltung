<?php

namespace Config;

class oConfig
{
    private $sDBHost = '';
    private $sDBName = '';
    private $sUserName = '';
    private $sPassword = '';
    
    /**
     * Gets private attributes
     * 
     * @param string $sAttributeName
     * 
     * @return mixed
     */
    protected function sGetAttribute($sAttributeName)
    {
        if (isset($this->{$sAttributeName})) {
            return $this->{$sAttributeName};
        }
        
        return null;
    }

    protected function vSetCredentials()
    {
        $aConfig = parse_ini_file(__DIR__ . '/../config.ini');
        if (getenv("DBHOST") !== FALSE) {
            $this->sDBHost = getenv("DBHOST");
        } else {
            $this->sDBHost = $aConfig['DBHOST'];
        }

        if (getenv("DBNAME") !== FALSE) {
            $this->sDBName = getenv("DBNAME");
        } else {
            $this->sDBName = $aConfig['DBNAME'];
        }

        if (getenv("DBUSER") !== FALSE) {
            $this->sUserName = getenv("DBUSER");
        } else {
            $this->sUserName = $aConfig['DBUSER'];
        }

        if (getenv("DBPASSWD") !== FALSE) {
            $this->sPassword = getenv("DBPASSWD");
        } else {
            $this->sPassword = $aConfig['DBPASSWD'];
        }

        if (!$this->sDBHost || !$this->sDBName || !$this->sUserName || !$this->sPassword) {
            exit('Die Konfigurationsdatei ist fehlerhaft.');
        }
    }
}
