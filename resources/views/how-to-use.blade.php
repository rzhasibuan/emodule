@extends('layouts.fe')

@section('title', 'How to use?')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold mb-4 text-teal-600 flex items-center gap-2">
            <svg class="w-8 h-8 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m-4-5v9"/></svg>
            How to Use Green Module
        </h1>
        <div class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col items-center p-4 bg-teal-50 dark:bg-teal-900 rounded-lg shadow hover:scale-105 transition-transform">
                    <svg class="w-10 h-10 text-teal-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a1 1 0 011 1v4a1 1 0 01-1 1h-2m-4 0v6m0 0l-2-2m2 2l2-2"/></svg>
                    <span class="font-semibold">Browse Modules</span>
                    <span class="text-sm text-gray-600 dark:text-gray-200 text-center">Use the sidebar or "Module" dropdown in the navbar to select a module.</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-blue-50 dark:bg-blue-900 rounded-lg shadow hover:scale-105 transition-transform">
                    <svg class="w-10 h-10 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A2 2 0 0020 6.382V5a2 2 0 00-2-2H6a2 2 0 00-2 2v1.382a2 2 0 00.447 1.342L9 10m6 0v4m0 0l-2-2m2 2l2-2"/></svg>
                    <span class="font-semibold">View Content</span>
                    <span class="text-sm text-gray-600 dark:text-gray-200 text-center">Selected module appears in the viewer. Read the PDF directly in your browser.</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-yellow-50 dark:bg-yellow-900 rounded-lg shadow hover:scale-105 transition-transform">
                    <svg class="w-10 h-10 text-yellow-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/></svg>
                    <span class="font-semibold">Access Quizzes & Videos</span>
                    <span class="text-sm text-gray-600 dark:text-gray-200 text-center">Click interactive quiz/video cards to test your knowledge or watch YouTube videos.</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-purple-50 dark:bg-purple-900 rounded-lg shadow hover:scale-105 transition-transform">
                    <svg class="w-10 h-10 text-purple-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                    <span class="font-semibold">Search</span>
                    <span class="text-sm text-gray-600 dark:text-gray-200 text-center">Use the search bar to quickly find modules by title.</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow hover:scale-105 transition-transform">
                    <svg class="w-10 h-10 text-gray-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.485-8.485l-.707.707M4.222 4.222l-.707.707M21 12h-1M4 12H3m16.485 4.485l-.707-.707M4.222 19.778l-.707-.707"/></svg>
                    <span class="font-semibold">Dark Mode</span>
                    <span class="text-sm text-gray-600 dark:text-gray-200 text-center">Toggle the theme using the sun/moon button for comfortable reading.</span>
                </div>
            </div>
        </div>
        <div class="mt-8 text-center">
            <h2 class="text-xl font-semibold mb-2 text-teal-500">Need Help?</h2>
            <p class="text-gray-700 dark:text-gray-200">If you have any questions or issues, please contact support or refer to the FAQ section.</p>
            <a href="mailto:support@greenmodule.com" class="inline-block mt-4 px-4 py-2 bg-teal-600 text-white rounded-lg shadow hover:bg-teal-700 transition">Contact Support</a>
        </div>
    </div>
</div>
@endsection
