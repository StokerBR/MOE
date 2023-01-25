<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    /**
     * Retorna o menu do usuário
     */
    public function menu() {

        return [
            [ 'name' => 'Home',	'url' => '/', 'icon' => 'mdi mdi-home' ],
            [ 'name' => 'Vagas de Estágio',	'url' => 'vagas', 'icon' => 'mdi mdi-tie' ],
        ];

    }

}
