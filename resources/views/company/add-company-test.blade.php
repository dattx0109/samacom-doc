@extends('layouts.base')
@section('content')
    <div class="add-new-page-container animated fadeInRight">
        <div class="single-info-page dashboard-page">
            <h3 class="dashboard-page-title">Thêm mới công ty</h3>
            <div class="dashboard-page-container">
                <form method="post" id="upload_form"  action="/company/add" class="form-horizontal" enctype="multipart/form-data">
                    <table class="dashboard-frm-table form-table">
                        <thead>
                        <tr>
                            <th scope="row">
                                <h3 class="text-navy">Thông tin cơ bản</h3>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">
                                <label for="name_company">Tên công ty <span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input type="text" class="form-control" name="name_company" id="name_company" value="{{old('name_company')}}">
                                <div class="error_name_company error_create  pull-left"></div>

                            </td>

                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="short_name">Tên rút gọn của công ty</label>
                            </th>
                            <td>
                                <input type="text" class="form-control" name="short_name" id="short_name" value="{{old('short_name')}}">
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="logo">Logo công ty<span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input type="file" class="form-control" name="logo" id="logo" value="{{old('logo')}}">
                                <div class="error_logo error_create  pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="address">Địa chỉ chi tiết công ty<span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input type="text" placeholder="VD: tầng 5 tòa nhà B&B số 60 ngõ 850 đường Láng" class="form-control" name="address" id="address" value="{{old('address')}}">
                                <div class="error_address error_create  pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="workplace">Địa chỉ công ty<span class="text-danger">*</span> </label>
                            </th>
                            <td>
                                <div class="col-lg-6">
                                    <select name="workplace" data-placeholder="Chọn tỉnh thành..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn tỉnh thành</option>
{{--                                        @foreach($provinces as $province)--}}
{{--                                            <option {{ (old("workplace") == $province->id ? "selected":"") }} value="{{$province->id}}">{{$province->name}}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                    <div class="error_workplace error_create pull-left"></div>
                                </div>
                                <div class="col-lg-6">
                                    <select name="district" id="district" data-placeholder="Chọn quận huyện..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn quận huyện</option>
                                    </select>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="company_size">Quy mô công ty<span class="text-danger">*</span> </label>
                            </th>
                            <td>
                                <select class="form-control m-b" name="company_size" id="company_size">
                                    <option value="" >Lưạ chọn </option>
                                    <option  {{ (old("company_size") == 1 ? "selected":"") }} value="1" >Từ 1 -10</option>
                                    <option  {{ (old("company_size") == 2 ? "selected":"") }} value="2" >Từ 10 - 50</option>
                                    <option  {{ (old("company_size") == 3 ? "selected":"") }} value="3" >Từ 50 - 100</option>
                                    <option  {{ (old("company_size") == 4 ? "selected":"") }} value="4" >Từ 100 - 200</option>
                                    <option  {{ (old("company_size") == 5 ? "selected":"") }} value="5" >Từ 200 - 500</option>
                                    <option  {{ (old("company_size") == 6 ? "selected":"") }} value="6" >Từ 500 - 1000</option>
                                    <option  {{ (old("company_size") == 7 ? "selected":"") }} value="7" >Trên 1000</option>
                                </select>
                                <div class="error_company_size error_create pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="sale_size">Quy mô đội sale <span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input placeholder="vd:10" type="text" class="form-control" name="sale_size" id="sale_size" value="{{old('sale_size')}}">
                                <div class="error_sale_size error_create pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="email">Email công ty<span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}">
                                <div class="error_email error_create pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="hotline">Hotline công ty<span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input type="text" class="form-control" name="hotline" id="hotline" value="{{old('hotline')}}" >
                                <div class="error_hotline error_create pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="website">Website công ty<span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input type="text" class="form-control" name="website" id="website" value="{{old('website')}}">
                                <div class="error_website error_create pull-left"></div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <table class="dashboard-frm-table form-table">
                        <thead>
                        <tr>
                            <th scope="row">
                                <h3 class="text-navy">Mô tả</h3>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">
                                <label for="about_us">Giới thiệu về công ty<span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <textarea id="about_us" class="form-control description_name" name="about_us" rows="5">{{old('about_us')}}</textarea>
                                <div class="error_about_us error_create pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="mission">Sứ mệnh của công ty</label>
                            </th>
                            <td>
                                <textarea type="text" rows="6" class="form-control" name="mission" id="mission">{{old('mission')}}
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="vision">Tầm nhìn của công ty</label>
                            </th>
                            <td>
                                <textarea type="text" class="form-control" rows="6" name="vision" id="vision">{{old('vision')}}
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="core_value">Giá trị của công ty</label>
                            </th>
                            <td>
                                <textarea type="text" rows="6" class="form-control" name="core_value" id="core_value">{{old('core_value')}}
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="other">Thông tin khác</label>
                            </th>
                            <td>
                                <textarea type="text" rows="6" class="form-control" name="other" id="other">{{old('other')}}
                                </textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" id="create_company">
                        <i class="fa fa-check"></i>&nbsp;Lưu lại
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript-bottom')
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>--}}
    <script src="{{asset('/js/js-service/add-company.js')}}"></script>

@endsection
