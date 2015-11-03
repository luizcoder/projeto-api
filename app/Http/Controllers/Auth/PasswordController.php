<?php

namespace app\Http\Controllers\Auth;

use app\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use app\Http\Requests;
use Password;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    protected $subject = "Recuperação de Senha";

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
    * Send a reset link to the given user.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        view()->composer('emails.auth.password', function($view) use ($request) {
            $view->with([
                'callBackUrl'   => $request->input('callBackUrl'),
            ]);
        });

        $response = Password::sendResetLink($request->only('email'), function ($message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
            return response()->json(['result'=>true]);

            case Password::INVALID_USER:
            return response()->json(['result'=>false]);
        }
    }



     /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return response()->json(['result'=>true]);

            default:
                return response()->json(['result'=>false]);

        }
    }
}
