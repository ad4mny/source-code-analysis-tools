<div class="masthead py-5">
    <div class="container bg-white rounded-3 p-5 text-dark my-5">
        <h1 class="display-1">History</h1>
        <?php if (isset($history) && is_array($history) && $history != false) {
            foreach ($history as $row) {
        ?>
                <div class="row mb-2 shadow-sm p-2 bg-success text-white rounded-3">
                    <div class="col m-auto">
                        Filename <?php echo $row['fd_name']; ?>
                    </div>
                    <div class="col m-auto">
                        Scanned at <?php echo $row['fd_log']; ?>
                    </div>
                    <div class="col-2">
                        <a href="<?php echo base_url() . 'result/' . $row['fd_id'] ?>" class="btn btn-light btn-sm float-end">Result</a>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>