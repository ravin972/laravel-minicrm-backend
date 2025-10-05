<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Activity;
use App\Events\DashboardStatsUpdated;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function getStats()
    {
        // Get stats with 1-minute cache to prevent frequent database hits
        $stats = Cache::remember('dashboard_stats', 60, function () {
            return [
                'totalProjects' => Project::count(),
                'activeTasks' => Task::where('status', '!=', 'completed')->count(),
                'totalClients' => Client::count(),
                'teamMembers' => User::with('roles')->get()->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->full_name,
                        'email' => $user->email,
                        'role' => $user->roles->first()?->name ?? 'No Role',
                    ];
                }),
            ];
        });

        // Get recent activity with relationships
        $activity = Activity::with(['causer', 'subject'])
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($activity) {
                return [
                    'time' => $activity->created_at->format('M d, H:i'),
                    'description' => $activity->description,
                    'causer' => $activity->causer ? [
                        'name' => $activity->causer->full_name ?? $activity->causer->name,
                        'type' => class_basename($activity->causer_type),
                    ] : null,
                    'subject' => $activity->subject ? [
                        'name' => $activity->subject->title ?? $activity->subject->name ?? $activity->subject->full_name,
                        'type' => class_basename($activity->subject_type),
                    ] : null,
                ];
            });

        // Get upcoming tasks with relationships
        $tasks = Task::with(['project', 'user', 'client'])
            ->where('status', '!=', 'completed')
            ->where('deadline_at', '>=', now())
            ->orderBy('deadline_at')
            ->limit(5)
            ->get()
            ->map(function ($task) {
                return [
                    'id' => $task->id,
                    'title' => $task->title,
                    'deadline' => $task->deadline_at->format('M d, Y'),
                    'status' => $task->status,
                    'project' => [
                        'id' => $task->project->id,
                        'title' => $task->project->title,
                    ],
                    'assignee' => [
                        'id' => $task->user->id,
                        'name' => $task->user->full_name,
                    ],
                    'client' => [
                        'id' => $task->client->id,
                        'name' => $task->client->company_name,
                    ],
                ];
            });

        // Get project status with detailed information
        $projects = Project::with(['client', 'user'])
            ->withCount(['tasks as total_tasks', 'tasks as completed_tasks' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->get()
            ->map(function ($project) {
                $progress = $project->total_tasks > 0
                    ? round(($project->completed_tasks / $project->total_tasks) * 100)
                    : 0;
                return [
                    'id' => $project->id,
                    'name' => $project->title,
                    'status' => $project->status,
                    'progress' => $progress,
                    'client' => [
                        'id' => $project->client->id,
                        'name' => $project->client->company_name,
                    ],
                    'manager' => [
                        'id' => $project->user->id,
                        'name' => $project->user->full_name,
                    ],
                    'total_tasks' => $project->total_tasks,
                    'completed_tasks' => $project->completed_tasks,
                ];
            });

        return response()->json([
            'stats' => $stats,
            'activity' => $activity,
            'tasks' => $tasks,
            'projects' => $projects,
        ]);
    }

    private function getRecentActivity()
    {
        return Activity::with(['causer', 'subject'])
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($activity) {
                return [
                    'time' => $activity->created_at->format('M d, H:i'),
                    'description' => $activity->description,
                ];
            });
    }

    public function broadcastStats()
    {
        $stats = [
            'totalProjects' => Project::count(),
            'activeTasks' => Task::where('status', '!=', 'completed')->count(),
            'totalClients' => Client::count(),
            'teamMembers' => User::count(),
        ];

        broadcast(new DashboardStatsUpdated($stats));

        return response()->json(['message' => 'Stats broadcasted successfully']);
    }
}