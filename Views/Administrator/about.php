<div class="container px-3 py-3">
    <h1>About Us</h1>
    <button id="addTextBtn" class="btn btn-success">Add New Text</button>
    <table id="textsTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Left Text</th>
                <th>Right Text</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="textModal" tabindex="-1" aria-labelledby="textModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add/Edit Text</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="textForm">
                    <input type="hidden" id="textId" name="textId">
                    <div class="form-group">
                        <label for="leftTxtBlock">Left Text Block:</label>
                        <textarea id="leftTxtBlock" name="leftTxtBlock" style="height: 200px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="rightTxtBlock">Right Text Block:</label>
                        <textarea id="rightTxtBlock" name="rightTxtBlock" style="height: 200px;"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Quill Scripts -->
<!-- Quill JS -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
    var quillLeft = new Quill('#leftTxtBlock', {
        theme: 'snow'
    });
    var quillRight = new Quill('#rightTxtBlock', {
        theme: 'snow'
    });

    $(document).ready(function() {
        var table = $('#textsTable').DataTable({
            "ajax": {
                "url": "<?= BASE_ADM_URL; ?>about/viewAll",
                "type": "GET",
                "dataType": "json"
            },
            "columns": [{
                    "data": "leftTxtBlock"
                },
                {
                    "data": "rightTxtBlock"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<button class="btn btn-warning mx-2" onclick="editText(' + row.id + ')">Edit</button>' +
                            '<button class="btn btn-danger mx-2" onclick="deleteText(' + row.id + ')">Delete</button>';
                    }
                }
            ]
        });

        $('#textForm').on('submit', function(e) {
            e.preventDefault();
            var formURL = $('#textId').val() ? "<?= BASE_ADM_URL; ?>about/update" : "<?= BASE_ADM_URL; ?>about/insert";
            var data = {
                id: $('#textId').val(),
                leftTxtBlock: quillLeft.root.innerHTML,
                rightTxtBlock: quillRight.root.innerHTML
            };
            $.post(formURL, data, function(response) {
                $('#textModal').modal('hide');
                table.ajax.reload();
                Swal.fire({
                    title: response.success ? 'Success' : 'Error',
                    text: response.message,
                    icon: response.success ? 'success' : 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
            }, 'json');
        });

        $('#addTextBtn').click(function() {
            $('#textForm')[0].reset();
            quillLeft.setText('');
            quillRight.setText('');
            $('#textId').val('');
            $('#modalTitle').text('Add New Text');
            $('#textModal').modal('show');
        });
    });

    function editText(id) {
        $.get("<?= BASE_ADM_URL; ?>about/viewOne/" + id, function(data) {
            $('#textId').val(data.id);
            quillLeft.root.innerHTML = data.leftTxtBlock;
            quillRight.root.innerHTML = data.rightTxtBlock;
        });
    }

    function deleteText(id) {
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
                $.post("<?= BASE_ADM_URL; ?>about/delete", {
                    id: id
                }, function(response) {
                    Swal.fire(
                        'Deleted!',
                        'The text has been deleted.',
                        'success'
                    ).then(function() {
                        table.ajax.reload();
                    });
                }, 'json');
            }
        });
    }

    function closeModal() {
        $('#textModal').modal('hide');
        // Clear CKEditor instances when closing modal
        CKEDITOR.instances.leftTxtBlock.setData('');
        CKEDITOR.instances.rightTxtBlock.setData('');
    }
</script>