<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\InterviewCriteria;
use App\Models\InterviewRatingScale;
use App\Models\TesKemampuanCriteria;
use App\Models\TesKemampuanRatingScale;
use Illuminate\Support\Str;

class RatingScalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all jobs
        $jobs = Job::all();

        // Create criteria and rating scales for each job
        foreach ($jobs as $job) {
            $this->createInterviewCriteria($job);
            $this->createTesKemampuanCriteria($job);
        }
    }

    /**
     * Create interview criteria and rating scales for a job
     *
     * @param Job $job
     * @return void
     */
    private function createInterviewCriteria(Job $job)
    {
        // Create qualification criteria
        $qualifikasi = InterviewCriteria::create([
            'criteria_id' => 'INT_QUAL_' . $job->job_id . '_' . Str::random(5),
            'job_id' => $job->job_id,
            'name' => 'Kualifikasi',
            'code' => 'K1',
            'description' => 'Kesesuaian kualifikasi dan pengalaman kandidat dengan posisi ' . $job->nama_job,
            'weight' => 0.33,
        ]);

        // Create communication criteria
        $komunikasi = InterviewCriteria::create([
            'criteria_id' => 'INT_KOMN_' . $job->job_id . '_' . Str::random(5),
            'job_id' => $job->job_id,
            'name' => 'Komunikasi',
            'code' => 'K2',
            'description' => 'Kemampuan berkomunikasi dan menyampaikan ide',
            'weight' => 0.33,
        ]);

        // Create attitude criteria
        $sikap = InterviewCriteria::create([
            'criteria_id' => 'INT_SIKP_' . $job->job_id . '_' . Str::random(5),
            'job_id' => $job->job_id,
            'name' => 'Sikap',
            'code' => 'K3',
            'description' => 'Sikap profesional dan etika kerja',
            'weight' => 0.33,
        ]);

        // Create rating scales for each criteria
        $this->createInterviewRatingScales($qualifikasi);
        $this->createInterviewRatingScales($komunikasi);
        $this->createInterviewRatingScales($sikap);
    }

    /**
     * Create rating scales for an interview criteria
     *
     * @param InterviewCriteria $criteria
     * @return void
     */
    private function createInterviewRatingScales(InterviewCriteria $criteria)
    {
        // Define rating descriptions based on criteria type
        $descriptions = [];

        if ($criteria->name === 'Kualifikasi') {
            $descriptions = [
                1 => 'Sangat tidak memenuhi kualifikasi yang dibutuhkan untuk posisi ini',
                2 => 'Kurang memenuhi kualifikasi dasar yang dibutuhkan',
                3 => 'Memenuhi kualifikasi dasar yang dibutuhkan',
                4 => 'Memenuhi semua kualifikasi dengan baik',
                5 => 'Melebihi semua kualifikasi yang dibutuhkan dengan sangat baik'
            ];
        } elseif ($criteria->name === 'Komunikasi') {
            $descriptions = [
                1 => 'Komunikasi sangat buruk, sulit dipahami dan tidak jelas',
                2 => 'Komunikasi kurang baik, terkadang tidak jelas',
                3 => 'Komunikasi cukup baik dan dapat dipahami',
                4 => 'Komunikasi baik, jelas dan efektif',
                5 => 'Komunikasi sangat baik, sangat jelas, efektif dan persuasif'
            ];
        } elseif ($criteria->name === 'Sikap') {
            $descriptions = [
                1 => 'Sikap sangat buruk, tidak profesional dan tidak menunjukkan etika kerja',
                2 => 'Sikap kurang baik, kurang profesional',
                3 => 'Sikap cukup baik dan profesional',
                4 => 'Sikap baik, profesional dan menunjukkan etika kerja yang baik',
                5 => 'Sikap sangat baik, sangat profesional dan menunjukkan etika kerja yang sangat baik'
            ];
        }

        // Create rating scales
        for ($i = 1; $i <= 5; $i++) {
            InterviewRatingScale::create([
                'id' => 'INT_RATE_' . $criteria->criteria_id . '_' . $i,
                'criteria_id' => $criteria->criteria_id,
                'rating_level' => $i,
                'name' => $this->getRatingName($i),
                'description' => $descriptions[$i] ?? "Level $i"
            ]);
        }
    }

    /**
     * Create skill test criteria and rating scales for a job
     *
     * @param Job $job
     * @return void
     */
    private function createTesKemampuanCriteria(Job $job)
    {
        // Define descriptions based on job type
        $description = 'Kemampuan teknis untuk posisi ' . $job->nama_job;

        // Create specific descriptions for some job types
        if (stripos($job->nama_job, 'Chef') !== false || stripos($job->nama_job, 'Cook') !== false) {
            $description = 'Kemampuan memasak dan pengetahuan kuliner';
        } elseif (stripos($job->nama_job, 'Pastry') !== false || stripos($job->nama_job, 'Baker') !== false) {
            $description = 'Kemampuan membuat kue dan roti';
        } elseif (stripos($job->nama_job, 'Server') !== false || stripos($job->nama_job, 'Waiter') !== false) {
            $description = 'Kemampuan melayani tamu dan pengetahuan produk';
        } elseif (stripos($job->nama_job, 'Barista') !== false) {
            $description = 'Kemampuan membuat kopi dan pengetahuan tentang kopi';
        }

        // Create the criteria
        $criteria = TesKemampuanCriteria::create([
            'criteria_id' => 'TES_' . $job->job_id . '_' . Str::random(5),
            'job_id' => $job->job_id,
            'name' => 'Kemampuan Teknis',
            'code' => 'T1',
            'description' => $description,
            'weight' => 1.0,
        ]);

        // Create rating scales
        $this->createTesKemampuanRatingScales($criteria);
    }

    /**
     * Create rating scales for a skill test criteria
     *
     * @param TesKemampuanCriteria $criteria
     * @return void
     */
    private function createTesKemampuanRatingScales(TesKemampuanCriteria $criteria)
    {
        // Create 5 rating levels with score ranges
        $scales = [
            [
                'level' => 1,
                'name' => 'Sangat Kurang',
                'description' => 'Kemampuan teknis sangat kurang dan tidak memenuhi standar minimum',
                'min_score' => 0,
                'max_score' => 20
            ],
            [
                'level' => 2,
                'name' => 'Kurang',
                'description' => 'Kemampuan teknis di bawah standar, memerlukan banyak perbaikan',
                'min_score' => 21,
                'max_score' => 40
            ],
            [
                'level' => 3,
                'name' => 'Cukup',
                'description' => 'Kemampuan teknis memenuhi standar minimum',
                'min_score' => 41,
                'max_score' => 60
            ],
            [
                'level' => 4,
                'name' => 'Baik',
                'description' => 'Kemampuan teknis baik, di atas standar minimum',
                'min_score' => 61,
                'max_score' => 80
            ],
            [
                'level' => 5,
                'name' => 'Sangat Baik',
                'description' => 'Kemampuan teknis sangat baik, jauh di atas standar',
                'min_score' => 81,
                'max_score' => 100
            ]
        ];

        // Create the rating scales
        foreach ($scales as $scale) {
            TesKemampuanRatingScale::create([
                'id' => 'TES_RATE_' . $criteria->criteria_id . '_' . $scale['level'],
                'criteria_id' => $criteria->criteria_id,
                'rating_level' => $scale['level'],
                'name' => $scale['name'],
                'description' => $scale['description'],
                'min_score' => $scale['min_score'],
                'max_score' => $scale['max_score']
            ]);
        }
    }

    /**
     * Get rating name based on level
     *
     * @param int $level
     * @return string
     */
    private function getRatingName($level)
    {
        $names = [
            1 => 'Sangat Kurang',
            2 => 'Kurang',
            3 => 'Cukup',
            4 => 'Baik',
            5 => 'Sangat Baik'
        ];

        return $names[$level] ?? "Level $level";
    }
}
