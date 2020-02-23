@extends('layouts.base')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title margin-ibox-title">
                    <div class="headerbox-add-box">
                        <h3>Nhà tuyển dụng</h3>
                        <div class="ibox-tools">
                            <div class="ibox-tools">
                                <a href="{{url('/listEmployer/mail-reset-pass')}}" class="">
                                    <button type="button" class="btn btn-success ibox-tool-add-new">
                                        <i class="fa fa-send"></i>Gửi lại mail tạo mật khẩu
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-tools">
                            <div class="ibox-tools">
                                <a href="{{url('/registerEmployer')}}" class="">
                                    <button type="button" class="btn btn-primary ibox-tool-add-new">
                                        <i class="fa fa-plus"></i>Thêm mới nhà tuyển dụng
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="headerbox-filter-box">
                    <form role="form" action="/listEmployer" method="GET">
                        <div class="headerbox-filter-item">
                            <input type="text" id="name_or_phone" name="name_or_phone" placeholder="Tên,email hoặc số điện thoại" value="{{request()->name_or_phone}}">
                        </div>
                        <div class="headerbox-filter-item">
                            <span>Ngày tạo</span>
                            <input type="text" id="date_created" name="date_created" placeholder="Chọn ngày " value="{{request()->date_created}}"/>
                            <button id="reset_fillter" type="button">Làm mới</button>
                            <button  class="btn btn-primary" style="background-color: #337ab7; border-color: #337ab7;
                                    color: #ffffff;" type="submit">Tìm kiếm</button>
                        </div>
                    </form>
                    <div class="headerbox-items-count">Tìm thấy {{$listEmployer->total()}} nhà tuyển dụng</div>
                </div>

            </div>


                <div class="ibox-content no-padding">
                    @if($errors->has('success'))
                        <p class="alert alert-success ">
                            {{$errors->first('success')}}
                        </p>
                    @endif
                    <div class="table-resonpsive">
                        <table class="table table-striped checkbox-table boxshadow-table" >
                            <thead>
                            <tr>
                                <td>
                                    <input class="checkbox-check-all" type="checkbox" value="">
                                </td>
                                <th>Name</th>
                                <th>Email </th>
                                <th>Phone</th>
                                <th>Ngày tạo</th>
                                {{--<th>Ngày đăng ký</th>--}}
                                {{--<th>Hành động</th>--}}

                            </tr>
                            </thead>
                            <tbody id="table-list">
                            <?php $i = 1 ?>
                            @foreach($listEmployer as $item )
                                <tr>
                                    <td>
                                        <input type="checkbox">
                                    </td>
                                    {{--<td>--}}
                                    {{--<a href="{{url('/detail/company/'.$item->id)}}" class="table-title-link">{{isset($item->id) ? $item->name : '' }}</a>--}}
                                    {{--<div class="table-row-action">--}}
                                    {{--<span class="edit">--}}
                                    {{--<a href="{{url('/detail/company/'.$item->id)}}">Xem</a>--}}
                                    {{--</span>--}}
                                    {{--|--}}
                                    {{--<span class="edit">--}}
                                    {{--<a href="{{url('/list/company/'.$item->id)}}">Sửa</a>--}}
                                    {{--</span>--}}
                                    {{--|--}}
                                    {{--<span class="delete">--}}
                                    {{--<a href="{{url('/company/delete/'.$item->id)}}" onclick="return confirm('Bạn có muốn xoá công ty {{$item->name}} không ?')">Xóa</a>--}}
                                    {{--</span>--}}
                                    {{--</div>--}}
                                    {{--</td>--}}
                                    <td>{{isset($item->name) ? $item->name : '' }}</td>
                                    <td>{{isset($item->email) ? $item->email : '' }}</td>
                                    <td>{{isset($item->phone) ? $item->phone : '' }}</td>
                                    <td>{{isset($item->created_at) ? date('d/m/Y ',strtotime($item->created_at)) : '' }}</td>
                                <?php $i ++ ?>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(($listEmployer->total()) === 0)
                            <div class="alert alert-info" role="alert">
                                Không tìm thấy nhà tuyển dụng
                            </div>
                            @endif
                        {{ $listEmployer->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript-bottom')
    <link rel="stylesheet" type="text/css" href="{{asset('daterangepicker-master/daterangepicker.css')}}" />
    <script type="text/javascript" src="{{asset('daterangepicker-master/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('daterangepicker-master/daterangepicker.js')}}"></script>

    <script>
        $(document).ready(function () {
            // Check all/uncheck all checkboxes when click on select all
            $('.checkbox-check-all').click(function () {
                var checkedStatus = this.checked;
                $('.checkbox-table tr').find('td:first :checkbox').each(function () {
                    $(this).prop('checked', checkedStatus);
                });
            });
            $('#reset_fillter').click(function () {
                $('#name_or_phone').val('');
                $('#date_created').val('');
            });
        });
        $(function() {
            $('input[name="date_created"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'DD/MM/YYYY'
                },
                opens: 'right',
            }, function(start, end, label) {
            });
            $('input[name="date_created"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $('input[name="date_created"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
