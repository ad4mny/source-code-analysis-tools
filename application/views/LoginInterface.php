<div class="container position-absolute top-50 start-50 translate-middle">
    <div class="row">
        <div class="col-4 offset-4">
            <div class="col bg-white shadow p-5 rounded-3">
                <form method="post" action="<?php echo base_url(); ?>login/submit">
                    <div class="form-group pb-3 text-center">
                        <h3 class="text-dark">Login</h3>
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
                    <div class="form-group text-center">
                        <small class="text-muted">
                            Create an account now, click <a href="<?php echo base_url(); ?>register" class="text-primary">here</a>.
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

