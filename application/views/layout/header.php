<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>ADI MUHAMMAD MUHSIDI</title>
<link rel="stylesheet" href="<?=base_url();?>assets/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-fileupload.min.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-timepicker.min.css" type="text/css" />
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/modernizr.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/responsive-tables.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/custom.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/check.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap-fileupload.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<div class="mainwrapper">
    <div class="header">
        <div class="logo">
            <a href="#"><img src="<?=base_url();?>assets/images/logo.png" alt="" /></a>
        </div>
        <div class="headerinner">
            <ul class="headmenu">
                <li class="right">
                    <div class="userloggedinfo">
                        <?php
                        $nik = $this->session->userdata('nik');
                        $photo = $this->db->query("SELECT photo FROM pegawai WHERE nik = '$nik'")->row_array();
                        if ($photo['photo'] != '' || $photo['photo'] != null)
                        {
                            echo '<img src="'.base_url().'assets/photo/pegawai/'.$photo['photo'].'" alt="">';
                        }
                        else
                        {
                            echo '<img src="'.base_url().'assets/photo/pegawai/thumb.png" alt="">';   
                        }
                        ?>
                        
                        <div class="userinfo">
                            <h5><?=$this->session->userdata('nama');?></h5>
                            <h5><?=$this->session->userdata('jabatan');?></h5>
                            <ul>
                                <li><?=anchor('pegawai/change_password', 'Change Password');?></li>
                                <li><?=anchor('login/logout', 'Log Out');?></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>