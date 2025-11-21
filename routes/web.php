<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\AddsController;
use App\Http\Controllers\Admin\GoldRateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/make-small-images', [App\Http\Controllers\WebController::class, 'generatesmallimages'])->name('make-small-images');
Route::get('/me', [App\Http\Controllers\WebController::class, 'me'])->name('me');
Route::post('/generate-text', [\App\Http\Controllers\CohereController::class, 'generateText'])->name('generate-text');
Route::view('/generate', 'generate');

Route::get('view', [Controller::class, 'index']);
Route::get('get/{filename}', [Controller::class, 'getfile']);

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});

Route::post('/removeWatermark', [\App\Http\Controllers\ImageController::class, 'removeWatermark'])->name('removeWatermark');

Route::get('/privacy_policy', function () {
      return view('privacy_seurty_content');
})->name('privacy-policy');

Route::get('/about', function () {
      return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact_us');
})->name('contact');


Route::get('/test', function () {
    return view('test');
});

Route::get('/testing', function () {
    return view('testing');
});

Route::get('/app1', function () {
    return view('layouts.app1');
});

Route::get('/app2', function () {
    return view('layouts.app2');
});
// Route::post('save', [Controller::class, 'save'])->name('save');

Route::get('/addWatermark', [App\Http\Controllers\WebController::class, 'addWatermark'])->name('addWatermark');

Route::get('/email', [MailController::class, 'sendEmail']);

Route::get('/tes_tt', [\App\Http\Controllers\ScraperContrller::class, 'tes_tt'])->name('tes_tt');
Route::get('/scraper', [\App\Http\Controllers\ScraperContrller::class, 'scraper_jang_jobs'])->name('scraper')->middleware('is_admin');
Route::get('/scraper_two', [\App\Http\Controllers\ScraperContrller::class, 'scraper_two'])->name('scraper_two');
Route::get('/image-upload', [\App\Http\Controllers\ScraperContrller::class, 'imageUpload']);
Route::post('/addWatermark', [\App\Http\Controllers\ScraperContrller::class, 'addWatermark'])->name('add-watermark');
Route::get('/imageWatermark', [\App\Http\Controllers\ScraperContrller::class, 'imageWatermark']);

Route::get('/', [App\Http\Controllers\WebController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\WebController::class, 'home'])->name('home');
// Route::post('/search', [App\Http\Controllers\WebController::class, 'search'])->name('search');
Route::match(['get', 'post'], 'search', [App\Http\Controllers\WebController::class, 'search'])->name('search');




Route::get('job_single/{slug}', function ($slug) {
    return redirect()->route('job-single', ['slug' => $slug], 301);
});

// New route for job details
Route::get('job-single/{slug}', [App\Http\Controllers\WebController::class, 'job_single'])
    ->name('job-single');
Route::get('related-jobs/{id}', [App\Http\Controllers\WebController::class, 'relatedJobs'])->name('related.jobs');

// Route::get('/contact_us', [App\Http\Controllers\WebController::class, 'contact_us'])->name('contact_us');
Route::permanentRedirect('/Bank_Jobs', '/Bank-Jobs');
Route::permanentRedirect('/Police_Jobs', '/Police-Jobs');

Route::get('/pak-army-jobs', [App\Http\Controllers\WebController::class, 'random_catadery_job'])->name('pak-army-jobs');
Route::get('/pak-navy-jobs', [App\Http\Controllers\WebController::class, 'random_catadery_job'])->name('pak-navy-jobs');
Route::get('/pak-airforce-jobs', [App\Http\Controllers\WebController::class, 'random_catadery_job'])->name('pak-airforce-jobs');
Route::get('/civilian-jobs', [App\Http\Controllers\WebController::class, 'random_catadery_job'])->name('civilian-jobs');
// civilian-jobs
 
Route::get('/Police-Jobs', [App\Http\Controllers\WebController::class, 'random_catadery_job'])->name('Police-Jobs');
Route::get('/Bank-Jobs', [App\Http\Controllers\WebController::class, 'random_catadery_job'])->name('Bank-Jobs');
Route::get('/ajx_featch_categorys/{id}', [App\Http\Controllers\WebController::class, 'ajx_featch_categorys'])->name('ajx_featch_categorys');
Route::get('/blogs', [App\Http\Controllers\WebController::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [App\Http\Controllers\WebController::class, 'showblog'])->name('blog.show');

Route::post('/downlode', [App\Http\Controllers\WebController::class, 'downlode'])->name('downlode');

Route::get('job_department/{slug}', function ($slug) {
    return redirect()->route('job-department', ['slug' => $slug], 301);
});
Route::get('/job-department/{slug}', [App\Http\Controllers\WebController::class, 'job_department'])->name('job-department');
Route::get('/job-newspaper/{slug}', [App\Http\Controllers\WebController::class, 'job_paper'])->name('job-newspaper');
Route::get('/ajx_featch_paper_jobs/{id}', [App\Http\Controllers\WebController::class, 'ajx_featch_paper_jobs'])->name('ajx_featch_paper_jobs');
Route::get('/ajx_featch/{id}', [App\Http\Controllers\WebController::class, 'ajx_featch'])->name('ajx_featch');
Route::get('/ajx_city/{id}', [App\Http\Controllers\WebController::class, 'ajx_city'])->name('ajx_city');
Route::get('/see_more_jobs', [App\Http\Controllers\WebController::class, 'see_more_jobs'])->name('see_more_jobs');
Route::get('job_city/{slug}', function ($slug) {
    return redirect()->route('job-city', ['slug' => $slug], 301);
});
Route::get('/job-city/{slug}', [App\Http\Controllers\WebController::class, 'job_city'])->name('job-city');
Route::post('/contactus_submit', [App\Http\Controllers\WebController::class, 'contactus_submit'])->name('contactus_submit');


// Route::get('/jobs_home', [App\Http\Controllers\WebController::class, 'index'])->name('jobs_home');
// Route::get('/testing_fff', [App\Http\Controllers\WebController::class, 'testing_fff'])->name('testing_fff');
// Route::get('users', ['uses'=>'UserController@index', 'as'=>'users.index']);
// Route::group(['prefix' => 'admin/job', 'as' => 'admin.job','middleware'=>['is_admin']], function () {
// Route::post('add-new', 'JobsController@store')->name('store');
// Route::get('list', 'JobsController@list')->name('list');
// Route::post('delete', 'JobsController@delete')->name('delete');
// Route::post('status', 'JobsController@status')->name('status');
// Route::post('edit', 'JobsController@edit')->name('edit');
// Route::post('update', 'JobsController@update')->name('update');
// });
Auth::routes();
//Admin Routes

Route::get('/user/dashboard', [AddsController::class, 'edit'])->name('user.dashboard')->middleware('IsEmployer');


Route::post('admin/job/delete_three_month_old_jobs', [App\Http\Controllers\Admin\JobsController::class, 'delete_three_month_old_jobs'])->name('admin.job.delete_three_month_old_jobs')->middleware('is_admin');
Route::post('admin/job/delete_all_jobs_without_img', [App\Http\Controllers\Admin\JobsController::class, 'delete_jobs_with_out_img'])->name('admin.job.delete_all_jobs_without_img')->middleware('is_admin');
Route::get('admin/job/list', [App\Http\Controllers\Admin\JobsController::class, 'list'])->name('admin.job.list')->middleware('is_admin');
// Route::post('admin/job/delete', [App\Http\Controllers\Admin\JobsController::class, 'delete'])->name('admin.job.delete')->middleware('is_admin');
Route::delete('admin/delete-job/{id}', [App\Http\Controllers\Admin\JobsController::class, 'deleteJob'])->name('delete.job');

Route::get('admin/job/delete_two', [App\Http\Controllers\Admin\JobsController::class, 'delete_two'])->name('admin.job.delete_two')->middleware('is_admin');
Route::post('admin/job/updatetwo', [App\Http\Controllers\Admin\JobsController::class, 'updatetwo'])->name('admin.job.updatetwo')->middleware('is_admin');
Route::post('admin/job/generate', [App\Http\Controllers\Admin\JobsController::class, 'generate'])->name('admin.job.generate')->middleware('is_admin');
Route::get('admin/job/console', [App\Http\Controllers\Admin\JobsController::class, 'console'])->name('admin.job.console')->middleware('is_admin');

Route::get('admin/job/images', [App\Http\Controllers\Admin\JobsController::class, 'images'])->name('admin.job.images')->middleware('is_admin');
Route::get('admin/job/auto', [App\Http\Controllers\Admin\JobsController::class, 'auto'])->name('admin.job.auto')->middleware('is_admin');
Route::get('admin/job/googleIndex{slug}', [App\Http\Controllers\Admin\JobsController::class, 'googleIndex'])->name('admin.job.googleIndex')->middleware('is_admin');


Route::get('admin/job/content_update', [App\Http\Controllers\Admin\JobsController::class, 'content_update'])->name('admin.job.content_update')->middleware('IsEmployer');
Route::get('admin/job/alljobs', [App\Http\Controllers\Admin\JobsController::class, 'alljobs'])->name('admin.job.alljobs')->middleware('is_admin');
Route::post('admin/job/updatefb', [App\Http\Controllers\Admin\JobsController::class, 'updatefb'])->name('admin.job.updatefb')->middleware('is_admin');


Route::post('admin/job/edit', [App\Http\Controllers\Admin\JobsController::class, 'edit'])->name('admin.job.edit')->middleware('is_admin');
Route::get('admin/home', [App\Http\Controllers\Admin\AdminController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('admin/popular_job_city', [App\Http\Controllers\Admin\AdminController::class, 'popular_job_city'])->name('admin.popular_job_city')->middleware('is_admin');
Route::get('admin/popular_job', [App\Http\Controllers\Admin\AdminController::class, 'popular_job'])->name('admin.popular_job')->middleware('is_admin');
//contacts
Route::get('admin/contacts/list', [App\Http\Controllers\Admin\ContactController::class, 'list'])->name('admin.contacts.list')->middleware('is_admin');
Route::get('admin/contacts/delete', [App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('admin.contacts.delete')->middleware('is_admin');

Route::get('admin/business-settings/web-config', [App\Http\Controllers\Admin\BusinessSettingsController::class, 'website_info'])->name('admin.business-settings.web-config')->middleware('is_admin');
Route::get('admin/business-settings/maintenance-add', [App\Http\Controllers\Admin\BusinessSettingsController::class, 'maintenance_add'])->name('admin.business-settings.maintenance-add')->middleware('is_admin');
Route::get('admin/business-settings/alert_add_update', [App\Http\Controllers\Admin\BusinessSettingsController::class, 'alert_add_update'])->name('admin.business-settings.alert_add_update')->middleware('is_admin');
Route::get('admin/business-settings/adsterra_social_adds', [App\Http\Controllers\Admin\BusinessSettingsController::class, 'adsterra_social_adds'])->name('admin.business-settings.adsterra_social_adds')->middleware('is_admin');
Route::get('admin/business-settings/whatsappJoinModal', [App\Http\Controllers\Admin\BusinessSettingsController::class, 'whatsappJoinModal'])->name('admin.business-settings.whatsappJoinModal')->middleware('is_admin');


Route::get('admin/blog/index', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('admin.blog.index')->middleware('IsEmployer');
Route::post('admin/blog/store', [App\Http\Controllers\Admin\BlogController::class, 'store'])->name('admin.blog.store')->middleware('IsEmployer');
Route::get('admin/blog/{id}/edit', [App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('admin.blog.edit')->middleware('IsEmployer');
Route::delete('admin/blog/{id}', [App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('admin.blog.destroy')->middleware('IsEmployer');

Route::post('admin/blog/{blog}/toggle-status', [App\Http\Controllers\Admin\BlogController::class, 'toggleStatus'])->name('admin.blog.toggle-status')->middleware('IsEmployer');

Route::get('admin/blog/create', [App\Http\Controllers\Admin\BlogController::class, 'create'])->name('admin.blog.create')->middleware('IsEmployer');
Route::put('/admin/blog/{id}', [App\Http\Controllers\Admin\BlogController::class, 'update'])->name('admin.blog.update')->middleware('IsEmployer');

Route::get('/admin/adds/list', [AddsController::class, 'list'])->name('admin.adds.list')->middleware('is_admin');
Route::get('/admin/adds/edit', [AddsController::class, 'edit'])->name('admin.adds.edit')->middleware('is_admin');
Route::get('/admin/adds/update', [AddsController::class, 'edit'])->name('admin.adds.edit')->middleware('is_admin');
Route::get('/admin/adds/update', [JobController::class, 'edit'])->name('admin.adds.edit')->middleware('is_admin');
Route::get('/admin/adds/getGoldRate', [GoldRateController::class, 'getGoldRate'])->name('admin.adds.getGoldRate')->middleware('is_admin');
Route::get('/admin/adds/scrape_gold', [GoldRateController::class, 'scrape_gold'])->name('admin.adds.scrape_gold')->middleware('is_admin');


Route::get('/gold-rates', function () {
    return view('gold_rates');
})->name('gold-rates');;

// Route::get('/ajx_overall_gold', [GoldRateController::class, 'getOverallGoldRates'])->name('ajx_overall_gold');
// Route::get('/ajx_city_gold', [GoldRateController::class, 'getCityGoldRates'])->name('ajx_city_gold');



Route::get('/gold', [GoldRateController::class, 'index'])->name('gold.page');

// API endpoints used by JS
Route::get('/api/gold/overall', [GoldRateController::class, 'apiOverall'])->name('api.gold.overall');
Route::get('/api/gold/cities', [GoldRateController::class, 'apiCities'])->name('api.gold.cities');
Route::get('/api/gold/last10', [GoldRateController::class, 'apiLast10'])->name('api.gold.last10');

Route::get('/api/comments', [GoldRateController::class, 'apiComments'])->name('api.comments');
Route::post('/api/comments', [GoldRateController::class, 'postComment'])->name('api.comments.post');

Route::post('/api/chat', [GoldRateController::class, 'postChat'])->name('api.chat.post');
Route::get('/api/chat/analytics', [GoldRateController::class, 'apiChatAnalytics'])->name('api.chat.analytics');

Route::get('/admin/adds/getGoldRate', [GoldRateController::class, 'getGoldRate'])->name('admin.adds.getGoldRate')->middleware('is_admin');
Route::get('/admin/adds/scrape_gold', [GoldRateController::class, 'scrape_gold'])->name('admin.adds.scrape_gold')->middleware('is_admin');


Route::get('/sitemap', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');
