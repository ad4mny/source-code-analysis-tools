<div class="container position-absolute top-50 start-50 translate-middle">
    <div class="row">
        <div class="col-4 offset-4">
            <div class="col bg-white shadow p-5 rounded-3">
                <form method="post" action="<?php echo base_url(); ?>register/submit">
                    <div class="form-group pb-3 text-center">
                        <h3 class="text-dark">Create a New Account</h3>
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
                    <div class="form-group pb-3 border-bottom">
                        <input type="password" class="form-control" name="c_password" placeholder="Confirm password" required>
                    </div>
                    <div class="form-group py-3 text-center">
                        <button type="submit" class="form-control btn btn-primary " name="submit">Create Account</button>
                    </div>
                    <div class="form-group text-center">
                        <small class="text-muted">Already have an account? <a href="<?php echo base_url(); ?>login">Login</a>.</small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

