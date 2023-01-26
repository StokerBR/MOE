<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\State;
use App\Rules\CPFCNPJ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {

    /**
     * Exibe a tela de cadastro
     *
     * @return void
     */
    public function index() {

        $data = [
            'states' => State::orderBy('name', 'asc')->get()
        ];

        return view('company.auth.register', $data);

    }

    /**
     * Realiza o cadastro da empresa no sistema
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'fantasy_name' => 'required|string|max:100',
            'social_reason' => 'required|string|max:100',
            'cnpj' => ['required', 'string', new CPFCNPJ()],
            'state_id' => 'required|integer|exists:states,id',
            'city_id' => 'required|integer|exists:cities,id',
            'additional_info' => 'nullable|string|max:500',
            'email' => 'required|email|max:100|unique:companies,email',
            'password' => 'required|confirmed|min:6|max:60',
        ]);

        $validator->after(function($validator) use ($request) {

            if ($request->state_id && $request->city_id) {

                $city = City::find($request->city_id);

                if ($city && $city->state_id != $request->state_id) {
                    $validator->errors()->add('city_id', 'A cidade especificada não pertence ao estado especificado');
                }

            }

        });

        if (!$validator->fails()) {

            $company = new Company();

            $company->fantasy_name = $request->fantasy_name;
            $company->social_reason = $request->social_reason;
            $company->cnpj = $request->cnpj;
            $company->state_id = $request->state_id;
            $company->city_id = $request->city_id;
            $company->additional_info = $request->additional_info;
            $company->email = $request->email;
            $company->password = Hash::make($request->password);

            $company->save();

            Auth::guard('company')->login($company);
            return companyRedirect('/')->withSuccess('Cadastro realizado com sucesso!');

        } else {
            return back()->withErrors($validator->errors()->first())->withInput();
        }

    }

}
