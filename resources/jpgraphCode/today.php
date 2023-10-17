<?php
            use App\Models\Profile;
            use App\Models\Category;
            use App\Models\Record;
            use App\models\User;
            use \Carbon\Carbon;
            use Illuminate\Http\Request;
            use Illuminate\Support\Facades\Auth;

            require_once('jpgraph/jpgraph.php');
            require_once ('jpgraph/jpgraph_bar.php');
            $user=Auth::user();
            Carbon::setLocale('ja');
            $currentDateTime = now();
            $matchingCategories = $user->categories()->whereDate('created_at', '=', $currentDateTime->toDateString())->get();
            $categoryTotal = [];
            $totalTime = 0;
            foreach ($matchingCategories as $category) {
                $categoryName = $category->name;
                $categoryTime = $category->workTime;     

                if (!isset($categoryTotal[$categoryName])) {
                    $categoryTotal[$categoryName] = 0;
                }

                $categoryTotal[$categoryName] += $categoryTime;
                $totalTime += $categoryTime;
            }
            
            
            $datay = [];
            $datax = [];
            foreach ($categoryTotal as $categoryName => $categoryTime) {
            $datay[] = $categoryTime; 
            $datax[] = $categoryName; 
            }
            $graph=new Graph(350,250);
            $graph->SetScale('textlin');
            $graph->SetMarginColor('white');
            $graph->title->SetTitle('today');
            $bplot=new Barplot($datay);
            $bplot->SetFillGradient('AntiqueWhite2', 'AntiqueWhite4:0.8', GRAD_VERT);
            $bplot->SetColor('darkred');
            $bplot->SetXData($datax);
            $graph->Add($bplot);
            $graph->Stroke(public_path('/jpgraph/jp_today.jpeg'));