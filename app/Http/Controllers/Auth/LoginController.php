<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        log::debug('app/Http/Controllers/Auth/LoginController.php login');
        $this->validateLogin($request);
        log::debug('app/Http/Controllers/Auth/LoginController.php paso validateLogin');

        if ($this->attemptLogin($request)) {
            log::debug('app/Http/Controllers/Auth/LoginController.php entro en if attemptLogin ');
            $user = $this->guard('api')->user();
            if ($user->activo!=1) {
                  $this->logout($request);
                  \Request::session()->invalidate();
                  return response()->json([ 'errors' => ['email' => 'El usuario aún no esta autorizado' ]],445);
            }
            $user->generateToken();
            $user->save();
            log::debug('app/Http/Controllers/Auth/LoginController.php '.$user->id.' Activo='.$user->activo);
            $request->session()->regenerate();
            return response()->json([
                'data' => $user->toArray(),
                'menus' => DB::select( DB::raw(
                                               'select descripcion,coalesce(componente,\'\') componente,pm.mdefault, m.id from menus m
                                                ,perfiles_menus pm
                                                ,perfiles_users pu
                                                ,users u
                                                where m.id=pm.idmenu
                                                and   pu.idusuario=u.id
                                                and   pu.idperfil=pm.idperfil
                                                and   u.id=:iduser'
                                              ),array('iduser' => $user->id)),
                'perfiles' => DB::select( DB::raw(
                                               'select descripcion from perfiles per 
                                                ,perfiles_users pu
                                                where pu.idusuario=:iduser
                                                and   pu.idperfil=per.id'
                                              ),array('iduser' => $user->id))
            ]);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        log::debug('app/Http/Controllers/Auth/LoginController.php entro en logout');
        $user = Auth::guard('api')->user();

        if ($user) {
            log::debug('app/Http/Controllers/Auth/LoginController.php entro en logout');
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['data' => 'User logged out.'], 200);
    }
/*
    protected function guard()
    {
        return Auth::guard('api');
    }
*/

}
