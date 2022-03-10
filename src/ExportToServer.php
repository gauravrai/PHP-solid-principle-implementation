<?php
namespace ExportToServer;

use Traits\CurlTrait\CurlTrait;

class ExportToServer
{
    use CurlTrait;

    public function export($records)
    {
        return $this->post($records);
    }
}