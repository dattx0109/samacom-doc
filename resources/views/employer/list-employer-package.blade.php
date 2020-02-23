@extends('layouts.base')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title margin-ibox-title">
                    <div class="headerbox-add-box">
                        <h3>Danh sách nhà tuyển dụng đặt hàng</h3>
                        <div class="ibox-tools">
                            <div class="ibox-tools">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-content no-padding">
                    <div class="table-resonpsive">
                        <table class="table table-striped  boxshadow-table">
                            <thead>
                            <tr>

                                <th>Tên Nhà tuyển dụng</th>
                                <th>SĐT</th>
                                <th>Loại gói</th>
                                <th>Số lượng mua</th>
                                <th>Tình trạng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listEmployPackage as $list)
                                    <tr>

                                        <td>
                                            <a href="" class="table-title-link">{{$list->name}}</a>

                                        </td>
                                        <td>{{$list->phone}}</td>
                                        <td>{{$list->package_name}}</td>
                                        <td>{{$list->count}}</td>
                                        <td class="action">
                                            @if($list->status==1||$list->status==2)
                                                <select name="status" data-id="{{$list->id}}">
                                                    <option @if($list->status==1) selected @endif value="1">
                                                        Đang chờ duyêt
                                                    </option>
                                                    <option @if($list->status==2) selected @endif value="2">Không liên lạc được </option>
                                                    <option value="3">Khác hàng hủy không mua</option>h
                                                    <option value="4">Khác hàng chờ chuyển tiền </option>h
                                                </select>
                                            @endif
                                                @if($list->status==3)
                                                    Khác hàng hủy không mua
                                           @endif
                                                @if($list->status==4)
                                                     Chờ Khách hàng chuyển tiền
                                           @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript-bottom')
    <script src="{{asset('js/js-service/employer-package-order.js')}}">
    </script>
@endsection
