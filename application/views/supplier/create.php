<div class="rightpanel">
    <div class="maincontent">
        <div class="maincontentinner">
            <?=$alert;?>
            <div class="widget">
                <h4 class="widgettitle"><?=$title;?></h4>
                <div class="widgetcontent">
                <form id="form1" class="stdform" method="post" action="<?=$action;?>">
                    <p>
                        <label>Nama</label>
                        <span class="field">
                            <input type="text" name="nama" value="<?=(set_value('nama')) ? set_value('nama') : $query['nama']?>" class="input-xlarge" required="true">
                        </span>
                    </p>
                    <p>
                        <label>Alamat</label>
                        <span class="field">
                            <input type="text" name="alamat" class="input-block-level" required="true" value="<?=(set_value('alamat')) ? set_value('alamat') : $query['alamat']?>">
                        </span>
                    </p>
                    <p>
                        <label>No. Telp</label>
                        <span class="field">
                            <input type="text" name="no_telp" class="input-medium" required="true"value="<?=(set_value('no_telp')) ? set_value('no_telp') : $query['no_telp']?>">
                        </span>
                    </p>             
                    <p>
                        <label>Email</label>
                        <span class="field">
                            <input type="email" name="email" class="input-medium" required="true"value="<?=(set_value('email')) ? set_value('email') : $query['email']?>">
                        </span>
                    </p>
                    <p>
                        <label>Jumlah Utang</label>
                        <span class="field">
                            <input type="text" name="jml_utang" class="input-medium" value="<?=(set_value('jml_utang')) ? set_value('jml_utang') : $query['jml_utang']?>">
                        </span>
                    </p>
                    <p class="stdformbutton">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        <?=anchor('supplier', 'KEMBALI', array('class' => 'btn'));?>
                    </p>
                </form>
                </div>
            </div>
            <?php $this->load->view('layout/copyright');?>
        </div>
    </div>
</div>

