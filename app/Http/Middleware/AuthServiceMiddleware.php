<?php


namespace App\Http\Middleware;


class AuthServiceMiddleware
{
    public function handle($request, \Closure $next)
    {
        $host = $_SERVER['HTTP_HOST'];

        if($host === 'cv4d.samacom.com.vn' || $host === 'docvikhachhang.samacom.com.vn'){
            return $next($request);
        }

        if ($request->session()->has('user')){
            $request->request->add(['user' => session('user')]);
            return $next($request);
        }
        return redirect('/login');
    }
}
