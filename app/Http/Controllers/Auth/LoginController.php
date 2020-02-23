<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Service\Account\AccountService;
use App\Service\AuthorizationService\LoginService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    private $loginService;
    private $accountService;
    public function __construct(LoginService $loginService, AccountService $accountService)
    {
        $this->loginService = $loginService;
        $this->accountService = $accountService;
    }

    public function getLogin()
    {
        session()->forget('user');
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $rawData        = $request->all();
        $userAfterLogin = $this->loginService->findUserByEmail($rawData['email']);
        if (! $userAfterLogin) {
            $errors = new MessageBag(['accountNotFound' => 'Tài khoản không tồn tại']);
            return back()->withInput($rawData)->withErrors($errors);
        }

        $isLoginSuccess = Hash::check($request['password'], $userAfterLogin->password);
        if (!$isLoginSuccess) {
            $errors = new MessageBag(['messageErrorPassword' => 'Mật khẩu của bạn không đúng']);
            return back()->withInput($rawData)->withErrors($errors);
        }
//        $this->accountService->logFistLoginAccountBackup($rawData['email']);
        $this->storeUserToSessionServer($userAfterLogin);
        return redirect('/user');
    }

    public function storeUserToSessionServer($user)
    {
        session()->put('user', $user);
    }
}
