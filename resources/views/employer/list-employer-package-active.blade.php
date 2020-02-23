@extends('layouts.base')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title margin-ibox-title">
                    <div class="headerbox-add-box">
                        <h3>Danh sách nhà tuyển dụng đặt hàng xử lý kích hoạt</h3>
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
                                <th>Loại gói</th>
                                <th>Số lượng mua</th>
                                <th>Tình trạng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listEmployPackagePendingApprove as $list)
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>
                                    <a href="" class="table-title-link">{{$list->name}}</a>
                                </td>
                                <td>{{$list->phone}}</td>
                                <td>{{$list->package_name}}</td>
                                <td>{{$list->count}}</td>
                                <td class="action">
                                    @if($list->status==4)
                                        <select name="status" data-id="{{$list->id}}">
                                            <option @if($list->status==4) selected @endif value="1">
                                                Chờ chuyển tiền
                                            </option>
                                            <option value="5">Hủy không mua nữa</option>
                                            <option value="6">Kích hoạt</option>

                                        </select>
                                    @endif
                                    @if($list->status==5)
                                        Hủy Không mua nữa
                                    @endif
                                    @if($list->status==6)
                                        Đã kích hoạt
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
    <script src="{{asset('js/js-service/employer-package-active.js')}}"></script>
@endsection
