<?php
namespace RealTime;

use Contracts\Db\Db;
use DbConnector\DbConnector;

class RealTime extends DbConnector implements Db
{
    private $dbInstance;
    private $recordIds;

    public function __construct($config = [])
    {
        parent::__construct($this->configMySql());
        $this->dbInstance = $this->connect();
    }
    public function get()
    {
        $fetchedData = $this->find();
        return $this->format($fetchedData);
    }

    public function find()
    {
        return $this->dbInstance
                    ->query("SELECT * FROM tran_machinerawpunch where isMoved=0 order by PunchDatetime asc")
                    ->fetchAll();
    }
    public function update()
    {
        if(is_array($this->recordIds) && count($this->recordIds)){
            $this->dbInstance
                    ->query("update tran_machinerawpunch set isMoved=1 where Tran_MachineRawPunchId in (".implode(",", $this->recordIds).")");
        }
    }
    private function format($fetchedData)
    {
        foreach($fetchedData as $d){
            $this->recordIds[] = $d['Tran_MachineRawPunchId'];
        }
        return $fetchedData;
    }
    private function configSql()
    {
        return [
            'connectionString' => 'sqlsrv:Server=WIN-4F7E91U0HM1\SQLEXPRESS;Database=realtime',
            'user' => 'essl',
            'password' => 'essl'
        ];
    }
    private function configMySql()
    {
        return [
            'connectionString' => "mysql:host=localhost;dbname=biometric_realtime",
            'user' => 'root',
            'password' => ''
        ];
    }
}