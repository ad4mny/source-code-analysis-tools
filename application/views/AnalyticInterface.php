<div class="container ">
    <div class="row d-flex align-items-center justify-content-center" style="height: 80vh;">
        <div class="col-6">
            <h3 class="text-center pb-1"><i class="fas fa-file-code fa-3x"></i></h3>
            <h3 class="text-center pb-2">Upload a source code file to begin analysis.</h3>
            <form method="post" action="<?php echo base_url(); ?>analytic/upload" enctype="multipart/form-data" class="row g-1">
                <div class="col-10">
                    <input type="file" class="form-control form-control-lg" name="source_code">
                </div>
                <div class="col">
                    <button type="submit" class="form-control form-control-lg btn-primary" name="submit">
                        <i class="fas fa-upload"></i>
                    </button>
                </div>
            </form>
            <small class="mt-2 text-muted">Currently, only PHP language are acceptable and make sure your file in the stated language.</small>
        </div>
    </div>
</div>