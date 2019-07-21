<div class="main_page_content" id="User_register">
    <section class="p-0" id="my-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div id="details" class="col-md-9 border-right pt-3">

                    <div class="alert alert-danger" style="display: none" id="err-msg"> </div>
                    <div class="alert alert-success" style="display: none" id="success-msg"></div>

                    <h2 class="big-title"><?php echo  __('forget_password');?></h2>
                    <div id="loading_reg" style="display: none;text-align: center;">
                        <i class="fa fa-refresh fa-spin fa-5x fa-fw" ></i>
                        <br>Loading...
                        <!-- <span class="sr-only">Loading...</span> -->
                    </div>
                    <form class="pl-4" id="emailForm">
                        <div class="border border-bottom-0 border-right-0 border-left-0">
                            <br>
                            <div class="form-group row justify-content-center required">
                                <label for="opass" class="col-3 col-form-label text-right control-label">Email</label>
                                <div class="col-5">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <span class="col-3"></span>
                            <div class="col-5">
                                <button style="cursor: pointer" type="submit" id="email-button" class="btn btn-orange">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>