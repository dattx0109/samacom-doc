<?php


namespace App\Repository\Jobs;


use App\Repository\Company\CompanyRepository;
use App\Repository\District\DistrictRepository;
use App\Repository\Employer\EmployerRepository;
use App\Repository\FieldWork\FieldWorkRepository;
use App\Repository\Province\ProvinceRepository;
use App\Repository\Skill\SkillRepository;
use Illuminate\Support\Facades\DB;

class DetailJobRepository
{
    const TABLE_NAME = 'jobs';
    const TAG_TABLE_NAME = 'tags';
    const SKILL_JOB_TABLE_NAME = 'skill_job';
    const CHARACTER_JOB_TABLE_NAME = 'character_job';
    const CHARACTER_TABLE_NAME = 'character';

    public function getDetail($id)
    {
        $job = DB::table(self::TABLE_NAME)
                        ->leftJoin(InsertEmployerDescriptionRepository::TABLE_NAME, InsertEmployerDescriptionRepository::TABLE_NAME.'.id', '=',
                self::TABLE_NAME.'.employee_description_id')
            ->leftJoin( InsertJobDescriptionRepository::TABLE_NAME,
                InsertJobDescriptionRepository::TABLE_NAME.'.id', '=', self::TABLE_NAME.'.job_description_id')
            ->leftJoin(ProvinceRepository::TABLE_NAME,
                ProvinceRepository::TABLE_NAME.'.id', '=', self::TABLE_NAME.'.province_id')
            ->leftJoin(CompanyRepository::TABLE_NAME,
                CompanyRepository::TABLE_NAME.'.id', '=', self::TABLE_NAME.'.company_id')
            ->leftJoin(DistrictRepository::DATA_TABLE,
                DistrictRepository::DATA_TABLE.'.id', '=', self::TABLE_NAME.'.district_id')
            ->leftJoin(EmployerRepository::TABLE_NAME,
                EmployerRepository::TABLE_NAME.'.id', '=', self::TABLE_NAME.'.employer_id')
            ->leftJoin(FieldWorkRepository::TABLE_NAME,
                FieldWorkRepository::TABLE_NAME.'.id', '=', self::TABLE_NAME.'.field_work_id')
            ->where(self::TABLE_NAME.'.id', $id)
            ->select(self::TABLE_NAME.'.title', self::TABLE_NAME.'.income_min',
                self::TABLE_NAME.'.job_publish', self::TABLE_NAME.'.job_expire',
                self::TABLE_NAME.'.income_max', self::TABLE_NAME.'.base_salary_min',
                self::TABLE_NAME.'.base_salary_max', self::TABLE_NAME.'.province_id', self::TABLE_NAME.'.district_id',
                self::TABLE_NAME.'.job_description_id', self::TABLE_NAME.'.employee_description_id',
                self::TABLE_NAME.'.level_id', self::TABLE_NAME.'.job_type', self::TABLE_NAME.'.province_id',
                self::TABLE_NAME.'.district_id', self::TABLE_NAME.'.workplace_full_text',
                self::TABLE_NAME.'.field_work_id',self::TABLE_NAME.'.type',
                self::TABLE_NAME.'.employer_id', self::TABLE_NAME.'.gender',
                self::TABLE_NAME.'.is_show', self::TABLE_NAME.'.is_public',self::TABLE_NAME.'.id',
                ProvinceRepository::TABLE_NAME.'.name as province_name',
                DistrictRepository::DATA_TABLE.'.name as district_name',
                InsertJobDescriptionRepository::TABLE_NAME.'.description',
                InsertJobDescriptionRepository::TABLE_NAME.'.requirements',
                InsertJobDescriptionRepository::TABLE_NAME.'.benefit',
                InsertEmployerDescriptionRepository::TABLE_NAME.'.degree',
                InsertEmployerDescriptionRepository::TABLE_NAME.'.experience',
                InsertEmployerDescriptionRepository::TABLE_NAME.'.appearance',
                InsertEmployerDescriptionRepository::TABLE_NAME.'.voice',
                InsertEmployerDescriptionRepository::TABLE_NAME.'.created_at',
                InsertEmployerDescriptionRepository::TABLE_NAME.'.updated_at',
                EmployerRepository::TABLE_NAME.'.name as employer_name',
                EmployerRepository::TABLE_NAME.'.email as employer_email',
                FieldWorkRepository::TABLE_NAME.'.name as field_work_name',
                CompanyRepository::TABLE_NAME.'.name as company_name',
                CompanyRepository::TABLE_NAME.'.id as company_id',
                CompanyRepository::TABLE_NAME.'.short_name as company_short_name'
                )
            ->first();
        if (!empty($job)) {
            $tag = DB::table(self::TAG_TABLE_NAME)->where('job_id', $id)->get()->toArray();
            $skillJobs = DB::table(self::SKILL_JOB_TABLE_NAME)
                ->join(SkillRepository::TABLE_NAME,SkillRepository::TABLE_NAME.'.id' ,'=',self::SKILL_JOB_TABLE_NAME.'.skill_id')
                ->where('job_id', $id)
                ->get()->toArray();
            $characterJobs = DB::table(self::CHARACTER_JOB_TABLE_NAME)
                            ->join(self::CHARACTER_TABLE_NAME,self::CHARACTER_TABLE_NAME.'.id','=',self::CHARACTER_JOB_TABLE_NAME.'.character_id')
                            ->where('job_id', $id)->get()->toArray();
        }

        if (!empty($tag)) {
            $job->tags = $tag;
        }
        if (!empty($characterJobs)) {
            $job->characterJobs = $characterJobs;
        }
        if (!empty($skillJobs)) {
            $job->skillJobs = $skillJobs;
        }
//dd($job);
        return $job;

    }
}
