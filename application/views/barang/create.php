<div class="rightpanel">
    <div class="maincontent">
        <div class="maincontentinner">
            <?=$alert;?>
            <div class="widget">
                <h4 class="widgettitle"><?=$title;?></h4>
                <div class="widgetcontent">
                <form id="form1" class="stdform" method="post" action="<?=$action;?>">
                    <p>
                        <label>Kode Barang</label>
                        <span class="field">
                            <input type="text" name="kd_barang" value="<?=(set_value('kd_barang')) ? set_value('kd_barang') : $query['kd_barang']?>" class="input-medium" required="true">
                        </span>
                    </p>
                    <p>
                        <label>Nama Barang</label>
                        <span class="field">
                            <input type="text" name="nama_barang" class="input-block-level" required="true" value="<?=(set_value('nama_barang')) ? set_value('nama_barang') : $query['nama_barang']?>">
                        </span>
                    </p>
                    <p>
                        <label>Harga Beli</label>
                        <span class="field">
                            <input type="text" name="harga_beli" class="input-medium" required="true"value="<?=(set_value('harga_beli')) ? set_value('harga_beli') : $query['harga_beli']?>">
                        </span>
                    </p>             
                    <p>
                        <label>Harga Jual</label>
                        <span class="field">
                            <input type="text" name="harga_jual" class="input-medium" required="true"value="<?=(set_value('harga_jual')) ? set_value('harga_jual') : $query['harga_jual']?>">
                        </span>
                    </p>
                    <p>
                        <label>Diskon</label>
                        <span class="field">
                            <input type="text" name="diskon" class="input-medium"value="<?=(set_value('diskon')) ? set_value('diskon') : $query['diskon']?>">
                        </span>
                    </p>
                    <p>
                        <label>Satuan</label>
                        <span class="field">
                            <input type="text" name="satuan" class="input-xlarge" required="true"value="<?=(set_value('satuan')) ? set_value('satuan') : $query['satuan']?>">
                        </span>
                    </p>
                    <p>
                        <label>Jumlah Stok</label>
                        <span class="field">
                            <input type="text" name="jumlah_stok" class="input-medium" required="true"value="<?=(set_value('jumlah_stok')) ? set_value('jumlah_stok') : $query['jumlah_stok']?>">
                        </span>
                    </p>
                    <p>
                        <label>Stok Minimum</label>
                        <span class="field">
                            <input type="text" name="stok_min" class="input-medium" required="true"value="<?=(set_value('stok_min')) ? set_value('stok_min') : $query['stok_min']?>">
                        </span>
                    </p>
                    <p class="stdformbutton">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        <?=anchor('barang', 'KEMBALI', array('class' => 'btn'));?>
                    </p>
                </form>
                </div>
            </div>
            <?php $this->load->view('layout/copyright');?>
        </div>
    </div>
</div>

