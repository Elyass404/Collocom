<!-- resources/views/roles/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    @include('components.topbar')

    @include('components.sidebar')

    <!-- Main Content -->
    <div class="ml-64 pt-32 p-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit Role: {{ $role->name }}</h1>
            <a href="{{ route('roles.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                Back to Roles
            </a>
        </div>

        <!-- Role-based access check -->
        @if(Auth::user()->hasRole('admin'))
            <!-- Edit Form Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Role Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Enter role name"
                            value="{{ old('name', $role->name) }}"
                        >
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Permissions</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($permissions as $permission)
                                <div class="flex items-center">
                                    <input 
                                        type="checkbox" 
                                        name="permissions[]" 
                                        id="permission-{{ $permission->id }}" 
                                        value="{{ $permission->id }}"
                                        class="mr-2 rounded text-blue-500 focus:ring-blue-500"
                                        {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}
                                    >
                                    <label for="permission-{{ $permission->id }}" class="text-gray-700">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                
                    <div class="flex justify-end py-4">
                        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Update Role
                        </button>
                    </div>
                </form>
            </div>
        @else
            <!-- Access Denied Message -->
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-6 rounded mb-4 text-center">
                <h3 class="text-lg font-semibold mb-2">Access Restricted</h3>
                <p>Only administrators can edit roles.</p>
                <p class="mt-4">Please contact your administrator if you believe this is an error.</p>
            </div>
        @endif
    </div>

    <!-- JavaScript for Dropdown Menu -->
    <script>
        document.getElementById('profile-menu').addEventListener('click', function() {
            document.getElementById('menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>