<?php

namespace Database;

include('includes/config.php');

class oDB extends \Config\oConfig
{
    private $oConnection;

    public function __construct ()
    {
        $this->vSetCredentials();
        $this->vConnect();
    }

    /**
     * Gets the database connection
     * 
     * @return \PDO
     */
    public function oGetConnection ()
    {
        return $this->oConnection;
    }

    /**
     * Start the Database Connection
     * 
     * @return void
     */
    public function vConnect()
    {
        $this->oConnection = new \PDO("mysql:host=" . $this->sGetAttribute('sDBHost') . "; dbname=" . $this->sGetAttribute('sDBName') . "; charset=utf8", $this->sGetAttribute('sUserName'), $this->sGetAttribute('sPassword'));
    }

    /**
     * Close the Database Connection if we explicitly need it.
     * Since all our actions are reloading the page, we dont need to close the connection.
     * 
     * @return void
     */
    public function vCloseConnection()
    {
        $this->oConnection = null;
    }
}
