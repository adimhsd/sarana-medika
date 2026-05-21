<script type="text/javascript">
function confirmation(id) {
   var answer = confirm("Apakah anda yakin data penjualan dengan kode = "+id+" akan dihapus ?")
   if (answer)
   {
      window.location = 'http://localhost/toko/penjualan/delete/'+id;
   }
   else
   {
      window.location = 'penjualan';
   }
}
</script>
<div class="rightpanel">
    <div class="maincontent">
        <?=form_open($action);?>
        <div class="maincontentinner">
            <?=$alert;?>
            <div class="btn-group">
                <?=anchor('penjualan/create', '<i class="icon-plus icon-white"></i> TAMBAH', array('class'=>'btn btn-success'));?>
                <button type="submit" class="btn btn-danger"><i class="icon-trash icon-white"></i> HAPUS</button>
            </div>
            <h4 class="widgettitle"><?=$title;?></h4>
            <table id="dyntable" class="table table-bordered table-condensed">
                <thead>
                    <tr>
                      	<th class="nosort"><input type="checkbox" class="checkall" /></th>
                        <th>NO</th>
                        <th>NO. FAKTUR</th>
                        <th>CUSTOMER</th>
                        <th>TANGGAL FAKTUR</th>
                        <th>TANGGAL JATUH TEMPO</th>
                        <th>TOTAL PENJUALAN</th>
                        <th>STATUS</th>
                        <th style="width:25px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($query->result() as $row) { ?>
                    <tr class="gradeX">
                        <td class="aligncenter"><span class="center"><input type="checkbox" name="no_faktur[]" value="<?=$row->no_faktur;?>"/></span></td>
                        <td><?=$no;?></td>
                        <td><?=$row->no_faktur;?></td>
                        <td><?=$row->nama;?></td>
                        <td><?=indo_date($row->tgl_faktur);?></td>
                        <td><?=indo_date($row->tgl_jatuh_tempo);?></td>
                        <td>Rp. <?=rupiah($row->total_harga);?></td>
                        <td><?php echo $row->status == 'n' ? '<span class="label label-warning">Belum Lunas</span>' : '<span class="label label-success">Lunas</span>';?></td>
                        <td>
                            <div class="btn-group">
                                <!--<?=anchor('penjualan/create_list/'.$row->no_faktur, '<i class="icon-edit icon-white"></i>', array('class'=>'btn btn-primary'));?>-->
                                
                                <?php
                                if ($row->status == 'n')
                                {
                                    echo anchor('penjualan/lunas/'.$row->no_faktur, '<i class="icon-retweet icon-white"></i>', array('class'=>'btn btn-primary'));
                                } 
                                ?>

                                <?=anchor('penjualan/print_faktur/'.$row->no_faktur, '<i class="icon-print icon-white"></i>', array('class'=>'btn btn-success'));?>
                                <a class="btn btn-danger" href="javascript:confirmation('<?=$row->no_faktur;?>')"><i class="icon-trash icon-white"></i></a>
                                <!--<?=anchor('penjualan/delete/'.$row->no_faktur, '<i class="icon-trash icon-white"></i>', array('class'=>'btn btn-danger'));?>-->
                            </div>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>                
            <?php $this->load->view('layout/copyright');?>
        </div>
        </form>
    </div>        
</div>