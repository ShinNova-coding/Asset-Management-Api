<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-light p-4">
=======
@extends('layouts.app')
@section('content')
>>>>>>> 949c4877df802f32be66384faf2308d20eb732c2
    <div class="container col-md-8">
        <h3 class="mb-4">Category CRUD Management</h3>

        <div class="input-group mb-3 shadow-sm">
            <input type="hidden" id="cat_id">
            <input type="text" id="cat_name" class="form-control" placeholder="Category Name">
            <button class="btn btn-success" onclick="saveCategory()" id="btnCat">Add Category</button>
        </div>

        <table class="table table-white table-hover shadow-sm border">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="catList"></tbody>
        </table>
    </div>

    <script>
        const api = '/api/categories';

        async function fetchCats() {
            const res = await axios.get(api);
            const rows = res.data.data.map(c => `
                <tr>
                    <td>${c.id}</td>
                    <td>${c.name}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" onclick="editCat(${c.id}, '${c.name}')">Edit</button>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteCat(${c.id})">Delete</button>
                    </td>
                </tr>
            `).join('');
            document.getElementById('catList').innerHTML = rows;
        }

        async function saveCategory() {
            const id = document.getElementById('cat_id').value;
            const name = document.getElementById('cat_name').value;
            
            if(id) await axios.put(`${api}/${id}`, { name });
            else await axios.post(api, { name });
            
            location.reload();
        }

        function editCat(id, name) {
            document.getElementById('cat_id').value = id;
            document.getElementById('cat_name').value = name;
            document.getElementById('btnCat').innerText = 'Update';
            document.getElementById('btnCat').className = 'btn btn-warning';
        }

        async function deleteCat(id) {
            if(confirm('Delete?')) {
                await axios.delete(`${api}/${id}`);
                fetchCats();
            }
        }

        fetchCats();
    </script>
<<<<<<< HEAD
</body>
</html>
=======
@endsection
>>>>>>> 949c4877df802f32be66384faf2308d20eb732c2
