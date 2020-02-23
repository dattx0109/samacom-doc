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
                                <th>Tên khách hàng cần khảo sát tâm lý</th>
                                <th>Giọng nói của KH cần khảo sát</th>
                                <th>Khuôn mặt của KH cần khảo sát</th>
                                <th>Khí chất của KH cần khảo sát</th>
                                <th>Năm sinh của KH cần khảo sát</th>
                                <th>Lĩnh vực hoạt động của KH cần khảo sát</th>
                                <th>Giới tính của KH cần khảo sát</th>
                                <th>Tên KH để gửi thông tin</th>
                                {{--<th>Giới tính KH</th>--}}
                                <th>Năm sinh KH</th>
                                <th>SDT của KH</th>
                                <th>Email KH</th>
                                <th>Ngành KH đang làm</th>
                                {{--<th>Vị trí sale KH của KH</th>--}}
                                <th>Loại khảo sát</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1 ?>
                                @foreach($listTamLyKh as $list)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>
                                        {{isset($list->ten_KH)?$list->ten_KH:'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->giong_noi_KH)?$list->giong_noi_KH==1?'Mỏng':'Dày':'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->khuon_mat_KH)?$list->khuon_mat_KH==1?'Mềm mỏng':'Góc cạnh':'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->khi_chat_KH)?$list->khi_chat_KH==1?'Dễ gần':'Khó gần':'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->nam_sinh_KH)?$list->nam_sinh_KH:'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->linh_vuc_hoat_dong_KH)?$list->linh_vuc_hoat_dong_KH:'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->gioi_tinh_KH)?$list->gioi_tinh_KH==1?'Nam':'Nữ':'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->ten_lien_lac)?$list->ten_lien_lac:'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->gioi_tinh)?$list->gioi_tinh==1?'Nam':'Nữ':'Không có dữ liệu'}}
                                    </td>
                                    {{--<td>--}}
                                        {{--{{isset($list->nam_sinh)?$list->nam_sinh:'Không có dữ liệu'}}--}}
                                    {{--</td>--}}
                                    <td>
                                        {{isset($list->sdt)?$list->sdt:'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->email)?$list->email:'Không có dữ liệu'}}
                                    </td>
                                    <td>
                                        {{isset($list->nganh_dang_lam)?$list->nganh_dang_lam:'Không có dữ liệu'}}
                                    </td>
                                    {{--<td>--}}
                                        {{--{{isset($list->vi_tri_sale)?$list->vi_tri_sale:'Không có dữ liệu'}}--}}
                                    {{--</td>--}}
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
                            {{ $listTamLyKh->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="export">
        <a href ="{{ route('exportTamLyKh') }}" class="btn btn-info export" id="export-button"> Export file </a>
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
