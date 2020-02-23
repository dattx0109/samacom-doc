@extends('layouts.base')
@section('content')
    <div class="row">
        @if(isset($message) || session('message'))
            <div>
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Cập nhật permission thành công.
                </div>
            </div>
        @endif

        <form method="post" action="{{url('role/'.request()->route()->parameters['id'])}}">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title margin-ibox-title">
                        <div class="headerbox-add-box">
                            <h3>Chỉnh sửa quyền {{$role->name}}</h3>
                            <div class="ibox-tools">
                                <!-- Button to Open the Modal -->
{{--                                <button type="button" class="btn btn-primary ibox-tool-add-new" data-toggle="modal" data-target="#myModal">--}}
{{--                                    Thêm Vai trò--}}
{{--                                </button>--}}
                                <button class="btn btn-primary ibox-tool-left-btn"><i class="fa far fa-save"></i> Lưu lại</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content no-padding">
                        <div class="table-list-container">
                            @foreach($permission as $items)
                                <div class="table-list-item table-list-item-three">
                                    <div class="table-responsive boxshadow-table table-div">
                                        <table class="table checkbox-table hover-table">
                                            <thead>
                                            <tr>
                                                <th><i class="fa fa-info-circle"></i> {{ isset($items['category_name']) ? $items['category_name'] : ''}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                @if(is_array($item))
                                                    <tr>
                                                        <td>
                                                            <label>
                                                                <input type="checkbox" name="{{ $item['id'] }}" {{isset($item['isAccess']) ? 'checked' : ''}}>{{ isset($item['name']) ? $item['name'] : ''}}
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection