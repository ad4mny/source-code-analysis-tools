<div class="container ">
    <div class="row px-5 ms-5 me-4">
        <div class="col-5 pe-4 me-4">
            <div class="row d-flex align-items-center justify-content-center" style="height: 80vh;">
                <div class="col">
                    <h3 class="py-3" style=" letter-spacing: 1px;">A tool that provide great insight on code flaw and posible solution.</h3>
                    <h5 class="lead lh-base pb-3" style=" letter-spacing: 1px;">Assists and help summarised all details on the code flawed on which lines, causes, fix and explanation.</h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row d-flex align-items-center justify-content-center" style="height: 80vh;">
                <div class="col border-end pe-4">
                    <form method="post" action="<?php echo base_url(); ?>register/submit">
                        <div class="form-group pb-2 text-center">
                            <h5 class="text-dark">Create a New Account</h5>
                        </div>
                        <div class="form-group pb-2">
                            <input type="text" class="form-control" name="name" placeholder="Your full name" required>
                        </div>
                        <div class="form-group pb-2">
                            <select name="institute" class="form-select">
                                <option>Individual</option>
                                <option>Student</option>
                                <option>Company</option>
                            </select>
                        </div>
                        <div class="form-group pb-2">
                            <input type="text" class="form-control" name="username" placeholder="Your username" required>
                        </div>
                        <div class="form-group pb-2">
                            <input type="password" class="form-control" name="password" placeholder="Your password" required>
                        </div>
                        <div class="form-group pb-3">
                            <input type="password" class="form-control" name="c_password" placeholder="Confirm password" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="form-control btn btn-secondary text-white" name="submit">Create Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row d-flex align-items-center justify-content-center" style="height: 80vh;">
                <div class="col bg-white shadow p-5 px-4 rounded-3 ms-4">
                    <form method="post" action="<?php echo base_url(); ?>login/submit">
                        <div class="form-group pb-3">
                            <h5 class="text-dark">Client Login</h5>
                        </div>
                        <div class="form-group pb-2">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="form-group pb-3 border-bottom">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group py-3 text-center">
                            <button type="submit" class="form-control btn btn-primary " name="submit">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>