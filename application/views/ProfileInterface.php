<div class="container pb-5 px-5 my-5">
    <div class="row mx-5">
        <div class="col">
            <h1 class="display-4 border-bottom">Account Setting</h1>
        </div>
    </div>
    <div class="row mx-5">
        <div class="col me-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">Personal Information</a>
                <a href="#" class="list-group-item list-group-item-action">Payment Information</a>
                <a href="#" class="list-group-item list-group-item-action">Feedback</a>
            </div>
        </div>
        <div class="col-8 border-start ps-3">
            <?php if (isset($profiles) && is_array($profiles) && $profiles != false) { ?>
                <div class="pb-2">
                    <small>Username</small>
                    <p> <?php echo $profiles['ud_username']; ?></p>
                </div>
                <div class="pb-2">
                    <small>Full Name</small>
                    <p> <?php echo $profiles['ud_fullname']; ?></p>
                </div>
                <div class="pb-2">
                    <small>Institution</small>
                    <p> <?php echo $profiles['ud_institution']; ?></p>
                </div>
                <div class="pb-2">
                    <a href="<?php echo base_url(); ?>profile/delete" class="btn btn-danger">Deactivate</a>
                </div>
                <div class="pb-2">
                    <a href="<?php echo base_url(); ?>profile/update" class="btn btn-outline-primary">Update Account</a>
                </div>
            <?php
            } else { ?>
                <div class="row mb-2">
                    <div class="col m-auto">
                        <p class="text-muted fw-light">No scan analysis history available yet.</p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>