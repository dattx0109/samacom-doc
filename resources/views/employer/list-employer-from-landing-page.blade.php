@extends('layouts.base')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title margin-ibox-title">
                    <div class="headerbox-add-box">
                        <h3>Danh sách nhà tuyển dụng cần tư vấn để mua các gói sản phẩm</h3>
                        <div class="ibox-tools">
                            <div class="ibox-tools">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-content no-padding">
                    <div class="table-resonpsive">
                        <table class="table table-striped checkbox-table boxshadow-table">
                            <thead>
                            <tr>
                                <td>
                                    <input class="checkbox-check-all" type="checkbox" value="">
                                </td>
                                <th>Tên Nhà tuyển dụng</th>
                                <th>SĐT</th>
                                <th>Email</th>
                                <th>Loại gói</th>
                                <th>Số lượng mua</th>
                                <th>Tình trạng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listEmployer as $list)
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>
                                    <a href="" class="table-title-link">{{$list->name}}</a>
                                </td>
                                <td>{{$list->phone}}</td>
                                <td>{{$list->email}}</td>
                                <td>{{isset($list->package_name)?$list->package_name:'Cần tư vấn gói mua'}}</td>
                                <td>{{isset($list->number)?$list->number:0}}</td>
                                <td class="action">
                                    @if($list->status==1||$list->status==2)
                                        <select name="status" data-id="{{$list->id}}">
                                            <option @if($list->status==1) selected @endif value="1">
                                                Đang chờ duyêt
                                            </option>
                                            <option @if($list->status==2) selected @endif value="2">Không liên lạc được </option>
                                            <option value="3">Khách hàng hủy không mua</option>h
                                            <option value="4">Khách hàng đồng ý mua </option>h
                                        </select>
                                    @endif
                                    @if($list->status==3)
                                        Khác hàng hủy không mua
                                    @endif
                                    @if($list->status==4)
                                        Khách hàng đồng ý mua
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript-bottom')
    <script>
        $(document).ready(function () {
            // Check all/uncheck all checkboxes when click on select all
            $('.checkbox-check-all').click(function () {
                var checkedStatus = this.checked;
                $('.checkbox-table tr').find('td:first :checkbox').each(function () {
                    $(this).prop('checked', checkedStatus);
                });
            });

        });
    </script>
    <script src="{{asset('js/js-service/advisory-employer-package-order.js')}}">
    </script>
@endsection
