<nav class="px-5 navbar sticky-top navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand  text-primary" href="<?php echo base_url(); ?>">
                <h3><i class="fas fa-code fa-fw fa-sm"></i> Scrutinyx</h3>
            </a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item px-1">
                    <h5>
                        <a href="<?php echo base_url(); ?>analytic" class="nav-link <?php if ($this->uri->segment(1) == 'analytic') echo 'active border-bottom border-3 border-primary'; ?>">
                            Analytic
                        </a>
                    </h5>
                </li>
                <li class="nav-item px-1">
                    <h5>
                        <a href="<?php echo base_url(); ?>solution" class="nav-link  <?php if ($this->uri->segment(1) == 'solution') echo 'active border-bottom border-3 border-primary'; ?>">
                            Solution
                        </a>
                    </h5>
                </li>
                <li class="nav-item px-1">
                    <h5>
                        <a href="<?php echo base_url(); ?>solution" class="nav-link  <?php if ($this->uri->segment(1) == 'price') echo 'active border-bottom border-3 border-primary'; ?>">
                            Pricing
                        </a>
                    </h5>
                </li>
                <li class="nav-item px-1">
                    <h5>
                        <a href="<?php echo base_url(); ?>about" class="nav-link  <?php if ($this->uri->segment(1) == 'about') echo 'active border-bottom border-3 border-primary'; ?>">
                            About
                        </a>
                    </h5>
                </li>
                <li class="nav-item px-1">
                    <h5>
                        <?php if (!isset($_SESSION['uid'])) { ?>
                            <a href="<?php echo base_url(); ?>login" class="nav-link px-2 <?php if ($this->uri->segment(1) == 'login') echo 'active border-bottom border-3 border-primary'; ?>">
                                Login
                            </a>
                        <?php } else { ?>
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Client Area
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="m-auto">
                                    <a href="<?php echo base_url(); ?>history" class="dropdown-item" type="button">
                                        <i class="fas fa-history fa-sm fa-fw me-1"></i> History
                                    </a>
                                </li>
                                <li class="m-auto">
                                    <a href="<?php echo base_url(); ?>account" class="dropdown-item" type="button">
                                        <i class="fas fa-user-cog fa-sm fa-fw me-1"></i> Account Setting
                                    </a>
                                </li>
                                <li class="m-auto">
                                    <a href="#" class="dropdown-item" type="button">
                                        <i class="fas fa-headset fa-sm fa-fw me-1"></i> Contact Us</a>
                                </li>
                                <li class="m-auto">
                                    <a href="<?php echo base_url(); ?>logout" class="dropdown-item" type="button">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw me-1"></i> Logout</a>
                                </li>
                            </ul>
                        <?php } ?>
                    </h5>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="w-50 float-end position-absolute m-3">
    <?php
    if ($this->session->tempdata('notice') != NULL) {
        echo '<div class="alert alert-light border-0 shadow alert-dismissible fade show" role="alert">';
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