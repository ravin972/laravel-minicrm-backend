<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'MiniCRM') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                    },
                },
            }
        </script>
    </head>
    <body class="bg-gray-50 font-sans antialiased">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            
            <!-- Header Navigation -->
            <div class="absolute top-0 right-0 p-6 text-right">
                @if (Route::has('login'))
                    <nav class="flex flex-1 justify-end space-x-4">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>

            <main class="w-full max-w-5xl mx-auto px-6 lg:px-8">
                <!-- Hero Section -->
                <div class="text-center py-20 sm:py-24">
                    <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900">
                        Streamline Your Business with <span class="text-blue-600">MiniCRM</span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        A simple, powerful, and intuitive solution to manage clients, projects, and tasks all in one place.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-md bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Go to Dashboard</a>
                        @else
                        <a href="{{ route('register') }}" class="rounded-md bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Get Started</a>
                        <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">→</span></a>
                        @endauth
                    </div>
                </div>

                <!-- Features Section -->
                <div class="py-16 sm:py-20">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl lg:text-center">
                            <h2 class="text-base font-semibold leading-7 text-blue-600">Everything You Need</h2>
                            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">A Better Way to Manage Your Workflow</p>
                            <p class="mt-6 text-lg leading-8 text-gray-600">Stay organized and boost your productivity with our core features designed for small businesses and freelancers.</p>
                        </div>
                        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                                
                                <!-- Client Management -->
                                <div class="relative pl-16">
                                    <dt class="text-base font-semibold leading-7 text-gray-900">
                                        <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A5.975 5.975 0 0112 13a5.975 5.975 0 013 1.803M15 21a9 9 0 00-5.657-8.228m5.657 8.228A9 9 0 013 21m3-3A3 3 0 106 3a3 3 0 000 12z" />
                                            </svg>
                                        </div>
                                        Client Management
                                    </dt>
                                    <dd class="mt-2 text-base leading-7 text-gray-600">Keep all your client information organized, accessible, and up-to-date in one central location.</dd>
                                </div>

                                <!-- Project Tracking -->
                                <div class="relative pl-16">
                                    <dt class="text-base font-semibold leading-7 text-gray-900">
                                        <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        Project Tracking
                                    </dt>
                                    <dd class="mt-2 text-base leading-7 text-gray-600">Monitor project progress, deadlines, and milestones from start to finish. Never miss a beat.</dd>
                                </div>

                                <!-- Task Management -->
                                <div class="relative pl-16">
                                    <dt class="text-base font-semibold leading-7 text-gray-900">
                                        <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                            </svg>
                                        </div>
                                        Task Organization
                                    </dt>
                                    <dd class="mt-2 text-base leading-7 text-gray-600">Create, assign, and track tasks for every project. Ensure your team stays aligned and productive.</dd>
                                </div>

                                <!-- Role-Based Permissions -->
                                <div class="relative pl-16">
                                    <dt class="text-base font-semibold leading-7 text-gray-900">
                                        <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        </div>
                                        Secure & Role-Based
                                    </dt>
                                    <dd class="mt-2 text-base leading-7 text-gray-600">Control who can see and do what with simple, powerful role-based permissions for Admins and Users.</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="py-16 text-center text-sm text-black/70 w-full">
                <p>MiniCRM &copy; {{ date('Y') }}</p>
            </footer>
        </div>
    </body>
</html>
