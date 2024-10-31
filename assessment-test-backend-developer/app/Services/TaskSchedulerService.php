<?php

namespace App\Services;

class TaskSchedulerService
{
    public function calculateMinimalCompletionTime($numTasks, $taskTimes, $inDegree, $graph)
    {
        // initialize queue and completion time array variable
        $queue = [];
        $completionTime = array_fill(0, $numTasks, 0);

        // add tasks with zero dependencies to the queue
        for ($task = 0; $task < $numTasks; $task++) {
            if ($inDegree[$task] === 0) {
                $queue[] = $task;
                $completionTime[$task] = $taskTimes[$task];
            }
        }

        // process each task in queue
        while (!empty($queue)) {
            $task = array_shift($queue);

            foreach ($graph[$task] as $dependentTask) {
                // update the completion time for the dependent task
                $completionTime[$dependentTask] = max(
                    $completionTime[$dependentTask],
                    $completionTime[$task] + $taskTimes[$dependentTask]
                );

                // Decrement the in-degree of the dependent task
                $inDegree[$dependentTask]--;

                // add it to the queue if there's no remaining dependencies
                if ($inDegree[$dependentTask] === 0) {
                    $queue[] = $dependentTask;
                }
            }
        }

        // the minimal time to complete all tasks is the maximum completion time
        return max($completionTime);
    }
}