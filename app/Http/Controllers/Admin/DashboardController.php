<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\FileUpload;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Lesson;
use App\User;
use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    public function index()
    {
        $data['total_users'] = User::where('is_admin', 0)->count();
        $data['total_active_courses'] = Course::where('is_displayed', 1)->where('is_draft', 0)->count();
        $data['total_lessons'] = Lesson::count();
        $data['total_revenue'] = Invoice::where('status', 'completed')->sum('grand_total');
        $users = User::where('is_admin', 0)->take(5)->latest()->get();

        // ChartJS
        $analyticsDataTotal = Analytics::fetchTotalVisitorsAndPageViews(Period::days(28));
        $page_views = [];
        $visitors = [];
        $dates = [];

        foreach($analyticsDataTotal as $item)
        {
            $page_views[] = $item['pageViews'];
            $visitors[] = $item['visitors'];
            $dates[] = $item['date']->format('d/m');
        }

        $chartjs = app()->chartjs
            ->name('lineChartPageViews')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($dates)
            ->datasets([
                [
                    "label" => "Page Views",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $page_views,
                ]
            ])
            ->options([
                'legend' => [
                    'display' => true,
                    'labels' => [
                        'fontColor' => '#000'
                    ]
                ],
                'plugins' => [
                    'datalabels' => [
                        'color' => '#FFCE56'
                    ]
                ],
            ]);

        $chartjsVisitors = app()->chartjs
            ->name('lineChartVisitors')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($dates)
            ->datasets([
                [
                    "label" => "Visitors",
                    'backgroundColor' => "rgba(255, 99, 132, 0.2)",
                    'borderColor' => "#dd4041",
                    "pointBorderColor" => "#dd4041",
                    "pointBackgroundColor" => "#dd4041",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $visitors,
                ],
            ])
            ->options([
                'legend' => [
                    'display' => true,
                    'labels' => [
                        'fontColor' => '#000'
                    ]
                ],
                'plugins' => [
                    'datalabels' => [
                        'color' => '#FFCE56'
                    ]
                ],
            ]);

        $browsers = Analytics::fetchTopBrowsers(Period::days(28), $maxResults = 10);
        $brow = [];
        foreach ($browsers as $item){
            $brow['browsers'][] = $item['browser'];
            $brow['sessions'][] = $item['sessions'];
        }

        $chartBrowsers = app()->chartjs
            ->name('browsers')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($brow['browsers'])
            ->datasets([
                [
                    "label" => "Top Browsers",
                    'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    'data' => $brow['sessions']
                ]
            ])
            ->options([]);

        $userType = Analytics::fetchUserTypes(Period::days(28));
        $types = [];
        foreach ($userType as $item){
            $types['type'][] = $item['type'];
            $types['sessions'][] = $item['sessions'];
        }

        $chartUserType = app()->chartjs
            ->name('UserType')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($types['type'])
            ->datasets([
                [
                    "label" => "User Type",
                    'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    'data' => $types['sessions']
                ]
            ])
            ->options([]);

        $topReferers = Analytics::fetchTopReferrers(Period::days(28));
        $Referers = [];
        foreach ($topReferers as $item){
            $Referers['url'][] = $item['url'];
            $Referers['pageViews'][] = $item['pageViews'];
        }

        $charttopReferers = app()->chartjs
            ->name('topReferers')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($Referers['url'])
            ->datasets([
                [
                    "label" => "Top Referers",
                    'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    'data' => $Referers['pageViews']
                ]
            ])
            ->options([]);

//        $totalPageView = Analytics::fetchVisitorsAndPageViews(Period::days(28));
//        dd($totalPageView);

        return view('admin.dashboard', compact('data', 'users',
            'chartjs', 'chartjsVisitors', 'chartBrowsers', 'chartUserType', 'charttopReferers'));
    }

    public function files()
    {
        $files = FileUpload::latest()->paginate(20);
        return view('admin.files.index', compact('files'));
    }
}
