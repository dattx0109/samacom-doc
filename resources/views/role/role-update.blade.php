@extends('layouts.base')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="single-info-page dashboard-page">
            <h3 class="dashboard-page-title">Sửa tên vai trò</h3>
            <div class="dashboard-page-container">
                <form action="{{url('/role/update/'.request()->route()->parameters['id'])}}" method="post">
                    <table class="dashboard-frm-table form-table">
                        <tr>
                            <th scope="row">
                                <label for="name">Tên vai trò</label>
                            </th>
                            <td>
                                <input value="{{$role->name}}" name="name" type="text" class="form-control" placeholder="">
                                <span>
                                    @if($errors->has('name'))
                                        <p class="text-danger pull-right">
                                            {{$errors->first('name')}}
                                        </p>
                                    @endif
                                </span>
                            </td>
                        </tr>
                    </table>
                    <div class="dashboard-btn-group">
                        <button class="btn btn-primary"><i class="fa far fa-save"></i> Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript-bottom')
@endsection
