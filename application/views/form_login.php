<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>ADI MUHAMMAD MUHSIDI</title>
<link rel="stylesheet" href="<?=base_url();?>assets/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/style.shinyblue.css" type="text/css" />

<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/custom.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#login').submit(function(){
            var u = jQuery('#username').val();
            var p = jQuery('#password').val();
            if(u == '' && p == '') {
                jQuery('.login-alert').fadeIn();
                return false;
            }
        });
    });
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body class="loginpage">

<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img src="<?=base_url();?>assets/images/logo.png" alt="" /></div>
        <?=form_open($action, array('id'=> 'login'));?>
            <div class="inputwrapper login-alert">
                <div class="alert alert-error">Invalid username or password</div>
            </div>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="username" id="username" placeholder="Username" />
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" id="password" placeholder="Password" />
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit">Sign In</button>
            </div>            
        </form>
    </div>
</div>
<div class="loginfooter">
    <p>&copy; <?=date('Y');?> UNIKU. By Adi Muhammad Muhsidi</p>
</div>
</body>
</html>
