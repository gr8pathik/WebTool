<div class="form-box" id="login-box">
    <div class="header">Sign In</div>
    <form action="<?php echo base_url('site/admin/login');?>" method="post">
        <div class="body bg-gray">
            <!-- messages section (error, warning, success) -->
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <ul>
                        <?php echo validation_errors(); ?>
                    </ul>
                </div>
            <?php endif;?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif;?>
            
            <!-- /messages section -->
            <div class="form-group">
                <input type="text" name="email" id="email" class="form-control" placeholder="Email or Username"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
            </div>          
            <div class="form-group">
                <input type="checkbox" name="remember_me"/> Remember me
            </div>
        </div>
        <div class="footer">                                                               
            <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
            
            <p><a href="#">I forgot my password</a></p>
        </div>
    </form>
</div>