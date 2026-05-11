@extends('layouts.app')
@section('content')
        <h3 class="mb-4">User CRUD Management</h3>
        
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form id="userForm">
                    <div class="row g-2">
                        <input type="hidden" id="is_edit" value="false">
                        <div class="col-md-2"><input type="text" id="employee_id" class="form-control" placeholder="EMP-ID"></div>
                        <div class="col-md-3"><input type="text" id="name" class="form-control" placeholder="Full Name"></div>
                        <div class="col-md-3"><input type="email" id="email" class="form-control" placeholder="Email"></div>
                        <div class="col-md-2"><input type="password" id="password" class="form-control" placeholder="Password"></div>
                        <div class="col-md-2">
                            <button type="button" onclick="saveUser()" class="btn btn-primary w-100" id="btnSave">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Emp ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userList"></tbody>
        </table>
    </div>

    <script>
        const api = '/api/users'; // Controller ရဲ့ API path

        // 1. GET - Retrieve Users
        async function fetchUsers() {
            const res = await axios.get(api);
            const rows = res.data.data.map(u => `
                <tr>
                    <td>${u.employee_id}</td>
                    <td>${u.name}</td>
                    <td>${u.email}</td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="editUser('${u.employee_id}')">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteUser('${u.employee_id}')">Delete</button>
                    </td>
                </tr>
            `).join('');
            document.getElementById('userList').innerHTML = rows;
        }

        // 2. POST/PUT - Create or Update
        async function saveUser() {
            const isEdit = document.getElementById('is_edit').value === 'true';
            const id = document.getElementById('employee_id').value;
            const data = {
                employee_id: id,
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                role_id: 1, // Default dummy role
                joined_date: new Date().toISOString().split('T')[0]
            };
            if(document.getElementById('password').value) data.password = document.getElementById('password').value;

            try {
                if(isEdit) await axios.put(`${api}/${id}`, data);
                else await axios.post(api, data);
                location.reload();
            } catch(e) { alert("Error checking fields!"); }
        }

        // 3. DELETE
        async function deleteUser(id) {
            if(confirm('Delete this user?')) {
                await axios.delete(`${api}/${id}`);
                fetchUsers();
            }
        }

        // 4. PREPARE EDIT
        async function editUser(id) {
            const res = await axios.get(`${api}/${id}`);
            const u = res.data.data;
            document.getElementById('employee_id').value = u.employee_id;
            document.getElementById('employee_id').readOnly = true;
            document.getElementById('name').value = u.name;
            document.getElementById('email').value = u.email;
            document.getElementById('is_edit').value = 'true';
            document.getElementById('btnSave').innerText = 'Update';
            document.getElementById('btnSave').className = 'btn btn-warning w-100';
        }

        fetchUsers();
    </script>
@endsection