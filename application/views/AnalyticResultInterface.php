<div class="masthead py-5">
    <div class="container bg-white rounded-3 p-5 text-dark my-5">
        <?php if (isset($scan) && is_array($scan) && $scan != false) { ?>
            <div class="row">
                <div class="col">
                    <h2 class="border-bottom pb-2">Scan Result</h2>
                    <h5><?php echo $scan['errors']; ?> Warning(s) detected!</h5>
                    <h5>File name: <span class="text-muted"><?php echo $scan['file']; ?></span></h5>
                    <h5>Time taken: <span class="text-muted"><?php echo $scan['time']; ?> seconds </span></h5>
                    <h5 class="border-bottom pb-2">Date scanned: <span class="text-muted"><?php echo $scan['date']; ?> UTC</span></h5>
                </div>
            </div>

            <?php
            if ($scan['data'] != false) {
                foreach ($scan['data'] as $data) {
            ?>
                    <div class="row mb-2">
                        <div class="col">
                            <div class="card">
                                <div class="card-header bg-danger  text-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Possible code flaw for SQL Injections.</h5>
                                    <i class="fas fa-exclamation-triangle fa-lg"></i>
                                </div>
                                <div class="card-body d-inline-flex">
                                    <div class="pe-3 border-end">
                                        <small class="text-muted">CODE LINE</small>
                                        <p class="mb-0">Line <?php echo $data['line']; ?></p>
                                    </div>
                                    <div class="ps-3">
                                        <small class="text-muted">CODE CONTENT</small>
                                        <p class="mb-0"><?php echo $data['content']; ?></p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">DESCRIPTION</small>
                                    <p class="mb-0"><?php echo $data['desc']; ?></p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">POSSIBLE CODE FIX</small>
                                    <p class="mb-0"><?php echo $data['code']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } else {
                ?>
                <h4 class="text-success">Your file is good, no possible SQL injection flaws detected.</h4>
                <a href="<?php echo base_url(); ?>history">View scan history</a>
                <hr>
        <?php }
        } ?>
        <h2>End of result.</h2>
    </div>
</div>