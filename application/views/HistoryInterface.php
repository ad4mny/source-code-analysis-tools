<div class="container pb-5 px-5 my-5">
    <div class="row px-5">
        <div class="col">
            <h1 class="display-4 border-bottom">History</h1>
        </div>
    </div>
    <div class="px-5">
        <?php if (isset($history) && is_array($history) && $history != false) {
            foreach ($history as $row) {
        ?>
                <div class="row bg-light mb-2 py-1 border rounded-3">
                    <div class="col m-auto">
                        <?php echo $row['fd_name']; ?>
                    </div>
                    <div class="col m-auto text-end">
                        <?php echo $row['fd_log']; ?>
                    </div>
                    <div class="col-1 text-end">
                        <div class="btn-group">
                            <a class="text-decoration-none dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url() . 'result/' . hashin($row['fd_id']); ?>" class="dropdown-item">
                                        View
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal" class="dropdown-item" onclick="update('<?php echo hashin($row['fd_id']); ?>')">
                                        Update
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() . 'result/delete/' . hashin($row['fd_id']); ?>" class="dropdown-item">
                                        Delete
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="row mb-2">
                <div class="col m-auto">
                    <p class="text-muted fw-light">No scan analysis history available yet.</p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update new code file</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url(); ?>analysis/update" enctype="multipart/form-data" class="row g-1">
                    <small class="">CHOOSE NEW SOURCE CODE</small>
                    <div class="col-10">
                        <input type="file" class="form-control " name="source_code">
                        <input type="hidden" name="file_id" id="file_id">
                    </div>
                    <div class="col">
                        <button type="submit" class="form-control btn-primary" name="submit">
                            <i class="fas fa-upload"></i>
                        </button>
                    </div>
                    <small class="mt-2 text-muted">Currently, only PHP language are acceptable and make sure your file in the stated language.</small>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function update(file_id) {
        document.getElementById("file_id").value = file_id;
    }
</script>