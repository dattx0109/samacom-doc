
@extends('layouts.base')

@section('style-top')
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="single-info-page dashboard-page">
            <h3 class="dashboard-page-title">Tạo nhà tuyển dụng</h3>
            <form class="m-t" role="form" action="{{url('/postRegisterEmployer')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" value="{{old('name')}}" name="name" placeholder="Họ và tên" >
                    @if($errors->has('name'))
                        <p class="text-danger">
                            {{$errors->first('name')}}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{old('phone')}}"  name="phone" placeholder="Số điện thoại" >
                    @if($errors->has('phone'))
                        <p class="text-danger ">
                            {{$errors->first('phone')}}
                        </p>
                    @endif
                    @if($errors->has('errorsPhone'))
                        <p class="text-danger ">
                            {{$errors->first('errorsPhone')}}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Email" >
                    @if($errors->has('email'))
                        <p class="text-danger ">
                            {{$errors->first('email')}}
                        </p>
                    @endif
                    @if($errors->has('errorsEmail'))
                        <p class="text-danger ">
                            {{$errors->first('errorsEmail')}}
                        </p>
                    @endif
                </div>
                {{--<div class="form-group">--}}
                    {{--<input type="password" class="form-control" name="password" placeholder="Mật khẩu" >--}}
                    {{--@if($errors->has('password'))--}}
                        {{--<p class="text-danger ">--}}
                            {{--{{$errors->first('password')}}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu" >--}}
                    {{--@if($errors->has('confirm_password'))--}}
                        {{--<p class="text-danger ">--}}
                            {{--{{$errors->first('confirm_password')}}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                {{--<div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>--}}
                {{--</div>--}}
                <button type="submit" class="btn btn-primary block full-width m-b">Tạo</button>
            </form>
        </div>
    </div>
@endsection
@section('javascript-bottom')
    <script src="{{asset('js/js-service/update-job-service.js')}}"></script>
@endsection

