<?php require_once root_path() . '/resources/views/layout/header.view.php'; ?>




<div class="full-page-container">

    <div class="d-flex flex-row justify-content-center px-4" style="margin-top:9vh;" >
        <div class="card" style="width:28rem;">
            <div class="card-header py-3  d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #eee;">
                <h5>Login to Continue</h5>
                <div class="media-box media-box-sm bg-primary text-white" style="">
                    <i class="material-icons">all_inclusive</i>
                </div>
            </div>
            <div class="card-body">
                <form class="">
                    <div class="form-group mb-4 mt-2">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="abc@geekman.site">

                    </div>
                    <div class="form-group mb-4">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="******">
                    </div>
                    <div class="form-check mb-2 py-2">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Keep Me Logged In</span>
                        </label>
                    </div>
                    <div class="py-1">
                        <button type="submit" class="btn btn-primary btn-block ">Submit</button>
                    </div>
                    <div class="py-2 px-0">
                        <p class="mb-0">
                            <button class=" btn btn-link pl-1">Forgot Password?</button>
                        </p>
                    </div>
                    <div class="py-0 mt-2 d-flex justify-content-around">
                        <button class="btn btn-flat-info"><i class="fa fa-twitter"></i></button>
                        <button class="btn btn-flat-danger"><i class="fa fa-google"></i></button>
                        <button class="btn btn-flat-primary"><i class="fa fa-facebook"></i></button>
                        <button class="btn btn-flat-warning"><i class="fa fa-stack-overflow"></i></button>
                    </div>

                </form>
            </div>
            <div class="card-footer">
                <button class=" btn btn-link pl-1">Don't have an account? Signup Now!</button>
            </div>
        </div>
    </div>
</div>

<!--<script src="../../../public/js/jquery.min.js"></script>-->
<!--<script src="../../../public/js/popper.min.js"></script>-->
<!--<script src="../../../public/js/bootstrap.min.js"></script>-->

<script src="<?= root_path() . '/public/js/popper.min.js' ?>"></script>
<script src="<?= root_path() . '/public/js/bootstrap.min.js' ?>"></script>






<?php require_once root_path() . '/resources/views/layout/footer.view.php'; ?>
