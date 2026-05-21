<div class="rightpanel">
    <div class="maincontent">
        <div class="maincontentinner">
            <?=$alert;?>
            <div class="widget">
                <h4 class="widgettitle"><?=$title;?></h4>
                <div class="widgetcontent">
                <?=form_open_multipart($action, array('class'=>'stdform'));?>
                    <p>
                        <label>Nama</label>
                        <span class="field">
                            <input type="text" name="nama" value="<?=(set_value('nama')) ? set_value('nama') : $query['nama']?>" class="input-xlarge" required="true">
                        </span>
                    </p>
                    <p>
                        <label>Name</label>
                        <span class="field">
                            <input type="text" name="username" value="<?=(set_value('username')) ? set_value('username') : $query['username']?>" class="input-xlarge" required="true">
                        </span>
                    </p>
                    <p>
                        <label>Password</label>
                        <span class="field">
                            <input type="password" name="password" class="input-xlarge">
                        </span>
                    </p>
                    <p>
                        <label>Jenis Kelamin</label>
                        <span class="field">
                        <select name="jenis_kelamin" class="uniformselect">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        </span>
                    </p>
                    <p>
                        <label>Tempat Lahir</label>
                        <span class="field">
                            <input type="text" name="tempat_lahir" value="<?=(set_value('tempat_lahir')) ? set_value('tempat_lahir') : $query['tempat_lahir']?>" class="input-xlarge" >
                        </span>
                    </p>
                    <p>
                        <label>Tanggal Lahir</label>
                        <span class="field">
                            <input type="date" name="tgl_lahir" class="input-medium" placeholder="mm/dd/yyyy" value="<?=(set_value('tgl_lahir')) ? set_value('tgl_lahir') : $query['tgl_lahir']?>">
                        </span>
                    </p>
                    <p>
                        <label>Alamat</label>
                        <span class="field">
                            <input type="text" name="alamat" class="input-block-level"  value="<?=(set_value('alamat')) ? set_value('alamat') : $query['alamat']?>">
                        </span>
                    </p>
                    <p>
                        <label>No. Telp</label>
                        <span class="field">
                            <input type="text" name="no_telp" class="input-medium" value="<?=(set_value('no_telp')) ? set_value('no_telp') : $query['no_telp']?>">
                        </span>
                    </p>
                    <p>
                        <label>Pendidikan</label>
                        <span class="field">
                            <?php
                            $pend = array(
                                    'SMP' => 'SMP',
                                    'SMA' => 'SMA',
                                    'D3' => 'D3',
                                    'S1' => 'S1',
                                    'S2' => 'S2'
                                    ); 
                            echo form_dropdown('pendidikan', $pend, $query['pendidikan'], "class='uniformselect'");?>
                        </span>
                    </p>
                     <p>
                        <label>Tanggal Masuk Kerja</label>
                        <span class="field">
                            <input type="date" name="tgl_masuk_kerja" class="input-medium" placeholder="mm/dd/yyyy" value="<?=(set_value('tgl_masuk_kerja')) ? set_value('tgl_masuk_kerja') : $query['tgl_masuk_kerja']?>">
                        </span>
                    </p>           
                    <p>
                        <label>Gaji</label>
                        <span class="field">
                            <input type="text" name="gaji" class="input-medium" value="<?=(set_value('gaji')) ? set_value('gaji') : $query['gaji']?>">
                        </span>
                    </p>
                    <div class="par">
                        <label>Photo</label>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="input-append">
                        <div class="uneditable-input span3">
                            <i class="iconfa-file fileupload-exists"></i>
                            <span class="fileupload-preview"></span>
                        </div>
                        <span class="btn btn-file"><span class="fileupload-new">Select file</span>
                        <span class="fileupload-exists">Change</span>
                        <input type="file" name="photo" /></span>
                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                        </div>
                    </div>
                    <p>
                        <label>Jabatan</label>
                        <span class="field">
                            <?php
                            $level = array(
                                    'gudang' => 'Gudang',
                                    'owner' => 'Owner',
                                    'kurir' => 'Kurir',
                                    'marketing' => 'Marketing'
                                    ); 
                            echo form_dropdown('jabatan', $level, $query['jabatan'], "class='uniformselect'");?>
                        </span>
                    </p>
                    <p class="stdformbutton">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        <?=anchor('customer', 'KEMBALI', array('class' => 'btn'));?>
                    </p>
                </form>
                </div>
            </div>
            <?php $this->load->view('layout/copyright');?>
        </div>
    </div>
</div>

