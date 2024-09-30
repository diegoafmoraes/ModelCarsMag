<div class="container">
    <h1>Magazine Management</h1>
    <button id="addMagazineBtn" class="btn btn-success">Add New Magazine</button>
    <table id="magazinesTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Number</th>
                <th>Publication Date</th>
                <th>Cover Image</th>
                <th>PDF File</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="magazineModal" tabindex="-1" aria-labelledby="magazineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="magazineModalLabel">Magazine Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="magazineForm" enctype="multipart/form-data">
                    <input type="hidden" id="magazineId" name="magazineId">
                    <div class="form-group">
                        <label for="number">Issue Number:</label>
                        <input type="number" id="number" name="number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="publication_date">Publication Date:</label>
                        <input type="date" id="publication_date" name="publication_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cover_image">Cover Image (JPG):</label>
                        <input type="file" id="cover_image" name="cover_image" accept=".jpg,.jpeg" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pdf_file">Magazine Content (PDF):</label>
                        <input type="file" id="pdf_file" name="pdf_file" accept=".pdf" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Magazine</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#magazinesTable').DataTable({
            "ajax": {
                "url": "<?= BASE_ADM_URL; ?>magazine/viewAll",
                "type": "GET",
                "dataType": "json"
            },
            "columns": [{
                    "data": "number"
                },
                {
                    "data": "publication_date"
                },
                {
                    "data": "cover",
                    "render": function(data) {
                        return '<img src="<?= BASE_URL; ?>assets/images/magazine-covers/' + data + '" alt="Cover" width="100">';
                    }
                },
                {
                    "data": "mag",
                    "render": function(data) {
                        return '<a href="<?= BASE_URL; ?>assets/images/magazine-issues/' + data + '" target="_blank">View PDF</a>';
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<button class="btn btn-warning mx-2" onclick="editMagazine(' + row.id + ')">Edit</button>' +
                            '<button class="btn btn-danger mx-2" onclick="deleteMagazine(' + row.id + ')">Delete</button>';
                    }
                }
            ]
        });

        $('#addMagazineBtn').click(function() {
            $('#magazineForm')[0].reset();
            $('#magazineId').val('');
            $('#magazineModalLabel').text('Add New Magazine');
            $('#magazineModal').modal('show');
        });

        $('#magazineForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this); // Garante que todos os dados do formulário sejam coletados

            // Aqui, assumimos que o ID está em um campo oculto no formulário (ajuste se necessário)
            let id = $('#magazineId').val(); // Ou qualquer outro campo que contenha o ID

            // Se o ID for passado, ajusta a URL e o método para update
            let formURL = id ? `<?= BASE_ADM_URL; ?>magazine/update/${id}` : '<?= BASE_ADM_URL; ?>magazine/insert';

            $.ajax({
                url: formURL,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        title: response.status === 'success' ? 'Success' : 'Error',
                        text: response.message,
                        icon: response.status === 'success' ? 'success' : 'error'
                    }).then(function() {
                        $('#magazineModal').modal('hide');
                        table.ajax.reload();
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + xhr.responseText);
                    Swal.fire({
                        title: 'Error',
                        text: 'There was an issue with the operation.',
                        icon: 'error'
                    });
                }
            });
        });

    });

    function editMagazine(id) {
        $.get("<?= BASE_ADM_URL; ?>magazine/viewOne/" + id, function(data) {
            $('#magazineId').val(data.id);
            $('#number').val(data.number);
            $('#publication_date').val(data.publication_date);
            $('#magazineModalLabel').text('Edit Magazine');
            $('#magazineModal').modal('show');
        }, 'json');
    }

    function deleteMagazine(id) {
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

                $.ajax({
                    type: "POST",
                    url: "<?= BASE_ADM_URL; ?>magazine/delete",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var res = JSON.parse(response);
                        if (res.success) {
                            /*         Swal.fire(
                                        'Deleted!',
                                        res.message,
                                        'success',
                                    ); */
                            Swal.fire({
                                title: res.success ? 'Success' : 'Error',
                                text: res.message,
                                icon: res.success ? 'success' : 'error',
                                timer: 1500, // Timer set to 1.5 seconds
                                showConfirmButton: false // Não mostra o botão de confirmação
                            }).then(function() {
                                $('#userModal').modal('hide');
                                /* table.ajax.reload(); */
                                setTimeout(
                                    window.location.reload(), 300);
                            });
                        } else {
                            Swal.fire(
                                'Failed!',
                                res.message,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting.',
                            'error'
                        );
                    }
                });

            }
        });
    }

    function closeModal() {
        // $('#userModal').hide();
        $('#magazineModal').modal('hide');
    }
</script>