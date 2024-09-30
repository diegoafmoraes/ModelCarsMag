<div class="container px-3 py-3">
    <h1>Banners</h1>
    <div class="float-right">
        <button id="addBannerBtn" class="btn btn-success float-right">Add Banner</button>
        <table id="bannersTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Page</th>
                    <th>Area</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="bannerModal" tabindex="-1" aria-labelledby="bannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bannerModalLabel">Banner Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeBannerModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bannerForm" enctype="multipart/form-data">
                    <input type="hidden" id="bannerId" name="bannerId">
                    <div class="form-group">
                        <label for="pageId">Page:</label>
                        <select id="pageId" name="pageId" class="form-control" required>
                            <!-- Options serão geradas dinamicamente -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="area">Area:</label>
                        <select id="area" name="area" class="form-control" required>
                            <option value="left">Left</option>
                            <option value="center">Center</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bannerImage">Banner Image:</label>
                        <input type="file" id="bannerImage" name="bannerImage" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeBannerModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#bannersTable').DataTable({
            "ajax": {
                "url": "<?= BASE_ADM_URL; ?>banner/viewAll",
                "type": "GET",
                "dataType": "json"
            },
            "columns": [{
                    "data": "page"
                },
                {
                    "data": "area"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<button class="btn-warning mx-2" onclick="editBanner(' + row.id + ')">Edit</button>' +
                            '<button class="btn-danger mx-2" onclick="deleteBanner(' + row.id + ')">Delete</button>';
                    }
                }
            ]
        });

        // Preencher o select de páginas
        $.get("<?= BASE_ADM_URL; ?>page/viewAll", function(data) {
            var options = '';
            data.forEach(function(page) {
                options += '<option value="' + page.id + '">' + page.page + '</option>';
            });
            $('#pageId').html(options);
        }, 'json');

        $('#addBannerBtn').click(function() {
            $('#bannerForm')[0].reset();
            $('#bannerId').val('');
            $('#bannerModalLabel').text('Add Banner');
            $('#bannerModal').modal('show');
        });

        $('#bannerForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var formURL = $('#bannerId').val() ? "<?= BASE_ADM_URL; ?>banner/update" : "<?= BASE_ADM_URL; ?>banner/insert";
            $.ajax({
                url: formURL,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        title: response.success ? 'Success' : 'Error',
                        text: response.message,
                        icon: response.success ? 'success' : 'error',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(function() {
                        $('#bannerModal').modal('hide');
                        table.ajax.reload();
                    });
                }
            });
        });
    });

    function editBanner(id) {
        $.get("<?= BASE_ADM_URL; ?>banner/viewOne/" + id, function(data) {
            $('#bannerId').val(data.id);
            $('#pageId').val(data.pageId);
            $('#area').val(data.area);
            $('#bannerModalLabel').text('Edit Banner');
            $('#bannerModal').modal('show');
        }, 'json');
    }

    function deleteBanner(id) {
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
                $.post("<?= BASE_ADM_URL; ?>banner/delete", { id: id }, function(response) {
                    Swal.fire({
                        title: response.success ? 'Success' : 'Error',
                        text: response.message,
                        icon: response.success ? 'success' : 'error',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(function() {
                        table.ajax.reload();
                    });
                }, 'json');
            }
        });
    }

    function closeBannerModal() {
        $('#bannerModal').modal('hide');
    }
</script>
