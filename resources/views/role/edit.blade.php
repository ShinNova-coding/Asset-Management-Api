<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
 <h1>Edit Roles</h1>
     <form action="/roles/{{ $role->id }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-8">
            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Role Name</label>
            <input type="text" name="name" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                placeholder="e.g. Technician" value="{{ $role->name }}">
        </div>

        <div class="mb-8">
            <label class="block text-sm font-bold text-gray-700 mb-4 uppercase tracking-wide">Assign Permissions</label>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-96 overflow-y-auto p-4 bg-gray-50 rounded-lg border border-gray-200">
                @foreach($permissions as $permission)
                    <label class="flex items-center p-3 bg-white border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition group">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer"
                            @if($role->permissions->contains('id',$permission->id))
                            checked
                            @endif
                            >
                            
                        <span class="ml-3 text-gray-700 group-hover:text-blue-700 font-medium capitalize">
                            {{ str_replace('-', ' ', $permission->name) }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 border-t pt-6">
            <a href="/roles" class="text-gray-500 hover:text-gray-700 font-medium">Cancel</a>
            <button type="submit" 
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md transition transform active:scale-95">
                Save Role & Permissions
            </button>
        </div>
    </form>
</body>
</html>