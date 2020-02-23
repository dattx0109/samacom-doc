@extends('layouts.base')
@section('style-top')
    <style>
        .hr-end-benefit {
            border: solid 1px rgba(126, 134, 140, 0.68);
        }
    </style>
@endsection
@section('content')
    <div class="add-new-page-container animated fadeInRight">
        @if(session('message'))
            <div class="alert alert-success" role="alert">
                {{session('message')}}
            </div>
        @endif
        <div class="single-info-page dashboard-page">
            <h3 class="dashboard-page-title">Chỉnh sửa công ty {{$detailCompany['name_company']}}</h3>
            <div class="dashboard-page-container">
                <form  method="post" enctype="multipart/form-data" action="{{route('edit-company',$detailCompany['id_company'])}}" class="form-horizontal" id="edit-company">
                    <input type="hidden" class="form-control" name="company_description_id"
                           value="{{$detailCompany['company_description_id']}}">
                    <input type="hidden" class="form-control" name="company_id" value="{{$detailCompany['id_company']}}">

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
                                <input autocomplete="off" type="text" class="form-control" name="name_company"
                                       value="{{old('name_company', isset($detailCompany['name_company'])?$detailCompany['name_company']:'')}}" id="name_company">
                                <div class="error_name_company error_update  pull-left"></div>
                            </td>

                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="short_name">Tên rút gọn của công ty</label>
                            </th>
                            <td>
                                <input type="text" class="form-control" name="short_name" value="{{old('short_name', isset($detailCompany['short_name'])?$detailCompany['short_name']:'')}}" id="short_name">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="logo">Logo công ty <span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input type="file" class="form-control" name="logo" id="logo">
                                <img src="{{$detailCompany['logo']}}" alt="" style="width: 100px;height: auto" class="pull-right">
                                <div class="error_logo error_update  pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="address">Địa chỉ chi tiết công ty <span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input type="text" class="form-control" name="address"
                                       value="{{old('address', isset($detailCompany['address'])?$detailCompany['address']:'')}}" id="address">
                                <div class="error_address error_update  pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="workplace">Địa chỉ công ty <span class="text-danger">*</span> </label>
                            </th>

                            <td>
                                <div class="col-lg-6">
                                    <select name="workplace" data-placeholder="Chọn tỉnh thành..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn tỉnh thành</option>
                                        @foreach($provinces as $province)
                                            <option {{old('workplace')? (old('workplace')==$province->id?'selected':''): (!empty($detailCompany)?$detailCompany['workplace']==$province->id?'selected':'':'')}} value="{{$province->id}}">{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="error_workplace error_update pull-left"></div>
                                </div>
                                <div class="col-lg-6">
                                    <select name="district" id="district" data-placeholder="Chọn quận huyện..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn quận huyện</option>
                                        @foreach($districts as $district)
                                            <option  {{old('district')? (old('district')==$province->id?'selected':''): (!empty($detailCompany)?$detailCompany['district']==$province->id?'selected':'':'')}}   value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </td>

                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="company_size">Quy mô công ty <span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <select class="form-control m-b" name="company_size" id="company_size" >
{{--                                    <option value="" >Lưạ chọn </option>--}}
                                    <option {{old('company_size')? (old('company_size')==1?'selected':''): (!empty($detailCompany)?$detailCompany['company_size']==1?'selected':'':'')}} value="1" >Từ 1 -10</option>
                                    <option {{old('company_size')? (old('company_size')==2?'selected':''): (!empty($detailCompany)?$detailCompany['company_size']==2?'selected':'':'')}}  value="2" >Từ 10 - 50</option>
                                    <option {{old('company_size')? (old('company_size')==3?'selected':''): (!empty($detailCompany)?$detailCompany['company_size']==3?'selected':'':'')}}  value="3" >Từ 50 - 100</option>
                                    <option {{old('company_size')? (old('company_size')==4?'selected':''): (!empty($detailCompany)?$detailCompany['company_size']==4?'selected':'':'')}}  value="4" >Từ 100 - 200</option>
                                    <option {{old('company_size')? (old('company_size')==5?'selected':''): (!empty($detailCompany)?$detailCompany['company_size']==5?'selected':'':'')}}  value="5" >Từ 200 - 500</option>
                                    <option {{old('company_size')? (old('company_size')==6?'selected':''): (!empty($detailCompany)?$detailCompany['company_size']==6?'selected':'':'')}}  value="6" >Từ 500 - 1000</option>
                                    <option {{old('company_size')? (old('company_size')==7?'selected':''): (!empty($detailCompany)?$detailCompany['company_size']==7?'selected':'':'')}}  value="7" >Trên 1000</option>
                                </select>
                                <div class="error_company_size error_update pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="sale_size">Quy mô đội sale </label>
                            </th>
                            <td>
                                <input placeholder="vd:10" type="text" class="form-control" name="sale_size" value="{{old('sale_size', isset($detailCompany['sale_size'])?$detailCompany['sale_size']:'')}}"  id="sale_size">
                                <div class="error_sale_size error_update pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="email">Email công ty <span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input type="text" class="form-control" name="email" value="{{old('email', isset($detailCompany['email'])?$detailCompany['email']:'')}}" id="email">
                                <div class="error_email error_update pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="hotline">Hotline công ty <span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input type="text" class="form-control" name="hotline"
                                       value="{{old('hotline', isset($detailCompany['hotline'])?$detailCompany['hotline']:'')}}" id="hotline">
                                <div class="error_hotline error_update pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="website">Website công ty <span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <input type="text" class="form-control" name="website" value="{{old('website', isset($detailCompany['website'])?$detailCompany['website']:'')}}" id="website">
                                <div class="error_website error_update pull-left"></div>
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
                                <label for="about_us">Giới thiệu về công ty <span class="text-danger">*</span></label>
                            </th>
                            <td>
                                <textarea type="text"  class="form-control" rows="10" name="about_us" id="about_us">
                                    {!! old('about_us', isset($detailCompany['about_us'])?$detailCompany['about_us']:'')!!}
                                </textarea>
                                <div class="error_about_us error_update pull-left"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="mission">Sứ mệnh của công ty</label>
                            </th>
                            <td>
                                <textarea type="text" rows="10" class="form-control" name="mission" id="mission">
                                    {!! old('mission', isset($detailCompany['mission'])?$detailCompany['mission']:'')!!}
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="vision">Tầm nhìn của công ty</label>
                            </th>
                            <td>

                                <textarea  type="text" rows="10" class="form-control" name="vision" id="vision">
                                    {!! old('vision', isset($detailCompany['vision'])?$detailCompany['vision']:'')!!}
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="core_value">Giá trị của công ty</label>
                            </th>
                            <td>
                                <textarea type="text"  rows="10" class="form-control" name="core_value" id="core_value">
                                    {!! old('core_value', isset($detailCompany['core_value'])?$detailCompany['core_value']:'')!!}
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="other">Thông tin khác</label>
                            </th>
                            <td>
                                <textarea type="text" rows="10" class="form-control" name="other" id="other">
                                    {!! old('other', isset($detailCompany['other'])?$detailCompany['other']:'')!!}
                                </textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" id="update-company" >
                        <i class="fa fa-check"></i>&nbsp;Cập nhật
                    </button>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('javascript-bottom')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
    <script src="{{asset('js/plugins/bootstrap-markdown/bootstrap-markdown.js')}}"></script>
    <script src="{{asset('js/plugins/bootstrap-markdown/markdown.js')}}"></script>
    <script src="{{asset('/js/js-service/edit-company-service.js')}}"></script>

@endsection
