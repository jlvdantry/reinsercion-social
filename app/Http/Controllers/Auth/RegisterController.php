<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Perfiles_users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\str;
use Illuminate\Support\Facades\Log;
use Mail;
use App\Mail\UserRegistrado;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registro-exitoso';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    protected function registered(Request $request, $user)
    {
      log::debug('RegisterController.php registered empezo');
      $user->generateToken();
      Mail::to($user->email)->send(new UserRegistrado($user->getconCatalogosbyID($user->id)));
      log::debug('RegisterController.php registered paso envio email'.print_r($user->toArray(),true));
      return response()->json(['data' => $user->toArray()], 200);
      log::debug('RegisterController.php registered despues de response');
      //return redirect('/registro-exitoso');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres'  => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'rfc'      => ['required', 'string', 'rfc', 'max:13',   'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nombres' => $data['nombres'],
            'ape_pat' => $data['ape_pat'],
            'ape_mat' => $data['ape_mat'],
            'rfc' => $data['rfc'],
            'calle' => $data['calle'],
            'email' => $data['email'],
            'sgirpc' => $data['sgirpc'],
            'vigencia' => $data['vigencia'],
            'stps' => $data['stps'],
            'exterior' => $data['exterior'],
            'interior' => $data['interior'],
            'colonia' => $data['colonia'],
            'id_alcaldia' => $data['id_alcaldia'],
            'cp' => $data['cp'],
            'num_telefono' => $data['num_telefono'],
            'tipopersona' => $data['tipopersona'],
            'password' => Hash::make($data['password']),
            'cb' => $data['cb'],
            'epmr' => $data['epmr'],
            'erv' => $data['erv'],
            'rpar' => $data['rpar']

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create_usuario(array $data)
    {
        return User::create([
            'nombres' => $data['nombres'],
            'ape_pat' => $data['ape_pat'],
            'ape_mat' => $data['ape_mat'],
            'email' => $data['email'],
            'puesto' => $data['puesto'],
            'num_telefono' => $data['num_telefono'],
            'activo' => $data['activo'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function register(Request $request)
    {
        log::debug('RegisterController.php register');
        $this->validator($request->all())->validate();
        log::debug('RegisterController.php paso validator');
        log::debug($request['rfc']);

        if (!$request->has('idperfil')) {
                return response()->json(['errors' => ['idperfil' => 'No se ha seleccionado un perfil al usuario']], 401);
        }
/*
        if ($request->has('num_telefono')) {
            $dato=User::where('num_telefono','=',$request['num_telefono']);
            if ($dato->count()>0) {
                log::debug('Auth/RegisterController.php entro en if');
                return response()->json(['errors' => ['num_telefono' => 'el número telefonico ya esta registrado']], 401);
            }
        }
*/

        log::debug('entro RegisterController.php paso guard');
        if ($request->has('tercero')) {
            event(new Registered($user = $this->create($request->all())));
            $this->guard()->login($user);
            //$pe = new Perfiles_users ( [ "idusuario" => $user->id, "idperfil" => "2" ] ); // da de alta el perfil de 3er acreditado
            //$pe->save();
        }
        if ($request->has('usuario')) {
            //event(new Registered($user = $this->create_usuario($request->all())));
            //$this->guard()->login($user);
            $user = $this->create_usuario($request->all());
            $pe = new Perfiles_users ( [ "idusuario" => $user->id, "idperfil" => $request['idperfil']] );
            $pe->save();
            Mail::to($user->email)->send(new UserRegistrado($user->getconCatalogosbyID($user->id)));
        }
        return response()->json(['data' => $user->toArray()], 200);
        //$this->registered($request, $user);
        //$this->guard()->logout($user);
        //return $request->has('tercero') ? $this->registered($request, $user) ? : redirect($this->redirectPath()) : redirect($this->redirectPath());
    }

/*
    protected function guard()
    {
         return Auth::guard('pc');
    }
*/

}
