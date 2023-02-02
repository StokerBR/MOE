<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller {

    /**
     * Exibe a página inicial do painel de empresa
     *
     * @return void
     */
    public function home() {
        return view('company.home');
    }

    /**
     * Exibe a página de perfil da empresa
     *
     * @return void
     */
    public function profile() {

        $data = [
            'company' => Auth::guard('company')->user(),
            'states' => State::orderBy('name', 'asc')->get()
        ];

        return view('company.auth.profile', $data);

    }

    /**
     * Atualiza os dados da empresa
     *
     * @param Request $request
     * @return void
     */
    public function updateProfile(Request $request) {

        $company = Auth::guard('company')->user();

        $validator = Validator::make($request->all(), [
            'fantasy_name' => 'required|string|max:100',
            'social_reason' => 'required|string|max:100',
            'state_id' => 'required|integer|exists:states,id',
            'city_id' => 'required|integer|exists:cities,id',
            'additional_info' => 'nullable|string|max:500',
            'email' => 'required|email|max:100|unique:companies,email,'.$company->id,
        ]);

        $validator->sometimes('password', 'required|confirmed|min:6|max:60', function() use ($request) {
            return $request->change_password || $request->password;
        });

        if (!$validator->fails()) {

            $company->fantasy_name = $request->fantasy_name;
            $company->social_reason = $request->social_reason;
            $company->state_id = $request->state_id;
            $company->city_id = $request->city_id;
            $company->additional_info = $request->additional_info;
            $company->email = $request->email;

            if ($request->change_password || $request->password) {
                $company->password = Hash::make($request->password);
            }

            $company->save();

            return companyRedirect('/')->withSuccess('Perfil atualizado com sucesso!');

        } else {
            return back()->withErrors($validator->errors()->first())->withInput();
        }

    }

}
