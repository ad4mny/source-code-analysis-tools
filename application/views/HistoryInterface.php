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
                <div class="row bg-white mb-2 shadow-sm rounded-3">
                    <div class="col m-auto">
                        Filename <?php echo $row['fd_name']; ?>
                    </div>
                    <div class="col m-auto">
                        Scanned at <?php echo $row['fd_log']; ?>
                    </div>
                    <div class="col-2">
                        <a href="<?php echo base_url() . 'result/' . $row['fd_id'] ?>" class="text-decoration-none text-primary btn-sm float-end">
                            View
                        </a>
                        <a href="<?php echo base_url() . 'result/' . $row['fd_id'] ?>" class="text-decoration-none text-danger btn-sm float-end">
                            Delete
                        </a>
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