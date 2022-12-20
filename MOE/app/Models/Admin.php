<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Retorna o menu do usuário
     */
    public function menu() {

        return [
            [ 'name' => 'Home',	'url' => '/', 'icon' => 'mdi mdi-home' ],
        ];

    }

}
