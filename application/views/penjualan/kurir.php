<div class="rightpanel">
    <div class="maincontent">
        <div class="maincontentinner">
            <h4 class="widgettitle"><?=$title;?></h4>
            <table id="dyntable" class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NO. FAKTUR</th>
                        <th>SUPPLIER</th>
                        <th>TANGGAL FAKTUR</th>
                        <th>TANGGAL JATUH TEMPO</th>
                        <th>TOTAL PENJUALAN</th>
                        <th style="width:25px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($query->result() as $row) { ?>
                    <tr class="gradeX">
                        <td><?=$no;?></td>
                        <td><?=$row->no_faktur;?></td>
                        <td><?=$row->nama;?></td>
                        <td><?=indo_date($row->tgl_faktur);?></td>
                        <td><?=indo_date($row->tgl_jatuh_tempo);?></td>
                        <td>Rp. <?=rupiah($row->total_harga);?></td>
                        <td>
                            <div class="btn-group">
                                <?=anchor('penjualan/cetak_faktur/'.$row->no_faktur, '<i class="icon-print icon-white"></i>', array('class'=>'btn btn-success'));?>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>                
            <?php $this->load->view('layout/copyright');?>
        </div>
    </div>        
</div>