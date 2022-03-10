<?php
namespace Contracts\Db;

interface Db
{
    public function __construct();

    public function get();
}