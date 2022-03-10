<?php
namespace Essl;

use Contracts\Db\Db;
use DbConnector\DbConnector;

class Essl extends DbConnector implements Db
{
    private $dbInstance;
    private $table;
    private $recordIds;

    public function __construct($config = [])
    {
        parent::__construct($this->configMySql());
        $this->dbInstance = $this->connect();
        $this->table = 'devicelogs_' . (int)date('m') . '_' . date('Y');
    }
    public function get()
    {
        $fetchedData = $this->find();
        
        return $this->format($fetchedData);
    }
    public function update()
    {
        if(is_array($this->recordIds) && count($this->recordIds)){			
            $this->dbInstance
                    ->query("update " . $this->table . " set isMoved=1 where DeviceLogId in (".implode(",", $this->recordIds).")");
        }
    }
    private function find()
    {
        return $this->dbInstance
                    ->query("SELECT * FROM " . $this->table . " where isMoved=0 order by LogDate asc")
                    ->fetchAll();
    }
    private function format($fetchedData)
    {
        $array = [];
        foreach($fetchedData as $d){
            $array[] = [
                'PunchDatetime' => $d['LogDate'],
                'CardNo' => $d['UserId'],
            ];
            $this->recordIds[] = $d['DeviceLogId'];
        }
        return $array;
    }
    
    private function configSql()
    {
        return [
            'connectionString' => 'sqlsrv:Server=WIN-4F7E91U0HM1\SQLEXPRESS;Database=essl',
            'user' => 'essl',
            'password' => 'essl'
        ];
    }
    private function configMySql()
    {
        return [
            'connectionString' => "mysql:host=localhost;dbname=biometric_essl",
            'user' => 'root',
            'password' => ''
        ];
    }
}