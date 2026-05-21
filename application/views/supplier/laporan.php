<div class="rightpanel">
    <div class="maincontent">
        <div class="maincontentinner">
            <div class="btn-group">
                <?=anchor('supplier/laporan/cetak', '<i class="icon-download-alt icon-white"></i> SAVE AS EXCEL', array('class'=>'btn btn-success'));?>
                <?=anchor('supplier/cetak_pdf', '<i class="icon-download-alt icon-white"></i> SAVE AS PDF', array('class'=>'btn btn-success'));?>
            </div>
            <h4 class="widgettitle"><?=$title;?></h4>
            <table id="dyntable" class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>ALAMAT</th>
                        <th>TELP</th>
                        <th>EMAIL</th>
                        <th>JUMLAH UTANG</th>
                        <th>TGL DAFTAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($query->result() as $row) { ?>
                    <tr class="gradeX">
                        <td><?=$no;?></td>
                        <td><?=$row->nama;?></td>
                        <td><?=$row->alamat;?></td>
                        <td><?=$row->no_telp;?></td>
                        <td><?=$row->email;?></td>
                        <td>Rp. <?=rupiah($row->jml_utang);?></td>
                        <td><?=indo_date($row->tgl_daftar);?></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>                
            <?php $this->load->view('layout/copyright');?>
        </div>
    </div>        
</div>