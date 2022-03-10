<?php
namespace Contracts\DbType;

interface DbType
{
    public function __construct($config);
    public function connect();
}