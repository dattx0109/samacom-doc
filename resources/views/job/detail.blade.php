@extends('layouts.base')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="single-info-page dashboard-page">
            <h3 class="dashboard-page-title">{{isset($job->title)?$job->title:'Chi tiết công việc'}}</h3>
            <div class="" >
                <a style="font-size: 13px" class="text text-info" href="{{route('list-job')}}">
                    <i class="fa fa-angle-double-left"></i>
                    <smail>Trở về trang danh sách công việc</smail>
                </a>
            </div>
            <br>
            <a href="{{url('/job/show/'.request()->route()->parameters['id'])}}" class="">
                <button type="button" class="btn btn-primary ibox-tool-add-new">
                    <span class="glyphicon glyphicon-edit"></span>   sửa thông tin công việc
                </button>
            </a>
            @if($job->is_public == null)
                <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#public-job">Public Job</button>
            @else
                @if($job->is_show==1)
                    <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#hidden-job">Ẩn Job</button>
                @endif
                @if($job->is_show==2)
                    <button type="button" class="btn btn-warning " data-toggle="modal"  data-target="#show-job">Hiện Job</button>
                @endif
            @endif
            <div class="dashboard-page-container">
                <form action="" method="post" id="create-job">
                    @csrf
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
                                <label for="company_id">Công ty</label>
                            </th>
                            <td>
                                {{ isset($job->company_short_name) ? $job->company_short_name :($job->company_name ? $job->company_name : 'Không có dữ liệu') }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="company_id">Phân loại công việc</label>
                            </th>
                            <td>
                                @if($job->type==1)
                                    Công việc copy
                                @endif
                                @if($job->type==2)
                                    Công việc tự đăng của nhà tuyển dụng
                                    {{$job->employer_name}}
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="title">Tiêu đề công việc</label>
                            </th>
                            <td>
                                {{isset($job->title)?$job->title:'Không có dữ liệu'}}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="title">Loại hình việc làm</label>
                            </th>
                            <td>
                                @if($job->job_type==1)
                                    Toàn thời gian
                                @endif
                                    @if($job->job_type==2)
                                        Parttime
                                @endif
                                    @if($job->job_type==3)
                                        Hợp đồng
                                @endif
                                    @if($job->job_type==4)
                                        Mùa vụ
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="title">Ngày đăng tuyển </label>
                            </th>
                            <td>
                                {{isset($job->job_publish)?$job->job_publish:'Không có dữ liệu'}}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="title">Hạn tuyển dụng  </label>
                            </th>
                            <td>
                                {{isset($job->job_expire)?$job->job_expire:'Không có dữ liệu'}}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="income_min">Lương cứng </label>
                            </th>
                            <td>
                                @if(empty($job->base_salary_min))
                                    Thoả thuận
                                @endif
                                @if(!empty($job->base_salary_min))
                                    @if($job->base_salary_min == $job->base_salary_max) đ
                                        {{number_format($job->base_salary_min)}} đ
                                    @else
                                        {{number_format($job->base_salary_min)}} đ
                                        ~  {{number_format($job->base_salary_max)}} đ
                                    @endif

                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="base_salary_min">Thu nhập </label>
                            </th>
                            <td>
                                @if(empty($job->income_min))
                                    Thoả thuận
                                @endif
                                @if(!empty($job->income_min))
                                    @if($job->income_min == $job->income_max)
                                        {{number_format($job->income_min)}} đ
                                    @else
                                        {{number_format($job->income_min)}} đ ~ {{number_format($job->income_max)}} đ
                                    @endif
                                @endif


                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="workplace">Chọn địa điểm làm việc</label>
                            </th>
                            <td>
                                {{isset($job->district_name)?$job->district_name.'-':''}}
                                {{isset($job->province_name)?$job->province_name:'Không có dữ liệu'}}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="sex">Giới tính</label>
                            </th>
                            <td>
                                @if($job->gender==1)
                                    Nam
                                @elseif($job->gender==2)
                                    Nữ
                                @elseif($job->gender==3)
                                    Khác
                                @elseif($job->gender==4)
                                    Không yêu cầu giới tính
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="description_name">Thông tin mô tả công việc</label>
                            </th>
                            <td>
                                {!! isset($job->description)?$job->description:'Không có dữ liệu' !!}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="description_name">Yêu cầu công việc</label>
                            </th>
                            <td>
                                {!! isset($job->requirements)?$job->requirements:'Không có dữ liệu' !!}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="description_name">Quyền lợi</label>
                            </th>
                            <td>
                                {!! isset($job->benefit)?$job->benefit:'Không có dữ liệu' !!}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="description_name">Vị trí sale</label>
                            </th>
                            <td>
                                @if(isset($job->tags))
                                @foreach($job->tags as $tag)
                                    <span class="label label-success">{{getParseSales($tag->tag_id)}}</span>
                                @endforeach
                                    @else
                                    Không có dữ liệu
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="description_name">Ngành nghề</label>
                            </th>
                            <td>
                                {{$job->field_work_name}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="dashboard-frm-table form-table">
                        <thead>
                        <tr>
                            <th scope="row">
                                <h3 class="text-navy">Chân dung ứng viên</h3>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">
                                <label for="charecter">Tính cách</label>
                            </th>
                            <td>
                                @if(isset($job->characterJobs))
                                    @foreach($job->characterJobs as $characterJob)
                                        <span class="label label-success">{{$characterJob->name}}</span>
                                    @endforeach
                                @else
                                    Không có dữ liệu
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="description_benefit">Kỹ năng</label>
                            </th>
                            <td>

                                @if(isset($job->skillJobs))
                                    @foreach($job->skillJobs as $skillJob)
                                        <span class="label label-success">{{$skillJob->name}}</span>
                                    @endforeach
                                @else
                                    Không có dữ liệu
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for=degree"">Bằng cấp</label>
                            </th>
                            <td>
                                {{isset($job->degree)? getParseDegree($job->degree):'Không có dữ liệu'}}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="experience">Kinh nghiệm</label>
                            </th>
                            <td>
                                {{isset($job->experience)? getExperienceAdd($job->experience) :'Không có dữ liệu'}}
                            </td>
                        </tr>
{{--                        <tr>--}}
{{--                            <th scope="row">--}}
{{--                                <label for="appearance">Ngoại hình</label>--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{isset($job->appearance)?$job->appearance:'Không có dữ liệu'}}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th scope="row">--}}
{{--                                <label for="voice">Giọng nói</label>--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{isset($job->voice)?$job->voice:'Không có dữ liệu'}}--}}
{{--                            </td>--}}
{{--                        </tr>--}}

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    @if($job->is_public==null)
        <div class="modal fade" id="public-job" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title text-center">Bạn có muốn public job này ?</h3>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-public-job" >Đồng ý</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @else
        @if($job->is_show==1)
            <!-- Modal -->
            <div class="modal fade" id="hidden-job" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title text-center">Bạn có muốn ẩn Job này ?</h3>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <button type="button" class="btn btn-danger btn-hidden-job" >Đồng ý</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif
        @if($job->is_show==2)
            <div class="modal fade" id="show-job" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title text-center">Bạn có muốn hiện lại Job này ?</h3>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <button type="button" class="btn btn-danger btn-show-job" >Đồng ý</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    @endif
@endsection
@section('javascript-bottom')
    <script src="{{asset('js/js-service/detail-job-service.js')}}"></script>

@endsection
