<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $template['title'];?></title>
        <?php echo $template['metadata'];?>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <?php echo $this->asset->add_css('css/bootstrap.min.css');?>
        <?php echo $this->asset->add_css('css/font-awesome.min.css');?>
        <?php echo $this->asset->add_css('css/AdminLTE.css');?>
        <?php echo $this->asset->add_css('css/style.css');?>
        <?php echo $this->asset->compile_css();?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <?php echo $template['body'];?>
        <!-- Bootstrap -->
        <?php echo $this->asset->add_raw_js('http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js');?>
        <?php echo $this->asset->add_js('js/bootstrap.min.js');?>
        <?php echo $this->asset->compile_js();?>

    </body>
</html>