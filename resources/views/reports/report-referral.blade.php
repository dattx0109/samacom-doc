@extends('layouts.base')

@section('style-top')
    <style>
        .ibox-content{
            border: none;
            padding: 0 0 0 0;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Công việc chia sẻ</h5>
                </div>
                <div class="ibox-content" style="padding-left: 10px">
                    <h1 class="no-margins">{{$countJobShare}}</h1>
                    <small>Công việc</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lượt apply công việc</h5>
                </div>
                <div class="ibox-content" style="padding-left: 10px">
                    <h1 class="no-margins">{{$countJobApply}}</h1>
                    <small>Lượt</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tài khoản đăng ký mới</h5>
                </div>
                <div class="ibox-content" style="padding-left: 10px">
                    <h1 class="no-margins">{{$countAccountRegisterAll}}</h1>
                    <small>Tài khoản</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tìm kiếm </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="get" action="">
                        <div class="row">
                            <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="share">
                                    <option value="0" {{request()->share == 0 ?'selected':"" }}>Sắp xếp theo lượng chia sẻ</option>
                                    <option value="1" {{request()->share == 1 ?'selected':"" }}>Sắp xếp tăng dần</option>
                                    <option value="2" {{request()->share == 2 ?'selected':"" }}>Sắp xếp giảm dần</option>
                                </select>
                            </div>
                            <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="apply">
                                    <option value="0" {{request()->apply == 0 ?'selected':"" }}>Sắp xếp theo lượng ứng tuyển</option>
                                    <option value="1" {{request()->apply == 1 ?'selected':"" }}>Sắp xếp tăng dần</option>
                                    <option value="2" {{request()->apply == 2 ?'selected':"" }}>Sắp xếp giảm dần</option>
                                </select>
                            </div>
{{--                            <div class="col-sm-2 m-b-xs">--}}
{{--                                <select class="input-sm form-control input-s-sm inline">--}}
{{--                                    <option value="0">Sắp xếp theo lượng đăng ký</option>--}}
{{--                                    <option value="1">Sắp xếp tăng dần</option>--}}
{{--                                    <option value="2">Sắp xếp giảm dần</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                        </div>
                        <div class="row">
    {{--                        <div class="form-group col-sm-2">--}}
    {{--                            <input type="email" placeholder="Nhập số điện thoại" class="form-control">--}}
    {{--                        </div>--}}
                            <div class="form-group col-sm-2">
                                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    @if($errors->has('success'))
                        <p class="text-danger ">
                            {{$errors->first('success')}}
                        </p>
                    @endif
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Điện thoại</th>
                            <th>Chia sẻ</th>
                            <th>Ứng tuyển</th>
                            <th>Đăng ký</th>
                            <th>KPI</th>
                            <th>Hoàn thành</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($listReferral as $item)
                                <tr>
                                    <td>{{$item['name']}}</td>
                                    <td>
                                        <a class="modal-job" href="" data-name="{{$item['name']}}" data-phone="{{$item['phone']}}" data-id="{{$item['id']}}" data-toggle="modal">
                                            {{$item['phone']}}
                                        </a>
                                    </td>
                                    <td>
                                        <label class="label label-info">
                                            {{$item['jobShare']}}
                                        </label>
                                    </td>
                                    <td>
                                        <label class="label label-info">
                                            {{$item['jobApply']}}
                                        </label>
                                    </td>
                                    <td><label class="label label-info">
                                            {{$item['jobRegister']}}
                                        </label></td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalJobForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Danh sách công việc</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h3 id="modal-name">Linh Trần</h3>

                            <p class="small" id="modal-phone">
                                SDT: 0868888336
                            </p>
{{--                            <p class="small">--}}
{{--                                EMAIL: tienvm.saf@gmail.com--}}
{{--                            </p>--}}
                        </div>
                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên công việc</th>
                                    <th>Số lượng apply</th>
                                    <th>Số tài khoản đăng ký</th>
                                </tr>
                                </thead>
                                <tbody id="body-job">
                                <tr><td>1</td><td>Mark</td><td>Otto</td><td>@mdo</td></tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript-bottom')
    <script src="{{asset('js/js-service/report-referral.js')}}"></script>
@endsection
