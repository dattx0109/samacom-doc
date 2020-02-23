@extends('layouts.base')
@section('content')
    <div class="add-new-page-container animated fadeInRight">
        <div class="single-info-page dashboard-page">
            <h3 class="dashboard-page-title">Công ty {{$detailCompany['name_company']}}</h3>
            <div class="dashboard-page-container">
                <div class="" >
                    <a style="font-size: 13px" class="text text-info" href="{{route('company-index')}}"> <i class="fa fa-angle-double-left"></i> <smail>Trở về trang danh sách công ty</smail></a>
                </div>
                <br>
                <a href="{{url('/list/company/'.request()->route()->parameters['id'])}}" class="">
                    <button type="button" class="btn btn-primary ibox-tool-add-new">
                        <span class="glyphicon glyphicon-edit"></span>
                        sửa thông tin công ty
                    </button>
                </a>
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
                            <label for="name_company">Tên công ty: </label>
                        </th>
                        <td>
                            {{$detailCompany['name_company']}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="name_company">Tên viết tắt công ty: </label>
                        </th>
                        <td>
                            {{$detailCompany['short_name']}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="logo">Logo công ty: </label>
                        </th>
                        <td>
                            <img src="{{$detailCompany['logo']}}" class="upload-img" alt="">
{{--                            {{isset($detailCompany['logo']) ? ' ' : 'Không có dữ liệu'}}--}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="address">Địa chỉ chi tiết công ty:</label>
                        </th>
                        <td>
                            {{isset($detailCompany['address'])? $detailCompany['address'] : 'Không có dữ liệu'}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="address">Địa chỉ công ty:</label>
                        </th>
                        <td>

                            @foreach($provinces as $province)
                              {{ ($detailCompany['workplace'] == $province->id ? $province->name:"") }}
                            @endforeach
                                -
                            @foreach($districts as $district)
                                {{ ($detailCompany['district'] == $district->id ? $district->name:"") }}
                            @endforeach
{{--                            {{isset($detailCompany['address'])?$job->district_name.'-':''}}--}}
{{--                            {{isset($job->province_name)?$job->province_name:'Không có dữ liệu'}}--}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="size_min">Quy mô công ty:</label>
                        </th>
                        <td>
                            @if($detailCompany['company_size'] == 1)
                                Từ 1 -10
                                @elseif($detailCompany['company_size'] == 2)
                                Từ 10 - 50
                                @elseif($detailCompany['company_size'] == 3)
                                Từ 50 - 100
                                @elseif($detailCompany['company_size'] == 4)
                                Từ 100 - 200
                                @elseif($detailCompany['company_size'] == 5)
                                Từ 200 - 500
                                @elseif($detailCompany['company_size'] == 6)
                                Từ 500 - 1000
                                @elseif($detailCompany['company_size'] == 7)
                                Trên 1000
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="">Quy mô đội sale: </label>
                        </th>
                        <td>
                            {{isset($detailCompany['sale_size'])? $detailCompany['sale_size'] : 'Không có dữ liệu'}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="email">Email công ty:</label>
                        </th>
                        <td>
                            {{isset($detailCompany['email'])? $detailCompany['email'] : 'Không có dữ liệu'}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="hotline">Hotline công ty:</label>
                        </th>
                        <td>
                            {{isset($detailCompany['hotline'])? $detailCompany['hotline'] : 'Không có dữ liệu'}}
                        </td>
                    </tr>
                        <tr>
                            <th scope="row">
                                <label for="website">Website công ty:</label>
                            </th>
                            <td>
                                {{isset($detailCompany['website'])? $detailCompany['website'] : 'Không có dữ liệu'}}
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
                            <label for="about_us">Giới thiệu về công ty:</label>
                        </th>
                        <td>
                            {!! isset($detailCompany['about_us'])? $detailCompany['about_us'] : 'Không có dữ liệu' !!}
                        </td>
                    </tr>
                        <tr>
                            <th scope="row">
                                <label for="mission">Sứ mệnh của công ty:</label>
                            </th>
                            <td>
                                {!! isset($detailCompany['mission'])? $detailCompany['mission'] : 'Không có dữ liệu' !!}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="vision">Tầm nhìn của công ty:</label>
                            </th>
                            <td>
                                {!! isset($detailCompany['vision'])? $detailCompany['vision'] : 'Không có dữ liệu' !!}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="core_value">Giá trị của công ty:</label>
                            </th>
                            <td>
                                {!! isset($detailCompany['core_value'])? $detailCompany['core_value'] : 'Không có dữ liệu'  !!}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="other">Thông tin khác:</label>
                            </th>
                            <td>
                                {!!isset($detailCompany['other'])? $detailCompany['other'] : 'Không có dữ liệu'  !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
{{--                    <table class="dashboard-frm-table form-table">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th scope="row">--}}
{{--                                <h3 class="text-navy">Quyền lợi / Chế độ đãi ngộ</h3>--}}
{{--                            </th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                    </table>--}}
{{--                @foreach($detailCompany['benefit'] as $item)--}}
{{--                        <table class="dashboard-frm-table form-table">--}}
{{--                            <tr>--}}
{{--                                <th scope="row">--}}
{{--                                    <label for="name_benefit[]">Tên phúc lợi:</label>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    {{isset($item['name'])? $item['name'] : 'Không có dữ liệu'}}--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th scope="row">--}}
{{--                                    <label for="icon[]">Icon phúc lợi:</label>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    {{isset($item['icon'])? $item['icon'] : 'Không có dữ liệu'}}--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th scope="row">--}}
{{--                                    <label for="description[]">Mô tả về phúc lợi:</label>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    {!!  isset($item['description'])? $item['description'] : 'Không có dữ liệu' !!}--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        </table>--}}
{{--                    <hr>--}}
{{--                @endforeach--}}

            </div>
        </div>
    </div>

@endsection
@section('javascript-bottom')
    <script>
        $(document).ready(function(){
            $('.chosen-select').chosen({width: "100%"});
            $( "td:contains('Không có dữ liệu')" ).addClass('null-info-block');
        });
        $('.btn-store').on('click', function (){
            $('#create-job').submit();
        })
    </script>
    <script src="{{asset('/js/js-service/edit-company-service.js')}}"></script>
@endsection
