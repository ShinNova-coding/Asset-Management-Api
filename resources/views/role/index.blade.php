@extends('layouts.app')

@section('title', 'Role Management')

@section('page-title', 'Role Management')

@section('subtitle', 'Manage system roles and permissions')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Role Management
            </h1>

            <p class="text-gray-500 mt-1">
                Manage roles and assign permissions to users.
            </p>
        </div>

        <a href="/roles/create"
           class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl shadow-sm transition font-medium">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="size-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>

            Create Role
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))

    <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-2xl">
        {{ session('success') }}
    </div>

    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-lg font-semibold text-gray-800">
                Roles List
            </h2>

        </div>

        <div class="p-6 overflow-x-auto">

            <table id="roleTable"
                   class="display stripe hover"
                   style="width:100%">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Role Name</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($roles as $key => $role)

                    <tr>

                        <!-- Number -->
                        <td>
                            <div class="font-medium text-gray-700">
                                {{ $key + 1 }}
                            </div>
                        </td>

                        <!-- Role Name -->
                        <td>
                            <div class="flex items-center gap-3">

                                <div>
                                    <h3 class="font-semibold text-gray-800">
                                        {{ $role->name }}
                                    </h3>
                                </div>

                            </div>
                        </td>

                        <!-- Permissions -->
                        <td>

                            <div class="flex flex-wrap gap-2">

                                @foreach($role->permission as $permission)

                                <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-medium">
                                    {{ $permission->name }}
                                </span>

                                @endforeach

                            </div>

                        </td>

                        <!-- Actions -->
                        <td>

                            <div class="flex items-center gap-3">

                                <!-- Edit -->
                                <a href="/roles/{{ $role->id }}/edit"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl text-sm font-medium transition shadow-sm">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="size-4"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M11 5h2m-1-1v2m6.586 2.586a2 2 0 010 2.828l-8.172 8.172a4 4 0 01-1.414.943L6 21l.471-2.999a4 4 0 01.943-1.414l8.172-8.172a2 2 0 012.828 0z"/>
                                    </svg>

                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="/roles/{{ $role->id }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this role?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl text-sm font-medium transition shadow-sm">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="size-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22m-5-4H6a1 1 0 00-1 1v3h14V4a1 1 0 00-1-1z"/>
                                        </svg>

                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>
    </div>
</div>

<!-- DataTable -->
<script>
    $(document).ready(function () {

        $('#roleTable').DataTable({

            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true,

            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search roles..."
            }
        });

    });
</script>

@endsection