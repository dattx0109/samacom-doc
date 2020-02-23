@extends('layouts.base')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title margin-ibox-title">
                    <div class="headerbox-add-box">
                        <h3>Danh sách ứng viên</h3>
                        {{--<div class="ibox-tools">--}}
                        {{--<div class="ibox-tools">--}}
                        {{--<a href="" class="">--}}
                        {{--<button type="button" class="btn btn-primary ibox-tool-add-new">--}}
                        {{--<i class="fa fa-plus"></i>Thêm mới--}}
                        {{--</button>--}}
                        {{--</a>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <form role="form" action="{{route('filter-account')}}" method="get">
                        <div class="headerbox-filter-box">
                            <div class="headerbox-filter-item">
                                <input type="text" placeholder="Tên,email,số điện thoại" id="name" name="name"
                                       value="{{request()->name}}">
                            </div>
                            <div class="headerbox-filter-item">
                                <select name="gender" id="gender">
                                    <option {{request()->gender ==''?'selected':"" }} value="">Giới tính</option>
                                    <option {{request()->gender == 1?'selected':"" }} value="1">Nam</option>
                                    <option {{request()->gender == 2?'selected':"" }} value="2">Nữ</option>
                                    <option {{request()->gender == 2?'selected':"" }} value="3">Khác</option>
                                </select>
                            </div>
                            <div class="headerbox-filter-item">
                                <select name="is_married" id="is_married">
                                    <option value="" {{request()->is_married ==''?'selected':"" }}>Tình trạng hôn nhân
                                    </option>
                                    <option {{request()->is_married ==1?'selected':"" }} value="1">Độc thân</option>
                                    <option {{request()->is_married ==2?'selected':"" }} value="2">Có gia đình</option>
                                    <option {{request()->is_married ==3?'selected':"" }} value="3">Có con</option>
                                </select>
                            </div>
                            <div class="headerbox-filter-item">
                                <select name="job_search_status" id="job_search_status">
                                    <option value="" {{request()->job_search_status ==''?'selected':"" }}>Tình trạng tìm
                                        việc
                                    </option>
                                    <option {{request()->job_search_status ==1?'selected':"" }} value="1">Đang tìm
                                        việc
                                    </option>
                                    <option {{request()->job_search_status ==2?'selected':"" }} value="2">Đang cân
                                        nhắc
                                    </option>
                                    <option {{request()->job_search_status ==3?'selected':"" }} value="3">Không tìm
                                        việc
                                    </option>
                                </select>
                            </div>
                            <div class="headerbox-filter-item">
                                <select name="province_id" id="province_id" data-placeholder="Chọn tỉnh thành..."
                                >
                                    <option {{request()->province_id ==''?'selected':"" }} value="">Chọn tỉnh thành
                                    </option>
                                    @foreach($provinces as $province)
                                        <option
                                            {{request()->province_id == $province->id ?'selected':"" }} value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="headerbox-filter-item">
                                <select name="district_id" id="district_id" data-placeholder="Chọn quận huyện..."
                                >
                                    <option value="">Chọn quận huyện</option>
                                    @if(isset($listDistrictByProvinceId))
                                        @foreach($listDistrictByProvinceId as $listDistrict)
                                            <option
                                                {{request()->district_id == $listDistrict->id ?'selected': ""}} value="{{$listDistrict->id}}">{{$listDistrict->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-normal">Kinh nghiệm ở vị trí</label>
                                <div>
                                    <select name="position_exp[]" data-placeholder="Chọn vị trí sales..."
                                            class="chosen-select" multiple
                                            style="width:350px;" tabindex="4">
                                        <option
                                            @if(isset(request()->position_exp)) @if(in_array(1, request()->position_exp)) selected
                                            @endif @endif value="1">Sales Admin
                                        </option>
                                        <option
                                            @if(isset(request()->position_exp)) @if(in_array(2, request()->position_exp)) selected
                                            @endif @endif value="2">Telesales
                                        </option>
                                        <option
                                            @if(isset(request()->position_exp)) @if(in_array(3, request()->position_exp)) selected
                                            @endif @endif value="3">Sales tư vấn
                                        </option>
                                        <option
                                            @if(isset(request()->position_exp)) @if(in_array(4, request()->position_exp)) selected
                                            @endif @endif value="4">Sales thị trường
                                        </option>
                                        <option
                                            @if(isset(request()->position_exp)) @if(in_array(5, request()->position_exp)) selected
                                            @endif @endif value="5">Sales bán hàng
                                        </option>
                                        <option
                                            @if(isset(request()->position_exp)) @if(in_array(6, request()->position_exp)) selected
                                            @endif @endif value="6">Sales online
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-normal">Kinh nghiệm với nghề</label>
                                <div>
                                    <select name="field_exp[]" data-placeholder="Chọn ngành nghề..."
                                            class="chosen-select" multiple
                                            style="width:350px;" tabindex="4">
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(1, request()->field_exp)) selected
                                            @endif @endif value="1">Du lịch & Nghỉ dưỡng (Nhà hàng, Khách sạn, Khu du
                                            lịch, Nghỉ dưỡng, …)
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(2, request()->field_exp)) selected
                                            @endif @endif value="2">Bán lẻ/Bán sỉ/Thương mại
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(3, request()->field_exp)) selected
                                            @endif @endif value="3">Bảo hiểm (Nhân thọ/ Phi nhân thọ
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(4, request()->field_exp)) selected
                                            @endif @endif value="4">Bất động sản
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(5, request()->field_exp)) selected
                                            @endif @endif value="5">Kiến trúc/Thiết kế (Nhà phát triển, Kiến trúc/thiết
                                            kế, Dịch vụ bán/Quản lý/Cho thuê, …)
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(6, request()->field_exp)) selected
                                            @endif @endif value="6">Công nghệ Phần mềm/Thiết bị phụ trợ
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(7, request()->field_exp)) selected
                                            @endif @endif value="7">Công nghệ Thông tin/Hạ tầng/Viễn thông
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(8, request()->field_exp)) selected
                                            @endif @endif value="8">Dầu khí/Năng lượng
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(9, request()->field_exp)) selected
                                            @endif @endif value="9">Dệt may/Da giày
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(10, request()->field_exp)) selected
                                            @endif @endif value="10">Dịch vụ & Tư vấn (Luật, Nhân sự, Nghiên cứu thị
                                            trường, …)
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(11, request()->field_exp)) selected
                                            @endif @endif value="11">Dịch vụ tài chính (Đầu tư, Kế toán, Kiểm toán,
                                            Chứng khoán, …)
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(12, request()->field_exp)) selected
                                            @endif @endif value="12">Y tế/Dược
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(13, request()->field_exp)) selected
                                            @endif @endif value="13">Giáo dục/Đào tạo
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(14, request()->field_exp)) selected
                                            @endif @endif value="14">Hàng tiêu dùng (Thực phẩm & Phi thực phẩm)
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(15, request()->field_exp)) selected
                                            @endif @endif value="15">Internet/Thương mại điện tử
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(16, request()->field_exp)) selected
                                            @endif @endif value="16">Kỹ thuật/Máy móc/Cơ khí Công nghiệp
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(17, request()->field_exp)) selected
                                            @endif @endif value="17">Ngân hàng
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(18, request()->field_exp)) selected
                                            @endif @endif value="18">Nông nghiệp/Lâm/Ngư nghiệp
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(19, request()->field_exp)) selected
                                            @endif @endif value="19">Ô tô/Phụ tùng
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(20, request()->field_exp)) selected
                                            @endif @endif value="20">Marketing/Pr/Truyền thông/Giải trí
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(21, request()->field_exp)) selected
                                            @endif @endif value="21">Sản xuất/Hóa chất
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(22, request()->field_exp)) selected
                                            @endif @endif value="22">Vận tải/Hậu cần (Xuất nhập khẩu, Vận chuyển tiếp
                                            vận, Giao nhận hàng hóa)
                                        </option>
                                        <option
                                            @if(isset(request()->field_exp)) @if(in_array(23, request()->field_exp)) selected
                                            @endif @endif value="23">Xây dựng/Vật liệu (Nhà xây dựng, Nhà thầu thi
                                            công/giám sát, Sản xuất VLXD,…)
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-normal">Kỹ năng</label>
                                <div>
                                    <select name="skill[]" data-placeholder="Chọn kỹ năng..." class="chosen-select"
                                            multiple
                                            style="width:350px;" tabindex="4">
                                        @foreach($listSkill as $item)
                                            <option
                                                @if(isset(request()->skill)) @if(in_array($item->id, request()->skill)) selected
                                                @endif @endif value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-normal">Mức lương mong muốn</label>
                                <div>
                                    <select name="salary[]" data-placeholder="Chọn mức lương..." class="chosen-select"
                                            multiple
                                            style="width:350px;" tabindex="4">
                                        <option
                                            @if(isset(request()->salary)) @if(in_array(1, request()->salary)) selected
                                            @endif @endif value="1">Dưới 6,000,000 đ
                                        </option>
                                        <option
                                            @if(isset(request()->salary)) @if(in_array(2, request()->salary)) selected
                                            @endif @endif value="2">6,000,000 đ - 8,000,000 đ
                                        </option>
                                        <option
                                            @if(isset(request()->salary)) @if(in_array(3, request()->salary)) selected
                                            @endif @endif value="3">8,000,000 đ - 10,000,000 đ
                                        </option>
                                        <option
                                            @if(isset(request()->salary)) @if(in_array(4, request()->salary)) selected
                                            @endif @endif value="4">10,000,000 đ - 15,000,000 đ
                                        </option>
                                        <option
                                            @if(isset(request()->salary)) @if(in_array(5, request()->salary)) selected
                                            @endif @endif value="5">15,000,000 đ - 20,000,000 đ
                                        </option>
                                        <option
                                            @if(isset(request()->salary)) @if(in_array(6, request()->salary)) selected
                                            @endif @endif value="6">20,000,000 đ - 30,000,000 đ
                                        </option>
                                        <option
                                            @if(isset(request()->salary)) @if(in_array(7, request()->salary)) selected
                                            @endif @endif value="7">30,000,000 đ - 50,000,000 đ
                                        </option>
                                        <option
                                            @if(isset(request()->salary)) @if(in_array(8, request()->salary)) selected
                                            @endif @endif value="8">50,000,000 đ - 100,000,000 đ
                                        </option>
                                        <option
                                            @if(isset(request()->salary)) @if(in_array(9, request()->salary)) selected
                                            @endif @endif value="9">Trên 100,000,000 đ
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-normal">Vị trí mong muốn</label>
                                <div>
                                    <select name="position_wish[]" data-placeholder="Chọn vị trí sales..."
                                            class="chosen-select" multiple
                                            style="width:350px;" tabindex="4">
                                        <option
                                            @if(isset(request()->position_wish)) @if(in_array(1, request()->position_wish)) selected
                                            @endif @endif value="1">Sales Admin
                                        </option>
                                        <option
                                            @if(isset(request()->position_wish)) @if(in_array(2, request()->position_wish)) selected
                                            @endif @endif value="2">Telesales
                                        </option>
                                        <option
                                            @if(isset(request()->position_wish)) @if(in_array(3, request()->position_wish)) selected
                                            @endif @endif value="3">Sales tư vấn
                                        </option>
                                        <option
                                            @if(isset(request()->position_wish)) @if(in_array(4, request()->position_wish)) selected
                                            @endif @endif value="4">Sales thị trường
                                        </option>
                                        <option
                                            @if(isset(request()->position_wish)) @if(in_array(5, request()->position_wish)) selected
                                            @endif @endif value="5">Sales bán hàng
                                        </option>
                                        <option
                                            @if(isset(request()->position_wish)) @if(in_array(6, request()->position_wish)) selected
                                            @endif @endif value="6">Sales online
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-normal">Ngành nghề mong muốn</label>
                                <div>
                                    <select name="field_wish[]" data-placeholder="Chọn ngành nghề..."
                                            class="chosen-select" multiple
                                            style="width:350px;" tabindex="4">
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(1, request()->field_wish)) selected
                                            @endif @endif value="1">Du lịch & Nghỉ dưỡng (Nhà hàng, Khách sạn, Khu du
                                            lịch, Nghỉ dưỡng, …)
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(2, request()->field_wish)) selected
                                            @endif @endif value="2">Bán lẻ/Bán sỉ/Thương mại
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(3, request()->field_wish)) selected
                                            @endif @endif value="3">Bảo hiểm (Nhân thọ/ Phi nhân thọ
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(4, request()->field_wish)) selected
                                            @endif @endif value="4">Bất động sản
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(5, request()->field_wish)) selected
                                            @endif @endif value="5">Kiến trúc/Thiết kế (Nhà phát triển, Kiến trúc/thiết
                                            kế, Dịch vụ bán/Quản lý/Cho thuê, …)
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(6, request()->field_wish)) selected
                                            @endif @endif value="6">Công nghệ Phần mềm/Thiết bị phụ trợ
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(7, request()->field_wish)) selected
                                            @endif @endif value="7">Công nghệ Thông tin/Hạ tầng/Viễn thông
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(8, request()->field_wish)) selected
                                            @endif @endif value="8">Dầu khí/Năng lượng
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(9, request()->field_wish)) selected
                                            @endif @endif value="9">Dệt may/Da giày
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(10, request()->field_wish)) selected
                                            @endif @endif value="10">Dịch vụ & Tư vấn (Luật, Nhân sự, Nghiên cứu thị
                                            trường, …)
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(11, request()->field_wish)) selected
                                            @endif @endif value="11">Dịch vụ tài chính (Đầu tư, Kế toán, Kiểm toán,
                                            Chứng khoán, …)
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(12, request()->field_wish)) selected
                                            @endif @endif value="12">Y tế/Dược
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(13, request()->field_wish)) selected
                                            @endif @endif value="13">Giáo dục/Đào tạo
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(14, request()->field_wish)) selected
                                            @endif @endif value="14">Hàng tiêu dùng (Thực phẩm & Phi thực phẩm)
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(15, request()->field_wish)) selected
                                            @endif @endif value="15">Internet/Thương mại điện tử
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(16, request()->field_wish)) selected
                                            @endif @endif value="16">Kỹ thuật/Máy móc/Cơ khí Công nghiệp
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(17, request()->field_wish)) selected
                                            @endif @endif value="17">Ngân hàng
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(18, request()->field_wish)) selected
                                            @endif @endif value="18">Nông nghiệp/Lâm/Ngư nghiệp
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(19, request()->field_wish)) selected
                                            @endif @endif value="19">Ô tô/Phụ tùng
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(20, request()->field_wish)) selected
                                            @endif @endif value="20">Marketing/Pr/Truyền thông/Giải trí
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(21, request()->field_wish)) selected
                                            @endif @endif value="21">Sản xuất/Hóa chất
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(22, request()->field_wish)) selected
                                            @endif @endif value="22">Vận tải/Hậu cần (Xuất nhập khẩu, Vận chuyển tiếp
                                            vận, Giao nhận hàng hóa)
                                        </option>
                                        <option
                                            @if(isset(request()->field_wish)) @if(in_array(23, request()->field_wish)) selected
                                            @endif @endif value="23">Xây dựng/Vật liệu (Nhà xây dựng, Nhà thầu thi
                                            công/giám sát, Sản xuất VLXD,…)
                                        </option>
                                    </select>
                                </div>
                            </div>
                                <button type="button" id="reset_fillter">Làm mới bộ lọc</button>
                                <button class="btn btn-primary" style="background-color: #337ab7; border-color: #337ab7;
                                    color: #ffffff;" type="submit" id="sbmFilter">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
                <p class="pull-right">Tìm thấy {{$filterAccount->total()}} ứng viên</p>
                <div class="ibox-content no-padding">
                    <div class="table-resonpsive">
                        <table class="table table-striped boxshadow-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Hoạt động</th>
                                <th>Ngày đăng ký</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="table-list">
                            <?php $i = 1 ?>
                            @foreach($filterAccount as $item )
                                <tr>
                                    <td>{{isset($item->name) ? $item->name : '' }}</td>
                                    <td>{{isset($item->email) ? $item->email : '' }}</td>
                                    <td>{{isset($item->phone) ? $item->phone : '' }}</td>
                                    <td>@if($item->is_active === 1 ) Hoạt động @else Không hoạt động @endif</td>
                                    <td>{{ $item->created_at ? $item->created_at : '' }}</td>
                                    <td>
                                        @if($item->is_show!=2)
                                            <button data-id={{$item->id}} type="button"
                                                    class="btn btn-danger btn-sm btn-modal-hide" data-toggle="modal"
                                                    data-target="#hide-account-cv">Ẩn Ứng viên
                                            </button>
                                        @else
                                            <button data-id={{$item->id}} type="button"
                                                    class="btn btn-warning btn-sm btn-modal-hide" data-toggle="modal"
                                                    data-target="#show-account-cv">Hiện Ứng viên
                                            </button>
                                        @endif
                                    </td>
                                    <?php $i++ ?>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(($filterAccount->total()) === 0)
                            <div class="alert alert-info" role="alert">
                                Không tìm thấy ứng viên
                            </div>
                        @endif
                            {{ $filterAccount->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hide-account-cv" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title text-center">Bạn có muốn ẩn cv  này ?</h3>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <button type="button" class="btn btn-danger btn-hide-account" >Đồng ý</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

{{--    show ung vien--}}

    <div class="modal fade" id="show-account-cv" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title text-center">Bạn có muốn hiện lại cv này ?</h3>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <button type="button" class="btn btn-danger btn-show-account" >Đồng ý</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('javascript-bottom')
    <script src="{{asset('/js/js-service/list-account-service.js')}}"></script>
@endsection
