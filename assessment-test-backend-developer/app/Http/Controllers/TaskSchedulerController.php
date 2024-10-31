<?php

namespace App\Http\Controllers;

use App\Services\TaskSchedulerService;
use Illuminate\Http\Request;

class TaskSchedulerController extends Controller
{
    private $graph = [];
    private $inDegree = [];
    private $taskTimes = [];
    private $numTasks;
    private $taskSchedulerService;

    public function __construct(TaskSchedulerService $taskSchedulerService)
    {
        $this->taskSchedulerService = $taskSchedulerService;
    }

    public function calculateMinimalCompletionTime(Request $request)
    {
        $request = $request->all();
        $numTasks = $request['numTasks'];
        $taskTimes = $request['taskTimes'];
        $dependencies = $request['dependencies'];

        $inDegree = array_fill(0, $numTasks, 0);
        $graph = array_fill(0, $numTasks, []);

        foreach ($dependencies as [$u, $v]) {
            $graph[$u][] = $v;
            $inDegree[$v]++;
        }

        $minimalTime = $this->taskSchedulerService->calculateMinimalCompletionTime($numTasks, $taskTimes, $inDegree, $graph);

        echo "Minimal time to complete all tasks: " . $minimalTime . PHP_EOL;
    }
}
