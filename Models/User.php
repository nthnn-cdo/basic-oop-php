<?php

namespace Models;

use Shiroyuki\DB\Model;

class User extends Model
{
    public array $columns = [
        'id',
        'name',
        'email',
        'hobby',
        'height',
        'weight',
        'gender',
    ];
}
