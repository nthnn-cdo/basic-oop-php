<?php

namespace Components;

use Models\User;
use Shiroyuki\Components\DataTable;

class UserDataTable extends DataTable
{
    public function __construct()
    {
        $this->modelInstance = new User();
    }
}