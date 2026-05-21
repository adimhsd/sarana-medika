<script type="text/javascript">
function confirmation(id) {
   var answer = confirm("Apakah anda yakin data customer dengan Kode customer = "+id+" akan dihapus ?")
   if (answer)
   {
      window.location = 'http://localhost/toko/customer/delete/'+id;
   }
   else
   {
      window.location = 'customer';
   }
}
</script>
<div class="rightpanel">
    <div class="maincontent">
        <?=form_open($action);?>
        <div class="maincontentinner">
            <?=$alert;?>
            <div class="btn-group">
                <?=anchor('customer/create', '<i class="icon-plus icon-white"></i> TAMBAH', array('class'=>'btn btn-success'));?>
                <button type="submit" class="btn btn-danger"><i class="icon-trash icon-white"></i> HAPUS</button>
                <?=anchor('customer/laporan/cetak', '<i class="icon-download-alt icon-white"></i> SAVE AS EXCEL', array('class'=>'btn btn-success'));?>
                <?=anchor('customer/cetak_pdf', '<i class="icon-download-alt icon-white"></i> SAVE AS PDF', array('class'=>'btn btn-success'));?>
            </div>
            <h4 class="widgettitle"><?=$title;?></h4>
            <table id="dyntable" class="table table-bordered table-condensed">
                <thead>
                    <tr>
                      	<th class="nosort"><input type="checkbox" class="checkall" /></th>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>ALAMAT</th>
                        <th>TELP</th>
                        <th>EMAIL</th>
                        <th>JML. PIUTANG</th>
                        <th style="width:25px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($query->result() as $row) { ?>
                    <tr class="gradeX">
                        <td class="aligncenter"><span class="center"><input type="checkbox" name="kd_customer[]" value="<?=$row->kd_customer;?>"/></span></td>
                        <td><?=$no;?></td>
                        <td><?=$row->nama;?></td>
                        <td><?=$row->alamat;?></td>
                        <td><?=$row->no_telp;?></td>
                        <td><?=$row->email;?></td>
                        <td>Rp. <?=rupiah($row->jml_piutang);?></td>
                        <td>
                            <div class="btn-group">
                                <?=anchor('customer/update/'.$row->kd_customer, '<i class="icon-edit icon-white"></i>', array('class'=>'btn btn-primary'));?>
                                <a class="btn btn-danger" href="javascript:confirmation('<?=$row->kd_customer;?>')"><i class="icon-trash icon-white"></i></a>
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