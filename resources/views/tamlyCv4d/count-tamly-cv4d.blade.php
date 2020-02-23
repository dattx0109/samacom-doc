@extends('tamlyCv4d.baseTamLyCv4d')

@section('content-tam-ly-cv4d')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content no-padding">
                    <div class="table-responsive">
                        <table class="table table-striped checkbox-table boxshadow-table">
                            <thead>
                            <tr>
                                <th style="width: 30%;">
                                    Loại hình
                                </th>
                                <th>Thần thái</th>
                                <th>Nhân khẩu học</th>
                                <th>Nhân Tướng học</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <th>Đọc vị tâm lý khách hàng</th>
                                    <td>{{$listCountTamLy['0']}}</td>
                                    <td>{{$listCountTamLy['1']}}</td>
                                    <td>{{$listCountTamLy['2']}}</td>
                                </tr>
                                <tr>
                                    <th>CV-4D</th>
                                    <td>{{$listCountCv4d['0']}}</td>
                                    <td>{{$listCountCv4d['1']}}</td>
                                    <td>{{$listCountCv4d['2']}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
