<?php


namespace App\Service\Job;

use App\Mail\Mailer;
use App\Repository\CharacterJob\CharacterJobRepository;
use App\Repository\Job\JobRepository;
use App\Repository\Job\ListEmployesApplyJobRepository;
use App\Repository\Jobs\DeleteEmployerDescriptionRepository;
use App\Repository\Jobs\DeleteJobDescriptionRepository;
use App\Repository\Jobs\DetailJobRepository;
use App\Repository\Jobs\InsertEmployerDescriptionRepository;
use App\Repository\Jobs\InsertJobDescriptionRepository;
use App\Repository\Jobs\InsertJobRepository;
use App\Repository\Jobs\UpdateJobRepository;
use App\Repository\SkillJob\SkillJobRepository;
use App\Repository\Tag\TagRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class JobService
{
    private $insertJobDescriptionRepository;
    private $insertEmployerDescriptionRepository;
    private $insertJobRepository;
    private $detailJobRepository;
    private $jobRepository;
    private $tagRepository;
    private $deleteJobDescriptionRepository;
    private $deleteEmployerDescriptionRepository;
    private $updateJobRepository;
    private $skillJobRepository;
    private $characterJobRepository;
    private $employerApplyJobRepository;

    public function __construct(
        InsertJobDescriptionRepository $insertJobDescriptionRepository,
        InsertEmployerDescriptionRepository $insertEmployerDescriptionRepository,
        InsertJobRepository $insertJobRepository,
        DetailJobRepository $detailJobRepository,
        JobRepository $jobRepository,
        TagRepository $tagRepository,
        DeleteJobDescriptionRepository $deleteJobDescriptionRepository,
        DeleteEmployerDescriptionRepository $deleteEmployerDescriptionRepository,
        UpdateJobRepository $updateJobRepository,
        SkillJobRepository $skillJobRepository,
        CharacterJobRepository $characterJobRepository,
        ListEmployesApplyJobRepository $employerApplyJobRepository
    ) {
        $this->insertJobDescriptionRepository = $insertJobDescriptionRepository;
        $this->insertEmployerDescriptionRepository = $insertEmployerDescriptionRepository;
        $this->insertJobRepository = $insertJobRepository;
        $this->detailJobRepository = $detailJobRepository;
        $this->jobRepository = $jobRepository;
        $this->tagRepository = $tagRepository;
        $this->deleteJobDescriptionRepository = $deleteJobDescriptionRepository;
        $this->deleteEmployerDescriptionRepository = $deleteEmployerDescriptionRepository;
        $this->updateJobRepository = $updateJobRepository;
        $this->skillJobRepository = $skillJobRepository;
        $this->characterJobRepository = $characterJobRepository;
        $this->employerApplyJobRepository = $employerApplyJobRepository;
    }

    public function getAllJob($rawData)
    {
        return $this->jobRepository->getAllJob($rawData);
    }

    public function insert($rawData)
    {
        DB::beginTransaction();
        try {
            $rawData['job_description_id']      = $this->insertJobDescriptionRepository->insert($rawData);
            $rawData['employee_description_id'] = $this->insertEmployerDescriptionRepository->insert($rawData);
            $rawData['slug']                    = str_slug($rawData['title'], '-');
            $checkTitle                         = $this->insertJobRepository->checkTitleExist($rawData['title']);
            if (intval($checkTitle)) {
                $rawData['slug'] .= '-'.intval($checkTitle);
            }
            $jobId = $this->insertJobRepository->insert($rawData);
            if (!empty($rawData['tag'])) {
                $dataTagInsert = [
                    'job_id' => $jobId,
                    'tag_id' => $rawData['tag'],
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")];

                $this->tagRepository->insert($dataTagInsert);
            }
            $this->insertSkillJob($rawData, $jobId);
            $this->insertCharacterJob($rawData, $jobId);
            DB::commit();
            return $jobId;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function getDetail($id)
    {
        return $this->detailJobRepository->getDetail($id);
    }

    public function update($dataUpdate)
    {
        $job = $this->detailJobRepository->getDetail($dataUpdate['job_id']);
        if (empty($job)) {
            return view('error.403');
        }
        DB::beginTransaction();
        try {
            //todo delete data old
            $this->deleteEmployerDescriptionRepository->delete($job->employee_description_id);
            $this->deleteJobDescriptionRepository->delete($job->job_description_id);
            $this->tagRepository->delete($dataUpdate['job_id']);
            $this->characterJobRepository->deleteCharacterJob($dataUpdate['job_id']);
            $this->skillJobRepository->deleteSkillJob($dataUpdate['job_id']);
            //todo insert and update data new
            $dataUpdate['job_description_id']      = $this->insertJobDescriptionRepository->insert($dataUpdate);
            $dataUpdate['employee_description_id'] = $this->insertEmployerDescriptionRepository->insert($dataUpdate);
            $this->insertSkillJob($dataUpdate, $dataUpdate['job_id']);
            $this->insertCharacterJob($dataUpdate, $dataUpdate['job_id']);

            $dataUpdate['slug'] = str_slug($dataUpdate['title'], '-');
            $checkTitle         = $this->insertJobRepository->checkTitleExist($dataUpdate['title'], $dataUpdate['job_id']);
            if (intval($checkTitle)) {
                $dataUpdate['slug'] .= '-'.intval($checkTitle);
            }
            $this->updateJobRepository->update($dataUpdate);
            if (!empty($dataUpdate['tag'])) {
                $dataTagInsert = [
                    'job_id' => $dataUpdate['job_id'],
                    'tag_id' => $dataUpdate['tag'],
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")];

                $this->tagRepository->insert($dataTagInsert);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function insertSkillJob($rawData, $jobId)
    {
        if (!empty($rawData['skills'])) {
            $dataInsert = [];
            foreach ($rawData['skills'] as $skill) {
                array_push($dataInsert, [
                    'job_id' => $jobId,
                    'skill_id' => $skill,
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]);
            }
            $this->skillJobRepository->insert($dataInsert);
        }
    }

    public function insertCharacterJob($rawData, $jobId)
    {
        if (!empty($rawData['character'])) {
            $dataInsert = [];
            foreach ($rawData['character'] as $charecter) {
                array_push($dataInsert, [
                    'job_id' => $jobId,
                    'character_id' => $charecter,
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]);
            }
            $this->characterJobRepository->insert($dataInsert);
        }
    }

    /**
     * @param $id
     * @param $dataChange
     */
    public function changeHiddenShow($id, $dataChange)
    {
        $this->jobRepository->changeHiddenShow($id, $dataChange);
    }

    /**
     * @param $id
     */
    public function publicJob($id)
    {
        DB::beginTransaction();
        try {
            // update status job
            $this->jobRepository->publicJob($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function countApplyJob()
    {
        $data = $this->employerApplyJobRepository->countApplyJob();
        $countApply = [];

        foreach ($data as $item) {
            $countApply[$item->job_id] = $item->count;
        }
        return $countApply;
    }
}
