<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * @var UserService
     */
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->userService = $userService;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Obtain the user information from GitHub.
     *
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $user = $this->userService->updateOrCreateWithFacebook($user);

        Auth::loginUsingId($user->id);

        return redirect()->to('/home');
    }
}
