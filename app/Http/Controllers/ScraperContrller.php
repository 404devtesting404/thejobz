<?php

namespace App\Http\Controllers;

use App\Model\Jobscity;
use Goutte\Client;
// use Request;
use DB;
use App\Model\Jobspapaer;
use Exception;
use Image;

// use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
// use GuzzleHttp\Client as GuzzleClient;
// use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;



class ScraperContrller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $results = array();
    public $NO = 100;



    public function imageUpload()
    {
        return view('image-upload');
    }

    public function imageWatermark()
    {

        // $img = asset('storage/app/public/jobs/629060_1.jpg');
        $imgPath = storage_path('app/public/jobs/629060_1.jpg');

        // Load the image using the file path
        $img = Image::make($imgPath);


        // $img = Image::make(public_path('img/jang/512885_1.JPG'));
        $img->insert(public_path('Watermark.png'), 'center', 100, 100);
        $img->encode('png');
        $img->save(public_path('images/new-image.png'));
    }

    public function addWatermark(Request $request)
    {
        $image = $request->file('image');

        $input['image'] = time() . '.' . $image->extension();

        // Get path of images folder from /public
        $imageFilePath = public_path('img');

        $img = Image::make($image->path());

        $img->text('By Online Web Tutor', 450, 100, function ($font) {
            // Using font family here
            $font->file(public_path('RobotoMono-Italic-VariableFont_wght.ttf'));
            $font->size(40);
            $font->color('#202124');
            $font->align('center');
            $font->valign('bottom');
        });

        $img->save($imageFilePath . '/' . $input['image']);

        return back()
            ->with('success', 'Image Saved');
    }

    function checkFileExists($url, $name_paper)
    {
        //  dd($url,$name_paper);
        $imgurl = $url . '_1.jpg';
        $imgurl2 = $url . '_1.JPG';
        // print_r($imgurl);
        // echo "<br>";
        if ($name_paper == 'express') {
            $path = 'C:/xampp/htdocs/laravel_Scraper_test/public/img/express/';
        } elseif ($name_paper ==  'jang') {
            $path = 'C:/xampp/htdocs/laravel_Scraper_test/public/img/jang/';
        } elseif ($name_paper ==  'dawn') {
            $path = 'C:/xampp/htdocs/laravel_Scraper_test/public/img/dawn/';
        } elseif ($name_paper ==  'the_news') {
            $path = 'C:/xampp/htdocs/laravel_Scraper_test/public/img/the_news/';
        } elseif ($name_paper ==  'nawaiwaqt') {
            $path = 'C:/xampp/htdocs/laravel_Scraper_test/public/img/nawaiwaqt/';
        } elseif ($name_paper ==  'aaj') {
            $path = 'C:/xampp/htdocs/laravel_Scraper_test/public/img/aaj/';
        } elseif ($name_paper ==  'dunya') {
            $path = 'C:/xampp/htdocs/laravel_Scraper_test/public/img/dunya/';
        } elseif ($name_paper ==  'daily_pak') {
            $path = 'C:/xampp/htdocs/laravel_Scraper_test/public/img/daily_pak/';
        }

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        $headers = @get_headers($imgurl);
        $to_headers = @get_headers($imgurl2);

        if ($name_paper == 'express') {
            $folder_name = 'C:/xampp/htdocs/laravel_Scraper_test/public/images/express/';
        } elseif ($name_paper ==  'jang') {
            $folder_name = 'C:/xampp/htdocs/laravel_Scraper_test/public/images/jang/';
        } elseif ($name_paper ==  'dawn') {
            $folder_name = 'C:/xampp/htdocs/laravel_Scraper_test/public/images/dawn/';
        } elseif ($name_paper ==  'the_news') {
            $folder_name = 'C:/xampp/htdocs/laravel_Scraper_test/public/images/the_news/';
        } elseif ($name_paper ==  'nawaiwaqt') {
            $folder_name = 'C:/xampp/htdocs/laravel_Scraper_test/public/images/nawaiwaqt/';
        } elseif ($name_paper ==  'aaj') {
            $folder_name = 'C:/xampp/htdocs/laravel_Scraper_test/public/images/aaj/';
        } elseif ($name_paper ==  'dunya') {
            $folder_name = 'C:/xampp/htdocs/laravel_Scraper_test/public/images/dunya/';
        } elseif ($name_paper ==  'daily_pak') {
            $folder_name = 'C:/xampp/htdocs/laravel_Scraper_test/public/images/daily_pak/';
        }

        if (!is_dir($folder_name)) {
            mkdir($folder_name, 0755, true);
        }

        if ($headers[0] == 'HTTP/1.1 200 OK') {
            $imgurl = $url . '_1.jpg';
            $my_save_dir = 'C:/xampp/htdocs/laravel_Scraper_test/public/img/';
            $filename = basename(time() . $imgurl);
            $complete_save_loc = $path . $filename;
            file_put_contents($complete_save_loc, file_get_contents($imgurl));
            $imgurl = substr(strrchr($imgurl, "/"), 1);
            $img = Image::make($complete_save_loc);
            // $img->insert(public_path('Watermark.png'), 'center', 100, 100);
            // $img->encode('png');
            // $img->save($folder_name . $filename, 10);
            // return $filename;
            // Calculate the center position for the watermark
            $watermark = Image::make(public_path('Watermark.png'));
            $watermarkWidth = $watermark->width();
            $watermarkHeight = $watermark->height();
            $imageWidth = $img->width();
            $imageHeight = $img->height();
            $positionX = ($imageWidth - $watermarkWidth) / 2;
            $positionY = ($imageHeight - $watermarkHeight) / 2;

            // Insert the watermark at the calculated position
            $img->insert($watermark, 'top-left', (int)$positionX, (int)$positionY);

            // Save the image without re-encoding and maintaining original quality
            $img->save($folder_name . $filename);

            return $filename;

            return $filename;
        }
        if ($to_headers[0] == 'HTTP/1.1 200 OK') {


            $imgurl = $url . '_1.JPG';
            $my_save_dir = 'C:/xampp/htdocs/laravel_Scraper_test/public/img/';
            $filename = basename($imgurl);
            $complete_save_loc = $path . $filename;
            file_put_contents($complete_save_loc, file_get_contents($imgurl));
            $imgurl = substr(strrchr($imgurl, "/"), 1);
            $img = Image::make($complete_save_loc);
            // $img->insert(public_path('Watermark.png'), 'center', 100, 100);
            // $img->encode('png');
            // $img->save($folder_name . $filename);
            // return $filename;
            // Calculate the center position for the watermark
            $watermark = Image::make(public_path('Watermark.png'));
            $watermarkWidth = $watermark->width();
            $watermarkHeight = $watermark->height();
            $imageWidth = $img->width();
            $imageHeight = $img->height();
            $positionX = ($imageWidth - $watermarkWidth) / 2;
            $positionY = ($imageHeight - $watermarkHeight) / 2;

            // Insert the watermark at the calculated position
            $img->insert($watermark, 'top-left', (int)$positionX, (int)$positionY);

            // Save the image without re-encoding and maintaining original quality
            $img->save($folder_name . $filename);

            return $filename;
        }
    }

    public function scraper()
    {
        $client = new Client();
        // dd($name_paper);
        // $url = 'https://www.jobz.pk/jang_jobs/';
        // $page = $client->request('GET', $url);
        // $arr = [];
        // $page->filter('.row_container')->each(function ($item) {
        //   $arr['title']  = $item->filter('.cell1')->text();
        //   $arr['department']  = $item->filter('.cell2')->text();
        //   $arr['city']  = $item->filter('.cell3')->text();
        //   $arr['posted']  = $item->filter('.cell4')->text();
        //   $data = [
        //     'title' =>  $arr['title'],
        //     'department' =>    str_replace(array('&nbsp', ';'), '', $arr['department']),
        //     'city' =>  $arr['city'],
        //     'posted' =>  $arr['posted']
        //   ];
        //   DB::table('jobs')->insertGetId($data);
        // });


        // $no = 6849;
    }
    public function scraper_two()
    {
        $client = new Client();
        $cities_array = ['lahore', 'karachi', 'islamabad', 'faisalabad', 'multan', 'rawalpindi', 'peshawar', 'hyderabad', 'gujranwala', 'bahawalpur', 'sargodha', 'sialkot', 'quetta'];

        $Jobscity = Jobscity::select('name')->get();
        foreach ($cities_array as $city) {
            $url = 'http://' . $city . '.pakistanjobs.pk/';
            try {
                $page = $client->request('GET', $url);
                $page->filter('.color-str')->each(function ($item) {
                    $href = $item->filter('.class-1 a')->attr('href');
                    if (!empty($href)) {
                        $client_inner = new Client();
                        $page_inner = $client_inner->request('GET', $href);
                        $pages_inner['job-d-head'] = $page_inner->filter('#job-d-head')->text();
                        $job = new Jobspapaer;
                        $exists =  $users = Jobspapaer::where('title', '=', $pages_inner['job-d-head'])->first();
                        if (empty($exists)) {
                            $pages_inner['job-detail'] = $page_inner->filter('#job-detail-inner')->text();
                            preg_match('/Industry: (.*?) Functional Area:/', $pages_inner['job-detail'], $matches);
                            $industry = $matches[1] ?? '';

                            preg_match('/Functional Area: (.*?) Job Type:/', $pages_inner['job-detail'], $matches);
                            $area = $matches[1] ?? '';

                            preg_match('/Job Type: (.*?) Job Location:/', $pages_inner['job-detail'], $matches);
                            $jobType = $matches[1] ?? '';

                            preg_match('/Job Location: (.*) Job Nature:/', $pages_inner['job-detail'], $matches);
                            $location = $matches[1] ?? '';

                            preg_match('/Job Nature: (.*?) Gender:/', $pages_inner['job-detail'], $matches);
                            $nature = isset($matches[1]) ? $matches[1] : '';
                            preg_match('/Gender: (.*?) Preference Education:/', $pages_inner['job-detail'], $matches);
                            $gender = $matches[1] ?? '';

                            preg_match('/Education: (.*?) Career Level:/', $pages_inner['job-detail'], $matches);
                            $education = $matches[1] ?? '';

                            preg_match('/Career Level: (.*?) Job Shift:/', $pages_inner['job-detail'], $matches);
                            $career = $matches[1] ?? '';

                            preg_match('/Job Shift: (.*?) Job Posted:/', $pages_inner['job-detail'], $matches);
                            $shift = $matches[1] ?? '';

                            preg_match('/Job Posted: (.*?) Minimum Experience:/', $pages_inner['job-detail'], $matches);
                            $posted = $matches[1] ?? '';

                            preg_match('/Minimum Experience: (.*?) Taken from Newspaper:/', $pages_inner['job-detail'], $matches);
                            $experience = $matches[1] ?? '';

                            preg_match('/Taken from Newspaper: (.*?) Expected Last Date:/', $pages_inner['job-detail'], $matches);
                            $newspaper = $matches[1] ?? '';

                            preg_match('/Expected Last Date: (.*)$/', $pages_inner['job-detail'], $matches);
                            $lastdate = $matches[1] ?? '';
                            $pages_inner['img'] = $page_inner->filter('.image-container')->html();
                            $imgHtml = $pages_inner['img'];
                            $imgCrawler = new Crawler($imgHtml);
                            $imageUrl = $imgCrawler->filter('img')->attr('src');
                            $imageNameWithType = basename($imageUrl);
                            $imageContent = file_get_contents($imageUrl);
                            if ($imageContent !== false) {
                                // Specify the folder where you want to save the image
                                // $folderPath = 'images/';
                                $folderPath = storage_path('app\public\images/');
                                // Check if the folder exists, if not, create it
                                if (!file_exists($folderPath)) {
                                    mkdir($folderPath, 0777, true); // Recursive directory creation
                                }
                                // dd($folderPath);
                                // Save the image to the folder
                                $savedImagePath = $folderPath . $imageNameWithType;
                                file_put_contents($savedImagePath, $imageContent);
                                // Output the path where the image is saved
                                // echo "Image saved: $savedImagePath";
                            } else {
                                echo "Failed to download image from: $imageUrl";
                            }
                            $job->title = $pages_inner['job-d-head'];
                            $job->name = '';
                            $job->industry = $industry;
                            $job->functional_area = $area;
                            $job->job_type = $jobType;
                            $job->job_nature =  $nature;
                            $job->job_shift = $shift;
                            $job->gender = $gender;
                            $job->education = $education;
                            $job->career_level = $career;
                            $job->location = $location;
                            $parts = explode(',', $location);
                            $city = trim($parts[0]);
                            $job->city = $city;
                            $job->experience = $experience;
                            $job->paper_name =  $newspaper;
                            $job->job_last_date = $lastdate;
                            $job->img = $savedImagePath;
                            $job->img_live_url = $imageUrl;
                            $job->link = $href;
                            // $job->created_at =  $posted;
                            $job->save();
                        }
                    }
                });
            } catch (Exception $e) {
                echo 'Error fetching data for city ' . $city . ': ' . $e->getMessage();
            }
        }
        // $this->scraper_express_jobs();
    }

    public function scraper_jang_jobs()
    {
        $paper_array = ['jang_jobs', 'the_news_jobs', 'dawn_jobs', 'nawaiwaqt_jobs', 'aaj_jobs', 'dunya_jobs'];
        $client = new Client();
        $data = []; // Initialize data array

        foreach ($paper_array as $paper) {
            for ($x = 0; $x <= 5; $x++) {
                $url = 'https://www.jobz.pk/' . $paper . '-' . $x . '/';
                try {
                    sleep(2); // 2 seconds delay
                    $crawler = $client->request('GET', $url, [
                        'headers' => [
                            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36'
                        ]
                    ]);


                    $jobLinks = $crawler->filter('.row_container .cell1 a')->extract(['href']);

                    $titles = $crawler->filter('.row_container .cell1 a')->each(function ($node) {
                        return $node->text();
                    });
                    $departments = $crawler->filter('.cell2 a')->each(function ($node) {
                        return $node->text();
                    });
                    $cities = $crawler->filter('.cell3 a')->each(function ($node) {
                        return $node->text();
                    });
                    $postedDates = $crawler->filter('.cell4')->each(function ($node) {
                        return $node->text();
                    });

                    foreach ($jobLinks as $key => $jobLink) {
                        $title = $titles[$key]; 
                        // dd($title);
                        // Check if the title already exists in the database or array
                        $titleExistsInDB = DB::table('jobs')
                            ->where('title_scraper', '=', $title)
                            ->exists();
                        // dd($titleExistsInDB);

                        $titleExistsInArray = array_search($title, array_column($data, 'title')) !== false;
                        if (!$titleExistsInDB && !$titleExistsInArray) {
                        // dd('if');
                        // dd($title);
                        // dd($jobLink);

                            // Fetch the image URL from the job page
                            $client_inner = new Client();
                            $page_inner = $client_inner->request('GET', $jobLink);
                        // dd($page_inner);
                            
                            $jsonLd = $page_inner->filter('script[type="application/ld+json"]')->first()->text();
                        // dd($jsonLd);

                            if ($jsonLd) {
                                $jsonData = json_decode($jsonLd, true);
                                if (isset($jsonData['jobLocation']['address'])) {
                                    $address = $jsonData['jobLocation']['address']; 
                                    $type = $address['@type'] ?? '';
                                    $streetAddress = $address['streetAddress'] ?? '';
                                    $addressLocality = $address['addressLocality'] ?? '';
                                    $addressRegion = $address['addressRegion'] ?? '';
                                    $postalCode = $address['postalCode'] ?? '';
                                    $addressCountry = $address['addressCountry'] ?? 'PK'; 
                                }

                            }

                            $pages_inner['img'] = $page_inner->filter('#ad-pic-cont')->html();

                            $imgHtml = $pages_inner['img'];
                            $imgCrawler = new Crawler($imgHtml);
                            $imageUrl = $imgCrawler->filter('img')->attr('src');

                            // Download the image
                            $uniqueImageName = $this->downloadJobImage($jobLink, $imageUrl);

                            if (!$uniqueImageName) {
                                Log::error("Image download failed for job: $jobLink");
                                continue;
                            }

                            $cityName = str_replace(['&nbsp', ';'], '', $cities[$key]);
                            $departmentName = str_replace(['&nbsp', ';'], '', $departments[$key]);

                            $city_id = DB::table('job_city')->where('name', '=', $cityName)->value('id');
                            if (empty($city_id)) {
                                $city_id = DB::table('job_city')->insertGetId(['name' => $cityName, 'slug' => Str::slug($cityName)]);
                            }

                            $department_id = DB::table('job_department')->where('name', '=', $departmentName)->value('id');
                            if (empty($department_id)) {
                                $department_id = DB::table('job_department')->insertGetId(['name' => $departmentName, 'slug' => Str::slug($departmentName)]);
                            }

                            $endpoint = $this->cleanText($cityName);
                            $department = $this->cleanText($departmentName, 'JOBS');
                            $paper_name = $this->cleanText($paper, 'JOBS');
                            $posted = date('Y-m-d', strtotime($postedDates[$key]));
                            $paper_name = str_replace('_', ' ', $paper);
                            $paper_name = str_replace('jobs', '', $paper_name); 

                            $meta_keywords = "Explore latest jobs in $department, $department JOBS IN $endpoint, Jobs in $department, Jobs in $endpoint, $department jobs, Jobs in Pakistan $endpoint, Jobs in Pakistan $department Jobs in  $endpoint,Jobs, jobs pakistan, pakistan jobs, careers, Recruitment, Employment, Hiring, Banking, CVs, paper jobs, Finance, IT, Marketing, Resume, Work, naukri, Online Jobs, Newspaper Jobs";
                            $meta_description = "Explore latest job $department IN $endpoint . Find the latest $department jobs and opportunities in $endpoint , jobs in $department ,  Apply now for exciting careers in $department , Start new career by applying job in $department of $posted in $paper_name news paper";
                            $meta_canonical = 'https://thejobz.pk/job-single/' . Str::slug($title);


                            $data[] = [
                                'paper_name' => $paper,
                                'title' => $title,
                                'title_scraper' => $title,
                                'slug' => Str::slug($title),
                                'department' => $department_id,
                                'job_type' => '', // Adjust this according to your logic
                                'city' => $city_id,
                                'posted' => $posted,
                                'img' => $uniqueImageName,
                                'img_live_url' => $imageUrl,
                                'link' => $jobLink,
                                'meta_keywords' => $meta_keywords,
                                'meta_description' => $meta_description,
                                'meta_canonical'   => $meta_canonical,

                                'type'  => $type,
                                'street_address'  => $streetAddress,
                                'address_locality'  => $addressLocality,
                                'address_region'  => $addressRegion,
                                'postal_code'  => $postalCode,
                                'address_country'  => $addressCountry, 
                                'status' => 0,
                            ];
                        }
                        // dd($data);

                        // if (!$titleExistsInDB && !$titleExistsInArray) {

                        //     $client_inner = new Client();
                        //     $page_inner = $client_inner->request('GET', $jobLink);
                        //     $pages_inner['img'] = $page_inner->filter('#ad-pic-cont')->html();

                        //     $imgHtml = $pages_inner['img'];
                        //     $imgCrawler = new Crawler($imgHtml); 

                        //     $imageUrl = $imgCrawler->filter('img')->attr('src'); 
                        //     $imageNameWithType = basename($imageUrl);
                        //     $uniqueIdentifier = uniqid();
                        //     $uniqueImageName = $uniqueIdentifier . '_' . $imageNameWithType; 
                        //     $imageContent = file_get_contents($imageUrl); 
                        //     if ($imageContent !== false) {
                        //         $folderPath = storage_path('app/public/jobs/');
                        //         if (!file_exists($folderPath)) {
                        //             mkdir($folderPath, 0777, true);
                        //         }
                        //         $savedImagePath = $folderPath . $uniqueImageName;
                        //         file_put_contents($savedImagePath, $imageContent);
                        //     } else { 
                        //         \Log::error("Failed to download image from: $imageUrl");
                        //     } 

                        //     $cityName = str_replace(['&nbsp', ';'], '', $cities[$key]);
                        //     $departmentName = str_replace(['&nbsp', ';'], '', $departments[$key]);

                        //     $city_id = DB::table('job_city')->where('name', '=', $cityName)->value('id');
                        //     if (empty($city_id)) {
                        //         $city_id = DB::table('job_city')->insertGetId(['name' => $cityName, 'slug' => Str::slug($cityName)]);
                        //     }

                        //     $department_id = DB::table('job_department')->where('name', '=', $departmentName)->value('id');
                        //     if (empty($department_id)) {
                        //         $department_id = DB::table('job_department')->insertGetId(['name' => $departmentName, 'slug' => Str::slug($departmentName)]);
                        //     } 


                        //     $data[] = [
                        //         'paper_name' => $paper,
                        //         'title' => $title,
                        //         'slug' => Str::slug($title),
                        //         'department' => $department_id,
                        //         'job_type' => '', // Adjust this according to your logic
                        //         'city' => $city_id,
                        //         'posted' => date('Y-m-d', strtotime($postedDates[$key])),
                        //         'img' => $uniqueImageName,
                        //         'img_live_url' => $imageUrl,
                        //         'link' => $jobLink,
                        //         'status' => 0,
                        //     ];
                        // }
                    }
                } catch (\Exception $e) {
                    \Log::error("Error fetching URL: $url, Error: " . $e->getMessage());
                }
            }
        }
       

        // Insert jobs into the database
        if (!empty($data)) {
            try {
                DB::table('jobs')->insert($data);
            } catch (\Illuminate\Database\QueryException $e) {
                \Log::error("Duplicate entry detected or database error: " . $e->getMessage());
            }
        } else {
            \Log::info("No data to insert for papers: " . implode(', ', $paper_array));
        }
    }

    public function scraper_jang_jobs__old()
    {
        $paper_array = ['jang_jobs', 'the_news_jobs', 'dawn_jobs', 'nawaiwaqt_jobs', 'aaj_jobs', 'dunya_jobs'];
        $client = new Client();
        foreach ($paper_array as $paper) {
            for ($x = 0; $x <= 1; $x++) {
                $url = 'https://www.jobz.pk/' . $paper . '-' . $x . '/';
                try {
                    $crawler = $client->request('GET', $url);
                    $jobLinks = $crawler->filter('.row_container .cell1 a')->extract(['href']);
                    $titles = $crawler->filter('.row_container .cell1 a')->each(function ($node) {
                        return $node->text();
                    });
                    $departments = $crawler->filter('.cell2 a')->each(function ($node) {
                        return $node->text();
                    });
                    $city = $crawler->filter('.cell3 a')->each(function ($node) {
                        return $node->text();
                    });
                    // Check if .cell4 exists before extracting

                    $postedDates = $crawler->filter('.cell4')->each(function ($node) {
                        return $node->text();
                    });

                    // $arr['title']  = $crawler->filter('.row_container .cell1 a')->text();
                    // $arr['department']  = $crawler->filter('.cell2 a')->text();
                    // $arr['city']  = $crawler->filter('.cell3 a')->text();
                    // $arr['posted']  = $crawler->filter('.cell4')->eq(1)->text();
                    foreach ($jobLinks as $key => $jobLink) {
                        if ($titles[$key]  != 'Job Title') {
                            $existingJob = DB::table('jobs')
                                ->where('title', $titles[$key])
                                ->where('paper_name', $paper)
                                ->where('link', $jobLink)
                                ->exists();
                            if (!$existingJob) {
                                $client_inner = new Client();
                                $page_inner = $client_inner->request('GET', $jobLink);
                                // dd($page_inner);
                                // $pages_inner['job-d-head'] = $page_inner->filter('.job_detail')->text();
                                // $arr['title'] = $page_inner->filter('#head1')->text();
                                // $pages_inner['department']  = $page_inner->filter('.cell2 a')->text();
                                $pages_inner['img'] = $page_inner->filter('#ad-pic-cont')->html();
                                // $pages_inner['posted']  = $crawler->filter('.cell3 a')->text();
                                // $pages_inner['city']  = $crawler->filter('.cell4')->eq(1)->text();
                                // dd($arr['title']);


                                $imgHtml = $pages_inner['img'];
                                $imgCrawler = new Crawler($imgHtml);
                                $imageUrl = $imgCrawler->filter('img')->attr('src');
                                $imageNameWithType = basename($imageUrl);

                                $imageContent = file_get_contents($imageUrl);
                                if ($imageContent !== false) {
                                    $folderPath =  public_path('img/');
                                    if (!file_exists($folderPath)) {
                                        mkdir($folderPath, 0777, true); // Recursive directory creation
                                    }
                                    $savedImagePath = $folderPath . $imageNameWithType;
                                    file_put_contents($savedImagePath, $imageContent);
                                } else {
                                    echo "Failed to download image from: $imageUrl";
                                }

                                //  dd($arr['title']);

                                $city_id = DB::table('job_city')->where('name', '=', str_replace(array('&nbsp', ';'), '', $city[$key]))->value('id');
                                $department_id = DB::table('job_department')->where('name', '=', str_replace(array('&nbsp', ';'), '', $departments[$key]))->value('id');

                                if (empty($city_id)) {
                                    $job_city = [
                                        'name' =>  str_replace(array('&nbsp', ';'), '', $city[$key]),
                                    ];
                                    $city_id = DB::table('job_city')->insertGetId($job_city);
                                }
                                if (empty($department_id)) {
                                    $job_department = [
                                        'name' =>  str_replace(array('&nbsp', ';'), '', $city[$key]),
                                    ];
                                    $department_id = DB::table('job_city')->insertGetId($job_department);
                                }
                                $data[] = [
                                    'paper_name' => $paper,
                                    'title' =>  $titles[$key],
                                    'slug' =>  Str::slug($titles[$key]),
                                    'department' => $department_id,
                                    'job_type' => '', // Adjust this according to your logic
                                    'city' =>  $city_id,
                                    'posted' =>  date('Y-m-d', strtotime($postedDates[$key])),
                                    'img' => $imageNameWithType,
                                    'img_live_url' => $imageUrl,
                                    'link' => $jobLink,
                                    'status' => 0,
                                ];
                            }
                            // dd($data);
                            // DB::table('jobs')->insertGetId($data);
                            // if (!empty($data)) {
                            //     DB::table('jobs')->insert($data);
                            // }
                        }
                    }
                } catch (\Exception $e) {
                    echo "Error fetching URL: " . $e->getMessage() . "\n"; // Error handling
                }
            }
        }
        if (!empty($data)) {
            DB::table('jobs')->insert($data);
        }
    }

    // ok not in local not ok in love

    public function scraper_jang_jobs_old()
    {
        $paper_array = ['jang_jobs', 'the_news_jobs', 'dawn_jobs', 'nawaiwaqt_jobs', 'aaj_jobs', 'dunya_jobs'];
        $client = new Client();
        $data = []; // Initialize data array
        // origin 1 tha count
        foreach ($paper_array as $paper) {
            for ($x = 0; $x <= 5; $x++) {
                $url = 'https://www.jobz.pk/' . $paper . '-' . $x . '/';
                try {
                    sleep(2); // 2 seconds delay
                    $crawler = $client->request('GET', $url, [
                        'headers' => [
                            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36'
                        ]
                    ]);

                    $jobLinks = $crawler->filter('.row_container .cell1 a')->extract(['href']);
                    $titles = $crawler->filter('.row_container .cell1 a')->each(function ($node) {
                        return $node->text();
                    });
                    $departments = $crawler->filter('.cell2 a')->each(function ($node) {
                        return $node->text();
                    });
                    $cities = $crawler->filter('.cell3 a')->each(function ($node) {
                        return $node->text();
                    });
                    $postedDates = $crawler->filter('.cell4')->each(function ($node) {
                        return $node->text();
                    });

                    foreach ($jobLinks as $key => $jobLink) {
                        $title = $titles[$key];

                        // Check if the title already exists in the database
                        $titleExistsInDB = DB::table('jobs')
                            ->where('title', '=', $title)
                            ->exists();

                        // Check if the title already exists in the $data array
                        $titleExistsInArray = array_search($title, array_column($data, 'title')) !== false;

                        if (!$titleExistsInDB && !$titleExistsInArray) {
                            $client_inner = new Client();
                            $page_inner = $client_inner->request('GET', $jobLink);
                            $pages_inner['img'] = $page_inner->filter('#ad-pic-cont')->html();

                            $imgHtml = $pages_inner['img'];
                            $imgCrawler = new Crawler($imgHtml);
                            $imageUrl = $imgCrawler->filter('img')->attr('src');
                            $imageNameWithType = basename($imageUrl);
                            $uniqueIdentifier = uniqid();
                            $uniqueImageName = $uniqueIdentifier . '_' . $imageNameWithType;

                            $imageContent = file_get_contents($imageUrl);
                            if ($imageContent !== false) {
                                $folderPath = storage_path('app/public/jobs/');
                                if (!file_exists($folderPath)) {
                                    mkdir($folderPath, 0777, true);
                                }
                                $savedImagePath = $folderPath . $uniqueImageName;
                                file_put_contents($savedImagePath, $imageContent);
                            } else {
                                \Log::error("Failed to download image from: $imageUrl");
                            }

                            $cityName = str_replace(['&nbsp', ';'], '', $cities[$key]);
                            $departmentName = str_replace(['&nbsp', ';'], '', $departments[$key]);

                            $city_id = DB::table('job_city')->where('name', '=', $cityName)->value('id');
                            if (empty($city_id)) {
                                $city_id = DB::table('job_city')->insertGetId(['name' => $cityName, 'slug' => Str::slug($cityName)]);
                            }

                            $department_id = DB::table('job_department')->where('name', '=', $departmentName)->value('id');
                            if (empty($department_id)) {
                                $department_id = DB::table('job_department')->insertGetId(['name' => $departmentName, 'slug' => Str::slug($departmentName)]);
                            }

                            $endpoint = $this->cleanText($cityName);
                            $department = $this->cleanText($departmentName, 'JOBS');
                            $paper_name = $this->cleanText($paper, 'JOBS');

                            $meta_keywords = "$endpoint, Jobs in $department, Jobs in $endpoint, $department jobs, Jobs in Pakistan $endpoint, Jobs, jobs pakistan, pakistan jobs, careers, Recruitment, Employment, Hiring, Banking, CVs, paper jobs, Finance, IT, Marketing, Resume, Work, naukri, Online Jobs, Newspaper Jobs";
                            $meta_description = "Explore $endpoint jobs. Find the latest $department jobs and opportunities. Apply now for exciting careers in $department!";
                            // $meta_canonical = url("/jobs/$endpoint");
                            $meta_canonical = 'https://thejobz.pk/job-single/' . Str::slug($title);
                            $data[] = [
                                'paper_name' => $paper,
                                'title' => $title,
                                // 'meta_keywords' => $meta_keywords,
                                // 'meta_description' => $meta_description,
                                // 'meta_canonical' => $meta_canonical,
                                'slug' => Str::slug($title),
                                'department' => $department_id,
                                'job_type' => '', // Adjust this according to your logic
                                'city' => $city_id,
                                'posted' => date('Y-m-d', strtotime($postedDates[$key])),
                                'img' => $uniqueImageName,
                                'img_live_url' => $imageUrl,
                                'link' => $jobLink,
                                'status' => 0,
                            ];
                        }
                    }
                } catch (\Exception $e) {
                    \Log::error("Error fetching URL: $url, Error: " . $e->getMessage());
                }
            }
        }

        // Insert jobs into database
        if (!empty($data)) {
            DB::table('jobs')->insert($data);
        } else {
            \Log::info("No data to insert for papers: " . implode(', ', $paper_array));
        }
    }

    function downloadJobImage($jobLink, $imageUrl)
    {
        // Generate a unique name for the image
        $imageNameWithType = basename($imageUrl);
        $uniqueIdentifier = uniqid();
        $uniqueImageName = $uniqueIdentifier . '_' . pathinfo($imageNameWithType, PATHINFO_FILENAME) . '.webp'; // Save as WebP

        // Set up CURL for downloading the image
        $ch = curl_init($imageUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36");
        curl_setopt($ch, CURLOPT_REFERER, "https://www.jobz.pk/");

        // Execute CURL request
        $imageContent = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Handle errors or non-200 responses
        if (curl_errno($ch) || $httpCode !== 200) {
            Log::error("Failed to download image from: $imageUrl, error: " . curl_error($ch));
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        // Save the image to the local storage
        $folderPath = storage_path('app/public/jobs/');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $tempImagePath = $folderPath . 'temp_' . uniqid() . '.' . pathinfo($imageNameWithType, PATHINFO_EXTENSION);

        // Save the original image temporarily
        file_put_contents($tempImagePath, $imageContent);

        // Convert to WebP using Intervention Image
        $webpImagePath = $folderPath . $uniqueImageName;
        $image = \Intervention\Image\Facades\Image::make($tempImagePath);
        $image->encode('webp', 90); // Convert to WebP with 90% quality
        $image->save($webpImagePath);

        // Delete the temporary file
        unlink($tempImagePath);

        return $uniqueImageName;
    }


    public function scraper_jang_jobs()
    {
        $paper_array = ['jang_jobs', 'the_news_jobs', 'dawn_jobs', 'nawaiwaqt_jobs', 'aaj_jobs', 'dunya_jobs'];
        $client = new Client();
        $data = []; // Initialize data array

        foreach ($paper_array as $paper) {
            for ($x = 0; $x <= 5; $x++) {
                $url = 'https://www.jobz.pk/' . $paper . '-' . $x . '/';
                try {
                    sleep(2); // 2 seconds delay
                    $crawler = $client->request('GET', $url, [
                        'headers' => [
                            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36'
                        ]
                    ]);

                    $jobLinks = $crawler->filter('.row_container .cell1 a')->extract(['href']);
                    $titles = $crawler->filter('.row_container .cell1 a')->each(function ($node) {
                        return $node->text();
                    });
                    $departments = $crawler->filter('.cell2 a')->each(function ($node) {
                        return $node->text();
                    });
                    $cities = $crawler->filter('.cell3 a')->each(function ($node) {
                        return $node->text();
                    });
                    $postedDates = $crawler->filter('.cell4')->each(function ($node) {
                        return $node->text();
                    });

                    foreach ($jobLinks as $key => $jobLink) {
                        $title = $titles[$key];

                        // Check if the title already exists in the database or array
                        $titleExistsInDB = DB::table('jobs')
                            ->where('title', '=', $title)
                            ->exists();
                        $titleExistsInArray = array_search($title, array_column($data, 'title')) !== false;
                        if (!$titleExistsInDB && !$titleExistsInArray) {
                            // Fetch the image URL from the job page
                            $client_inner = new Client();
                            $page_inner = $client_inner->request('GET', $jobLink);
                            $pages_inner['img'] = $page_inner->filter('#ad-pic-cont')->html();

                            $imgHtml = $pages_inner['img'];
                            $imgCrawler = new Crawler($imgHtml);
                            $imageUrl = $imgCrawler->filter('img')->attr('src');

                            // Download the image
                            $uniqueImageName = $this->downloadJobImage($jobLink, $imageUrl);

                            if (!$uniqueImageName) {
                                Log::error("Image download failed for job: $jobLink");
                                return;
                            }

                            $cityName = str_replace(['&nbsp', ';'], '', $cities[$key]);
                            $departmentName = str_replace(['&nbsp', ';'], '', $departments[$key]);

                            $city_id = DB::table('job_city')->where('name', '=', $cityName)->value('id');
                            if (empty($city_id)) {
                                $city_id = DB::table('job_city')->insertGetId(['name' => $cityName, 'slug' => Str::slug($cityName)]);
                            }

                            $department_id = DB::table('job_department')->where('name', '=', $departmentName)->value('id');
                            if (empty($department_id)) {
                                $department_id = DB::table('job_department')->insertGetId(['name' => $departmentName, 'slug' => Str::slug($departmentName)]);
                            }

                            $endpoint = $this->cleanText($cityName);
                            $department = $this->cleanText($departmentName, 'JOBS');
                            $paper_name = $this->cleanText($paper, 'JOBS');
                            $posted = date('Y-m-d', strtotime($postedDates[$key]));
                            $paper_name = str_replace('_', ' ', $paper);
                            $paper_name = str_replace('jobs', '', $paper_name);

                            // dd($paper_name);

                            $meta_keywords = "Explore latest jobs in $department, $department JOBS IN $endpoint, Jobs in $department, Jobs in $endpoint, $department jobs, Jobs in Pakistan $endpoint, Jobs in Pakistan $department Jobs in  $endpoint,Jobs, jobs pakistan, pakistan jobs, careers, Recruitment, Employment, Hiring, Banking, CVs, paper jobs, Finance, IT, Marketing, Resume, Work, naukri, Online Jobs, Newspaper Jobs";
                            $meta_description = "Explore latest job $department IN $endpoint . Find the latest $department jobs and opportunities in $endpoint , jobs in $department ,  Apply now for exciting careers in $department , Start new career by applying job in $department of $posted in $paper_name news paper";
                            $meta_canonical = 'https://thejobz.pk/job-single/' . Str::slug($title);

                            $data[] = [
                                'paper_name' => $paper,
                                'title' => $title,
                                'slug' => Str::slug($title),
                                'department' => $department_id,
                                'job_type' => '', // Adjust this according to your logic
                                'city' => $city_id,
                                'posted' => $posted,
                                'img' => $uniqueImageName,
                                'img_live_url' => $imageUrl,
                                'link' => $jobLink,
                                'meta_keywords' => $meta_keywords,
                                'meta_description' => $meta_description,
                                'meta_canonical'   => $meta_canonical,
                                'status' => 0,
                            ];
                        }

                        // if (!$titleExistsInDB && !$titleExistsInArray) {

                        //     $client_inner = new Client();
                        //     $page_inner = $client_inner->request('GET', $jobLink);
                        //     $pages_inner['img'] = $page_inner->filter('#ad-pic-cont')->html();

                        //     $imgHtml = $pages_inner['img'];
                        //     $imgCrawler = new Crawler($imgHtml);
                        //     // dd($imgCrawler);

                        //     $imageUrl = $imgCrawler->filter('img')->attr('src');
                        //     // dd($imageUrl);
                        //     $imageNameWithType = basename($imageUrl);
                        //     $uniqueIdentifier = uniqid();
                        //     $uniqueImageName = $uniqueIdentifier . '_' . $imageNameWithType;
                        //     // dd($uniqueImageName);
                        //     // dd(1);
                        //     $imageContent = file_get_contents($imageUrl);
                        //     dd($imageContent);
                        //     if ($imageContent !== false) {
                        //         $folderPath = storage_path('app/public/jobs/');
                        //         if (!file_exists($folderPath)) {
                        //             mkdir($folderPath, 0777, true);
                        //         }
                        //         $savedImagePath = $folderPath . $uniqueImageName;
                        //         file_put_contents($savedImagePath, $imageContent);
                        //     } else {
                        //         dd($imageUrl);
                        //         \Log::error("Failed to download image from: $imageUrl");
                        //     }
                        //     dd(2);

                        //     $cityName = str_replace(['&nbsp', ';'], '', $cities[$key]);
                        //     $departmentName = str_replace(['&nbsp', ';'], '', $departments[$key]);

                        //     $city_id = DB::table('job_city')->where('name', '=', $cityName)->value('id');
                        //     if (empty($city_id)) {
                        //         $city_id = DB::table('job_city')->insertGetId(['name' => $cityName, 'slug' => Str::slug($cityName)]);
                        //     }

                        //     $department_id = DB::table('job_department')->where('name', '=', $departmentName)->value('id');
                        //     if (empty($department_id)) {
                        //         $department_id = DB::table('job_department')->insertGetId(['name' => $departmentName, 'slug' => Str::slug($departmentName)]);
                        //     }
                        //     dd(3);


                        //     $data[] = [
                        //         'paper_name' => $paper,
                        //         'title' => $title,
                        //         'slug' => Str::slug($title),
                        //         'department' => $department_id,
                        //         'job_type' => '', // Adjust this according to your logic
                        //         'city' => $city_id,
                        //         'posted' => date('Y-m-d', strtotime($postedDates[$key])),
                        //         'img' => $uniqueImageName,
                        //         'img_live_url' => $imageUrl,
                        //         'link' => $jobLink,
                        //         'status' => 0,
                        //     ];
                        // }
                    }
                } catch (\Exception $e) {
                    \Log::error("Error fetching URL: $url, Error: " . $e->getMessage());
                }
            }
        }

        // Insert jobs into the database
        if (!empty($data)) {
            try {
                DB::table('jobs')->insert($data);
            } catch (\Illuminate\Database\QueryException $e) {
                \Log::error("Duplicate entry detected or database error: " . $e->getMessage());
            }
        } else {
            \Log::info("No data to insert for papers: " . implode(', ', $paper_array));
        }
    }



    function cleanText($text, $removeWord = null)
    {
        $text = str_ireplace($removeWord, '', $text); // Specific word remove kare
        $text = preg_replace('/[^a-zA-Z0-9 ]/', ' ', $text); // Special characters remove kare
        return strtoupper(trim(preg_replace('/\s+/', ' ', $text))); // Uppercase kare aur spaces clean kare
    }

    public function scraper_express_jobs()
    {
        $client = new Client();
        for ($x = 0; $x <= 10; $x++) {
            $url = 'https://www.jobz.pk/express_jobs-' . $x . '/';
            $page = $client->request('GET', $url);
            $page->filter('.row_container')->each(function ($item) {
                $arr['title']  = $item->filter('.cell1')->text();
                $arr['title_anchor']  = $item->filter('.cell1')->html();
                $arr['department']  = $item->filter('.cell2')->text();
                $arr['city']  = $item->filter('.cell3')->text();
                $arr['posted']  = $item->filter('.cell4')->text();
                $arr['img_url'] = 'null';
                if ($arr['title'] != 'Job Title') {
                    $tt = strtolower(str_replace(array(' ', '2022', '-'), '', $arr['title_anchor']));
                    $no = (int) filter_var($tt, FILTER_SANITIZE_NUMBER_INT);
                    $date = date('Y-m', strtotime($arr['posted']));
                    $img_url = 'https://www.jobz.pk/images/jobs/' . $date . '/' . $no;
                    $arr['img_url'] = $img_url;
                    $arr['img_name'] = $date . '/' . $no;;
                    $responce = $this->checkFileExists($img_url, 'express');
                    $data = [
                        'paper_name' => 'express',
                        'title' =>  $arr['title'],
                        'department' =>    str_replace(array('&nbsp', ';'), '', $arr['department']),
                        'city' =>  $arr['city'],
                        'posted' =>  date('Y-m-d', strtotime($arr['posted'])),
                        'img' => $responce,
                        'img_live_url' => $arr['img_url'],
                        'link' => $arr['title_anchor']
                    ];

                    $exists =  $users = DB::table('jobs')->where('title', '=', $arr['title'])->first();
                    if (empty($exists)) {
                        $department_id =  $users = DB::table('job_department')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['department']))->first();
                        $city_id =  $users = DB::table('job_city')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['city']))->first();
                        if (empty($department_id)) {
                            $job_department = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['department']),
                            ];
                            $data['department'] =  DB::table('job_department')->insertGetId($job_department);
                        } else {
                            $data['department'] = $department_id->id;
                        }
                        if (empty($city_id)) {
                            $job_city = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['city']),
                            ];
                            $data['city'] =  DB::table('job_city')->insertGetId($job_city);
                        } else {
                            $data['city'] = $city_id->id;
                        }

                        DB::table('jobs')->insertGetId($data);
                    }
                }
            });
        }
        $this->scraper_the_news_jobs();
    }

    public function scraper_the_news_jobs()
    {
        $client = new Client();
        for ($x = 0; $x <= 10; $x++) {
            $url = 'https://www.jobz.pk/the_news_jobs-' . $x . '/';
            $page = $client->request('GET', $url);
            $page->filter('.row_container')->each(function ($item) {
                $arr['title']  = $item->filter('.cell1')->text();
                $arr['title_anchor']  = $item->filter('.cell1')->html();
                $arr['department']  = $item->filter('.cell2')->text();
                $arr['city']  = $item->filter('.cell3')->text();
                $arr['posted']  = $item->filter('.cell4')->text();
                $arr['img_url'] = 'null';
                if ($arr['title'] != 'Job Title') {
                    $tt = strtolower(str_replace(array(' ', '2022', '-'), '', $arr['title_anchor']));
                    $no = (int) filter_var($tt, FILTER_SANITIZE_NUMBER_INT);
                    $date = date('Y-m', strtotime($arr['posted']));
                    $img_url = 'https://www.jobz.pk/images/jobs/' . $date . '/' . $no;
                    $arr['img_url'] = $img_url;
                    $arr['img_name'] = $date . '/' . $no;;
                    $responce = $this->checkFileExists($img_url, 'the_news');
                    $data = [
                        'paper_name' => 'the_news',
                        'title' =>  $arr['title'],
                        'department' =>    str_replace(array('&nbsp', ';'), '', $arr['department']),
                        'city' =>  $arr['city'],
                        'posted' =>  date('Y-m-d', strtotime($arr['posted'])),
                        'img' => $responce,
                        'img_live_url' => $arr['img_url'],
                        'link' => $arr['title_anchor']
                    ];

                    $exists =  $users = DB::table('jobs')->where('title', '=', $arr['title'])->first();
                    if (empty($exists)) {
                        $department_id =  $users = DB::table('job_department')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['department']))->first();
                        $city_id =  $users = DB::table('job_city')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['city']))->first();
                        if (empty($department_id)) {
                            $job_department = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['department']),
                            ];
                            $data['department'] =  DB::table('job_department')->insertGetId($job_department);
                        } else {
                            $data['department'] = $department_id->id;
                        }
                        if (empty($city_id)) {
                            $job_city = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['city']),
                            ];
                            $data['city'] =  DB::table('job_city')->insertGetId($job_city);
                        } else {
                            $data['city'] = $city_id->id;
                        }

                        DB::table('jobs')->insertGetId($data);
                    }
                }
            });
        }
        $this->scraper_dawn_jobs();
    }

    public function scraper_dawn_jobs()
    {
        $client = new Client();
        for ($x = 0; $x <= 10; $x++) {
            $url = 'https://www.jobz.pk/dawn_jobs-' . $x . '/';
            $page = $client->request('GET', $url);
            $page->filter('.row_container')->each(function ($item) {
                $arr['title']  = $item->filter('.cell1')->text();
                $arr['title_anchor']  = $item->filter('.cell1')->html();
                $arr['department']  = $item->filter('.cell2')->text();
                $arr['city']  = $item->filter('.cell3')->text();
                $arr['posted']  = $item->filter('.cell4')->text();
                $arr['img_url'] = 'null';
                if ($arr['title'] != 'Job Title') {
                    $tt = strtolower(str_replace(array(' ', '2022', '-'), '', $arr['title_anchor']));
                    $no = (int) filter_var($tt, FILTER_SANITIZE_NUMBER_INT);
                    $date = date('Y-m', strtotime($arr['posted']));
                    $img_url = 'https://www.jobz.pk/images/jobs/' . $date . '/' . $no;
                    $arr['img_url'] = $img_url;
                    $arr['img_name'] = $date . '/' . $no;;
                    $responce = $this->checkFileExists($img_url, 'dawn');
                    $data = [
                        'paper_name' => 'dawn',
                        'title' =>  $arr['title'],
                        'department' =>    str_replace(array('&nbsp', ';'), '', $arr['department']),
                        'city' =>  $arr['city'],
                        'posted' =>  date('Y-m-d', strtotime($arr['posted'])),
                        'img' => $responce,
                        'img_live_url' => $arr['img_url'],
                        'link' => $arr['title_anchor']
                    ];

                    $exists =  $users = DB::table('jobs')->where('title', '=', $arr['title'])->first();
                    if (empty($exists)) {
                        $department_id =  $users = DB::table('job_department')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['department']))->first();
                        $city_id =  $users = DB::table('job_city')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['city']))->first();
                        if (empty($department_id)) {
                            $job_department = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['department']),
                            ];
                            $data['department'] =  DB::table('job_department')->insertGetId($job_department);
                        } else {
                            $data['department'] = $department_id->id;
                        }
                        if (empty($city_id)) {
                            $job_city = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['city']),
                            ];
                            $data['city'] =  DB::table('job_city')->insertGetId($job_city);
                        } else {
                            $data['city'] = $city_id->id;
                        }

                        DB::table('jobs')->insertGetId($data);
                    }
                }
            });
        }
        $this->scraper_nawaiwaqt_jobs();
    }

    public function scraper_nawaiwaqt_jobs()
    {
        $client = new Client();
        for ($x = 0; $x <= 10; $x++) {
            $url = 'https://www.jobz.pk/nawaiwaqt_jobs-' . $x . '/';
            $page = $client->request('GET', $url);
            $page->filter('.row_container')->each(function ($item) {
                $arr['title']  = $item->filter('.cell1')->text();
                $arr['title_anchor']  = $item->filter('.cell1')->html();
                $arr['department']  = $item->filter('.cell2')->text();
                $arr['city']  = $item->filter('.cell3')->text();
                $arr['posted']  = $item->filter('.cell4')->text();
                $arr['img_url'] = 'null';
                if ($arr['title'] != 'Job Title') {
                    $tt = strtolower(str_replace(array(' ', '2022', '-'), '', $arr['title_anchor']));
                    $no = (int) filter_var($tt, FILTER_SANITIZE_NUMBER_INT);
                    $date = date('Y-m', strtotime($arr['posted']));
                    $img_url = 'https://www.jobz.pk/images/jobs/' . $date . '/' . $no;
                    $arr['img_url'] = $img_url;
                    $arr['img_name'] = $date . '/' . $no;;
                    $responce = $this->checkFileExists($img_url, 'nawaiwaqt');
                    $data = [
                        'paper_name' => 'nawaiwaqt',
                        'title' =>  $arr['title'],
                        'department' =>    str_replace(array('&nbsp', ';'), '', $arr['department']),
                        'city' =>  $arr['city'],
                        'posted' =>  date('Y-m-d', strtotime($arr['posted'])),
                        'img' => $responce,
                        'img_live_url' => $arr['img_url'],
                        'link' => $arr['title_anchor']
                    ];

                    $exists =  $users = DB::table('jobs')->where('title', '=', $arr['title'])->first();
                    if (empty($exists)) {
                        $department_id =  $users = DB::table('job_department')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['department']))->first();
                        $city_id =  $users = DB::table('job_city')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['city']))->first();
                        if (empty($department_id)) {
                            $job_department = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['department']),
                            ];
                            $data['department'] =  DB::table('job_department')->insertGetId($job_department);
                        } else {
                            $data['department'] = $department_id->id;
                        }
                        if (empty($city_id)) {
                            $job_city = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['city']),
                            ];
                            $data['city'] =  DB::table('job_city')->insertGetId($job_city);
                        } else {
                            $data['city'] = $city_id->id;
                        }

                        DB::table('jobs')->insertGetId($data);
                    }
                }
            });
        }
        $this->scraper_aaj_jobs();
    }
    public function scraper_aaj_jobs()
    {
        $client = new Client();
        for ($x = 0; $x <= 10; $x++) {
            $url = 'https://www.jobz.pk/aaj_jobs-' . $x . '/';
            $page = $client->request('GET', $url);
            $page->filter('.row_container')->each(function ($item) {
                $arr['title']  = $item->filter('.cell1')->text();
                $arr['title_anchor']  = $item->filter('.cell1')->html();
                $arr['department']  = $item->filter('.cell2')->text();
                $arr['city']  = $item->filter('.cell3')->text();
                $arr['posted']  = $item->filter('.cell4')->text();
                $arr['img_url'] = 'null';
                if ($arr['title'] != 'Job Title') {
                    $tt = strtolower(str_replace(array(' ', '2022', '-'), '', $arr['title_anchor']));
                    $no = (int) filter_var($tt, FILTER_SANITIZE_NUMBER_INT);
                    $date = date('Y-m', strtotime($arr['posted']));
                    $img_url = 'https://www.jobz.pk/images/jobs/' . $date . '/' . $no;
                    $arr['img_url'] = $img_url;
                    $arr['img_name'] = $date . '/' . $no;;
                    $responce = $this->checkFileExists($img_url, 'aaj');
                    $data = [
                        'paper_name' => 'aaj',
                        'title' =>  $arr['title'],
                        'department' =>    str_replace(array('&nbsp', ';'), '', $arr['department']),
                        'city' =>  $arr['city'],
                        'posted' =>  date('Y-m-d', strtotime($arr['posted'])),
                        'img' => $responce,
                        'img_live_url' => $arr['img_url'],
                        'link' => $arr['title_anchor']
                    ];

                    $exists =  $users = DB::table('jobs')->where('title', '=', $arr['title'])->first();
                    if (empty($exists)) {
                        $department_id =  $users = DB::table('job_department')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['department']))->first();
                        $city_id =  $users = DB::table('job_city')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['city']))->first();
                        if (empty($department_id)) {
                            $job_department = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['department']),
                            ];
                            $data['department'] =  DB::table('job_department')->insertGetId($job_department);
                        } else {
                            $data['department'] = $department_id->id;
                        }
                        if (empty($city_id)) {
                            $job_city = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['city']),
                            ];
                            $data['city'] =  DB::table('job_city')->insertGetId($job_city);
                        } else {
                            $data['city'] = $city_id->id;
                        }

                        DB::table('jobs')->insertGetId($data);
                    }
                }
            });
        }
        $this->scraper_dunya_jobs();
    }
    public function scraper_dunya_jobs()
    {
        $client = new Client();
        for ($x = 0; $x <= 10; $x++) {
            $url = 'https://www.jobz.pk/dunya_jobs-' . $x . '/';
            $page = $client->request('GET', $url);
            $page->filter('.row_container')->each(function ($item) {
                $arr['title']  = $item->filter('.cell1')->text();
                $arr['title_anchor']  = $item->filter('.cell1')->html();
                $arr['department']  = $item->filter('.cell2')->text();
                $arr['city']  = $item->filter('.cell3')->text();
                $arr['posted']  = $item->filter('.cell4')->text();
                $arr['img_url'] = 'null';
                if ($arr['title'] != 'Job Title') {
                    $tt = strtolower(str_replace(array(' ', '2022', '-'), '', $arr['title_anchor']));
                    $no = (int) filter_var($tt, FILTER_SANITIZE_NUMBER_INT);
                    $date = date('Y-m', strtotime($arr['posted']));
                    $img_url = 'https://www.jobz.pk/images/jobs/' . $date . '/' . $no;
                    $arr['img_url'] = $img_url;
                    $arr['img_name'] = $date . '/' . $no;;
                    $responce = $this->checkFileExists($img_url, 'dunya');
                    $data = [
                        'paper_name' => 'dunya',
                        'title' =>  $arr['title'],
                        'department' =>    str_replace(array('&nbsp', ';'), '', $arr['department']),
                        'city' =>  $arr['city'],
                        'posted' =>  date('Y-m-d', strtotime($arr['posted'])),
                        'img' => $responce,
                        'img_live_url' => $arr['img_url'],
                        'link' => $arr['title_anchor']
                    ];

                    $exists =  $users = DB::table('jobs')->where('title', '=', $arr['title'])->first();
                    if (empty($exists)) {
                        $department_id =  $users = DB::table('job_department')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['department']))->first();
                        $city_id =  $users = DB::table('job_city')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['city']))->first();
                        if (empty($department_id)) {
                            $job_department = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['department']),
                            ];
                            $data['department'] =  DB::table('job_department')->insertGetId($job_department);
                        } else {
                            $data['department'] = $department_id->id;
                        }
                        if (empty($city_id)) {
                            $job_city = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['city']),
                            ];
                            $data['city'] =  DB::table('job_city')->insertGetId($job_city);
                        } else {
                            $data['city'] = $city_id->id;
                        }

                        DB::table('jobs')->insertGetId($data);
                    }
                }
            });
        }
        $this->scraper_daily_pak_jobs();
    }
    public function scraper_daily_pak_jobs()
    {
        $client = new Client();
        for ($x = 0; $x <= 10; $x++) {
            $url = 'https://www.jobz.pk/daily_pak_jobs-' . $x . '/';
            $page = $client->request('GET', $url);
            $page->filter('.row_container')->each(function ($item) {
                $arr['title']  = $item->filter('.cell1')->text();
                $arr['title_anchor']  = $item->filter('.cell1')->html();
                $arr['department']  = $item->filter('.cell2')->text();
                $arr['city']  = $item->filter('.cell3')->text();
                $arr['posted']  = $item->filter('.cell4')->text();
                $arr['img_url'] = 'null';
                if ($arr['title'] != 'Job Title') {
                    $tt = strtolower(str_replace(array(' ', '2022', '-'), '', $arr['title_anchor']));
                    $no = (int) filter_var($tt, FILTER_SANITIZE_NUMBER_INT);
                    $date = date('Y-m', strtotime($arr['posted']));
                    $img_url = 'https://www.jobz.pk/images/jobs/' . $date . '/' . $no;
                    $arr['img_url'] = $img_url;
                    $arr['img_name'] = $date . '/' . $no;;

                    $responce = $this->checkFileExists($img_url, 'daily_pak');
                    $data = [
                        'paper_name' => 'daily_pak',
                        'title' =>  $arr['title'],
                        'department' =>    str_replace(array('&nbsp', ';'), '', $arr['department']),
                        'city' =>  $arr['city'],
                        'posted' =>  date('Y-m-d', strtotime($arr['posted'])),
                        'img' => $responce,
                        'img_live_url' => $arr['img_url'],
                        'link' => $arr['title_anchor']
                    ];

                    $exists =  $users = DB::table('jobs')->where('title', '=', $arr['title'])->first();
                    if (empty($exists)) {
                        $department_id =  $users = DB::table('job_department')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['department']))->first();
                        $city_id =  $users = DB::table('job_city')->select('id')->where('name', '=', str_replace(array('&nbsp', ';'), '', $arr['city']))->first();
                        if (empty($department_id)) {
                            $job_department = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['department']),
                            ];
                            $data['department'] =  DB::table('job_department')->insertGetId($job_department);
                        } else {
                            $data['department'] = $department_id->id;
                        }
                        if (empty($city_id)) {
                            $job_city = [
                                'name' =>  str_replace(array('&nbsp', ';'), '', $arr['city']),
                            ];
                            $data['city'] =  DB::table('job_city')->insertGetId($job_city);
                        } else {
                            $data['city'] = $city_id->id;
                        }

                        DB::table('jobs')->insertGetId($data);
                    }
                }
            });
        }
        echo "Commplete Scrap All";
    }
}
