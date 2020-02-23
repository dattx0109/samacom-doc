@extends('layouts.base')
@section('content')
    <style>
        .alert-form{
            display: none;
        }
    </style>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="single-info-page dashboard-page">
            <h3 class="dashboard-page-title">Chi tiết tài khoản</h3>
            <div class="dashboard-page-container">
                <form action="{{route('update_data_user',['id'=>1])}}" method="post" class="form-horizontal">
                    @csrf
                    <table class="dashboard-frm-table form-table">
                        <tr>
                            <th scope="row">
                                <label for="name">Tên người dùng</label>
                            </th>
                            <td>
                                <input value="{{$user['name'] }}"  name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nguyen Van A">
                                <span class=" alert-form help-block m-b-none alert alert-danger alert-name"></span>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="email">Email</label>
                            </th>
                            <td>
                                <input value="{{$user['email'] }}" name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="vana@gmail.com">
                                <span class="help-block m-b-none alert alert-danger alert-form alert-email"></span>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="phone">Số điện thoại</label>
                            </th>
                            <td>
                                <input value="{{$user['phone'] }}" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="0966677247">
                                <span class="alert-form help-block m-b-none alert alert-danger alert-phone"></span>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label>Trạng thái</label>
                            </th>
                            <td>
                                @if($user['deleted_by']!= null)
                                    <span class="label label-danger">Đã xóa</span>
                                @else
                                    <span class="label label-primary">đang hoạt động</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="">Vai trò</label>
                            </th>
                            <td>
                                <select name="role" data-placeholder="Chọn vai ..." class="chosen-select" multiple style="width:350px;" tabindex="4">
                                    <option value="">Select</option>
                                    @foreach($roles as $item)
                                        <option @if(array_key_exists($item->id,$user['role_name'])) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="dashboard-btn-group">
                    <button class="btn btn-primary btn-update" type="button">Lưu lại  </button>
                    @if($user['deleted_by']== null)
                        <button class="btn btn-danger btn-delete" type="button" data-toggle="modal" data-target="#modal_delete_user"> Xóa tài khoản</button>
                    @endif
                    <button class="btn btn-warning btn-reset-password" type="button" data-toggle="modal" data-target="#modal_reset_user"> Đặt lại mật khẩu </button>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal_delete_user" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Xác nhận xóa tài khoản</h4>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc xóa tài khoản này</p>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-delete-user" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal_reset_user" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Xác nhận đặt lại mật khẩu</h4>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc đăt lại mật khẩu</p>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-reset-user" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('javascript-bottom')
    <script src="{{asset('js/js-service/detail-user-service.js')}}"></script>
@endsection
