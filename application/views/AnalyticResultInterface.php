<div class="container pb-5 px-5 my-5">
    <?php if (isset($scan) && is_array($scan) && $scan != false) { ?>
        <div class="row">
            <div class="col">
                <h1 class="display-4 border-bottom">Scan Result</h1>
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
                <div class="row pb-2">
                    <div class="col">
                        <div class="card rounded-3 border-0 shadow h-100">
                            <div class="card-header bg-warning ">
                                <h5 class="mb-0">
                                    <i class="fas fa-exclamation-triangle fa-fw"></i>
                                    Possible SQL Injection
                                </h5>
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