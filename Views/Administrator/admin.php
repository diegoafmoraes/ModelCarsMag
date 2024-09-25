<div class="container">
    <h1>Admin Users</h1>
    <div class="float-right">

        <button id="addUserBtn" class="btn btn-success float-right">Add User</button>
        <table id="usersTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>

    </div>
</div>

<!-- Modal -->
<div class="modal" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <input type="hidden" id="userId" name="userId">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#usersTable').DataTable({
            "ajax": {
                "url": "<?= BASE_ADM_URL; ?>admin/viewAll",
                "type": "GET",
                "dataType": "json"
            },
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "user"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<button class="btn-warning mx-2" onclick="editUser(' + row.id + ')">Edit</button>' +
                            '<button class="btn-danger mx-2" onclick="deleteUser(' + row.id + ')">Delete</button>';
                    }
                }
            ]
        });

        $('#addUserBtn').click(function() {
            $('#userForm')[0].reset();
            $('#userId').val('');
            $('#modalTitle').text('Add User');
            $('#password').attr('required', true);
            $('#userModal').modal('show');
        });

        $('#userForm').submit(function(e) {
            e.preventDefault();
            var postData = $(this).serialize();
            var formURL = $('#userId').val() ? "<?= BASE_ADM_URL; ?>admin/update" : "<?= BASE_ADM_URL; ?>admin/insert";
            $.post(formURL, postData, function(response) {
                Swal.fire({
                    title: response.success ? 'Success' : 'Error',
                    text: response.message,
                    icon: response.success ? 'success' : 'error',
                    timer: 1500, // Timer set to 1.5 seconds
                    showConfirmButton: false // Não mostra o botão de confirmação
                }).then(function() {
                    $('#userModal').modal('hide');
                    table.ajax.reload();
                });

            }, 'json');
        });
    });

    function editUser(id) {
        $.get("<?= BASE_ADM_URL; ?>admin/viewOne/" + id, function(data) {
            $('#userId').val(data.id);
            $('#name').val(data.name);
            $('#username').val(data.user);
            $('#password').removeAttr('required'); // Remove the required attribute when editing
            $('#modalTitle').text('Edit User');
            $('#userModal').modal('show');
        }, 'json');
    }

    function deleteUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?= BASE_ADM_URL; ?>admin/delete", {
                    id: id
                }, function(response) {
                    /* Swal.fire('Deleted!', 'Your file has been deleted.', 'success').then(function() {
                        table.ajax.reload();
                    }); */
                    Swal.fire({
                        title: response.success ? 'Success' : 'Error',
                        text: response.message,
                        icon: response.success ? 'success' : 'error',
                        timer: 1500, // Timer set to 1.5 seconds
                        showConfirmButton: false // Não mostra o botão de confirmação
                    }).then(function() {
                        $('#userModal').modal('hide');
                        /* table.ajax.reload(); */
                        setTimeout(
                            window.location.reload(), 300);
                    });

                }, 'json');
            }
        });
    }

    function closeModal() {
        // $('#userModal').hide();
        $('#userModal').modal('hide');
    }
</script>