
@extends('layouts.base')

@section('style-top')
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="single-info-page dashboard-page">
            <h3 class="dashboard-page-title">Gửi mail cho nhà tuyển dụng</h3>
            @if(isset($message))
            <div class="alert alert-success" role="alert">
                    {{$message}}
            </div>
            @endif
            @if(isset($messageFail))
                <div class="alert alert-danger" role="alert">
                    {{$messageFail}}
                </div>
            @endif
            <form class="m-t" role="form" action="/listEmployer/resend-mail-reset-pass" method="post">
                @csrf
                <div class="form-group">
                    <select name="employer_id" data-placeholder="Chọn nhà tuyển dụng ..." class="chosen-select"  tabindex="2">
                        <option value="">Chọn nhà tuyển dụng </option>
                        @if(isset($listEmployer))
                        @foreach($listEmployer as $list)
                            <option value="{{$list->id}}">
                                {{$list->name}}
                                {{$list->email}}
                            </option>
                        @endforeach
                            @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Gửi</button>
            </form>
        </div>
    </div>
@endsection
@section('javascript-bottom')
    <script src="{{asset('js/js-service/update-job-service.js')}}"></script>
@endsection

