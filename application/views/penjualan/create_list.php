<div class="rightpanel">
    <div class="maincontent">
        <div class="maincontentinner">
            <h4 class="widgettitle"><?=$title;?></h4>
            <div class="widgetcontent">
            <form id="form1" class="stdform" method="post" action="<?=$action;?>">
                <p>
                    <label>Nama Barang</label>
                    <span class="field">
                        <?=form_dropdown('kd_barang', $q_barang, $query['kd_barang'], 'class="input-block-level"');?>
                    </span>
                </p>
                <p>
                    <label>Jumlah</label>
                    <span class="field">
                        <input type="text" name="jml_barang" class="input-small" required="true">
                    </span>
                </p>
                <p class="stdformbutton">
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                </p>
            </form>
            </div>
        </div>
        <div class="maincontentinner">
            <?=$alert;?>
            <h4 class="widgettitle"><?=$title;?></h4>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="width:10px;">NO</th>
                        <th>KODE BARANG</th>
                        <th>NAMA BARANG</th>
                        <th>HARGA SATUAN</th>
                        <th>JUMLAH BELI</th>
                        <th>DISKON</th>
                        <th>SUB TOTAL</th>
                        <th style="width:10px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; $total = 0; foreach($detail_penjualan->result() as $dt) { ?>
                    <tr>
                        <td><?=$no;?></td>
                        <td><?=$dt->kd_barang;?></td>
                        <td><?=$dt->nama_barang;?></td>
                        <td>Rp. <?=rupiah($dt->harga_jual);?> / <?=$dt->satuan;?></td>
                        <td><?=$dt->jml_barang;?></td>
                        <td><?=$dt->diskon;?> %</td>
                        <td>Rp. <?=rupiah($dt->subtotal_harga);?></td>
                        <td>
                            <div class="btn-group">
                                <?=anchor('penjualan/delete_detail/'.$this->uri->segment(3).'/'.$dt->kd_barang, '<i class="icon-trash icon-white"></i>', array('class'=>'btn btn-danger'));?>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; $total += $dt->subtotal_harga; } ?>
                    <tr>
                        <td colspan="6" style="text-align:right;font-weight:bold;">TOTAL PENJUALAN</td>
                        <td style="font-weight:bold;">Rp. <?=rupiah($total);?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>          
            <?php 
            $query = $this->db->where('no_faktur', $this->uri->segment(3))->get('penjualan')->row_array();
            $is_update = $query['is_update'];
            if ($is_update == 'n' && $detail_penjualan->num_rows() > 0)
            {
                echo anchor('penjualan/cetak_faktur/'.$this->uri->segment(3), 'CETAK FAKTUR PENJUALAN', array('class'=>'btn btn-success'));
            }
            ?>      
            <?php $this->load->view('layout/copyright');?>
        </div>
    </div>        
</div>