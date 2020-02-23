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
            <h3 class="dashboard-page-title">Chỉnh sửa thông tin công việc</h3>
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
                                <label for="company_id">Chọn công ty <span class="required">*</span> </label>
                            </th>
                            <td>
                                <select name="company_id" data-placeholder="Chọn công ty ..." class="chosen-select"  tabindex="2">
                                    <option value="">Chọn công ty </option>
                                    @foreach($companies as $company)
                                        <option  {{($job->company_id== $company->id ? "selected":"") }} value="{{$company->id}}">{{$company->name}}</option>
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
                                    <div><label> <input type="radio" @if($job->type==1) checked @endif value="1" id="type" name="type"> Việc làm copy</label></div>
                                    <div><label> <input type="radio" value="2" @if($job->type==2) checked @endif id="type" name="type"> Việc làm tự đăng </label></div>
                                    <div class="error-create-job error_type"></div>
                                </div>
                                <div class="col-lg-6 select-employer" @if($job->type==1) style="display: none" @endif >
                                    <select name="employer_id" id="employer_id" data-placeholder="Chọn nhà tuyển dụng" class="chosen-select"  tabindex="2">
                                        <option value="">Chọn nhà tuyển dụng</option>
                                        @foreach($employers as $employer)
                                            <option @if($job->employer_id == $employer->id) selected @endif value="{{$employer->id}}">{{$employer->name . ' ( ' . $employer->email . ' )'}}</option>
                                        @endforeach
                                    </select>
                                    <div class="error-create-job error_employer_id"></div>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="level_id">Chọn chức vụ <span class="required">*</span> </label>
                            </th>
                            <td>
                                <select name="level_id" data-placeholder="Chọn chức vụ ..." class="chosen-select"  tabindex="2">
                                    <option value="">Chọn chức vụ </option>
                                    @foreach(getRank() as $key => $rank)
                                        <option {{($job->level_id== $key ? "selected":"") }} value="{{$key}}">{{$rank}}</option>
                                    @endforeach
                                </select>
                                <div class="error-create-job error_level"></div>

                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="title">Tiêu đề công việc <span class="required">*</span></label>
                            </th>
                            <td>
                                <input value="{{ $job->title }}" type="text" name="title" placeholder="" class="form-control">
                                <div class="error-create-job error_title"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="title">Hạn tuyển dụng <span class="required">*</span></label>
                            </th>
                            <td>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input
                                        type="text" name="job_expire" class="form-control"
                                        value="{{date("d-m-Y",strtotime($job->job_expire))  }}">
                                </div>
                                <div class="error-create-job error_job_expire"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="title">Loại việc làm <span class="required">*</span></label>
                            </th>
                            <td>
                                <select name="job_type" data-placeholder="Loại việc làm..." class="chosen-select"  tabindex="2">
                                    <option  value="">Chọn loại việc làm</option>
                                    <option {{($job->job_type== 1 ? "selected":"") }}  value="1">Toàn thời gian</option>
                                    <option {{($job->job_type== 2 ? "selected":"") }}  value="2">Partime</option>
                                    <option {{($job->job_type== 3 ? "selected":"") }}  value="3">Hợp đồng</option>
                                    <option  {{($job->job_type== 4 ? "selected":"") }} value="4">Mùa vụ</option>
                                </select>
                                <div class="error-create-job error_type_of_employment"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="base_salary_min">Lương cứng<span class="required">*</span></label>
                            </th>
                        <td>
                            <div class="col-sm-12">
                                <div class="row base_salary @if(empty($job->base_salary_max)) hidden @endif">
                                    <div class="col-md-6">
                                        <div class="input-group m-b">
                                            <input value="{{ (int)$job->base_salary_min }}" type="text"
                                                   name="base_salary_min" placeholder="Lương cứng tối thiểu "
                                                   class="form-control">
                                            <span class="input-group-addon">đ</span>
                                        </div>
                                        <div class="error-create-job error_base_salary_min"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group m-b">
                                            <input value="{{ (int)$job->base_salary_max }}" type="text"
                                                   name="base_salary_max" placeholder="Lương cứng tối đa"
                                                   class="form-control">
                                            <span class="input-group-addon">đ</span>
                                        </div>
                                        <div class="error-create-job error_base_salary_max"></div>

                                    </div>

                                </div>
                                <div class="checkbox m-r-xs">
                                    <input @if(empty($job->base_salary_max)) checked @endif type="checkbox" name="salary_base_type" id="salary_base_type" value="1" class="salary_base_type">
                                    <label for="checkbox">Thoả thuận </label>
                                </div>
                            </div>
                            <td>
                        <tr>
                            <th scope="row">
                                <label for="income_min">Thu nhập <span class="required">*</span></label>
                            </th>
                            <td>
                                <div class="col-sm-12">
                                    <div class="row income @if(empty($job->income_min)) hidden @endif">
                                        <div class="col-md-6">
                                            <div class="input-group m-b">
                                                <input value="{{(int)$job->income_min }}" type="text" name="income_min" placeholder="Thu nhập tối thiểu" class="form-control">
                                                <span class="input-group-addon">đ</span>
                                            </div>
                                            <div class="error-create-job error_income_min"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group m-b">

                                                <input value="{{ (int)$job->income_max }}" type="text" name="income_max" placeholder="Thu nhập tối đa" class="form-control">

                                                <span class="input-group-addon">đ</span>
                                            </div>
                                            <div class="error-create-job error_income_max"></div>
                                        </div>
                                    </div>
                                    <div class="checkbox m-r-xs">
                                        <input @if(empty($job->income_min)) checked @endif type="checkbox" name="income_type" id="income_type" value="1" class="income_type">
                                        <label for="checkbox">Thoả thuận </label>
                                    </div>
                                </div>


                            </td>
{{--                            <td>--}}
{{--                                <div class="input-group m-b">--}}
{{--                                    <input value="{{(int)$job->income_min }}" type="text" name="income_min" placeholder="" class="form-control">--}}
{{--                                    <span class="input-group-addon">đ</span>--}}
{{--                                </div>--}}
{{--                                <div class="error-create-job error_income_min"></div>--}}
{{--                            </td>--}}
                        </tr>
{{--                        <tr>--}}
{{--                            <th scope="row">--}}
{{--                                <label for="income_max">Thu nhập tối đa <span class="required">*</span></label>--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                <div class="input-group m-b">--}}
{{--                                    <input value="{{ (int)$job->income_max }}" type="text" name="income_max" placeholder="" class="form-control">--}}
{{--                                    <span class="input-group-addon">đ</span>--}}
{{--                                </div>--}}
{{--                                <div class="error-create-job error_income_max"></div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        <tr>
                            <th scope="row">
                                <label for="workplace">Chọn địa điểm làm việc <span class="required">*</span></label>
                            </th>
                            <td>
                                <div class="col-lg-6">
                                    <select name="province_id" data-placeholder="Chọn tỉnh thành..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn tỉnh thành</option>
                                        @foreach($provinces as $province)
                                            <option {{ ($job->province_id == $province->id ? "selected":"") }} value="{{$province->id}}">{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="error-create-job error_province"></div>
                                </div>
                                <div class="col-lg-6">
                                    <select name="district_id" id="district" data-placeholder="Chọn quận huyện..." class="chosen-select"  tabindex="2">
                                        <option value="">Chọn quận huyện</option>
                                        @foreach($districts as $district)
                                            <option {{ ($job->district_id == $district->id ? "selected":"") }}  value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="workplace_full_text">Địa chỉ chính xác</label>
                            </th>
                            <td>
                                <input value="{{$job->workplace_full_text}}" type="text" name="workplace_full_text" placeholder="Địa chỉ chính xác" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="workplace">Vị trí  sale <span class="required">*</span></label>
                            </th>
                            <td>
                                <?php
                                $tagIds = array();
                                if (isset($job->tags)) {
                                    foreach ($job->tags as $tag) {
                                        array_push($tagIds, (int)$tag->tag_id);
                                    }
                                }
                                ?>
                                <select name="tag" data-placeholder="Vị trí  sale" class="chosen-select"  tabindex="2">
                                    <option  value="">Vị trí sale</option>
                                    @foreach(getGroupSales() as $key => $sale)
                                        <option {{ (in_array($key,$tagIds) ? "selected":"") }}   value="{{$key}}">{{$sale}}</option>
                                    @endforeach
                                </select>
                                    <div class="error-create-job error_tag"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="field_work_id">Ngành nghề <span class="required">*</span></label>
                            </th>
                            <td>
                                <select name="field_work_id" data-placeholder="Chọn lĩnh vực sale ..." class="chosen-select"  tabindex="2">
                                    <option value="">Chọn lĩnh vực sale </option>
                                    @foreach($fieldWorks as $fieldWork)
                                        <option {{ ($job->field_work_id == $fieldWork->id ? "selected":"") }}  value="{{$fieldWork->id}}">{{$fieldWork->name}}</option>
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
                                    <option   value="">Chọn giới tính </option>
                                    <option {{ ($job->gender == 1 ? "selected":"") }}  value="1"> Nam </option>
                                    <option {{ ($job->gender == 2 ? "selected":"") }}  value="2">Nữ</option>
                                    <option {{ ($job->gender == 3 ? "selected":"") }}  value="3">Khác</option>
                                    <option {{ ($job->gender == 4 ? "selected":"") }}  value="4">Không yêu cầu giới tính </option>
                                </select>
                                <div class="error-create-job error_gender"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="description">Thông tin mô tả công việc <span class="required">*</span></label>
                            </th>
                            <td>
                                <textarea type="text" rows="6" class="form-control" name="description" id="description">{!! $job->description !!}
                                </textarea>
{{--                                <div class="description">{!! $job->description !!}--}}
{{--                                </div>--}}
                                <div class="error-create-job error_description"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="requirements">Yêu cầu công việc<span class="required">*</span></label>
                            </th>
                            <td>
                                <textarea type="text" rows="6" class="form-control" name="requirements" id="requirements">{!! $job->requirements !!}
                                </textarea>
{{--                                <div class="requirements">{!! $job->requirements !!}--}}
{{--                                </div>--}}
                                <div class="error-create-job error_requirements"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="benefit">Quyền lợi<span class="required">*</span></label>
                            </th>
                            <td>
                                <textarea type="text" rows="6" class="form-control" name="benefit" id="benefit">{!! $job->benefit !!}
                                </textarea>
{{--                                <div class="benefit">{!! $job->benefit !!}--}}
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
                                <label for="charecter">Tính cách</label>
                            </th>
                            <td>
                                <?php
                                $characterIds = array();
                                if (isset($job->characterJobs)) {
                                    foreach ($job->characterJobs as $characterJob) {
                                        array_push($characterIds, (int)$characterJob->character_id);
                                    }
                                }
                                ?>
                                <select name="character" data-placeholder="Chọn tính cách ..." class="chosen-select" multiple tabindex="4">
                                    @foreach($characters as $character)
                                        <option {{ (in_array($character->id,$characterIds) ? "selected":"") }}  value="{{$character->id}}">{{$character->name}}</option>
                                    @endforeach
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="description_benefit">Kỹ năng</label>
                            </th>
                            <td>
                                <?php
                                $skillIds = array();
                                if (isset($job->skillJobs)) {
                                    foreach ($job->skillJobs as $skillJob) {
                                        array_push($skillIds, (int)$skillJob->skill_id);
                                    }
                                }

                                ?>
                                <select name="skills" data-placeholder="Chọn kỹ năng ..." class="chosen-select" multiple tabindex="4">
                                    @foreach($skills as $skills)
                                        <option {{ (in_array($skills->id,$skillIds) ? "selected":"") }} value="{{$skills->id}}">{{$skills->name}}</option>
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
                                        <option {{ ($job->degree == $key ? "selected":"") }}  value="{{$key}}">{{$degree}}</option>
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
                                        <option {{ ($job->experience == $key ? "selected":"") }}  value="{{$key}}">{{$experience}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
{{--                        <tr>--}}
{{--                            <th scope="row">--}}
{{--                                <label for="appearance">Ngoại hình</label>--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                <input type="text" value="{{$job->appearance }}" name="appearance" placeholder="" class="form-control">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th scope="row">--}}
{{--                                <label for="voice">Giọng nói</label>--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                <input type="text" value="{{$job->voice }}" name="voice" placeholder="" class="form-control">--}}
{{--                            </td>--}}
{{--                        </tr>--}}

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
    <script src="{{asset('js/js-service/update-job-service.js')}}"></script>
@endsection

