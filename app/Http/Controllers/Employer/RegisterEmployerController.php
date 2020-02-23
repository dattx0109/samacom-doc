<?php

namespace App\Http\Controllers\Employer;

use App\Http\Requests\RegisterEmployerRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Employer\EmployerService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

class RegisterEmployerController extends Controller
{
    //
    private $registerEmployerService;

    public function __construct(
        EmployerService $registerEmployerService
    )
    {
        $this->registerEmployerService = $registerEmployerService;
    }
    public function getregister()
    {
        return view('employer.registerEmployer');
    }

    public function postRegister(RegisterEmployerRequest $request)
    {
        $rawData = $request->input();
        DB::beginTransaction();
        try {
            $this->registerEmployerService->register($rawData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            $errors = new MessageBag(['errorsPhone' => 'Có lỗi xảy ra, xin vui lòng thử lại sau.']);
            return redirect('/registerEmployer')->withErrors($errors);
        }

        $errors = new MessageBag(['success' => 'Thêm nhà tuyển dụng thành công']);

        return redirect('/listEmployer')->withErrors($errors);
    }

    public function getChangePassword(Request $request)
    {
        $token = $request->get('token');
        return view('employer.change_password');
    }
}
