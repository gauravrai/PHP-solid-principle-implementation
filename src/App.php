<?php
namespace App;


use ExportToServer\ExportToServer;
use Essl\Essl;
use RealTime\RealTime;

class App
{
    private $essl;
    private $realTime;
    private $exportToServer;

    public function __construct()
    {
        $this->essl = new Essl();
        $this->realTime = new RealTime();
        $this->exportToServer = new ExportToServer();
    }
    public function exportAndDump()
    {
        $esslData = $this->essl->get();
        echo $this->exportToServer->export($esslData);
        $this->essl->update();
        echo '<br>--------------------<br>';
        $realTimeData = $this->realTime->get();
        echo $this->exportToServer->export($realTimeData);
        $this->realTime->update();
    }
}
