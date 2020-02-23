@extends('layouts.base')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                {{--<div class="ibox-title margin-ibox-title">--}}
                    {{--<div class="headerbox-add-box">--}}
                        {{--<h3>Nhà tuyển dụng</h3>--}}
                        {{--<div class="ibox-tools">--}}
                            {{--<div class="ibox-tools">--}}
                                {{--<a href="{{url('/registerEmployer')}}" class="">--}}
                                    {{--<button type="button" class="btn btn-primary ibox-tool-add-new">--}}
                                        {{--<i class="fa fa-plus"></i>Thêm mới nhà tuyển dụng--}}
                                    {{--</button>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="ibox-content no-padding">
                    <div class="table-resonpsive">
                        <table class="table table-striped checkbox-table boxshadow-table" >
                            <thead>
                            <tr>
                                <td>
                                    <input class="checkbox-check-all" type="checkbox" value="">
                                </td>
                                <th>Tên</th>
                                <th>Giới tính </th>
                                <th>Giọng nói</th>
                                <th>Khuôn mặt</th>
                                <th>Khí chất</th>
                                <th>Type</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Nam sinh</th>
                            </tr>
                            </thead>
                            <tbody id="table-list">
                            <?php $i = 1 ?>
                            @foreach($rawDataCv4d as $item )
                                <tr>
                                    <td>
                                        <input type="checkbox">
                                    </td>
                                    <td>{{isset($item->ten) ? $item->ten : '' }}</td>
                                    <td>{{isset($item->gioi_tinh) ? $item->gioi_tinh : '' }}</td>
                                    <td>{{isset($item->giong_noi) ? $item->giong_noi : '' }}</td>
                                    <td>{{isset($item->khuon_mat) ? $item->khuon_mat : '' }}</td>
                                    <td>{{isset($item->khi_chat) ? $item->khi_chat : '' }}</td>
                                    <td>{{isset($item->type) ? $item->khuon_mat : '' }}</td>
                                    <td>{{isset($item->so_dien_thoai) ? $item->so_dien_thoai : '' }}</td>
                                    <td>{{isset($item->email) ? $item->email : '' }}</td>
                                    <td>{{isset($item->nam_sinh) ? $item->nam_sinh : '' }}</td>

                                <?php $i ++ ?>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $rawDataCv4d->links() }}
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
@endsection
