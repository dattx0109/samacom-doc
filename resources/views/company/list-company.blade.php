@extends('layouts.base')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if (session('messages'))
                <div class="alert alert-success" role="alert">{{ session('messages') }}</div>
            @endif
            <div class="ibox float-e-margins">
                <div class="ibox-title margin-ibox-title">

                        <h3>Công ty</h3>
                        <div class="ibox-tools">
                            <div class="ibox-tools">
                                <a href="{{route('company-create')}}" class="">
                                    <button type="button" class="btn btn-primary ibox-tool-add-new">
                                        <i class="fa fa-plus"></i>Thêm mới
                                    </button>
                                </a>
                            </div>
                            <div class="headerbox-filter-box">
                                <form role="form" action="/company" method="GET">
                                    <div class="headerbox-filter-item">
                                        <input type="text" name="company_name" placeholder="Tên công ty" value="{{request()->company_name}}">
                                        <button class="btn btn-primary" style="background-color: #337ab7; border-color: #337ab7;
                                    color: #ffffff;" type="submit" type="submit">Tìm kiếm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="headerbox-filter-box">
{{--                        <div class="headerbox-filter-item">--}}
{{--                            <select name="" value="">--}}
{{--                                <option value="-1">Tác vụ</option>--}}
{{--                                <option value="Delete">Delete</option>--}}
{{--                                <option value="Disable">Disable</option>--}}
{{--                                <option value="Enable">Enable</option>--}}
{{--                            </select>--}}
{{--                            <input type="submit" name="" value="Apply">--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="ibox-content no-padding">
                    <div class="table-resonpsive">
                        <table class="table table-striped checkbox-table boxshadow-table">
                            <thead>
                            <tr>
                                <td>
                                    {{--<input class="checkbox-check-all" type="checkbox" value="">--}}
                                </td>
                                <th>Tên công ty</th>
                                <th>Email công ty</th>
                                <th>Ngày Thêm công ty</th>
                                <th>Ngày Sửa thông tin công ty</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($dataCompany as $item )
                                @if(!(isset($item->deleted_at)))
                                <tr>
                                    <td>
                                        {{--<input type="checkbox">--}}
                                    </td>
                                    <td>
                                        <a href="{{url('/detail/company/'.$item->id)}}" class="table-title-link">{{isset($item->id) ? $item->name : '' }}</a>
                                        <div class="table-row-action">
                                            <span class="edit">
                                                <a href="{{url('/detail/company/'.$item->id)}}">Xem</a>
                                            </span>
                                            |
                                            <span class="edit">
                                                <a href="{{url('/list/company/'.$item->id)}}">Sửa</a>
                                            </span>
{{--                                            |--}}
{{--                                            <span class="delete">--}}
{{--                                                <a href="{{url('/company/delete/'.$item->id)}}" onclick="return confirm('Bạn có muốn xoá công ty {{$item->name}} không ?')">Xóa</a>--}}
{{--                                            </span>--}}
                                        </div>
                                    </td>
                                    <td>{{isset($item->id) ? $item->email : '' }}</td>
                                    <td>{{isset($item->id) ? $item->created_at : '' }}</td>
                                    <td>{{isset($item->id) ? $item->updated_at : '' }}</td>
                                    <?php $i ++ ?>
                                </tr>
                                @endif
                            @endforeach
                            {{ $dataCompany->links() }}
                            </tbody>
                        </table>
                        @if(($dataCompany->total()) === 0)
                            <div class="alert alert-info" role="alert">
                                Không tìm thấy công ty
                            </div>
                        @endif
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
