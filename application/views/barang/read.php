<script type="text/javascript">
function confirmation(id) {
   var answer = confirm("Apakah anda yakin data barang dengan kode = "+id+" akan dihapus ?")
   if (answer)
   {
      window.location = 'http://localhost/toko/barang/delete/'+id;
   }
   else
   {
      window.location = 'barang';
   }
}
</script>
<div class="rightpanel">
    <div class="maincontent">
        <?=form_open($action);?>
        <div class="maincontentinner">
            <?=$alert;?>
            <div class="btn-group">
                <?=anchor('barang/create', '<i class="icon-plus icon-white"></i> TAMBAH', array('class'=>'btn btn-success'));?>
                <button type="submit" class="btn btn-danger"><i class="icon-trash icon-white"></i> HAPUS</button>
                <?=anchor('barang/laporan/cetak', '<i class="icon-download-alt icon-white"></i> SAVE AS EXCEL', array('class'=>'btn btn-success'));?>
                <?=anchor('barang/cetak_pdf', '<i class="icon-download-alt icon-white"></i> SAVE AS PDF', array('class'=>'btn btn-success'));?>
            </div>
            <h4 class="widgettitle"><?=$title;?></h4>
            <table id="dyntable" class="table table-bordered table-condensed">
                <colgroup>
                    <col class="con0" style="align: center; width: 4%" />
                    <col class="con1" />
                    <col class="con0" />
                    <col class="con1" />
                    <col class="con0" />
                    <col class="con1" />
                </colgroup>
                <thead>
                    <tr>
                      	<th class="nosort"><input type="checkbox" class="checkall" /></th>
                        <th>NO</th>
                        <th>KODE</th>
                        <th>NAMA BARANG</th>
                        <th>HARGA BELI</th>
                        <th>HARGA JUAL</th>
                        <th>DISKON</th>
                        <th>SATUAN</th>
                        <th>STOK</th>
                        <th>STOK MIN</th>
                        <th style="width:25px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($query->result() as $row) { ?>
                    <tr class="gradeX">
                        <td class="aligncenter"><span class="center"><input type="checkbox" name="kd_barang[]" value="<?=$row->kd_barang;?>"/></span></td>
                        <td><?=$no;?></td>
                        <td><?=$row->kd_barang;?></td>
                        <td><?=$row->nama_barang;?></td>
                        <td><?=$row->harga_beli;?></td>
                        <td><?=$row->harga_jual;?></td>
                        <td><?=$row->diskon;?></td>
                        <td><?=$row->satuan;?></td>
                        <td><?=$row->jumlah_stok;?></td>
                        <td><?=$row->stok_min;?></td>
                        <td>
                            <div class="btn-group">
                                <?=anchor('barang/update/'.$row->kd_barang, '<i class="icon-edit icon-white"></i>', array('class'=>'btn btn-primary'));?>
                                <a class="btn btn-danger" href="javascript:confirmation('<?=$row->kd_barang;?>')"><i class="icon-trash icon-white"></i></a>
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