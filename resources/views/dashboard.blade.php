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
    <h1>{{ Auth::user()->role->name?? 'Guest' }} Dashboard</h1>
    
    @if (Auth::user()->role->permissions->contains('name','manage-users'))
        <h1>Manage User</h1>
    @endif
    @if(Auth::user()->role->permissions->contains('name','manage-roles'))
    <a href="/roles">Manage roles</a>
    @endif
    <form action="/logout" method="POST">
        @csrf   
    <button type="submit">Logout</button>
    </form>
</body>
</html>