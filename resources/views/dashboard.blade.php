@php
    $user = Auth::user();
@endphp

@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', ($user->role->name ?? 'Guest') . ' Dashboard')

@section('subtitle', 'Welcome back, ' . ($user->name ?? 'Guest'))

@section('content')

<div class="space-y-6">

    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-3xl p-8 text-white shadow-lg">

        <h1 class="text-3xl font-bold mb-2">
            {{ $user->role->name ?? 'Guest' }} Dashboard
        </h1>

        <p class="text-blue-100">
            Manage your system efficiently.
        </p>
    </div>

    <!-- Permission Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Manage Users -->
        @if($user->role->permission->contains('name','manage-users'))

        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition">

            <div class="flex items-center justify-between mb-4">

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">
                    👤
                </div>

                <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                    Permission
                </span>
            </div>

            <h2 class="text-xl font-bold mb-2">
                User Management
            </h2>

            <p class="text-gray-500 text-sm mb-5">
                Create and manage system users.
            </p>

            <a href="/users"
               class="inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl transition">
                Manage Users
            </a>
            
        </div>

        @endif

        <!-- Manage Assets -->
        @if($user->role->permission->contains('name','view-my-assets'))

        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition">

            <div class="flex items-center justify-between mb-4">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    ⚙️
                </div>

                <span class="text-xs bg-purple-100 text-purple-600 px-3 py-1 rounded-full">
                    Permission
                </span>
            </div>

            <h2 class="text-xl font-bold mb-2">
                Asset Management
            </h2>

            <p class="text-gray-500 text-sm mb-5">
                Manage Asset and permissions.
            </p>

            <a href="/assets"
               class="inline-block px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-xl transition">
                Manage Asset
            </a>
        </div>

        @endif

        <!-- Manage Category -->
        @if($user->role->permission->contains('name','manage-categories'))

        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition">

            <div class="flex items-center justify-between mb-4">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    ⚙️
                </div>

                <span class="text-xs bg-purple-100 text-purple-600 px-3 py-1 rounded-full">
                    Permission
                </span>
            </div>

            <h2 class="text-xl font-bold mb-2">
                Category Management
            </h2>

            <p class="text-gray-500 text-sm mb-5">
                Manage Category and permissions.
            </p>

            <a href="/categories"
               class="inline-block px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-xl transition">
                Manage Category
            </a>
        </div>

        @endif

        <!-- Manage Roles -->
        @if($user->role->permission->contains('name','manage-roles'))

        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition">

            <div class="flex items-center justify-between mb-4">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    ⚙️
                </div>

                <span class="text-xs bg-purple-100 text-purple-600 px-3 py-1 rounded-full">
                    Permission
                </span>
            </div>

            <h2 class="text-xl font-bold mb-2">
                Role Management
            </h2>

            <p class="text-gray-500 text-sm mb-5">
                Manage roles and permissions.
            </p>

            <a href="/roles"
               class="inline-block px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-xl transition">
                Manage Roles
            </a>
        </div>

        @endif

    </div>

</div>

@endsection