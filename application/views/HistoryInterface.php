<div class="container pb-5 px-5 my-5">
    <h1 class="display-4 border-bottom">History</h1>
    <?php if (isset($history) && is_array($history) && $history != false) {
        foreach ($history as $row) {
    ?>
            <div class="row mb-2 shadow-sm rounded-3">
                <div class="col m-auto">
                    Filename <?php echo $row['fd_name']; ?>
                </div>
                <div class="col m-auto">
                    Scanned at <?php echo $row['fd_log']; ?>
                </div>
                <div class="col-2">
                    <a href="<?php echo base_url() . 'result/' . $row['fd_id'] ?>" class="btn btn-danger btn-sm float-end ">
                        <i class="fas fa-trash fa-fw"></i>
                    </a>
                    <a href="<?php echo base_url() . 'result/' . $row['fd_id'] ?>" class="btn btn-primary btn-sm float-end me-1">
                        <i class="fas fa-eye fa-fw"></i>
                    </a>
                </div>
            </div>
    <?php }
    } ?>
</div>