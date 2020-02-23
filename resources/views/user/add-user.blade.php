@extends('layouts.base')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="single-info-page dashboard-page">
            <h3 class="dashboard-page-title">Thêm mới tài khoản</h3>
            <div class="dashboard-page-container">
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible" id="alert-created-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{ Session::get('message') }}
                    </div>
                @endif
                <form action="{{route('store user')}}" method="post" class="form-horizontal">
                    @csrf
                    <table class="dashboard-frm-table form-table">
                        <tr>
                            <th scope="row">
                                <label for="name">Tên người dùng</label>
                            </th>
                            <td>
                                <input value="{{ old('name') }}"  name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nguyễn Văn A">
                                @error('name')
                                <span class="help-block m-b-none alert alert-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="name">Email</label>
                            </th>
                            <td>
                                <input value="{{ old('email') }}" name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="vana@gmail.com">
                                @error('email')
                                <span class="help-block m-b-none alert alert-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="name">Số điện thoại</label>
                            </th>
                            <td>
                                <input value="{{ old('phone') }}" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="0991225777">
                                @error('phone')
                                <span class="help-block m-b-none alert alert-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                    </table>
                    <div class="dashboard-btn-group">
                        <button class="btn btn-white" type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Lưu lại  </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('javascript-bottom')
    <script src="{{asset('js/js-service/add-user-service.js')}}"></script>
@endsection
