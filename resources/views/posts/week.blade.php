<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>活動計測</title>
        <link rel="stylesheet" href="{{ asset('cssLayout/common.css') }}">
        

</head>
<body class="custom-background">
            <div class="header">
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('front')" :active="request()->routeIs('front')">
                        {{ __('トップ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile1')" :active="request()->routeIs('profile1')">
                        {{ __('プロフィール') }}
                    </x-nav-link>
                    <x-nav-link :href="route('recordset')" :active="request()->routeIs('precordset')">
                        {{ __('記録する') }}
                    </x-nav-link>
            </div>
            </div>
    <h2>今日の記録・グラフ</h2>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    @if($records && $categoryTotal)
    <canvas id='week'></canvas>
    <canvas id='today'></canvas>
    @elseif(isset($categorytotal))
    <canvas id='today'></canvas>
    @else
        <h1>グラフを表示するための記録がありません</h1>
    @endif
    
    <h2>今日の記録</h2>
    @if(isset($categoryTotal) && !empty($categoryTotal))
    @foreach($categoryTotal as $categoryName => $categoryTime)
        <div class='categorytotal'>
            <p class='name'>カテゴリ名：{{ $categoryName }}</p>
            <p class='time'>時間：{{ $categoryTime }}</p>
        </div>    
    @endforeach
    @else
    <h3>記録がありません</h3>
    @endif
    <a href='/today'>今日の記録を確定する</a>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>


<script>
    var ctx = document.getElementById("today");
   <?php
        use Carbon\Carbon;
        use App\Models\Record;

        
        $categoryNames = array();
        $categoryTimes = array();
        foreach ($categoryTotal as $categoryName => $categoryTime) {
            $categoryNames[] = $categoryName;
            $categoryTimes[] = $categoryTime;
        }
        $categoryNamesString = "['" . implode("', '", $categoryNames) . "']";
        $categoryTimesString = "[" . implode(', ', $categoryTimes) . "]";
    ?>
    var categoryNames = <?php echo $categoryNamesString;?>;
    var categoryTimes = <?php echo $categoryTimesString; ?>;
    var today = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: categoryNames,
            datasets: [
                {
                    label: '活動時間(分)', 
                    data: categoryTimes, 
                    backgroundColor: "rgba(200,112,126,0.5)"
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: '今日のグラフ'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMax: 360,
                        suggestedMin: 0, 
                        stepSize: 30, 
                    }
                }]
            }
        }
    });



    var ctx = document.getElementById("week");
      <?php
        $totalTimes = [];
        $limit = 7;
        $count = 0;
        $days = [];
        
        foreach($records as $record) {
            $totalTimes[] = $record->total_time;
            $days[] = $record->created_at->toDateString();
            $count++;
            if ($count > $limit) {
                break;
            }
        }
    
        $totalTimeString = "['" . implode("', '", $totalTimes) . "']";
        
        ?>

        var totalTimes = <?php echo $totalTimeString; ?>;
        var days = <?php echo json_encode($days); ?>;
        console.log(days);
        var week = new Chart(ctx, {
            type: 'bar',
                data: {
                    labels: days,
                    datasets: [
                        {
                            label: '活動時間(分)', 
                            data: totalTimes, 
                            backgroundColor: "rgba(200,112,126,0.5)"
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: '今週のグラフ'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                suggestedMax: 360,
                                suggestedMin: 0, 
                                stepSize: 30, 
                            }
                        }]
                    }
                }
            });
        </script>
        </html>
