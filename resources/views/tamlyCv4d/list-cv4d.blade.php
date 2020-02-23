@extends('tamlyCv4d.baseTamLyCv4d')

@section('content-tam-ly-cv4d')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content no-padding">
                    <div class="table-responsive">
                        <table class="table table-striped checkbox-table boxshadow-table">
                            <thead>
                            <tr>
                                <th>
                                    STT
                                </th>
                                <th>Tên khách hàng cần CV-4D</th>
                                <th>Giới tính</th>
                                <th>Giọng nói</th>
                                <th>Khuôn mặt</th>
                                <th>Khí chất</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Năm sinh</th>
                                <th>Loại khảo sát</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                            @foreach($listCv4d as $list)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        {{isset($list->ten)?$list->ten:'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->gioi_tinh)?$list->gioi_tinh==1?'Nam':'Nữ':'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->giong_noi)?$list->giong_noi==1?'Mỏng':'Dày':'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->khuon_mat)?$list->khuon_mat==1?'Mềm mỏng':'Góc cạnh':'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->khi_chat)?$list->khi_chat==1?'Dễ gần':'Khó gần':'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->so_dien_thoai)?$list->so_dien_thoai:'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->email)?$list->email:'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->nam_sinh)?$list->nam_sinh:'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        @if($list->type == 1) Thần thái
                                        @elseif($list->type == 2) Nhân khẩu học
                                        @elseif($list->type == 3) Nhan tướng học
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach
                            </tbody>
                            {{ $listCv4d->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="export">
        <a href ="{{ route('exportCv4d') }}" class="btn btn-info export" id="export-button"> Export file </a>
    </div>

@endsection
@section('javascript-bottom')
    <script>
        $(document).ready(function(){
            $('.chosen-select').chosen({width: "100%"});
            $( "td:contains('Không có dữ liệu')" ).addClass('null-info-block');
        });
        $('.btn-store').on('click', function (){
            $('#create-job').submit();
        })
    </script>
@endsection
