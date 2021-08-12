<?php require APPROOT. '/views/inc/header.php'; ?>
<div class="row"></div>
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create an Account</h2>
            <p>Please fill out the form to register with us.</p>
            <form action="<?php echo URLROOT ?>/users/register" method="post">
                <div class="form-group">
                    <label for="name">Name <span>*</span></label>
                    <input type="text" name="name" id="name" 
                        class="form-control form-control-lg <?php echo ($data['name_error']) ?  'is-invalid' : '' ?> "
                        value="<?php echo $data['name']; ?>">
                    <span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" name="email" id="email" 
                        class="form-control form-control-lg <?php echo ($data['email_error']) ?  'is-invalid' : '' ?> "
                        value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>

                </div>
                <div class="form-group">
                    <label for="password">Password <span>*</span></label>
                    <input type="password" name="password" id="password" 
                        class="form-control form-control-lg <?php echo ($data['password_error']) ?  'is-invalid' : '' ?> "
                        value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
                </div>
                <div class="form-group">
                    <label for="confirmed_password">Password Confirmation <span>*</span></label>
                    <input type="password" name="confirmed_password" id="confirmed_password" 
                        class="form-control form-control-lg <?php echo ($data['confirmed_password_error']) ?  'is-invalid' : '' ?> "
                        value="<?php echo $data['confirmed_password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['confirmed_password_error']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/login" value="Login" class="btn btn-light btn-block">
                            Have an account? Login
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT. '/views/inc/footer.php'; ?>