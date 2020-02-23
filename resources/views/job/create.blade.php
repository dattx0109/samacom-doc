@extends('layouts.base')
@section('style-top')
    <style>
        .required{
            color: red;

        }
        .salary_base_type{
            margin:0 0 !important;
        }
        .income_type{
            margin:0 0 !important;
        }
    </style>
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="single-info-page dashboard-page">
            <h3 class="dashboard-page-title">Thêm mới công việc</h3>
            <div class="dashboard-page-container">
                <form action="{{route('job-store')}}" method="post" id="create-job">
                @csrf
                    <table class="dashboard-frm-table form-table">
                        <thead>
                            <tr>
                                <th scope="row">
                                    <h3 class="text-navy">Thông tin cơ bản</h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="company_id">Chọn công ty <span class="required">*</span></label>
                                </th>
                                <td>
                                    <select name="company_id" data-placeholder="Chọn công ty ..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn công ty </option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                   <div class="error-create-job error_company_id"></div>


                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="workplace">Phân loại công việc <span class="required">*</span></label>
                                </th>
                                <td>
                                    <div class="col-lg-6">
                                        <div><label> <input type="radio" checked value="1" id="type" name="type"> Việc làm copy</label></div>
                                        <div><label> <input type="radio" value="2" id="type" name="type"> Việc làm tự đăng </label></div>
                                        <div class="error-create-job error_type"></div>
                                    </div>
                                    <div class="col-lg-6 select-employer" style="display: none">
                                        <select name="employer_id" id="employer_id" data-placeholder="Chọn nhà tuyển dụng" class="chosen-select"  tabindex="2">
                                            <option value="">Chọn nhà tuyển dụng</option>
                                            @foreach($employers as $employer)
                                                <option value="{{$employer->id}}">{{$employer->name}} {{$employer->email}}</option>
                                            @endforeach
                                        </select>
                                        <div class="error-create-job error_employer_id"></div>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="level_id">Chọn chức vụ <span class="required">*</span></label>
                                </th>
                                <td>
                                    <select name="level_id" data-placeholder="Chọn chức vụ ..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn chức vụ </option>
                                        @foreach(getRank() as $key => $rank)
                                            <option value="{{$key}}">{{$rank}}</option>
                                        @endforeach
                                    </select>
                                   <div class="error-create-job error_level_id"></div>


                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="title">Tiêu đề công việc <span class="required">*</span></label>
                                </th>
                                <td>
                                    <input value="{{ old('title') }}" type="text" name="title" placeholder="" class="form-control">
                                    <div class="error-create-job error_title"></div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="title">Hạn tuyển dụng <span class="required">*</span></label>
                                </th>
                                <td>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="job_expire" class="form-control" value="{{ old('job_expire') }}">
                                    </div>
                                    <div class="error-create-job error_job_expire"></div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="job_type">Loại việc làm <span class="required">*</span></label>
                                </th>
                                <td>
                                    <select name="job_type" data-placeholder="Loại việc làm..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn loại việc làm</option>
                                            <option  value="1">Toàn thời gian</option>
                                            <option  value="2">Partime</option>
                                            <option  value="3">Hợp đồng</option>
                                            <option  value="4">Mùa vụ</option>
                                    </select>
                                    <div class="error-create-job error_job_type"></div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="base_salary"> Lương cứng <span class="required">*</span></label>
                                </th>
                                <td>
                                    <div class="col-sm-12">
                                        <div class="row base_salary">
                                            <div class="col-md-6">
                                                <div class="input-group m-b">
                                                    <input value="{{ old('base_salary_min') }}" type="text"
                                                           name="base_salary_min" placeholder="Lương cứng tối thiểu "
                                                           class="form-control">
                                                    <span class="input-group-addon">đ</span>
                                                </div>
                                                <div class="error-create-job error_base_salary_min"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group m-b">
                                                    <input value="{{ old('base_salary_max') }}" type="text"
                                                           name="base_salary_max" placeholder="Lương cứng tối đa"
                                                           class="form-control">
                                                    <span class="input-group-addon">đ</span>
                                                </div>
                                                <div class="error-create-job error_base_salary_max"></div>

                                            </div>

                                        </div>
                                        <div class="checkbox m-r-xs">
                                            <input type="checkbox" name="salary_base_type" id="salary_base_type" value="1" class="salary_base_type">
                                            <label for="checkbox">Thoả thuận </label>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="income_min">Thu nhập <span class="required">*</span></label>
                                </th>
                                <td>
                                    <div class="col-sm-12">
                                        <div class="row income">
                                            <div class="col-md-6">
                                                <div class="input-group m-b">
                                                    <input value="{{ old('income_min') }}" type="text" name="income_min" placeholder="Thu nhập tối thiểu" class="form-control">
                                                    <span class="input-group-addon">đ</span>
                                                </div>
                                                <div class="error-create-job error_income_min"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group m-b">

                                                    <input value="{{ old('income_max') }}" type="text" name="income_max" placeholder="Thu nhập tối đa" class="form-control">

                                                    <span class="input-group-addon">đ</span>
                                                </div>
                                                <div class="error-create-job error_income_max"></div>
                                            </div>
                                        </div>
                                        <div class="checkbox m-r-xs">
                                            <input type="checkbox" name="income_type" id="income_type" value="1" class="income_type">
                                            <label for="checkbox">Thoả thuận </label>
                                        </div>
                                    </div>


                                </td>
                            </tr>
{{--                            <tr>--}}
{{--                                <th scope="row">--}}
{{--                                    <label for="income_max">Thu nhập tối đa<span class="required">*</span></label>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    --}}
{{--                                </td>--}}
{{--                            </tr>--}}
                            <tr>
                                <th scope="row">
                                    <label for="workplace">Chọn địa điểm làm việc <span class="required">*</span></label>
                                </th>
                                <td>
                                    <div class="col-ms-12">
                                        <div class="row">

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <select name="province_id" data-placeholder="Chọn tỉnh thành..." class="chosen-select"  tabindex="2">
                                            <option value="">Chọn tỉnh thành</option>
                                            @foreach($provinces as $province)
                                                <option value="{{$province->id}}">{{$province->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="error-create-job error_province"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <select name="district_id" id="district_id" data-placeholder="Chọn quận huyện..." class="chosen-select"  tabindex="2">
                                            <option value="">Chọn quận huyện</option>
                                        </select>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="workplace">Địa chỉ chính xác <span class="required">*</span></label>
                                </th>
                                <td>
                                    <input type="text" name="workplace_full_text" placeholder="Địa chỉ chính xác" class="form-control">
                                    <div class="error-create-job error_workplace_full_text"></div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="tag">Vị trí sale <span class="required">*</span></label>
                                </th>
                                <td>
                                    <select name="tag" data-placeholder="Vị trí sale" class="chosen-select"  tabindex="2">
                                        <option  value="">Vị trí sale</option>
                                        @foreach(getGroupSales() as $key => $sale)
                                            <option  value="{{$key}}">{{$sale}}</option>
                                        @endforeach
                                    </select>
                                    <div class="error-create-job error_tag"></div>
                                </td>

                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="field_work_id">Ngành nghề<span class="required">*</span></label>
                                </th>
                                <td>
                                    <select name="field_work_id" data-placeholder="Chọn lĩnh vực sale ..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn ngành nghề </option>
                                        @foreach($fieldWorks as $fieldWork)
                                            <option  value="{{$fieldWork->id}}">{{$fieldWork->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="error-create-job error_field_work_sale"></div>


                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="gender">Giới tính <span class="required">*</span></label>
                                </th>
                                <td>
                                    <select name="gender" data-placeholder="Choose a Country..." class="chosen-select"  tabindex="2">
                                        <option  value="">Chọn giới tính </option>
                                        <option  value="1"> Nam </option>
                                        <option  value="2">Nữ</option>
                                        <option  value="3">Khác</option>
                                        <option  value="4">Không yêu cầu giới tính </option>
                                    </select>
                                    <div class="error-create-job error_gender"></div>
                                </td>
                            </tr>
                        <tr>
                            <th scope="row">
                                <label for="description">Thông tin mô tả công việc <span class="required">*</span></label>
                            </th>
                            <td>
                                <textarea type="text" rows="6" class="form-control" name="description" id="description">{{old('description')}}
                                </textarea>
{{--                                <div class="description">--}}
{{--                                </div>--}}
                                <div class="error-create-job error_description"></div>
                            </td>
                        </tr>
                            <tr>
                            <th scope="row">
                                <label for="requirements">Yêu cầu công việc<span class="required">*</span></label>
                            </th>
                            <td>
                                <textarea type="text" rows="6" class="form-control" name="requirements" id="requirements">{{old('requirements')}}
                                </textarea>
{{--                                <div class="requirements">--}}
{{--                                </div>--}}
                                <div class="error-create-job error_requirements"></div>
                            </td>
                        </tr>
                            <tr>
                            <th scope="row">
                                <label for="benefit">Quyền lợi <span class="required">*</span></label>
                            </th>
                            <td>
                                <textarea type="text" rows="6" class="form-control" name="benefit" id="benefit">{{old('benefit')}}
                                </textarea>
{{--                                <div class="benefit">--}}
{{--                                </div>--}}
                                <div class="error-create-job error_benefit"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="dashboard-frm-table form-table">
                        <thead>
                            <tr>
                                <th scope="row">
                                    <h3 class="text-navy">Chân dung ứng viên</h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="character">Tính cách</label>
                                </th>
                                <td>
                                    <select name="character" data-placeholder="Chọn tính cách ..." class="chosen-select" multiple tabindex="4">
                                        @foreach($characters as $character)
                                            <option  value="{{$character->id}}">{{$character->name}}</option>
                                        @endforeach
                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="description_benefit">Kỹ năng</label>
                                </th>
                                <td>
                                    <select name="skills" data-placeholder="Chọn kỹ năng ..." class="chosen-select" multiple tabindex="4">
                                        @foreach($skills as $skills)
                                            <option  value="{{$skills->id}}">{{$skills->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for=degree"">Bằng cấp</label>
                                </th>
                                <td>
                                    <select name="degree" data-placeholder="Chọn bằng cấp..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn bằng cấp </option>
                                        @foreach(getDegree() as $key => $degree)
                                            <option  value="{{$key}}">{{$degree}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="experience">Kinh nghiệm</label>
                                </th>
                                <td>

                                    <select name="experience" data-placeholder="Chọn kinh nghiệm..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn kinh nghiệm </option>
                                        @foreach(getExperience() as $key => $experience)
                                            <option  value="{{$key}}">{{$experience}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
{{--                            <tr>--}}
{{--                                <th scope="row">--}}
{{--                                    <label for="appearance">Ngoại hình</label>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <input type="text" name="appearance" placeholder="" class="form-control">--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th scope="row">--}}
{{--                                    <label for="voice">Giọng nói</label>--}}
{{--                                </th>--}}
{{--                                <td>--}}
{{--                                    <input type="text" name="voice" placeholder="" class="form-control">--}}
{{--                                </td>--}}
{{--                            </tr>--}}

                        </tbody>
                    </table>
                </form>
                <div class="dashboard-btn-group">
                    <button type="reset" class="btn btn-white">Reset</button>
                    <button type="button" class="btn btn-primary btn-store">Lưu lại</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript-bottom')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
    <script src="{{asset('js/js-service/add-job-service.js')}}"></script>
@endsection

