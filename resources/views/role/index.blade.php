<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
</head>
<body>
    Role & Permission
    <div class="container mt-5">
    <h2>Role Management</h2>
    <a href="/roles/create">Create new role</a>
    <table id="roleTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Role Name</th>
                <th>Permissions</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $key => $role)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @foreach($role->permissions as $permission)
                        <span class="badge bg-info text-dark">{{ $permission->name }}</span>
                    @endforeach
                </td>
                <td>
    <a href="/roles/{{ $role->id }}/edit" class="btn btn-primary">
        Edit roles
    </a>

    <form action="/roles/{{ $role->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this role?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" style="background-color: red; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
            Delete
    
    </form>
</td>
            </tr>





            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready( function () {
        $('#roleTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>

</body>
</html>