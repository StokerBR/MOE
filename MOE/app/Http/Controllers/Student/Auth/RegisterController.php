<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\State;
use App\Models\Student;
use App\Models\University;
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
            'universities' => University::orderBy('name', 'asc')->get(),
            'states' => State::orderBy('name', 'asc')->get(),
        ];

        return view('student.auth.register', $data);

    }

    /**
     * Realiza o cadastro do universitário no sistema
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'university_id' => 'required|integer|exists:universities,id',
            'registration' => 'required|string|max:100',
            'course_id' => 'required|integer|exists:universities,id',
            'course_completion' => 'nullable|integer|min:0|max:100',
            'state_id' => 'required|integer|exists:states,id',
            'city_id' => 'required|integer|exists:cities,id',
            'bio' => 'nullable|string|max:500',
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

            return back()->withSuccess('teste');

            $student = new Student();

            $student->save();

            Auth::guard('student')->login($student);
            return studentRedirect('/')->withSuccess('Cadastro realizado com sucesso!');

        } else {
            return back()->withErrors($validator->errors()->first())->withInput();
        }

    }

}
