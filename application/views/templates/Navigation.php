<div class="position-relative">
    <div class="position-absolute start-50 translate-middle justify-content-center mt-5 shadow">
        <div class="btn-group btn-group-lg">
            <a href="<?php echo base_url(); ?>" class="btn <?php if ($this->uri->segment(1) == '') echo 'btn-success';
                                                            else echo 'btn-light'; ?>">
                <small class="fs-6">Home</small>
            </a>
            <a href="<?php echo base_url(); ?>analytic" type="button" class="btn <?php if ($this->uri->segment(1) == 'analytic') echo 'btn-success';
                                                                                    else echo 'btn-light'; ?>">
                <small class="fs-6">Analytics</small>
            </a>
            <a href="<?php echo base_url(); ?>solution" type="button" class="btn <?php if ($this->uri->segment(1) == 'solution') echo 'btn-success';
                                                                                    else echo 'btn-light'; ?>">
                <small class="fs-6">Solution</small>
            </a>
            <a href="<?php echo base_url(); ?>about" type="button" class="btn <?php if ($this->uri->segment(1) == 'about') echo 'btn-success';
                                                                                else echo 'btn-light'; ?>">
                <small class="fs-6">About</small>
            </a>
        </div>
    </div>
    <div class="position-absolute end-0 mt-4">
        <?php if (!isset($_SESSION['uid'])) { ?>
            <a href="<?php echo base_url(); ?>login" class="nav-link text-white">
                <i class="fas fa-sign-in-alt"></i>
            </a>
        <?php } else { ?>
            <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user"></i> </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a href="<?php echo base_url(); ?>profile" class="dropdown-item" type="button">Profile</a></li>
                <li><a href="<?php echo base_url(); ?>history" class="dropdown-item" type="button">History</a></li>
                <li><a href="<?php echo base_url(); ?>logout" class="dropdown-item" type="button">Logout</a></li>
            </ul>
        <?php } ?>
    </div>
</div>

<div id="alert" class="w-75 position-absolute start-50 translate-middle mt-5" style="z-index: 2; top: 10%;">
    <?php
    if ($this->session->tempdata('notice') != NULL) {
        echo '<div class="alert alert-success border-0 shadow alert-dismissible fade show" role="alert">';
        echo '<i class="fas fa-info-circle fa-fw"></i> ' . $this->session->tempdata('notice');
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    if ($this->session->tempdata('error') != NULL) {
        echo '<div class="alert alert-danger border-0 shadow alert-dismissible fade show" role="alert">';
        echo '<i class="fas fa-exclamation-circle fa-fw"></i> ' . $this->session->tempdata('error');
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    ?>
</div>