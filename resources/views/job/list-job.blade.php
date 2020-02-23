@extends('layouts.base')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title margin-ibox-title">
                    <div class="headerbox-add-box">
                        <h3>Công việc</h3>
                        <div class="ibox-tools">
                            <div class="ibox-tools">
                                <a href="{{route('job-create')}}" class="">
                                    <button type="button" class="btn btn-primary ibox-tool-add-new">
                                        <i class="fa fa-plux"></i>Thêm mới
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="headerbox-filter-box">
                        <form role="form" action="/danh-sach-cong-viec" method="GET">
                            <div class="headerbox-filter-item">
                                <input type="text" id="title" name="title" placeholder="Tên công việc" value="{{request()->title}}">
                                <button type="submit">Tìm</button>
                            </div>
                            <div class="headerbox-filter-item">
                                <select name="salary" id="salary">
                                    <option {{request()->salary ==''?'selected':"" }} value="">Mức thu nhập</option>
                                    <option {{request()->salary ==1?'selected':"" }} value="1">< 6 triệu</option>
                                    <option {{request()->salary ==2?'selected':"" }} value="2">6 - 8 triệu</option>
                                    <option {{request()->salary ==3?'selected':"" }} value="3">8 - 10 triệu</option>
                                    <option {{request()->salary ==4?'selected':"" }} value="4">10 - 15 triệu</option>
                                    <option {{request()->salary ==5?'selected':"" }} value="5">15 - 20 triệu</option>
                                    <option {{request()->salary ==6?'selected':"" }} value="6">20 - 30 triệu</option>
                                    <option {{request()->salary ==7?'selected':"" }} value="7">30 - 50 triệu</option>
                                    <option {{request()->salary ==8?'selected':"" }} value="8">50 - 100 triệu</option>
                                    <option {{request()->salary ==9?'selected':"" }} value="9"> > 100 triệu</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </div>
                            <div class="headerbox-filter-item">
                                <select name="sale" id="sale">
                                    <option {{request()->sale ==''?'selected':"" }}  value="">Vị trí sales</option>
                                    <option {{request()->sale ==1?'selected':"" }} value="1">Sale Admin</option>
                                    <option {{request()->sale ==2?'selected':"" }} value="2">Telesales</option>
                                    <option {{request()->sale ==3?'selected':"" }} value="3">Sale tư vấn</option>
                                    <option {{request()->sale ==4?'selected':"" }} value="4">Sale thị trường</option>
                                    <option {{request()->sale ==5?'selected':"" }} value="5">Sale bán hàng</option>
                                    <option {{request()->sale ==6?'selected':"" }} value="6">Sale online</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </div>
                            <br/><br/>
                            <div class="headerbox-filter-item">
                                <select name="orderByJob" id="orderByJob">
                                    <option value="" {{request()->orderByJob == ''? 'selected': ""}}>Thời gian tạo công việc</option>
                                    <option value="1" {{request()->orderByJob == 1 ? 'selected': ""}}> Mới nhất </option>
                                    <option value="2" {{request()->orderByJob == 2 ? 'selected': ""}}> Cũ nhất</option>
                                </select>
                                <input type="submit" name="" value="Sắp xếp">
                            </div>
                            <div class="headerbox-filter-item">
                                <select name="orderBySale" id="orderBySale">
                                    <option value="" {{request()->orderBySale == '' ? 'selected': ""}}>Mức thu nhập </option>
                                    <option value="1" {{request()->orderBySale == 1 ? 'selected': ""}}>Từ cao xuống thấp</option>
                                    <option value="2" {{request()->orderBySale == 2 ? 'selected': ""}}>Từ thấp lên cao</option>
                                </select>
                                <input type="submit" name="" value="Sắp xếp">
                            </div>
                            <div class="headerbox-filter-item">
                                <select name="orderByPost" id="orderByPost">
                                    <option value="" {{request()->orderByPost == '' ? 'selected': ""}}>Số lượng ứng tuyển</option>
                                    <option value="1" {{request()->orderByPost == 1 ? 'selected': ""}}> Cao nhất</option>
                                    <option value="2" {{request()->orderByPost == 2 ? 'selected': ""}}> Thấp nhất</option>
                                </select>
                                <input type="submit" name="" value="Sắp xếp">
                                <button type="button" id="reset_fillter">Làm mới bộ lọc</button>
                            </div>
                        </form>
{{--                        <div class="headerbox-items-count">100 mục</div>--}}
                    </div>
                </div>
                <div class="ibox-content no-padding">
                    <div class="table-responsive">
                        <table class="table table-striped boxshadow-table">
                            <thead>
                            <tr>
                                <th>Tên công việc</th>
                                <th>Công ty</th>
                                <th>Thu nhập</th>
                                <th>Ngày tuyển dụng</th>
                                <th>Hạn tuyển dụng</th>
                                <th>Khu vực</th>
                                <th>Phân loại công việc</th>
                                <th>Số lượng ứng tuyển</th>
                                <th>Nhóm sales</th>
                                <th>Trạng thái</th>
                                <th>Thời gian cập nhật</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listJob as $item)
                                <tr>
                                    <td>
                                        <a href="{{route('job-detail',['id'=>$item->id])}}" class="table-title-link">
                                            {{$item->title}}
                                        </a>
                                        <div class="table-row-action">
                                            <span class="edit">
                                                <a href="{{route('job-detail',['id'=>$item->id])}}">Xem</a>
                                            </span>
                                            |
                                            <span class="edit">
                                                <a href="{{route('job-show',['id'=>$item->id])}}">Sửa</a>
                                            </span>

                                        </div>
                                    </td>
                                    <td>{{ $item->short_name ? $item->short_name : $item->name }}</td>
                                    <td>
                                        @if(empty($item->income_min))
                                            Thoả thuận
                                        @endif
                                        @if(!empty($item->income_min))
                                            @if($item->income_min == $item->income_max)
                                                {{number_format($item->income_min)}} đ
                                            @else
                                                {{number_format($item->income_min)}} đ
                                                - {{number_format($item->income_max)}} đ
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{$item->job_publish}}</td>
                                    <td>{{$item->job_expire}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>
                                        @if($item->type == 1)
                                            <label class="label label-info">Công việc copy </label>
                                        @endif
                                            @if($item->type == 2)
                                            <label class="label label-danger">Công việc tự đăng </label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('list-apply-job',['id'=>$item->id])}}">{{array_key_exists($item->id,$countApply)?$countApply[$item->id]:0}}</a>
                                    </td>
                                    <td>
                                       <span class="label label-success">{{getParseSales($item->tag_id)}}</span>
                                    </td>
                                    <td>
                                        @if($item->is_public==null)
                                            Chưa Public
                                        @else
                                            @if($item->is_show==1)
                                                Đang hiển thị
                                            @else
                                                Đang ẩn
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->updated_at ? $item->updated_at : ''  }}
                                    </td>
                                    <td>
                                        @if($item->is_public==null)
                                            <button data-id ={{$item->id}} type="button" class="btn btn-warning btn-sm btn-modal-public" data-toggle="modal"
                                                    data-target="#public-job">Public Job
                                            </button>
                                        @endif
                                        @if($item->is_public!=null)
                                            @if($item->is_show==1)
                                                    <button data-id ={{$item->id}} type="button" class="btn btn-warning btn-sm btn-modal-hide" data-toggle="modal" data-target="#hidden-job">Ẩn Job</button>

                                            @endif
                                            @if($item->is_show==2)
                                                    <button data-id ={{$item->id}} type="button" class="btn btn-warning btn-sm btn-modal-show" data-toggle="modal"  data-target="#show-job">Hiện Job</button>

                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(($listJob->total()) === 0)
                            <div class="alert alert-info" role="alert">
                                Không tìm thấy công việc.
                            </div>
                        @endif
                        {{ $listJob->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="public-job" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title text-center">Bạn có muốn public job này ?</h3>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-public-job" >Đồng ý</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

            <!-- Modal -->
            <div class="modal fade" id="hidden-job" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title text-center">Bạn có muốn ẩn Job này ?</h3>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <button type="button" class="btn btn-danger btn-hidden-job" >Đồng ý</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="show-job" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title text-center">Bạn có muốn hiện lại Job này ?</h3>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <button type="button" class="btn btn-danger btn-show-job" >Đồng ý</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
@endsection
@section('javascript-bottom')
        <script src="{{asset('js/js-service/list-job-service.js')}}"></script>
@endsection

