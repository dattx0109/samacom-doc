@extends('layouts.base')
@section('style-top')
    <style>
        .info-customer-product{
            margin-bottom: 15px;
            display:none;
        }
        .select-package{
            margin-bottom: 15px;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title margin-ibox-title">
                    <div class="headerbox-add-box">
                        <h3>Nhà tuyển dụng</h3>
                        <div class="ibox-tools">
                            <div class="ibox-tools">
                                    <button type="button" class="btn btn-primary ibox-tool-add-new" data-toggle="modal" href="#modal-add-package">
                                        <i class="fa fa-plus"></i>Thêm mới
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-content no-padding">
                    @if($errors->has('success'))
                        <p class="text-danger ">
                            {{$errors->first('success')}}
                        </p>
                    @endif
                    <div class="table-resonpsive">
                        <table class="table table-striped checkbox-table boxshadow-table" >
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone </th>
                                <th>Số lượt mở liên hệ/Tổng số lượt mở liên hệ</th>
                                <th>Ngày hết hạn mở liên hệ</th>
                                <th>Số lượng đăng tin/Tổng số lượng đăng tin</th>
                                <th>Ngày hết hạn đăng tin</th>
                                <th>Ngày kích hoạt</th>
                            </tr>
                            </thead>
                            <tbody id="table-list">
                            @foreach($listEmployerActive as $listEmployer)
                                <tr>
                                    <td>{{$listEmployer->name}}</td>
                                    <td>{{$listEmployer->phone}} </td>
                                    <td>{{$listEmployer->count_use_view}}/{{$listEmployer->count_view_contact_profile}}</td>
                                    <td>{{$listEmployer->view_expired_at}}</td>
                                    <td>{{$listEmployer->count_use_post}}/{{$listEmployer->count_post}}</td>
                                    <td>{{$listEmployer->post_expired_at}}</td>
                                    <td>{{$listEmployer->updated_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $listEmployerActive->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--modal-->
    <div id="modal-add-package" class="modal fade modal-no-padding" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup-frm-container">
                        <h2 class="m-t-none m-b">Kích hoạt dịch vụ</h2>
{{--                            <div class="col-sm-12" style="margin-bottom: 15px">--}}
                            <div class="form-group">
                                <label>Nhà tuyển dụng<span class="text-danger">(*)</span> </label>
                                <select id="employer" name="employer" data-placeholder="Chọn chức vụ ..." class="chosen-select"  tabindex="2">
                                    <option value="">Nhà tuyển dụng</option>
                                    @foreach($listEmployers as $employers)
                                        <option  value="{{$employers->id}}">{{$employers->phone}}-{{$employers->name}}</option>
                                    @endforeach
                                </select>
                                <div class="error-add-buy-product error_employer"></div>
                            </div>
{{--                            </div>--}}
{{--                            <br>--}}
                                <div class="col-sm-12" style="">
                                    <div class="form-group">
                                            <input type="radio" name="package_type" value="1" checked> Chọn theo gói
                                        &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="package_type" value="2"> Tùy chọn
                                    <div class="error-add-buy-product error_package_type"></div>
                                    </div>
                                </div>
{{--                            <div class="col-sm-12 select-package" >--}}
                                <div class="form-group">
                                    <label>Danh sách gói dịch vụ<span class="text-danger">(*)</span> </label>
                                    <select id="package" name="package" data-placeholder="Chọn chức vụ ..." class="chosen-select"  tabindex="2">
                                        <option value="">Danh sách gói dịch vụ</option>
                                        @foreach($listPackages as $listPackage)
                                            <option  value="{{$listPackage->id}}">{{$listPackage->name}}</option>
                                        @endforeach

                                    </select>
                                    <div class="error-add-buy-product error_package"></div>
                                </div>
                                    <div class="form-group">
                                        <label>Số lượng<span class="text-danger">(*)</span></label>
                                        <input type="text" placeholder="số lượng" class="form-control" name="count"
                                               id="count">
                                        <div class="error-add-buy-product error_count"></div>
                                    </div>

{{--                            </div>--}}
                            <div class="info-customer-product" >
                                <div class="form-group">
                                    <label>Số lượt mở liên hệ</label>
                                    <input type="text" placeholder="" class="form-control" name="count_view"
                                           id="count_view">
                                    <div class="error-add-buy-product error_count_view"></div>
                                </div>
                                <div class="form-group">
                                    <label>Số ngày mở liên hệ</label>
                                    <input type="text" placeholder="" class="form-control" name="count_day_view"
                                           id="count_day_view">
                                    <div class="error-add-buy-product error_count_day_view"></div>
                                </div>
                                <div class="form-group">
                                    <label>Số lượt đăng bài</label>
                                    <input type="text" placeholder="" class="form-control" name="count_employment_post"
                                           id="count_employment_post">
                                    <div class="error-add-buy-product error_count_employment_post"></div>
                                </div>
                                <div class="form-group">
                                    <label>Số ngày đăng bài</label>
                                    <input type="text" placeholder="" class="form-control" name="count_day_employment_post"
                                           id="count_day_employment_post">
                                    <div class="error-add-buy-product error_count_day_employment_post"></div>
                                </div>
                            </div>

                            <div class="popup-frm-btn-container">
                                <button class="btn btn-sm btn-primary" id="btn-store-product"><strong>Lưu lại</strong></button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript-bottom')
    <script src="{{asset('js/js-service/add-package-and-active-employer-v2.js')}}"></script>
    <script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endsection
