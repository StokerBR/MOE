<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * Retorna o menu do usuário
     */
    public function menu() {

        return [
            [ 'name' => 'Home',	'url' => '/', 'icon' => 'mdi mdi-home' ],
        ];

    }

}
