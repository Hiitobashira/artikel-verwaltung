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
}
