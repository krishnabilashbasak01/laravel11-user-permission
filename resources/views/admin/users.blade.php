@extends('admin.layouts.layout')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @canany(['add role', 'all permission'])
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Roles</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#crateUserTypeModal" title="Add New Role">
                                            <i class="fa fa-plus-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Roles -->
                                    <table id="roles" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endcanany
                    @canany(['add permission', 'all permission'])
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Permissions</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#cratePermissionModal" title="Add New Permission">
                                            <i class="fa fa-list"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- User Permission -->
                                    <table id="permissions" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endcanany

                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        <div class="card-tools">
                            @canany(['user create', 'all permission'])
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#crateUserModal" title="Add New User">
                                    <i class="fa fa-user-plus"></i>
                                </button>
                            @endcanany

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="userTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="crateUserModal" tabindex="-1" role="dialog" aria-labelledby="crateuserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crateuserModalLabel">Create User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createUserForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitCreateUser">Create User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Role Modal -->
    <div class="modal fade" id="crateUserTypeModal" tabindex="-1" role="dialog"
        aria-labelledby="crateUserTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crateUserTypeModalLabel">Create Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createRoleForm">
                        <div class="form-group">
                            <label for="userTypeName">Role Name</label>
                            <input type="text" class="form-control" id="userTypeName" name="name" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Role</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>


    <!-- Create Role Permissions Modal -->
    <div class="modal fade" id="crateRolePermissionModal" tabindex="-1" role="dialog"
        aria-labelledby="crateUserTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crateUserTypeModalLabel">Role Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="rolePermissionsModel">
                    <h1>Role</h1>
                    <div id="rolePermissionsDiv" class="row">

                    </div>
                    <form id="createRolePermissionForm">




                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Create Role Permissions Modal -->
    <div class="modal fade" id="addUserRoleModal" tabindex="-1" role="dialog" aria-labelledby="addUserRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crateUserTypeModalLabel">Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="userRollModel">
                    <h1>Role</h1>
                    <div id="userRoleDiv" class="row">

                    </div>
                    <form id="addRoleForm">




                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Create Permission Modal -->
    <div class="modal fade" id="cratePermissionModal" tabindex="-1" role="dialog"
        aria-labelledby="cratePermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cratePermissionModalLabel">Create Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createPermissionForm">
                        <div class="form-group">
                            <label for="permissionName">Permission Name</label>
                            <input type="text" class="form-control" id="permissionName" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Permission</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary" id="submitCreatePermission">Create Permission</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('admin/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('admin/plugins/dropzone/min/dropzone.min.j') }}s"></script>
    <script>
        $(function() {
            $("#roles").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#roles_wrapper .col-md-6:eq(0)');
            $("#permissions").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#permissions_wrapper .col-md-6:eq(0)');

            $("#userTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#userTable_wrapper .col-md-6:eq(0)');


            // Role Loading state
            var roleLoadingState = false;
            var roles = []
            var permissions = []
            var users = []

            refreshRoles()
            refreshPermissions()
            getUsers()


            $('#createRoleForm').submit(function(e) {

                e.preventDefault();
                var formData = new FormData(this);
                // console.log(e);
                $.ajax({
                    url: "/api/role/create",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        refreshRoles();
                    },
                    error: function(error) {
                        console.log("Error creating user type", error);
                        alert("Error creating user type, Please try again");
                    }
                });
            });
            $('#createPermissionForm').submit(function(e) {

                e.preventDefault();
                var formData = new FormData(this);
                // console.log(e);
                $.ajax({
                    url: "/api/permission/create",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        refreshPermissions();
                    },
                    error: function(error) {
                        console.log("Error creating user type", error);
                        alert("Error creating user type, Please try again");
                    }
                });
            });

            // Function to delete a role
            window.onItemDelete = function(id, type) { // Make this globally accessible by attaching to window
                $uri = ''
                if (type == 'role') {
                    $uri = `/api/role/delete/${id}`;
                }
                if (type == 'permission') {
                    $uri = `/api/permission/delete/${id}`;

                }
                var settings = {
                    "url": $uri,
                    "method": "DELETE",
                    "timeout": 0,
                };

                $.ajax(settings).done(function(response) {
                    if (type == 'role') refreshRoles(); // Refresh the table after deletion
                    if (type == 'permission') refreshPermissions(); // Refresh the table after deletion
                }).fail(function(error) {
                    alert("Error deleting the role. Please try again.");
                });
            }

            // add role
            function addRole(role) {
                var newRow = `<tr>
                                <td>${role.id}</td>
                                <td>${role.name}</td>
                                <td>
                                    <!-- Add action buttons here if needed -->
                                    <button type="button" class="openRolePermissionsModal btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#crateRolePermissionModal" data-role="${role.name}" data-role-id="${role.id}" title="Add New Permission">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#editRoleModal" title="Edit Role">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    <a onclick="onItemDelete(${role.id}, 'role');" type="button" class="btn btn-sm btn-danger"  title="Add New Role">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                              </tr>`;

                $('#roles tbody').append(newRow);
            }

            // add permission
            function addPermission(role) {
                var newRow = `<tr>
                                <td>${role.id}</td>
                                <td>${role.name}</td>
                                <td>
                                    <!-- Add action buttons here if needed -->
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#editUserTypeModal" title="Add New Role">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    <a onclick="onItemDelete(${role.id},'permission');" type="button" class="btn btn-sm btn-danger"  title="Add New Role">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                              </tr>`;

                $('#permissions tbody').append(newRow);
            }

            // on refresh roles
            function refreshRoles() {
                roleLoadingState = true
                var settings = {
                    "url": "/api/roles",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings).done(function(response) {
                    // Assuming response is an array of roles

                    if (Array.isArray(response.roles)) {
                        roles = response.roles;
                        $('#roles tbody').empty();
                        response.roles.forEach(role => {
                            // add row to roles table body
                            addRole(role);
                        });
                    } else {
                        console.log("Permissions data is not");

                    }

                });
            }

            // refresh permission
            function refreshPermissions() {
                roleLoadingState = true
                var settings = {
                    "url": "/api/permissions",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings).done(function(response) {
                    // Assuming response is an array of roles
                    // console.log(response);

                    if (Array.isArray(response.permissions)) {
                        permissions = response.permissions;

                        $('#permissions tbody').empty();

                        response.permissions.forEach(permission => {
                            // add row to roles table body
                            addPermission(permission);
                        });
                    } else {
                        console.log("Permissions data is not");

                    }

                });
            }



            // Use event delegation to bind the click event
            $(document).on('click', '.openRolePermissionsModal', function() {
                var role = $(this).data('role');
                var roleId = $(this).data('role-id');
                // console.log('Role ID:', roleId);
                // console.log('Role:', role);
                // Call the function to get permissions for the role
                var loading = '<div class="overlay"><i class="fas fa-3x fa-sync-alt"></i></div>';

                // loading
                // $('#rolePermissionsModel').append(loading);

                // loading complete
                $('#rolePermissionsModel h1').empty();
                $('#rolePermissionsModel h1').append(`Role: ${role}`);

                var _permissionOptions = ``


                permissions.forEach(permission => {
                    _permissionOptions +=
                        `<option value="${permission.name}">${permission.name}</option>`
                })

                var permission_selector = `<div class="form-group">
                            <label>Custom Select</label>
                            <select id='permission' class="custom-select">
                               ${_permissionOptions}
                            </select>
                        </div>`;
                var submitButton = `<button type="submit" class="btn btn-primary">Add Permission</button>`;
                $('#createRolePermissionForm').empty();
                $('#createRolePermissionForm').append(
                    `<input type="hidden" id="roleId" name="roleId" value="${roleId}">`);
                $('#createRolePermissionForm').append(permission_selector);
                $('#createRolePermissionForm').append(submitButton);

                getPermissionOfRole(roleId);
            });



            // get role permission
            function getPermissionOfRole(roleId) {
                var settings = {
                    "url": `/api/role/permissions/${roleId}`,
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings).done(function(response) {
                    // Assuming response is an array of roles

                    if (Array.isArray(response.permissions)) {
                        // console.log(response.permissions);
                        var permisssionButtons = ``;
                        response.permissions.forEach(permission => {
                            permisssionButtons += `<div class="col-3">
                            <button type="button" class="btn btn-xs btn-primary">${permission.name} <i data-role-id='${roleId}' data-permission='${permission.name}' class="fas fa-times remove-permission"></i> </button>
                        </div>`;

                        });

                        $('#rolePermissionsDiv').empty();
                        $('#rolePermissionsDiv').append(permisssionButtons);


                    } else {
                        console.log("Permissions data is not found");

                    }

                });
            }

            // on remove role permission
            $(document).on('click', '.remove-permission', function() {
                var roleId = $(this).data('role-id');
                var permission = $(this).data('permission');
                // console.log(roleId, permission);

                // have to write code for remove permission

                var form = new FormData();
                form.append("permission", permission);

                var settings = {
                    "url": `/api/role/remove-permission/${roleId}`,
                    "method": "POST",
                    "timeout": 0,
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": form
                };

                $.ajax(settings).done(function(response) {
                    // console.log(response);

                    getPermissionOfRole(roleId);
                });

            })

            // on create role permission submit
            $('#createRolePermissionForm').submit(function(e) {
                e.preventDefault();

                var roleId = $('#roleId').val();
                // console.log(roleId);

                var form = new FormData();
                form.append("permission", $('#permission').val());

                var settings = {
                    "url": `/api/role/add-permission/${roleId}`,
                    "method": "POST",
                    "timeout": 0,
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": form
                };

                $.ajax(settings).done(function(response) {
                    // console.log(response);
                    getPermissionOfRole(roleId);
                });


            })

            // get users
            function getUsers() {
                var settings = {
                    "url": "/api/users",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings).done(function(response) {

                    users = response.users;
                    // console.log(response);

                    fillUserTable(users)
                });
            }

            // fill user table
            function fillUserTable(users) {
                // clear user table
                $("#userTable tbody").empty()

                users.forEach(user => {
                    $("#userTable tbody").append(`<tr>
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td></td>
                        <td>
                            @canany(['add role', 'all permission'])
                                    <button type="button" class="openUserRolesModal btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#addUserRoleModal" data-user-id='${user.id}' title="Add New Role">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    @endcan
                                    @canany(['user edit', 'all permission'])
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#editRoleModal" title="Edit User">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    @endcan
                                    @canany(['user delete', 'all permission'])
                                    <button onclick="" type="button" data-user-id="${user.id}" class="btn btn-sm btn-danger deleteUser"  title="Delete User">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    @endcan
                        </td>
                        </tr>`)
                });
            }

            $(document).on('click', '.openUserRolesModal', function() {

                var userId = $(this).data('user-id');

                console.log(userId);



                refreshUserRoles(userId);
                // create form of roles add
                // $('#addRoleForm')
                var _roleOptions = ``


                roles.forEach(role => {
                    _roleOptions +=
                        `<option value="${role.name}">${role.name}</option>`
                })

                var role_selector = `<div class="form-group">
                            <label>Custom Select</label>
                            <select id='role' class="custom-select">
                               ${_roleOptions}
                            </select>
                        </div>`;
                var submitButton = `<button type="submit" class="btn btn-primary">Add Permission</button>`;

                $('#addRoleForm').empty();
                $('#addRoleForm').append(
                    `<input type="hidden" id="userId" name="userId" value="${userId}">`);
                $('#addRoleForm').append(role_selector)
                $('#addRoleForm').append(submitButton)

            });

            $('#addRoleForm').submit(function(e) {
                var role = $('#role').val();
                var userId = $('#userId').val();
                var form = new FormData();
                form.append("role", role);

                var settings = {
                    "url": `/api/role/add-user-role/${userId}`,
                    "method": "POST",
                    "timeout": 0,
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": form
                };

                $.ajax(settings).done(function(response) {
                    console.log(response);
                    refreshUserRoles(userId);
                });


            });


            // refress user roles
            function refreshUserRoles(userId) {
                // Get roles of this user
                var settings = {
                    "url": `/api/user/${userId}`,
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings).done(function(response) {
                    console.log(response.user);
                    var userRoles = response.user.roles;
                    console.log(userRoles);

                    var _roles = ``
                    userRoles.forEach(role => {
                        _roles += `<div class="col-3">
                            <button type="button" class="btn btn-xs btn-primary">${role.name} <i data-user-id="${userId}" data-role-id='${role.id}' data-role="${role.name}" class="fas fa-times remove-user-role"></i> </button>
                        </div>`
                    })
                    // have to add roles to model
                    $('#userRoleDiv').empty();
                    $('#userRoleDiv').append(_roles);
                });
            }

            // remove user role and add new
            $(document).on('click', '.remove-user-role', function() {
                var userId = $(this).data('user-id');
                var roleId = $(this).data('role-id');
                var role = $(this).data('role');
                console.log(roleId, role);

                var form = new FormData();
                form.append("role", role);

                var settings = {
                    "url": `/api/role/remove-user-role/${userId}`,
                    "method": "POST",
                    "timeout": 0,
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": form
                };

                $.ajax(settings).done(function(response) {
                    console.log(response);
                    refreshUserRoles(userId);
                });


            })

            $(document).on('click', '#submitCreateUser', function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();

                console.log(name, email, password);


                var settings = {
                    "url": "/api/user",
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Content-Type": "application/json"
                    },
                    "data": JSON.stringify({
                        "name": name,
                        "email": email,
                        "password": password
                    }),
                };

                $.ajax(settings).done(function(response) {

                    if (response.status == 'success') {
                        getUsers()

                    } else {
                        alert('Something wrong to create user')
                    }
                });

                // on ser creation success


            })

            $(document).on('click', '.deleteUser', function() {
                const userId = $(this).data('user-id');

                // Delete user ajax
                var settings = {
                    "url": `/api/user/${userId}`,
                    "method": "DELETE",
                    "timeout": 0,

                };
                $.ajax(settings).done(function(response) {
                    if (response.status == 'success') {
                        getUsers()

                    } else {
                        alert('Something Wrong to delete user')
                    }
                });



            })



        });


        // user role add, edit user, delete user code pending
        // permission edit, delete code pending
    </script>
@endsection
