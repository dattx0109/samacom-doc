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
                        <h3>Vai trò</h3>
                        <div class="ibox-tools">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary ibox-tool-add-new" data-toggle="modal"
                                    data-target="#myModal">
                                <i class="fa fa-plus"></i>Thêm mới
                            </button>
                        </div>
                    </div>

{{--                    <div class="headerbox-arrange-box">--}}
{{--                        <ul class="headerbox-arrange-list">--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0)" class="current-active">--}}
{{--                                    All--}}
{{--                                    <span class="list-count">(15)</span>--}}
{{--                                </a>--}}
{{--                                <span class="devide-line">|</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0)">--}}
{{--                                    Admin--}}
{{--                                    <span class="list-count">(1)</span>--}}
{{--                                </a>--}}
{{--                                <span class="devide-line">|</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0)">--}}
{{--                                    Nhân viên kế toán--}}
{{--                                    <span class="list-count">(10)</span>--}}
{{--                                </a>--}}
{{--                                <span class="devide-line">|</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0)">--}}
{{--                                    Nhân viên R&D--}}
{{--                                    <span class="list-count">(5)</span>--}}
{{--                                </a>--}}
{{--                                <span class="devide-line">|</span>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="headerbox-filter-box">--}}
{{--                        <div class="headerbox-filter-item">--}}
{{--                            <select name="" value="">--}}
{{--                                <option value="-1">Tác vụ</option>--}}
{{--                                <option value="Delete">Delete</option>--}}
{{--                                <option value="Disable">Disable</option>--}}
{{--                                <option value="Enable">Enable</option>--}}
{{--                            </select>--}}
{{--                            <input type="submit" name="" value="Apply">--}}
{{--                        </div>--}}
{{--                        <div class="headerbox-filter-item">--}}
{{--                            <select name="" value="">--}}
{{--                                <option value="-1">Đổi quyền thành...</option>--}}
{{--                                <option value="Nhân viên R&D">Nhân viên R&D</option>--}}
{{--                                <option value="Trưởng phòng R&D">Trưởng phòng R&D</option>--}}
{{--                                <option value="Nhân viên Marketing">Nhân viên Marketing</option>--}}
{{--                                <option value="Trưởng phòng Marketing">Trưởng phòng Marketing</option>--}}
{{--                            </select>--}}
{{--                            <input type="submit" name="" value="Đổi">--}}
{{--                        </div>--}}
{{--                        <div class="headerbox-items-count">100 mục</div>--}}
{{--                    </div>--}}
                </div>
                <div class="ibox-content no-padding">
                    <div class="table-responsive">
                        <table class="table table-striped checkbox-table boxshadow-table">
                            <thead>
                            <tr>
                                <th>
                                    STT
{{--                                    <input class="checkbox-check-all" type="checkbox" value="">--}}
                                </th>
                                <th>Vai trò</th>
                                <th>Thời gian tạo</th>
                                <th>Thời gian update</th>
                                <th>Công cụ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($listRole as $list)
                                <tr>
                                    <td>
                                        {{$i}}
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/role/'.$list->id)}}" class="table-title-link">
                                            {{$list->name}}
                                        </a>
                                        <div class="table-row-action">
                                                <span class="edit">
                                                    <a href="{{URL::to('/role/update/'.$list->id)}}">Sửa tên</a>
                                                </span>
                                            |
                                            <span class="edit">
                                                    <a href="{{URL::to('/role/'.$list->id)}}">Sửa roles</a>
                                                </span>
                                            |
                                            <span class="delete">
                                                    <a href="{{URL::to('/delete/'.$list->id)}}"
                                                       onclick="return confirm('Bạn có muốn xoá {{$list->name}} không ?')">Xóa</a>
                                                </span>
                                        </div>
                                    </td>
                                    <td>{{$list->created_at}}</td>
                                    <td>{{$list->updated_at}}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-rounded list-user" data-id="{{$list->id}}">
                                            <i class="fa fa-users"></i>Danh sách user
                                        </a>
                                    </td>
                                    <?php $i++ ?>
                                </tr>
                            @endforeach
                            <tr>
                                <th>
                                    STT
{{--                                    <input class="checkbox-check-all" type="checkbox" value="">--}}
                                </th>
                                <th>Vai trò</th>
                                <th>Thời gian tạo</th>
                                <th>Thời gian update</th>
                                <th>Công cụ</th>
                            </tr>
                            </tbody>
                        </table>
                        {{ $listRole->links() }}
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
                    <h4 class="modal-title">Thêm Vai trò</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Tên Vai trò:</label>
                            <input type="text" class="form-control" id="role_name" placeholder="Tên Vai trò"
                                   name="role_name">
                            <span class="text-danger notificaiton pull-right"></span>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <div id="btn_new_role" class="btn btn-w-m btn-primary">
                            Thêm vai trò
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="listUser">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Danh sách thành viên</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="ibox float-e-margins" style="max-height: 200px; overflow: auto;">
                                <ul class="list-group listUser">
                                    <li class="list-group-item">
                                        <span class="badge badge-info">minhtien2705@gmail.com</span>
                                        But I must explain to
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('javascript-bottom')
    <script src="{{asset('js/js-service/js-role.js')}}"></script>
    <script src="{{asset('js_service/js_role.js')}}"></script>
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
