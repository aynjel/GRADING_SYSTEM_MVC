<?= $this->setSiteTitle('Admin Registration'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="authincation">
    <div class="container" style="margin-top: 20px; margin-bottom: 20px; max-width: 700px;">
        <div class="authincation-content mx-auto shadow rounded">
            <div class="auth-form py-4 text-center">

                <i class="fas fa-user-plus fa-4x d-block text-dark"></i>

                <h4 class="my-4 text-uppercase fw-bold">
                    Admin Registration
                </h4>

                <form method="POST" autocomplete="off" class="mt-4">
                    <div class="row g-2">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-secondary" placeholder="First name"
                                name="first_name" value="<?= Helper::old('first_name'); ?>" required autofocus>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-secondary" placeholder="Last name"
                                name="last_name" value="<?= Helper::old('last_name'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-secondary" placeholder="Contact Number"
                                name="contact_number" value="<?= Helper::old('contact_number'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-secondary" placeholder="Address"
                                name="address" value="<?= Helper::old('address'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-secondary" placeholder="Username"
                                name="username" value="<?= Helper::old('username'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control border-secondary" placeholder="Email" name="email"
                                value="<?= Helper::old('email'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="password" class="form-control border-secondary" placeholder="Password"
                                name="password" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>