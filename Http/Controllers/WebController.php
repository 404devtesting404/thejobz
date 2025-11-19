<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use App\Model\Blog;
use Response;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $name;
    public $email;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
    ];
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data =  $users = DB::table('jobs')
                ->join('job_department', 'jobs.department', '=', 'job_department.id')
                ->join('job_city', 'jobs.city', '=', 'job_city.id')
                ->select('jobs.id', 'jobs.img', 'jobs.slug', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_department.slug as department_slug', 'job_city.name as city')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->orderBy('jobs.id', 'DESC')
                // ->take(5)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $paper_name =  ucfirst(str_replace('_', ' ', $row->paper_name));
                    $title = Str::limit($row->title, 45);
                    $department = Str::limit($row->department, 42);
                    $imgPath = asset('storage/app/public/jobs/' . $row->img);
                    $btn = "<div class='job-listing'> <div class='job-title-sec'> <div class='c-logo'> <img src='{$imgPath}' alt='{$title}' style='width: 60px; height: 60px;'></div><h3><a href='" . route('job-department', ['slug' => $row->department_slug]) . "'  target='_blank' title=''> $department</a></h3><a><span>$title</span><br><div class='job-lctn'><i class='la la-map-marker'>Job city:$row->city  <i class='la'>Job posted:</i></i>$row->posted</div></div><a href='" . route('job-single', ['slug' => $row->slug]) . "'  target='_blank' title='$row->title' class='aply-btn'>See More</a><span class='job-is ft'> $paper_name</span><span class='fav-job'><i class='la la-heart-o'></i></span></div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $popular_job_department =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->selectRaw('job_department.name, job_department.id , job_department.icon , count(job_department.name) as department_count ,job_department.slug')
            ->groupBy('job_department.id')
            ->orderBy('department_count', 'DESC')
            // ->having('department_count', '>', 8)
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            // ->where('jobs.view', '>', 1)
            ->take(4)
            ->get();
            // dd($popular_job_department);

        $popular_job_city =  $users = DB::table('jobs')
            ->join('job_city', 'jobs.city', '=', 'job_city.id')
            ->selectRaw('job_city.name, job_city.id ,job_city.icon , count(job_city.name) as city_count ')
            ->groupBy('job_city.id')
            ->orderBy('city_count', 'DESC')
            // ->having('city_count', '>', 2)
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->take(6)
            ->get();

            // dd($popular_job_city);
        $army_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%army%')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $navy_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%navy%')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $police_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%police%')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $bank_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%bank%')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $jobsCount = DB::table('jobs')
            ->whereYear('posted', '>=', 2022)
            ->count();
        $departmentCount = DB::table('job_department')
            ->count();
        $job_cityCount = DB::table('job_city')
            ->count();
        return view('home')->with('popular_job_city', $popular_job_city)->with('departmentCount', $departmentCount)
            ->with('popular_job_department', $popular_job_department)->with('jobsCount', $jobsCount)
            ->with('job_cityCount', $job_cityCount)
            ->with('army_jobs_count', $army_jobs_count)->with('navy_jobs_count', $navy_jobs_count)
            ->with('police_jobs_count', $police_jobs_count)->with('bank_jobs_count', $bank_jobs_count);
        // return view('home')->with('jobs', $jobs)->with('departmentCount', $departmentCount)->with('popular_job_department', $popular_job_department)->with('jobsCount', $jobsCount)->with('job_cityCount', $job_cityCount);
    }
    public function search(Request $request)
    {
        $army_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%army%')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $navy_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%navy%')
            ->where('jobs.img', '!=', null)
            ->count();

        $police_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%police%')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $bank_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%bank%')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $search_result = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'jobs.city', '=', 'job_city.id')
            ->select('jobs.id', 'jobs.img', 'jobs.slug', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_department.slug as department_slug','job_city.name as city')
            ->where('jobs.title', 'like', "%{$request->name}%")
            // ->where('job_city.name', 'like', "%{$request->city}%")
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->orderBy('jobs.id', 'DESC')
            ->paginate(10);
        // dd($search_result);
        return view('search')->with('search_result', $search_result)
            ->with('army_jobs_count', $army_jobs_count)->with('navy_jobs_count', $navy_jobs_count)
            ->with('police_jobs_count', $police_jobs_count)->with('bank_jobs_count', $bank_jobs_count);
    }

    public function job_department($slug)
    {
        try {

            $department_name = DB::table('job_department')
                ->select('job_department.name')
                ->where('job_department.slug', '=', $slug)
                ->first();

            if (!$department_name) {
                // return abort(404);
                return response()->view('errors.404', [], 404);
            }


            $army_jobs_count = DB::table('job_department')
                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%army%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();

            $navy_jobs_count = DB::table('job_department')
                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%navy%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();

            $police_jobs_count = DB::table('job_department')
                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%police%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();

            $bank_jobs_count = DB::table('job_department')
                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%bank%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();

                    switch (strtolower($slug)) {
                        case 'management':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "Q1. What are the most popular management job titles in Pakistan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Common titles include HR Manager, Project Manager, Operations Head, and Admin Executive."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q2. Do management jobs require a business degree?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Most employers prefer candidates with a BBA, MBA, or related degree, but relevant experience can also qualify you."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q3. Which cities offer the best management job opportunities?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Karachi, Lahore, and Islamabad offer the highest number of management roles, followed by Faisalabad and Multan."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q4. Are there remote or hybrid management jobs available?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, many companies now offer hybrid and remote managerial roles for experienced professionals."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q5. How do I increase my chances of getting a management job?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Keep your LinkedIn profile updated, add leadership certifications, and apply through verified platforms like TheJobz.pk."
                                    ]
                                ]
                            ];
                        break;
                        case 'private-company':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "Q1. What types of private company jobs are available in Pakistan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "You can find roles in IT, sales, HR, marketing, accounts, and administration across leading private companies."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q2. Are private jobs suitable for fresh graduates?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes! Many private companies hire fresh graduates as trainees or interns with growth opportunities."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q3. Which cities have the most private company jobs?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Major cities like Karachi, Lahore, and Islamabad offer the most openings, followed by Faisalabad and Multan."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q4. How can I apply for private jobs online?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Visit TheJobz.pk, search for your desired role, and click “Apply Online” to submit your CV directly."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q5. Are private company jobs better than government jobs?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Private jobs offer faster career growth, performance-based rewards, and flexible working environments."
                                    ]
                                ]
                            ];
                        break;
                        default:
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "What kind of jobs are available in Pakistan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "You can find thousands of verified jobs across Pakistan in government, private, and online sectors at TheJobz.pk."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How can I apply for jobs online in Pakistan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Simply visit TheJobz.pk, choose your desired city or category, and apply directly to verified employers."
                                    ]
                                ]
                            ];
                            break;
                    }

            return view('job_department', compact('faqData','department_name', 'army_jobs_count', 'navy_jobs_count', 'police_jobs_count', 'bank_jobs_count'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('home')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function job_city($id = null)
    {
        dd($id);
        try {
            $cityname = DB::table('job_city')
                ->select('job_city.name as city')
                ->where('job_city.slug', $id)
                ->first();
            // Check if cityname is not null and then capitalize the first letter
            if ($cityname) {
                $cityname->city = ucfirst($cityname->city);
            } else {
                Session::flash('alert-danger', 'danger');
                // Handle the case where cityname is null (city not found)
                // return redirect()->back()->with('error', 'City not found.');
                return redirect()->back()->with('error', 'An error occurred. Please try again.');
            }

            $army_jobs_count = DB::table('job_department')
                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%army%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();

            $navy_jobs_count = DB::table('job_department')
                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%navy%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();

            $police_jobs_count = DB::table('job_department')
                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%police%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();

            $bank_jobs_count = DB::table('job_department')
                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%bank%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();

                switch (strtolower($id)) {
                        case 'lahore':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "What are the latest jobs in Lahore right now?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "The latest jobs in Lahore include openings in IT, education, healthcare, banking, and marketing sectors. You can find updated vacancies daily on TheJobz.pk."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How can I apply for jobs in Lahore online?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Visit TheJobz.pk, search your desired category, and click 'Apply Online.' Upload your CV to apply directly to verified employers hiring in Lahore."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Are there part-time or remote jobs in Lahore?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, Lahore offers a wide range of part-time and remote roles, especially in content writing, customer service, and graphic design."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Which companies are hiring in Lahore now?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Major Lahore employers include banks, universities, IT firms, hospitals, and retail companies located in Gulberg, Johar Town, and Model Town areas."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Are there government jobs in Lahore for 2025?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, Punjab Government and Federal Departments regularly post openings in education, health, and administration — all listed on TheJobz.pk."
                                    ]
                                ]
                            ];
                            break;

                        case 'karachi':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "What are the latest jobs in Karachi right now?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "The latest jobs in Karachi include openings in IT, banking, marketing, teaching, healthcare, and government departments. You can find daily updated listings on TheJobz.pk for both full-time and part-time roles."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How can I apply for jobs in Karachi online?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Visit TheJobz.pk, select your preferred category or company, and click 'Apply Online.' Upload your CV and submit directly to verified employers hiring across Karachi."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Are there any part-time or remote jobs in Karachi?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, many companies now offer part-time, freelance, and remote job opportunities in Karachi, especially in digital marketing, graphic design, content writing, and customer support."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Which companies are hiring in Karachi right now?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Top Karachi employers currently hiring include major banks, software houses, schools, and multinational firms in Gulshan, Clifton, Saddar, and Korangi industrial areas."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How can fresh graduates find jobs in Karachi?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Fresh graduates can explore entry-level jobs on TheJobz.pk by filtering listings by experience level. Many companies offer trainee or internship programs in IT, sales, and administration."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "What are the most in-demand job fields in Karachi?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "The most in-demand fields are information technology (IT), sales & marketing, education, finance, and healthcare — offering steady career growth and competitive salaries."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Are government jobs in Karachi available for 2025?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, several government departments in Karachi post new vacancies throughout 2025. You can find Sindh Government, KMC, and FPSC jobs updated daily on TheJobz.pk."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How do I get female-specific jobs in Karachi?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "TheJobz.pk features a dedicated section for female jobs in Karachi, covering education, healthcare, HR, and remote work roles suitable for women professionals."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Is TheJobz.pk a trusted platform for Karachi jobs?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes. TheJobz.pk verifies all job listings to ensure applicants connect only with authentic and trusted employers across Pakistan."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Can I set alerts for new Karachi job openings?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, you can subscribe to job alerts on TheJobz.pk and receive instant notifications whenever new Karachi job opportunities matching your profile are posted."
                                    ]
                                ]
                            ];
                            break;
                        case 'islamabad':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "What are the latest jobs in Islamabad right now?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "The latest jobs in Islamabad cover IT, education, healthcare, banking, and marketing sectors. Updated daily on TheJobz.pk, you can browse verified openings and apply directly."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How can I apply for jobs in Islamabad online",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Visit TheJobz.pk, select your preferred job category, and click 'Apply Online.' Upload your CV to apply directly to verified employers and get notifications for new openings."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Are there any part-time or remote jobs in Karachi?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, many companies now offer part-time, freelance, and remote job opportunities in Karachi, especially in digital marketing, graphic design, content writing, and customer support."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Are there part-time or remote jobs in Islamabad?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, Islamabad offers part-time and remote roles in content writing, customer support, digital marketing, and graphic design—ideal for students and freelancers."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Which companies are hiring in Islamabad currently?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Top employers include banks, universities, IT firms, hospitals, and retail companies, mainly in sectors like G-9, F-10, and I-8. All verified openings are listed on TheJobz.pk."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Are there government jobs in Islamabad for 2025?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, federal departments and government institutions post regular vacancies in education, administration, and health, all listed on TheJobz.pk."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How can female candidates find jobs in Islamabad?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "TheJobz.pk provides a dedicated female jobs section, featuring opportunities in schools, offices, and remote setups that prioritize gender inclusivity."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Can I set alerts for new Islamabad job openings?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, by subscribing to TheJobz.pk alerts, you will receive instant notifications whenever new jobs matching your profile are posted."
                                    ]
                                ]
                            ];
                          break;
                        case 'peshawar':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "What types of jobs are currently available in Peshawar?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Peshawar offers opportunities in IT, education, healthcare, banking, marketing, and administration. TheJobz.pk lists verified openings daily."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How can I apply for jobs in Peshawar online?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Visit TheJobz.pk, choose your category, and click 'Apply Online.' Upload your CV to directly apply to verified employers."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Are part-time or remote jobs available in Peshawar?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, Peshawar features part-time and remote roles in content writing, graphic design, digital marketing, and customer support."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Which companies are hiring in Peshawar?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Top employers include banks, universities, IT firms, hospitals, and retail companies in areas like Saddar, University Road, and Hayatabad."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Are there government jobs in Peshawar for 2025?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, provincial and federal departments post vacancies in education, administration, and healthcare, listed on TheJobz.pk."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How can female candidates find suitable jobs in Peshawar?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "TheJobz.pk offers a dedicated section for female-friendly roles including office jobs, teaching, and remote work."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Can I get alerts for new job postings in Peshawar?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Subscribe to TheJobz.pk alerts to get instant notifications whenever new jobs matching your profile are posted."
                                    ]
                                ]
                            ];
                          break;
                        case 'rawalpindi':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "1. What kinds of jobs are currently available in Rawalpindi??",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Rawalpindi offers roles in IT, education, healthcare, banking, marketing, administration, and remote work. TheJobz.pk updates verified vacancies daily to help you find the right fit."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "2. How do I apply for jobs in Rawalpindi online?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Visit TheJobz.pk, search by category or keyword, click “Apply Online,” upload your CV, and follow the employer’s instructions to submit your application."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "3. Are remote and part-time jobs available in Rawalpindi?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, many employers in Rawalpindi post remote, freelance, and part-time roles in customer service, content writing, graphic design, and digital marketing."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "4. Which neighborhoods and companies hire most in Rawalpindi?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Top hiring areas include Bahria Town, Saddar, Chaklala, and Cantt, with active employers in education, healthcare, IT, banking, and retail sectors."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "5. Are there government jobs in Rawalpindi for 2025?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, both provincial and federal departments regularly post openings in administration, education, and healthcare sectors."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "6. How can female candidates find suitable jobs in Rawalpindi?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "TheJobz.pk offers a dedicated section for female candidates, featuring safe and flexible job options like office, teaching, and online roles."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "7. Can I get alerts for new job openings in Rawalpindi?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Absolutely! Subscribe to TheJobz.pk job alerts and get instant notifications for new vacancies that match your skills and experience."
                                    ]
                                ]
                            ];
                          break;
                        case 'quetta':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "1. What types of jobs are currently available in Quetta?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Quetta offers diverse job options in IT, education, banking, healthcare, and government sectors. TheJobz.pk updates listings daily for your convenience."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "2. How can I apply for jobs in Quetta online?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Visit TheJobz.pk, select your preferred category, and click “Apply Online.” Upload your CV and connect directly with verified Quetta employers."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "3. Are remote or part-time jobs available in Quetta?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes! TheJobz.pk lists remote and part-time roles in marketing, design, customer support, and IT for flexible work seekers."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "4. Which companies are hiring in Quetta right now?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Top employers include universities, hospitals, software houses, and logistics firms based in areas like Jinnah Town, Brewery Road, and Satellite Town."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "5. Are there government jobs in Quetta for 2025?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes. Provincial and federal departments frequently post jobs in administration, education, and health—browse them easily on TheJobz.pk."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "6. Can female candidates find suitable jobs in Quetta?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Absolutely! TheJobz.pk features women-friendly positions in education, administration, and remote work to ensure equal opportunities."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "7. Can I get alerts for new Quetta job openings?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, subscribe to TheJobz.pk alerts to get instant notifications whenever a new Quetta job matches your skills."
                                    ]
                                ]
                            ];
                          break;
                        case 'multan':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "What jobs are currently available in Multan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Multan offers career opportunities in IT, banking, healthcare, education, sales, and textile industries. You can find verified vacancies updated daily on TheJobz.pk."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How can I apply online for jobs in Multan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Just visit TheJobz.pk, search your preferred field, and click “Apply Online.” Upload your CV and connect directly with verified employers."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Are there part-time or remote jobs in Multan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes! Flexible roles in teaching, data entry, customer support, and digital marketing are frequently posted — ideal for students and remote workers."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Which companies are hiring in Multan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Leading organizations include banks, universities, textile industries, hospitals, and retail companies located in Gulgasht, Bosan Road, and Cantt Area."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Are there government jobs in Multan for 2025?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, Punjab Government and Federal departments regularly share vacancies in education, health, and administration on TheJobz.pk."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How can female candidates find jobs in Multan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "There is a dedicated Female Jobs section featuring teaching, office administration, healthcare, and remote job opportunities."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Can I get alerts for new job updates in Multan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Absolutely! Subscribe to job alerts on TheJobz.pk and receive notifications when new roles matching your skills are posted."
                                    ]
                                ]
                            ];
                          break;
                        case 'faisalabad':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "Q1: How can I find latest job openings in Faisalabad?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Visit TheJobz.pk and explore daily updated job listings for all skill levels."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q2: Are there government jobs in Faisalabad available now?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, we regularly update govt jobs from different departments, including health, education & administration sectors."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q3: Can fresh graduates find jobs in Faisalabad?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Absolutely! Many companies in Faisalabad hire freshers for IT, textile, sales & support roles."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q4: What industries have the highest hiring in Faisalabad?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Textile, manufacturing, education, IT, and healthcare sectors are top hiring sources."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q5: How do I apply for jobs through TheJobz.pk?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Simply open a job listing, read requirements, and click 'Apply' to submit your resume."
                                    ]
                                ]
                            ];
                          break;
                        case 'riyadh':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "Q1: How can I find latest jobs in Riyadh for Pakistanis?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Visit TheJobz.pk where we update jobs daily for drivers, labor, technicians, and skilled workers."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q2: Do Riyadh jobs offer visa and accommodation?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, many job listings include visa, food, medical & accommodation benefits."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q3: Can freshers get jobs in Riyadh?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes! Labor, packing, helper & security companies frequently hire fresh candidates."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q4: Are there high-paying jobs available in Riyadh?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, IT, engineering, healthcare, and driving roles offer higher salaries."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q5: How to apply for Riyadh jobs online?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Just open a listing, check eligibility, and click “Apply” to submit your resume."
                                    ]
                                ]
                            ];
                          break;
                          case 'dammam':
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "Q1: How can I find latest jobs in Dammam from Pakistan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Visit TheJobz.pk and browse daily updated job listings for labor, driving, and skilled roles."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q2: Do companies in Dammam provide accommodation and transportation?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes, majority job listings include food, accommodation, medical & transport benefits."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q3: Can freshers get jobs in Dammam?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Yes! Many companies hire helpers, packers, office boys & security guards without experience."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q4: Which industry has the most hiring in Dammam?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Construction, logistics, oil & gas, and industrial sectors have the highest hiring demand."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q5: How to apply online for Dammam jobs?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Open a job post, review eligibility, and click “Apply” to submit your CV instantly."
                                    ]
                                ]
                            ];
                          break;

                        default:
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "What kind of jobs are available in Pakistan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "You can find thousands of verified jobs across Pakistan in government, private, and online sectors at TheJobz.pk."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "How can I apply for jobs online in Pakistan?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Simply visit TheJobz.pk, choose your desired city or category, and apply directly to verified employers."
                                    ]
                                ]
                            ];
                            break;
                    }

            return view('job_city')
                ->with('faqData', $faqData)
                ->with('cityname', $cityname)
                ->with('army_jobs_count', $army_jobs_count)
                ->with('navy_jobs_count', $navy_jobs_count)
                ->with('police_jobs_count', $police_jobs_count)
                ->with('bank_jobs_count', $bank_jobs_count);
        } catch (\Exception $e) {
            dd($e);
            // Log the error or handle it as needed
            // return redirect()->back()->with('error', 'An error occurred. Please try again.');
            return redirect()->route('home')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function ajx_city($id = null, Request $request)
    {
        if ($request->ajax()) {
            $data = Cache::remember("jobs_city_$id", 60, function () use ($id) {
                return DB::table('jobs')
                    ->join('job_department', 'jobs.department', '=', 'job_department.id')
                    ->join('job_city', 'jobs.city', '=', 'job_city.id')
                    ->select(
                        'jobs.id',
                        'jobs.slug',
                        'jobs.img',
                        'jobs.posted',
                        'jobs.title',
                        'jobs.paper_name',
                        'job_department.name as department',
                        'job_city.name as city'
                    )
                    ->whereNotNull('jobs.img')
                    ->where('jobs.status', 1)
                    ->where('jobs.is_deleted', 0)
                    ->where('job_city.slug', $id)
                    ->orderByDesc('jobs.id')
                    ->get();
            });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('data', function ($row) {
                    $paper_name = ucfirst(str_replace('_', ' ', $row->paper_name));
                    $title = Str::limit($row->title, 45);
                    $img = asset('storage/app/public/jobs/' . $row->img);
                    $department = Str::limit($row->department, 42);

                    $btn = "<div class='job-listing'>
                                <div class='job-title-sec'>
                                    <div class='c-logo'>
                                        <img class='img_test' src='$img' alt='{$title}' style='width: 60px; height: 60px;'>
                                    </div>
                                    <h3><a href='#' title=''> $department</a></h3>
                                    <span>$title</span>
                                    <span class='job-lctn'>$row->posted</span>
                                </div>
                                <a href='" . url('job-single', ['slug' => $row->slug]) . "' target='_blank' title='$row->title' class='aply-btn'>See More</a>
                                <span class='job-is ft'> $paper_name</span>
                                <span class='fav-job'><i class='la la-heart-o'></i></span>
                            </div>";

                    return $btn;
                })
                ->rawColumns(['data'])
                ->make(true);
        }
    }





    public function ajx_city11($id = null, Request $request)
    {
        if ($request->ajax()) {
            $data =  $users = DB::table('jobs')
                ->join('job_department', 'jobs.department', '=', 'job_department.id')
                ->join('job_city', 'jobs.city', '=', 'job_city.id')
                ->select('jobs.id', 'jobs.slug', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_city.name as city')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->where('job_city.slug', $id)
                ->orderBy('jobs.id', 'DESC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('data', function ($row) {
                    $paper_name =  ucfirst(str_replace('_', ' ', $row->paper_name));
                    $title = Str::limit($row->title, 45);
                    // $img =  asset("public/img/" . '/' . $row->img);
                    $img = asset('storage/app/public/jobs/' . $row->img);
                    $department = Str::limit($row->department, 42);
                    $btn = "<div class='job-listing'> <div class='job-title-sec'> <div class='c-logo'><img class='img_test' src='$img' alt='{$title}' style='width: 60px; height: 60px;'></div><h3><a href='#' title=''> $department</a></h3><span>$title</span><span class='job-lctn'>$row->posted</span></div><a href='" . url('job-single', ['slug' => $row->slug]) . "' target='_blank' title='$row->title' class='aply-btn'>See More</a><span class='job-is ft'> $paper_name</span><span class='fav-job'><i class='la la-heart-o'></i></span></div>";
                    return $btn;
                })
                ->rawColumns(['data'])
                ->make(true);
        }
    }

    public function ajx_featch($id = null, Request $request)
    {
        if ($request->ajax()) {
            $data =  $users = DB::table('jobs')
                ->join('job_department', 'jobs.department', '=', 'job_department.id')
                ->join('job_city', 'jobs.city', '=', 'job_city.id')
                ->select('jobs.id', 'jobs.slug', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.slug as department_slug', 'job_department.name as department', 'job_city.name as city')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->where('job_department.slug', $id)
                ->orderBy('jobs.id', 'DESC')
                // ->take(5)
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('data', function ($row) {
                    $paper_name =  ucfirst(str_replace('_', ' ', $row->paper_name));
                    $title = Str::limit($row->title, 45);
                    // $img =  asset("public/img/" . '/' . $row->img);
                    $img = asset('storage/app/public/jobs/' . $row->img);

                    $department = Str::limit($row->department, 42);
                    $btn = "<div class='job-listing'> <div class='job-title-sec'> <div class='c-logo'><img class='img_test' src='$img' alt='{$title}' style='width: 60px; height: 60px;'></div><h3><a href='#' title=''> $department</a></h3><span>$title</span><div class='job-lctn'><i class='la la-map-marker'>Job city:$row->city <i class='la'>Job posted:$row->posted</i></i></div></div><a href='" . route('job-single', ['slug' => $row->slug]) . "' target='_blank' title='$row->title' class='aply-btn'>See More</a><span class='job-is ft'> $paper_name</span><span class='fav-job'><i class='la la-heart-o'></i></span></div>";
                    return $btn;
                })
                ->rawColumns(['data'])
                ->make(true);
        }
        //    return view('job_department');
        // return view('home')->with('jobs', $jobs)->with('departmentCount', $departmentCount)->with('popular_job_department', $popular_job_department)->with('jobsCount', $jobsCount)->with('job_cityCount', $job_cityCount);
    }

    public function random_catadery_job($id = null)
    {
        $army_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%army%')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $navy_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%navy%')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $police_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%police%')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $bank_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%bank%')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        switch (strtolower($id)) {
            case 'jang':
                $faqData = [
                    [
                        "@type" => "Question",
                        "name" => "Q1: What types of jobs are listed in Jang newspaper ads?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Govt, private firms, teaching, medical, engineering, and admin roles are commonly listed."
                        ]
                    ],
                    [
                        "@type" => "Question",
                        "name" => "Q2: How often are Jang jobs updated on TheJobz.pk?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Fresh listings are updated daily to ensure you never miss new openings."
                        ]
                    ],
                    [
                        "@type" => "Question",
                        "name" => "Q3: Can I apply directly through TheJobz.pk?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Yes — simply open job details and click Apply Online. Some listings may redirect to their official site."
                        ]
                    ],
                    [
                        "@type" => "Question",
                        "name" => "Q4: Are city-specific Jang jobs available?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Yes, including Karachi, Lahore, Islamabad, Rawalpindi, Faisalabad & more."
                        ]
                    ],
                    [
                        "@type" => "Question",
                        "name" => "Q5: Do Jang jobs include internships?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Yes — some companies post trainee & internship opportunities as well."
                        ]
                    ]
                ];
            break;
            case 'thenews':
                $faqData = [
                    [
                        "@type" => "Question",
                        "name" => "Q1: What types of jobs are listed in The News newspaper?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Listings include govt, private, finance, teaching, IT, engineering, and admin roles."
                        ]
                    ],
                    [
                        "@type" => "Question",
                        "name" => "Q2: How frequently are The News jobs updated on TheJobz.pk?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Newspaper jobs are refreshed daily for the latest vacancies."
                        ]
                    ],
                    [
                        "@type" => "Question",
                        "name" => "Q3: Can I apply online for The News jobs?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Yes — simply open the job post and follow the online application instructions."
                        ]
                    ],
                    [
                        "@type" => "Question",
                        "name" => "Q4: Are The News jobs available city-wise?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Yes — Lahore, Karachi, Islamabad, Rawalpindi & major cities are covered."
                        ]
                    ],
                    [
                        "@type" => "Question",
                        "name" => "Q5: Do listings include overseas jobs?",
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => "Yes — The News newspaper occasionally features overseas job ads."
                        ]
                    ]
                ];
            break;
            default:
                            $faqData = [
                                [
                                    "@type" => "Question",
                                    "name" => "Q1: What kind of jobs are listed on TheJobz.pk?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "TheJobz.pk lists government, private, and overseas jobs from top newspapers and official sources."
                                    ]
                                ],
                                [
                                    "@type" => "Question",
                                    "name" => "Q2: How often are new jobs posted on TheJobz.pk?",
                                    "acceptedAnswer" => [
                                        "@type" => "Answer",
                                        "text" => "Job listings are updated daily to ensure users always find the latest opportunities."
                                    ]
                                ]
                            ];
                            break;
         }

        $fullUrl = url()->full();
        $path = parse_url($fullUrl, PHP_URL_PATH);
        $segments = explode('/', $path);
        $endpoint = end($segments);
        $meta_data = [
            'title' => '',
            'description' => '',
            'keywords' => '',
            'canonical' => '',
            'og_title' => '',
            'og_description' => '',
            'og_image' => '',
            'og_image_alt' => '',
            'twitter_title' => '',
            'twitter_description' => '',
            'twitter_image_alt' => '',

        ];
        $JSON_D_Schema = [
            "@context" => "https://schema.org",
            "@type" => "CollectionPage",
            "name" => "",
            "description" => "",
            "url" => "",
            "hiringOrganization" => [
                "@type" => "",
                "name" => "",
                "sameAs" => ""
            ],
            "jobLocation" => [
                "@type" => "Place",
                "address" => [
                    "addressCountry" => "PK"
                ]
            ],
            "employmentType" => "Full-time",
            "applicantLocationRequirements" => [
                "@type" => "Country",
                "name" => "Pakistan"
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "TheJobz.pk",
                "url" => "https://thejobz.pk",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => "https://thejobz.pk/resources/assets/images/resource/logo9.png",
                    "width" => 600,
                    "height" => 60
                ]
            ]
        ];
        $data = [
            'title' => ''
        ];
        if ($endpoint == 'pak-navy-jobs') {
            $navy_jobs = DB::table('job_department')
                ->select('jobs.*')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%navy%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.meta_description', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                // ->whereDate('jobs.posted', '>=', \Carbon\Carbon::today())
                ->whereYear('jobs.posted', '>=', 2025)
                ->orderBy('jobs.created_at', 'desc') // Latest jobs first
                ->get()
                ->unique('title') // Unique titles
                ->values() // Index reset karega
                ->take(20);
            $meta_data = [
                'title' => 'Join Pakistan Navy - Apply for Govt Jobs 2025 | TheJobz.pk',
                'description' => 'Explore the latest Pakistan Navy jobs 2025. Apply online for Pak Navy recruitment, officer and sailor vacancies. Daily job updates on TheJobz.pk',
                'keywords' => 'Navy Jobs 2025, Pakistan Navy Jobs, Government Jobs, Latest Jobs in Pakistan, TheJobz.pk, Pak Navy Careers, Defense Jobs, Job Ads',
                'canonical' => 'https://thejobz.pk/pak-navy-jobs',
                'og_title' => 'Join Pakistan Navy - Apply for Govt Jobs 2025 | TheJobz.pk',
                'og_description' => 'Find and apply for the latest Pakistan Navy jobs in 2025. Get daily job updates on TheJobz.pk.',
                'og_image' => 'https://thejobz.pk/resources/assets/images/navy_logo.svg',
                'og_image_alt' => 'Join Pakistan Navy - Latest Navy Jobs 2025',
                'twitter_title' => 'Join Pakistan Navy - Apply for Govt Jobs 2025 | TheJobz.pk',
                'twitter_description' => 'Pakistan Navy career opportunities 2025. Apply for the latest officer & sailor jobs. Stay updated with TheJobz.pk',
                'twitter_image_alt' => 'Apply for Pakistan Navy Jobs 2025',

            ];
            $JSON_D_Schema = [
                "@context" => "https://schema.org",
                "@type" => "CollectionPage",
                "name" => "Pakistan Navy Jobs 2025",
                "description" => "Join Pakistan Navy with the latest government job openings for officers, sailors, and civilians. Apply online today.",
                "url" => "https://thejobz.pk/pak-navy-jobs",
                "hiringOrganization" => [
                    "@type" => "Organization",
                    "name" => "Pakistan Navy",
                    "sameAs" => "https://thejobz.pk/pak-navy-jobs"
                ],
                "jobLocation" => [
                    "@type" => "Place",
                    "address" => [
                        "addressCountry" => "PK"
                    ]
                ],
                "employmentType" => "Full-time",
                "applicantLocationRequirements" => [
                    "@type" => "Country",
                    "name" => "Pakistan"
                ],
                "publisher" => [
                    "@type" => "Organization",
                    "name" => "TheJobz.pk",
                    "url" => "https://thejobz.pk",
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => "https://thejobz.pk/resources/assets/images/resource/logo9.png",
                        "width" => 600,
                        "height" => 60
                    ]
                ]
            ];

            foreach ($navy_jobs as $job) {
                $JSON_D_Schema["hasPart"][] = [
                    "@type" => "JobPosting",
                    "title" => $job->title,
                    "datePosted" => Carbon::parse($job->posted)->format('Y-m-d'),
                    "validThrough" => Carbon::parse($job->posted)->addDays(20)->format('Y-m-d'),
                    "hiringOrganization" => [
                        "@type" => "Organization",
                        "name" => "Multiple Navy Jobs in Pakistan"
                    ],
                    "jobLocation" => [
                        "@type" => "Place",
                        "address" => [
                            "@type" => "PostalAddress",
                            "streetAddress" => $job->street_address,
                            "addressLocality" => $job->address_locality,
                            "addressRegion" => $job->address_region,
                            "postalCode" =>  $job->postal_code,
                            "addressCountry" => "PK"
                        ]
                    ],
                    "employmentType" => "Full-time",
                    "baseSalary" => [
                        "@type" => "MonetaryAmount",
                        "currency" => "PKR",
                        "description" => "Salary depends on experience and skills."
                    ],
                    "description" => Str::limit($job->meta_description, 300)
                ];
            }

            // **Agar koi job available nahi hai to `hasPart` ko remove kar do**
            if (empty($JSON_D_Schema["hasPart"])) {
                unset($JSON_D_Schema["hasPart"]);
            }

            $data = [
                'title' => 'Join Pakistan Navy 2025 | Latest Govt Jobs & Online Apply - TheJobz.pk'
            ];
        }

        if ($endpoint == 'pak-army-jobs') {
            $army_jobs = DB::table('job_department')
                ->select('jobs.*')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%army%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.meta_description', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                // ->whereDate('jobs.posted', '>=', \Carbon\Carbon::today())
                ->whereYear('jobs.posted', '>=', 2025)
                ->orderBy('jobs.created_at', 'desc') // Latest jobs first
                ->get()
                ->unique('title') // Unique titles
                ->values() // Index reset karega
                ->take(20);
            $meta_data = [
                'title' => 'Latest Pakistan Army Jobs 2025 | Join Pak Army - TheJobz.pk',
                'description' => 'Apply online for the latest Pakistan Army jobs 2025, including officer, sailor, and civilian vacancies. Get daily Pak Army recruitment updates on TheJobz.pk.',
                'keywords' => 'Latest Pakistan Army Jobs 2025, Pak Army Jobs, Army Recruitment 2025, Govt Jobs Pakistan, Defense Jobs, TheJobz.pk, Online Army Jobs',
                'canonical' => 'https://thejobz.pk/pak-army-jobs',
                'og_title' => 'Latest Pakistan Army Jobs 2025 - Apply Online | TheJobz.pk',
                'og_description' => 'Find the latest Pakistan Army job openings for officers, sailors, and civilians. Apply online and stay updated with TheJobz.pk.',
                'og_image' => 'https://thejobz.pk/resources/assets/images/army_logo.png',
                'og_image_alt' => 'Join Pakistan Army - Latest Army Jobs 2025',
                'twitter_title' => 'Pakistan Army Jobs 2025 - Apply Now',
                'twitter_description' => 'Join the Pakistan Army in 2025. Explore latest job openings and apply online.',
                'twitter_image_alt' => 'Apply for Pakistan Army Jobs 2025',

            ];
            $JSON_D_Schema = [
                "@context" => "https://schema.org",
                "@type" => "CollectionPage",
                "name" => "Latest Pakistan Army Jobs 2025",
                "description" => "Browse the latest Pakistan Army job openings for officers, sailors, and civilians. Apply online today.",
                "url" => "https://thejobz.pk/pak-army-jobs",
                "hiringOrganization" => [
                    "@type" => "Organization",
                    "name" => "Pakistan Army",
                    "sameAs" => "https://thejobz.pk/pak-army-jobs"
                ],
                "hasPart" => [],
                "jobLocation" => [
                    "@type" => "Place",
                    "address" => [
                        "addressCountry" => "PK"
                    ]
                ],
                "employmentType" => "Full-time",
                "applicantLocationRequirements" => [
                    "@type" => "Country",
                    "name" => "Pakistan"
                ],
                "publisher" => [
                    "@type" => "Organization",
                    "name" => "TheJobz.pk",
                    "url" => "https://thejobz.pk",
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => "https://thejobz.pk/resources/assets/images/resource/logo9.png",
                        "width" => 600,
                        "height" => 60
                    ]
                ]
            ];
            foreach ($army_jobs as $job) {
                $JSON_D_Schema["hasPart"][] = [
                    "@type" => "JobPosting",
                    "title" => $job->title,
                    "datePosted" => Carbon::parse($job->posted)->format('Y-m-d'),
                    "validThrough" => Carbon::parse($job->posted)->addDays(20)->format('Y-m-d'),
                    "hiringOrganization" => [
                        "@type" => "Organization",
                        "name" => "Pakistan Army"
                    ],
                    "jobLocation" => [
                        "@type" => "Place",
                        "address" => [
                            "@type" => "PostalAddress",
                            "streetAddress" => $job->street_address,
                            "addressLocality" => $job->address_locality,
                            "addressRegion" => $job->address_region,
                            "postalCode" =>  $job->postal_code,
                            "addressCountry" => "PK"
                        ]
                    ],
                    "employmentType" => "Full-time",
                    "baseSalary" => [
                        "@type" => "MonetaryAmount",
                        "currency" => "PKR",
                        "description" => "Salary depends on experience and skills."
                    ],
                    "description" => Str::limit($job->meta_description, 300)
                ];
            }

            // **Agar koi job available nahi hai to `hasPart` ko remove kar do**
            if (empty($JSON_D_Schema["hasPart"])) {
                unset($JSON_D_Schema["hasPart"]);
            }

            $data = [
                'title' => 'Latest Pakistan Army Jobs 2025 | Join Pak Army - TheJobz.pk'
            ];
        }

        if ($endpoint == 'bank-jobs') {
            $bank_jobs = DB::table('job_department')
                ->select('jobs.*')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%bank%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.meta_description', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                // ->whereDate('jobs.posted', '>=', \Carbon\Carbon::today())
                ->whereYear('jobs.posted', '>=', 2025)
                ->orderBy('jobs.created_at', 'desc') // Latest jobs first
                ->get()
                ->unique('title') // Unique titles
                ->values() // Index reset karega
                ->take(20);
            $meta_data = [
                'title' => 'Latest Bank Jobs 2025 | Careers in Banking - TheJobz.pk',
                'description' => 'Find the latest bank jobs in Pakistan 2025. Apply online for banking, finance, and government job openings at TheJobz.pk. Stay updated with daily job alerts.',
                'keywords' => 'Bank Jobs 2025, Banking Jobs Pakistan, Finance Jobs, Government Bank Jobs, Pakistan Bank Careers, Latest Jobs in Pakistan, TheJobz.pk, Job Openings',
                'canonical' => 'https://thejobz.pk/bank-jobs',
                'og_title' => 'Latest Bank Jobs 2025 | Careers in Banking - TheJobz.pk',
                'og_description' => 'Looking for banking jobs in Pakistan? Explore the latest bank job vacancies for 2025 and apply online today at TheJobz.pk.',
                'og_image' => 'https://thejobz.pk/resources/assets/images/bank_logo.png',
                'og_image_alt' => 'Join Pakistan Bank - Latest Bank Jobs 2025',
                'twitter_title' => 'Latest Bank Jobs 2025 | Careers in Banking - TheJobz.pk',
                'twitter_description' => 'Start your career in banking! Find and apply for the latest Pakistan bank jobs for 2025 at TheJobz.pk.',
                'twitter_image_alt' => 'Apply for Pakistan Bank Jobs 2025',

            ];
            $JSON_D_Schema = [
                "@context" => "https://schema.org",
                "@type" => "CollectionPage",
                "name" => "Pakistan Bank Jobs 2025",
                "description" => "Explore the latest job openings at Pakistan Bank and start your career in banking. Apply online today",
                "url" => "https://thejobz.pk/bank-jobs",
                "hiringOrganization" => [
                    "@type" => "Organization",
                    "name" => "Multiple Banks in Pakistan",
                    "sameAs" => "https://thejobz.pk/bank-jobs"
                ],
                "jobLocation" => [
                    "@type" => "Place",
                    "address" => [
                        "addressCountry" => "PK"
                    ]
                ],
                "employmentType" => "Full-time",
                "applicantLocationRequirements" => [
                    "@type" => "Country",
                    "name" => "Pakistan"
                ],
                "publisher" => [
                    "@type" => "Organization",
                    "name" => "TheJobz.pk",
                    "url" => "https://thejobz.pk",
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => "https://thejobz.pk/resources/assets/images/resource/logo9.png",
                        "width" => 600,
                        "height" => 60
                    ]
                ]
            ];
            foreach ($bank_jobs as $job) {
                $JSON_D_Schema["hasPart"][] = [
                    "@type" => "JobPosting",
                    "title" => $job->title,
                    "datePosted" => Carbon::parse($job->posted)->format('Y-m-d'),
                    "validThrough" => Carbon::parse($job->posted)->addDays(20)->format('Y-m-d'),
                    "hiringOrganization" => [
                        "@type" => "Organization",
                        "name" => "Multiple Banks in Pakistan"
                    ],
                    "jobLocation" => [
                        "@type" => "Place",
                        "address" => [
                            "@type" => "PostalAddress",
                            "streetAddress" => $job->street_address,
                            "addressLocality" => $job->address_locality,
                            "addressRegion" => $job->address_region,
                            "postalCode" =>  $job->postal_code,
                            "addressCountry" => "PK"
                        ]
                    ],
                    "employmentType" => "Full-time",
                    "baseSalary" => [
                        "@type" => "MonetaryAmount",
                        "currency" => "PKR",
                        "value" => $job->BaseSalaryValue,
                        "description" => "Salary depends on experience and skills."
                    ],
                    "description" => Str::limit($job->meta_description, 300)
                ];
            }

            // **Agar koi job available nahi hai to `hasPart` ko remove kar do**
            if (empty($JSON_D_Schema["hasPart"])) {
                unset($JSON_D_Schema["hasPart"]);
            }

            $data = [
                'title' => 'Latest Bank Jobs 2025 | Apply for Banking Careers in Pakistan - TheJobz.pk'
            ];
        }

        if ($endpoint == 'pak-airforce-jobs') {

            $army_jobs = DB::table('job_department')
                ->select('jobs.*')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%airforce%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.meta_description', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                // ->whereDate('jobs.posted', '>=', \Carbon\Carbon::today())
                ->whereYear('jobs.posted', '>=', 2025)
                ->orderBy('jobs.created_at', 'desc') // Latest jobs first
                ->get()
                ->unique('title') // Unique titles
                ->values() // Index reset karega
                ->take(20);
            $meta_data = [
                'title' => 'Latest Pakistan Airforce Jobs 2025 | Join Pak Airforce - TheJobz.pk',
                'description' => 'Apply online for the latest Pakistan Airforce jobs 2025, including officer, sailor, and civilian vacancies. Get daily Pak Airforce recruitment updates on TheJobz.pk.',
                'keywords' => 'Latest Pakistan Airforce Jobs 2025, Pak Airforce Jobs, Airforce Recruitment 2025, Govt Jobs Pakistan, Defense Jobs, TheJobz.pk, Online Airforce Jobs',
                'canonical' => 'https://thejobz.pk/pak-airforce-jobs',
                'og_title' => 'Latest Pakistan Airforce Jobs 2025 - Apply Online | TheJobz.pk',
                'og_description' => 'Find the latest Pakistan Airforce job openings for officers, sailors, and civilians. Apply online and stay updated with TheJobz.pk.',
                'og_image' => 'https://thejobz.pk/resources/assets/images/airforce.webp',
                'og_image_alt' => 'Join Pakistan Airforce - Latest Airforce Jobs 2025',
                'twitter_title' => 'Pakistan Airforce Jobs 2025 - Apply Now',
                'twitter_description' => 'Join the Pakistan Airforce in 2025. Explore latest job openings and apply online.',
                'twitter_image_alt' => 'Apply for Pakistan Airforce Jobs 2025',

            ];
            $JSON_D_Schema = [
                "@context" => "https://schema.org",
                "@type" => "CollectionPage",
                "name" => "Latest Pakistan Airforce Jobs 2025",
                "description" => "Browse the latest Pakistan Airforce job openings for officers, sailors, and civilians. Apply online today.",
                "url" => "https://thejobz.pk/pak-airforce-jobs",
                "hiringOrganization" => [
                    "@type" => "Organization",
                    "name" => "Pakistan Airforce",
                    "sameAs" => "https://thejobz.pk/pak-airforce-jobs"
                ],
                "hasPart" => [],
                "jobLocation" => [
                    "@type" => "Place",
                    "address" => [
                        "addressCountry" => "PK"
                    ]
                ],
                "employmentType" => "Full-time",
                "applicantLocationRequirements" => [
                    "@type" => "Country",
                    "name" => "Pakistan"
                ],
                "publisher" => [
                    "@type" => "Organization",
                    "name" => "TheJobz.pk",
                    "url" => "https://thejobz.pk",
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => "https://thejobz.pk/resources/assets/images/resource/logo9.png",
                        "width" => 600,
                        "height" => 60
                    ]
                ]
            ];
            foreach ($army_jobs as $job) {
                $JSON_D_Schema["hasPart"][] = [
                    "@type" => "JobPosting",
                    "title" => $job->title,
                    "datePosted" => Carbon::parse($job->posted)->format('Y-m-d'),
                    "validThrough" => Carbon::parse($job->posted)->addDays(20)->format('Y-m-d'),
                    "hiringOrganization" => [
                        "@type" => "Organization",
                        "name" => "Pakistan Airforce"
                    ],
                    "jobLocation" => [
                        "@type" => "Place",
                        "address" => [
                            "@type" => "PostalAddress",
                            "streetAddress" => $job->street_address,
                            "addressLocality" => $job->address_locality,
                            "addressRegion" => $job->address_region,
                            "postalCode" =>  $job->postal_code,
                            "addressCountry" => "PK"
                        ]
                    ],
                    "employmentType" => "Full-time",
                    "baseSalary" => [
                        "@type" => "MonetaryAmount",
                        "currency" => "PKR",
                        "description" => "Salary depends on experience and skills."
                    ],
                    "description" => Str::limit($job->meta_description, 300)
                ];
            }

            // **Agar koi job available nahi hai to `hasPart` ko remove kar do**
            if (empty($JSON_D_Schema["hasPart"])) {
                unset($JSON_D_Schema["hasPart"]);
            }

            $data = [
                'title' => 'Latest Pakistan Airforce Jobs 2025 | Join Pak Airforce - TheJobz.pk'
            ];
        }
        if ($endpoint == 'Police-Jobs') {
            $police_jobs = DB::table('job_department')
                ->select('jobs.*')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%police%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.meta_description', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                // ->whereDate('jobs.posted', '>=', \Carbon\Carbon::today())
                ->whereYear('jobs.posted', '>=', 2025)
                ->orderBy('jobs.created_at', 'desc') // Latest jobs first
                ->get()
                ->unique('title') // Unique titles
                ->values() // Index reset karega
                ->take(20);
            $meta_data = [
                'title' => 'Pakistan Police Jobs 2025 - Apply Online for Govt Vacancies | TheJobz.pk',
                'description' => 'Apply online for Pakistan Police jobs 2025. Find the latest government vacancies for officers, sailors, and constables. Stay updated with TheJobz.pk.',
                'keywords' => 'Pakistan Police Jobs 2025, Govt Police Jobs, Police Constable Jobs, Pak Police Careers, Security Jobs Pakistan, TheJobz.pk Jobs, Defense Sector Hiring',
                'canonical' => 'https://thejobz.pk/police-jobs',
                'og_title' => 'Pakistan Police Jobs 2025 - Apply Online for Govt Vacancies | TheJobz.pk',
                'og_description' => 'Find and apply for the latest Police jobs in 2025. Get daily job updates on TheJobz.pk.',
                'og_image' => 'https://thejobz.pk/resources/assets/images/police_logo.jpg',
                'og_image_alt' => 'Join Police - Latest Police Jobs 2025',
                'twitter_title' => 'Pakistan Police Jobs 2025 - Apply Online for Govt Vacancies | TheJobz.pk',
                'twitter_description' => 'Police career opportunities 2025. Apply for the latest officer & sailor jobs. Stay updated with TheJobz.pk',
                'twitter_image_alt' => 'Apply for Police Jobs 2025',

            ];
            $JSON_D_Schema = [
                "@context" => "https://schema.org",
                "@type" => "CollectionPage",
                "name" => "Police Jobs 2025",
                "description" => "Join Police with the latest government job openings. Apply online today.",
                "url" => "https://thejobz.pk/police-jobs",
                "hiringOrganization" => [
                    "@type" => "Organization",
                    "name" => "Police",
                    "sameAs" => "https://thejobz.pk/police-jobs"
                ],
                "jobLocation" => [
                    "@type" => "Place",
                    "address" => [
                        "addressCountry" => "PK"
                    ]
                ],
                "employmentType" => "Full-time",
                "applicantLocationRequirements" => [
                    "@type" => "Country",
                    "name" => "Pakistan"
                ],
                "publisher" => [
                    "@type" => "Organization",
                    "name" => "TheJobz.pk",
                    "url" => "https://thejobz.pk",
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => "https://thejobz.pk/resources/assets/images/resource/logo9.png",
                        "width" => 600,
                        "height" => 60
                    ]
                ]
            ];

            foreach ($police_jobs as $job) {
                $JSON_D_Schema["hasPart"][] = [
                    "@type" => "JobPosting",
                    "title" => $job->title,
                    "datePosted" => Carbon::parse($job->posted)->format('Y-m-d'),
                    "validThrough" => Carbon::parse($job->posted)->addDays(20)->format('Y-m-d'),
                    "hiringOrganization" => [
                        "@type" => "Organization",
                        "name" => "Multiple Police Jobs in Pakistan"
                    ],
                    "jobLocation" => [
                        "@type" => "Place",
                        "address" => [
                            "@type" => "PostalAddress",
                            "streetAddress" => $job->street_address,
                            "addressLocality" => $job->address_locality,
                            "addressRegion" => $job->address_region,
                            "postalCode" =>  $job->postal_code,
                            "addressCountry" => "PK"
                        ]
                    ],
                    "employmentType" => "Full-time",
                    "baseSalary" => [
                        "@type" => "MonetaryAmount",
                        "currency" => "PKR",
                        "description" => "Salary depends on experience and skills."
                    ],
                    "description" => Str::limit($job->meta_description, 300)
                ];
            }

            // **Agar koi job available nahi hai to `hasPart` ko remove kar do**
            if (empty($JSON_D_Schema["hasPart"])) {
                unset($JSON_D_Schema["hasPart"]);
            }

            $data = [
                'title' => 'Join Police 2025 | Latest Govt Jobs & Online Apply - TheJobz.pk'
            ];
        }

        return view('random_catadery_job', compact('army_jobs_count', 'data', 'navy_jobs_count', 'police_jobs_count', 'bank_jobs_count','faqData', 'meta_data', 'JSON_D_Schema'));
        // return view('random_catadery_job')->with('army_jobs_count', $army_jobs_count)->with('navy_jobs_count', $navy_jobs_count)
        //     ->with('police_jobs_count', $police_jobs_count)->with('bank_jobs_count', $bank_jobs_count);
    }

    public function ajx_featch_categorys($name = null, Request $request)
    {
        if ($name == 'pak-army-jobs') {
            if ($request->ajax()) {
                $data =  $users =  DB::table('job_department')
                    // ->selectRaw('job_department.name, job_department.id','jobs.*')
                    // ->select('jobs.id','jobs.img','jobs.posted','jobs.title','jobs.paper_name', 'job_department.name as department','job_city.name as city')
                    ->select('jobs.id', 'jobs.slug', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department')
                    ->join('jobs', 'job_department.id', '=', 'jobs.department')
                    ->where('job_department.name', 'LIKE', '%army%')
                    ->where('jobs.img', '!=', null)
                    ->where('jobs.status', '=', 1)
                    ->where('jobs.is_deleted', '=', 0)
                    ->orderBy('jobs.id', 'DESC')
                    ->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('data', function ($row) {
                        $paper_name =  ucfirst(str_replace('_', ' ', $row->paper_name));
                        $title = Str::limit($row->title, 45);
                        // $img =  asset("public/img/" . '/' . $row->img);
                        $img = asset('storage/app/public/jobs/' . $row->img);
                        $department = Str::limit($row->department, 42);
                        $btn = "<div class='job-listing'> <div class='job-title-sec'> <div class='c-logo'><img class='img_test' src='$img' alt='{$title}' style='width: 60px; height: 60px;'></div><h3><a href='#' title=''> $department</a></h3><span>$title</span><span class='job-lctn'>$row->posted</span></div><a href='" . route('job-single', ['slug' => $row->slug]) . "' target='_blank' title='$row->title' class='aply-btn'>See More</a><span class='job-is ft'> $paper_name</span><span class='fav-job'><i class='la la-heart-o'></i></span></div>";
                        return $btn;
                    })
                    ->rawColumns(['data'])
                    ->make(true);
            }
        } elseif ($name == 'pak-navy-jobs') {
            if ($request->ajax()) {
                $data =  $users =  DB::table('job_department')
                    // ->selectRaw('job_department.name, job_department.id','jobs.*')
                    // ->select('jobs.id','jobs.img','jobs.posted','jobs.title','jobs.paper_name', 'job_department.name as department','job_city.name as city')
                    ->select('jobs.id', 'jobs.slug', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department')
                    ->join('jobs', 'job_department.id', '=', 'jobs.department')
                    ->where('job_department.name', 'LIKE', '%navy%')
                    ->where('jobs.img', '!=', null)
                    ->where('jobs.status', '=', 1)
                    ->where('jobs.is_deleted', '=', 0)
                    ->orderBy('jobs.id', 'DESC')
                    ->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('data', function ($row) {
                        $paper_name =  ucfirst(str_replace('_', ' ', $row->paper_name));
                        $title = Str::limit($row->title, 45);
                        // $img =  asset("public/img/" . '/' . $row->img);
                        $img = asset('storage/app/public/jobs/' . $row->img);

                        $department = Str::limit($row->department, 42);
                        $btn = "<div class='job-listing'> <div class='job-title-sec'> <div class='c-logo'><img class='img_test' src='$img' alt='{$title}' style='width: 60px; height: 60px;'></div><h3><a href='#' title=''> $department</a></h3><span>$title</span><span class='job-lctn'>$row->posted</span></div><a href='" . route('job-single', ['slug' => $row->slug]) . "' target='_blank' title='$row->title' class='aply-btn'>See More</a><span class='job-is ft'> $paper_name</span><span class='fav-job'><i class='la la-heart-o'></i></span></div>";
                        return $btn;
                    })
                    ->rawColumns(['data'])
                    ->make(true);
            }
        } elseif ($name == 'Police-Jobs') {
            if ($request->ajax()) {
                $data =  $users =  DB::table('job_department')
                    // ->selectRaw('job_department.name, job_department.id','jobs.*')
                    // ->select('jobs.id','jobs.img','jobs.posted','jobs.title','jobs.paper_name', 'job_department.name as department','job_city.name as city')
                    ->select('jobs.id', 'jobs.slug', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department')
                    ->join('jobs', 'job_department.id', '=', 'jobs.department')
                    ->where('job_department.name', 'LIKE', '%police%')
                    ->where('jobs.img', '!=', null)
                    ->where('jobs.status', '=', 1)
                    ->where('jobs.is_deleted', '=', 0)
                    ->orderBy('jobs.id', 'DESC')
                    ->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('data', function ($row) {
                        $paper_name =  ucfirst(str_replace('_', ' ', $row->paper_name));
                        $title = Str::limit($row->title, 45);
                        // $img =  asset("public/img/" . '/' . $row->img);
                        $img = asset('storage/app/public/jobs/' . $row->img);

                        $department = Str::limit($row->department, 42);
                        $btn = "<div class='job-listing'> <div class='job-title-sec'> <div class='c-logo'><img class='img_test' src='$img' alt='{$title}' style='width: 60px; height: 60px;'></div><h3><a href='#' title=''> $department</a></h3><span>$title</span><span class='job-lctn'>$row->posted</span></div><a href='" . route('job-single', ['slug' => $row->slug]) . "' target='_blank' title='$row->title' class='aply-btn'>See More</a><span class='job-is ft'> $paper_name</span><span class='fav-job'><i class='la la-heart-o'></i></span></div>";
                        return $btn;
                    })
                    ->rawColumns(['data'])
                    ->make(true);
            }
        } elseif ($name == 'Bank-Jobs') {
            if ($request->ajax()) {
                $data =  $users =  DB::table('job_department')
                    // ->selectRaw('job_department.name, job_department.id','jobs.*')
                    // ->select('jobs.id','jobs.img','jobs.posted','jobs.title','jobs.paper_name', 'job_department.name as department','job_city.name as city')
                    ->select('jobs.id', 'jobs.slug', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department')
                    ->join('jobs', 'job_department.id', '=', 'jobs.department')
                    ->where('job_department.name', 'LIKE', '%bank%')
                    ->where('jobs.img', '!=', null)
                    ->where('jobs.status', '=', 1)
                    ->where('jobs.is_deleted', '=', 0)
                    ->orderBy('jobs.id', 'DESC')
                    ->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('data', function ($row) {
                        $paper_name =  ucfirst(str_replace('_', ' ', $row->paper_name));
                        $title = Str::limit($row->title, 45);
                        // $img =  asset("public/img/" . '/' . $row->img);
                        $img = asset('storage/app/public/jobs/' . $row->img);
                        $department = Str::limit($row->department, 42);
                        $btn = "<div class='job-listing'> <div class='job-title-sec'> <div class='c-logo'><img class='img_test' src='$img' alt='{$title}' style='width: 60px; height: 60px;'></div><h3><a href='#' title=''> $department</a></h3><span>$title</span><span class='job-lctn'>$row->posted</span></div><a href='" . route('job-single', ['slug' => $row->slug]) . "' target='_blank' title='$row->title' class='aply-btn'>See More</a><span class='job-is ft'> $paper_name</span><span class='fav-job'><i class='la la-heart-o'></i></span></div>";
                        return $btn;
                    })
                    ->rawColumns(['data'])
                    ->make(true);
            }
        } else {
            return 'error';
        }

        //    return view('job_department');
        // return view('home')->with('jobs', $jobs)->with('departmentCount', $departmentCount)->with('popular_job_department', $popular_job_department)->with('jobsCount', $jobsCount)->with('job_cityCount', $job_cityCount);
    }

    public function redirectToSlug($id)
    {
        // Find the job by ID
        // return response()->view('errors.404', [], 404);

        $job_single =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'jobs.city', '=', 'job_city.id')
            ->select('jobs.id', 'jobs.slug', 'jobs.department as department_id', 'jobs.view', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_city.name as city')
            ->where('jobs.id', $id)
            ->first();
        // Check if the job exists
        if ($job_single) {
            // Redirect to the new URL using the slug
            return redirect()->to('/job-single/' . $job_single->slug, 301);
        }
        return abort(404);
    }

    public function job_single($slug = null)
    {

        if (is_null($slug)) {
            return response()->view('errors.404', [], 404);
        }
        if (is_numeric($slug)) {
            $job  =  $users = DB::table('jobs')
                ->join('job_department', 'jobs.department', '=', 'job_department.id')
                ->join('job_city', 'jobs.city', '=', 'job_city.id')
                ->select('jobs.id', 'jobs.slug', 'jobs.type', 'jobs.street_address', 'jobs.address_locality', 'jobs.address_region', 'jobs.postal_code', 'jobs.address_country', 'jobs.department as department_id', 'jobs.view', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_department.slug as department_slug', 'job_city.name as city')

                ->where('jobs.is_deleted', 0)
                ->where('jobs.id', $slug)
                ->first();
            if ($job) {
                // return redirect()->route('job-single', ['slug' => $job->slug]);
                return redirect()->route('job-single', ['slug' => $job->slug], 301);
            } else {
                return response()->view('errors.404', [], 404);
            }
        }
        $job_single =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'jobs.city', '=', 'job_city.id')
            ->select('jobs.id', 'jobs.slug', 'jobs.type', 'jobs.street_address', 'jobs.address_locality', 'jobs.address_region', 'jobs.postal_code', 'jobs.address_country', 'jobs.department as department_id', 'jobs.view', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'jobs.meta_keywords', 'jobs.meta_description', 'jobs.BaseSalaryValue', 'jobs.meta_canonical', 'job_department.name as department', 'job_department.slug as department_slug', 'job_city.name as city')

            ->where('jobs.is_deleted', 0)
            ->where('jobs.slug', $slug)
            ->first();

        if (!$job_single) {
            return response()->view('errors.404', [], 404);
            // return redirect('/')->with('message', 'Job not found');
        }

        $view = 1 + $job_single->view;
        DB::table('jobs')->where('slug', $slug)->update(['view' => $view]);

        $relative_jobs =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'jobs.city', '=', 'job_city.id')
            ->select('jobs.id', 'jobs.slug', 'jobs.department as department_id', 'jobs.view', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_city.name as city')
            ->where('job_department.id', $job_single->department_id)
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->orderBy('jobs.id', 'DESC')
            ->take(5)
            ->get();

        return view('job-single')->with('relative_jobs', $relative_jobs)->with('job_single', $job_single);
    }

    public function test_example()
    {
        // Status code here
        $url_segment_one = \Request::segment(1);
        $id = \Request::segment(2);
        $jobs = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'jobs.city', '=', 'job_city.id')
            ->select('jobs.id', 'jobs.department as department_id', 'jobs.view', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_city.name as city')
            ->where('job_department.id', $id)
            ->orderBy('jobs.id', 'DESC')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->get();
        $msg = "This is a simple message.";
        return response()->json(array('action' => $jobs), 200);
    }

    public function contactus_submit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:30',
            'name' => 'required'
        ]);
        $p = $request->all();
        unset($p['_token']);
        DB::table('contacts')->insert($p);
        return redirect()->back()->with('message', 'Mail send successfully');
    }

    public function addWatermark()
    {

        $watermark = Image::make(public_path('Watermark.png'))->opacity(50);
        // $watermark = Image::make(public_path('Watermark.png'));
        $imagePath = storage_path('app/public/jobs/629443_1.jpg');
        $image = Image::make($imagePath);
        $image->insert($watermark, 'center');
        $image->save(public_path('images/test/watermarked.jpg'), 50);
        return 'Watermark added and image optimized successfully!';
    }

    public function downlode(Request $request)
    {
        $job_single =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'jobs.city', '=', 'job_city.id')
            ->select('jobs.id', 'jobs.downlode', 'jobs.department as department_id', 'jobs.view', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_city.name as city')
            ->where('jobs.id', $request->id)
            ->first();

        $downlode = 1 + $job_single->downlode;
        DB::table('jobs')->where('id', $request->id)->update(['downlode' => $downlode]);
        return true;
    }

      public function blogs(Request $request)
    {

        try {

        $blogs = Blog::where('status', 1)
                ->latest()
                ->paginate(6);

            if (!$blogs) {
                // return abort(404);
                return response()->view('errors.404', [], 404);
            }

            $army_jobs_count = DB::table('job_department')
                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%army%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();

            $navy_jobs_count = DB::table('job_department')
                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%navy%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();

            $police_jobs_count = DB::table('job_department')
                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%police%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();

            $bank_jobs_count = DB::table('job_department')


                ->select('jobs.id', 'jobs.img')
                ->join('jobs', 'job_department.id', '=', 'jobs.department')
                ->where('job_department.name', 'LIKE', '%navy%')
                ->where('jobs.img', '!=', null)
                ->where('jobs.status', '=', 1)
                ->where('jobs.is_deleted', '=', 0)
                ->count();


            return view('blogs', compact('blogs','army_jobs_count', 'navy_jobs_count', 'police_jobs_count', 'bank_jobs_count'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('home')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function showblog($slug)
    {
       $blog = Blog::where('slug', $slug)->firstOrFail();
        // Return the view with the blog data
        return view('blog-single', compact('blog'));
    }

}
