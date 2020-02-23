
@extends('layouts.base')
@section('content')
{{--    @dd($listUvApplyJob)--}}
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title margin-ibox-title">
                    <div class="headerbox-add-box">
                        <h3>Danh sách ứng viên apply công việc</h3>
                    </div>
                </div>
                <a href="{{route('list-job')}}">Quay lại trang danh sách công việc</a>
                <br> <br>
                <div class="ibox-content no-padding">
                    <div class="table-responsive">
                        <table class="table table-striped boxshadow-table">
                            <thead>
                            <tr>
                                <th>Họ và tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Trạng thái tìm việc</th>
                                <th>Thời gian apply công việc</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listUvApplyJob as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>@if($item->job_search_status == 1)
                                            đang tìm việc
                                            @elseif($item->job_search_status == 2)
                                            đang cân nhắc
                                            @else
                                            không tìm việc
                                        @endif
                                <td>{{$item->ngay_apply_job}}</td>
                                @endforeach

                            </tbody>
                        </table>
                        @if(($listUvApplyJob->total()) === 0)
                            <div class="alert alert-danger" role="alert">
                                Chưa có ứng viên nào ứng tuyển
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript-bottom')
    <script src="{{asset('js/js-service/list-job-service.js')}}"></script>
@endsection

