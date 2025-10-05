<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Projects</h3>
                        <p class="text-3xl font-bold text-blue-600" id="total-projects">0</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Active Tasks</h3>
                        <p class="text-3xl font-bold text-green-600" id="active-tasks">0</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Clients</h3>
                        <p class="text-3xl font-bold text-purple-600" id="total-clients">0</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Team Members</h3>
                        <div id="team-members-list" class="mt-4 space-y-4">
                            <div class="animate-pulse">
                                <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                <div class="space-y-3 mt-4">
                                    <div class="h-4 bg-gray-200 rounded"></div>
                                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity and Tasks -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Recent Activity -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Activity</h3>
                        <div id="recent-activity" class="space-y-4">
                            <div class="animate-pulse">
                                <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                <div class="space-y-3 mt-4">
                                    <div class="h-4 bg-gray-200 rounded"></div>
                                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Tasks -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Upcoming Tasks</h3>
                        <div id="upcoming-tasks" class="space-y-4">
                            <div class="animate-pulse">
                                <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                <div class="space-y-3 mt-4">
                                    <div class="h-4 bg-gray-200 rounded"></div>
                                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Status -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Project Status Overview</h3>
                    <div id="project-status" class="space-y-4">
                        <div class="animate-pulse">
                            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                            <div class="space-y-3 mt-4">
                                <div class="h-4 bg-gray-200 rounded"></div>
                                <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Initialize Echo
        window.Echo.private('dashboard')
            .listen('DashboardStatsUpdated', (e) => {
                updateDashboardStats(e.stats);
            })
            .listen('ActivityLogged', (e) => {
                updateRecentActivity(e.activity);
            });

        // Error handling for WebSocket connection
        window.Echo.connector.pusher.connection.bind('state_change', function(states) {
            if (states.current === 'disconnected' || states.current === 'failed') {
                console.error('WebSocket connection lost. Falling back to polling...');
                startPolling();
            }
        });

        // Fallback polling mechanism
        let pollingInterval = null;

        function startPolling() {
            if (!pollingInterval) {
                pollingInterval = setInterval(fetchDashboardData, 30000); // Poll every 30 seconds
            }
        }

        function stopPolling() {
            if (pollingInterval) {
                clearInterval(pollingInterval);
                pollingInterval = null;
            }
        }

        // Initial data load
        fetchDashboardData();

        function fetchDashboardData() {
            fetch('/api/dashboard-stats')
                .then(response => response.json())
                .then(data => {
                    updateDashboardStats(data.stats);
                    updateRecentActivity(data.activity);
                    updateUpcomingTasks(data.tasks);
                    updateProjectStatus(data.projects);
                })
                .catch(error => {
                    console.error('Error fetching dashboard data:', error);
                });
        }

        function updateDashboardStats(stats) {
            document.getElementById('total-projects').textContent = stats.totalProjects;
            document.getElementById('active-tasks').textContent = stats.activeTasks;
            document.getElementById('total-clients').textContent = stats.totalClients;
            
            // Update team members list
            const teamMembersContainer = document.getElementById('team-members-list');
            teamMembersContainer.innerHTML = stats.teamMembers.map(member => `
                <div class="flex items-center justify-between py-2 border-b border-gray-200 last:border-0">
                    <div>
                        <p class="text-gray-800 font-medium">${member.name}</p>
                        <p class="text-sm text-gray-600">${member.email}</p>
                    </div>
                    <div class="flex items-center">
                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">${member.role}</span>
                    </div>
                </div>
            `).join('');
        }

        function updateRecentActivity(activities) {
            const container = document.getElementById('recent-activity');
            container.innerHTML = activities.map(activity => `
                <div class="border-l-4 border-blue-500 pl-4 py-2">
                    <p class="text-sm text-gray-600">${activity.time}</p>
                    <p class="text-gray-800">
                        ${activity.description}
                        ${activity.causer ? `
                            <span class="text-sm text-gray-600">
                                by ${activity.causer.name} (${activity.causer.type})
                            </span>
                        ` : ''}
                    </p>
                    ${activity.subject ? `
                        <p class="text-sm text-gray-600">
                            ${activity.subject.type}: ${activity.subject.name}
                        </p>
                    ` : ''}
                </div>
            `).join('');
        }

        function updateUpcomingTasks(tasks) {
            const container = document.getElementById('upcoming-tasks');
            container.innerHTML = tasks.map(task => `
                <div class="flex items-center justify-between py-2 border-b border-gray-200 last:border-0">
                    <div class="flex-grow">
                        <p class="text-gray-800 font-medium">${task.title}</p>
                        <p class="text-sm text-gray-600">
                            Project: ${task.project.title} | Client: ${task.client.name}
                        </p>
                        <p class="text-sm text-gray-600">
                            Due: ${task.deadline} | Assigned to: ${task.assignee.name}
                        </p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full ${getStatusColor(task.status)}">
                        ${task.status}
                    </span>
                </div>
            `).join('');
        }

        function updateProjectStatus(projects) {
            const container = document.getElementById('project-status');
            container.innerHTML = projects.map(project => `
                <div class="mb-6 last:mb-0">
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <h4 class="font-medium text-gray-700">${project.name}</h4>
                            <p class="text-sm text-gray-600">
                                Client: ${project.client.name} | Manager: ${project.manager.name}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 text-xs rounded-full ${getStatusColor(project.status)}">
                                ${project.status}
                            </span>
                            <p class="text-sm text-gray-500 mt-1">
                                ${project.completed_tasks} of ${project.total_tasks} tasks completed
                            </p>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300" 
                             style="width: ${project.progress}%">
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function getStatusColor(status) {
            const colors = {
                'pending': 'bg-yellow-100 text-yellow-800',
                'in_progress': 'bg-blue-100 text-blue-800',
                'completed': 'bg-green-100 text-green-800',
                'cancelled': 'bg-red-100 text-red-800'
            };
            return colors[status.toLowerCase()] || 'bg-gray-100 text-gray-800';
        }
    </script>
    @endpush
</x-app-layout>
