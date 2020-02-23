@extends('layouts.base')
@section('content')

    <div class="row">
        @if(Session::has('delete'))
            <p class="alert alert-success">
                {{Session::get('delete')}}
            </p>
        @endif

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title margin-ibox-title">
                    <div class="headerbox-add-box">
                        <h3>User</h3>
                        <div class="ibox-tools">
                            <!-- Button to Open the Modal -->
                            <a href="{{route('user-create')}}" class="">
                                <button type="button" class="btn btn-primary ibox-tool-add-new">
                                    <i class="fa fa-plus"></i>Thêm mới
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="headerbox-filter-box">
                        <div class="headerbox-filter-item">
                            <form method="post" action="/user">
                                <select name="role_id" data-placeholder="Chọn chức vụ ..." class="chosen-select"  tabindex="2">
                                    <option {{request()->role_id ==''?'selected':"" }} value="">Chọn chức vụ </option>
                                    @foreach($listRole as $item)
                                        <option {{request()->role_id == $item->id ?'selected':"" }} value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                        <div class="headerbox-items-count">Hiện có:{{count($listUser)}} user</div>
                    </div>
                </div>
                <div class="ibox-content no-padding">
                    <div class="table-responsive">
                        <table class="table table-striped checkbox-table boxshadow-table">
                            <thead>
                                <tr>
                                    <th>
                                        STT
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($listUser as $list)
                                <tr>
                                    <td>
                                        {{$i}}
                                    </td>
                                    <td>
                                        <a href="{{route('user-detail',['id'=>$list->id])}}" class="table-title-link">
                                            {{$list->name}}
                                        </a>
                                        <div class="table-row-action">
                                            <span class="edit">
                                                <a href="{{route('user-detail',['id'=>$list->id])}}">Sửa</a>
                                            </span>
                                            |
                                            <span class="delete">
                                                <a href="{{URL::to('/user/delete/'.$list->id)}}" onclick="return confirm('Bạn có muốn xoá {{$list->name}} không ?')">Xóa</a>
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{isset($list->email)?$list->email:'---'}}</td>
                                    <td>{{isset($list->role)?$list->role:'---'}}</td>
                                    <td>{{isset($list->phone)?$list->phone:'---'}}</td>
                                    <td>
                                        @if($list->deleted_by!= null)
                                            <span class="label label-danger">đã xóa</span>
                                        @else
                                            <span class="label label-primary">hoạt động</span>

                                        @endif
                                    </td>
                                    <?php $i++ ?>
                                </tr>
                            @endforeach
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <input class="checkbox-check-all" type="checkbox" value="">--}}
{{--                                    </td>--}}
{{--                                    <th>Name</th>--}}
{{--                                    <th>Email</th>--}}
{{--                                    <th>Role</th>--}}
{{--                                    <th>Phone</th>--}}
{{--                                    <th>Status</th>--}}
{{--                                </tr>--}}
                            </tbody>
                        </table>
                        @if(count($listUser) === 0)
                        <div class="alert alert-danger" role="alert">
                            Không tìm thấy user
                        </div>
                            @endif
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- modal them role -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thêm User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Tên user:</label>
                            <input type="text" class="form-control" id="role_name" placeholder="Tên Vai trò" name="role_name">
                            <span class="text-danger notificaiton pull-right"></span>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <div id="btn-add-new-domain" class="btn btn-w-m btn-primary">
                            Thêm Vai trò
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('javascript-bottom')
    <script src="{{asset('js_service/js_role.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.chosen-select').chosen({width: "100%"});
            // Check all/uncheck all checkboxes when click on select all
            $('.checkbox-check-all').click (function () {
                var checkedStatus = this.checked;
                $('.checkbox-table tr').find('td:first :checkbox').each(function () {
                    $(this).prop('checked', checkedStatus);
                });
            });

        });
    </script>
@endsection
