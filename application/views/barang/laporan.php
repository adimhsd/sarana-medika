<div class="rightpanel">
    <div class="maincontent">
        <div class="maincontentinner">
            <div class="btn-group">
                <?=anchor('barang/laporan/cetak', '<i class="icon-download-alt icon-white"></i> SAVE AS EXCEL', array('class'=>'btn btn-success'));?>
                <?=anchor('barang/cetak_pdf', '<i class="icon-download-alt icon-white"></i> SAVE AS PDF', array('class'=>'btn btn-success'));?>
            </div>
            <h4 class="widgettitle"><?=$title;?></h4>
            <table id="dyntable" class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>KODE</th>
                        <th>NAMA BARANG</th>
                        <th>HARGA BELI</th>
                        <th>HARGA JUAL</th>
                        <th>DISKON</th>
                        <th>SATUAN</th>
                        <th>STOK</th>
                        <th>STOK MIN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($query->result() as $row) { ?>
                    <tr class="gradeX">
                        <td><?=$no;?></td>
                        <td><?=$row->kd_barang;?></td>
                        <td><?=$row->nama_barang;?></td>
                        <td><?=$row->harga_beli;?></td>
                        <td><?=$row->harga_jual;?></td>
                        <td><?=$row->diskon;?></td>
                        <td><?=$row->satuan;?></td>
                        <td><?=$row->jumlah_stok;?></td>
                        <td><?=$row->stok_min;?></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>                
            <?php $this->load->view('layout/copyright');?>
        </div>
    </div>        
</div>