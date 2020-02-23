<?php


namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeShowJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Repository\Job\JobRepository;
use App\Repository\Job\ListEmployesApplyJobRepository;
use App\Service\AuthorizationService\AuthorizationService;
use App\Service\AuthorizationService\PermissionConstant;
use App\Service\Character\CharacterService;
use App\Service\District\DistrictService;
use App\Service\Employer\EmployerService;
use App\Service\FieldWork\FieldWorkService;
use App\Service\File\FileServiceConst;
use App\Service\Job\JobService;
use App\Http\Requests\CreateJobRequest;
use App\Service\Company\CompanyService;
use App\Service\job\ListEmployesApplyJobService;
use App\Service\Mail\MailService;
use App\Service\Province\ProvinceService;
use App\Service\Skill\SkillService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
class JobController extends Controller
{
    private $jobService;
    private $provinceService;
    private $companyService;
    private $districtService;
    private $authorizationService;
    private $fieldWorkService;
    private $skillService;
    private $characterService;
    private $employerService;
    private $mailService;
    private $listUvApplayJobService;
    public function __construct(
        JobService $jobService,
        ProvinceService $provinceService,
        CompanyService $companyService,
        DistrictService $districtService,
        AuthorizationService $authorizationService,
        FieldWorkService $fieldWorkService,
        SkillService $skillService,
        CharacterService $characterService,
        EmployerService $employerService,
        MailService $mailService,
        ListEmployesApplyJobService $listUvApplayJobService
    ) {
        $this->provinceService = $provinceService;
        $this->jobService = $jobService;
        $this->companyService = $companyService;
        $this->districtService = $districtService;
        $this->authorizationService = $authorizationService;
        $this->fieldWorkService = $fieldWorkService;
        $this->skillService = $skillService;
        $this->characterService = $characterService;
        $this->employerService = $employerService;
        $this->mailService = $mailService;
        $this->listUvApplayJobService = $listUvApplayJobService;
    }

    public function index()
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::JOB_SYS_LIST_VIEW)
            ->checkPermission()
        ;
        if (!$isAccess) {
            return view('error.403');
        }
        $rawData = request()->input();
        $listJob = $this->jobService->getAllJob($rawData);
        $countApply = $this->jobService->countApplyJob();
        return view('job.list-job', ['listJob'=>$listJob,'countApply'=>$countApply]);
    }

    public function create()
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::JOB_SYS_DETAIL_ADD)
            ->checkPermission()
        ;
        if (!$isAccess) {
            return view('error.403');
        }
        $companies = $this->companyService->getListDescById();
        $provinces = $this->provinceService->getList();
        $fieldWorks = $this->fieldWorkService->getList();
        $skills = $this->skillService->getList();
        $characters = $this->characterService->getList();
        $employers = $this->employerService->listAllEmployer();
        return view('job.create', [
            'provinces' => $provinces,
            'companies' => $companies,
            'fieldWorks' => $fieldWorks,
            'skills' => $skills,
            'characters' => $characters,
            'employers' => $employers
        ]);
    }
    public function store(CreateJobRequest $request)
    {

        $userLogin = request()->user;
        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::JOB_SYS_DETAIL_ADD)
            ->checkPermission()
        ;
        if (!$isAccess) {
            return response()->json([], 403);
        }
        $this->jobService->insert($request->all());
    }
    public function detail($id)
    {

        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::JOB_SYS_DETAIL_VIEW)
            ->checkPermission()
        ;
        if (!$isAccess) {
            return view('error.403');
        }
        $job = $this->jobService->getDetail($id);
        if (empty($job)) {
            return view('error.403');
        }
        return view('job.detail', ['job' =>$job]);
    }

    public function getCvApplyJobByJobId($id)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::JOB_SYS_DETAIL_VIEW)
            ->checkPermission()
        ;
        if (!$isAccess) {
            return view('error.403');
        }
        $job = $this->jobService->getDetail($id);
        if (empty($job)) {
            return view('error.403');
        }
        $listUvApplyJob = $this->listUvApplayJobService->getListUVApplyJob($id);
//        dd($listUvApplyJob);
        return view('job.list-uv-apply', ['listUvApplyJob' =>$listUvApplyJob]);
    }

    public function show($id)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::JOB_SYS_DETAIL_EDIT)
            ->checkPermission();
        if (!$isAccess) {
            return view('error.403');
        }
        $job = $this->jobService->getDetail($id);
        if (empty($job)) {
            return view('error.404');
        }
        $companies = $this->companyService->getListDescById();
        $provinces = $this->provinceService->getList();
        $fieldWorks = $this->fieldWorkService->getList();
        $skills = $this->skillService->getList();
        $characters = $this->characterService->getList();
        $districts = $this->districtService->getList($job->province_id);
        $employers = $this->employerService->listAllEmployer();
        return view('job.show', [
            'provinces' => $provinces,
            'companies' => $companies,
            'job' => $job,
            'districts' => $districts,
            'fieldWorks' => $fieldWorks,
            'skills' => $skills,
            'characters' => $characters,
            'employers' => $employers
        ]);
    }
    public function update(UpdateJobRequest $request, $id)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::JOB_SYS_DETAIL_EDIT)
            ->checkPermission()
        ;
        if (!$isAccess) {
            return response()->json([], 403);
        }
        $this->jobService->update($request->all());
    }

    /**
     * @param $id
     * @param ChangeShowJobRequest $request
     * @return ResponseFactory|Response
     */
    public function changeShowJob($id, ChangeShowJobRequest $request)
    {

        $this->jobService->changeHiddenShow($id, $request->all());
        return response('success', 200);
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     */
    public function publicJob($id)
    {
        $publicJob = $this->jobService->publicJob($id);
        if (!$publicJob) {
            return response('error', 400);
        }
        $job = $this->jobService->getDetail($id);
        if ($job->type == JobRepository::JOB_TYPE_EMPLOYER) {
            $this->mailService->sendMailPublicJob($job);
        }

        return response('success', 200);
    }
}
