<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller {

    /**
     * Exibe a página para escolha do tipo de usuário
     *
     * @return void
     */
    public function chooseAccount() {

        return view('pages.choose-account');

    }

    /**
     * Retorna todas as cidades do estado especificado
     *
     * @param int $stateId
     * @return void
     */
    public function getCities($stateId) {

        $validator = Validator::make([ "state_id" => $stateId ], [
            "state_id" => "numeric|integer"
        ]);

        if (!$validator->fails()) {

            $state = State::find($stateId);

            if ($state && $state->count()) {

                return $state->cities()->orderBy('name', 'asc')->get();

            }

        }

        return response('Dados inválidos!', Response::HTTP_BAD_REQUEST);

    }

}
