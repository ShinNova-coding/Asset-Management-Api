<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ Auth::user()->role->name?? 'Guest' }} Dashboard</h1>
    @if (Auth::user()->role->permissions->contains('name','manage-users'))
        <h1>Manage User</h1>
    @endif
    @if(Auth::user()->role->permissions->contains('name','manage-roles'))
        <h1>Manage Roles</h1>
    @endif
    <form id="logout-form" action="/logout" method="POST" style="display:none;">
        @csrf   
    <button type="submit">Logout</button>

    </form>
</body>
</html>