<script type="text/javascript">
function confirmation(id) {
   var answer = confirm("Apakah anda yakin data pegawai dengan NIK = "+id+" akan dihapus ?")
   if (answer)
   {
      window.location = 'http://localhost/toko/pegawai/delete/'+id;
   }
   else
   {
      window.location = 'pegawai';
   }
}
</script>
<div class="rightpanel">
    <div class="maincontent">
        <?=form_open($action);?>
        <div class="maincontentinner">
            <?=$alert;?>
            <div class="btn-group">
                <?=anchor('pegawai/create', '<i class="icon-plus icon-white"></i> TAMBAH', array('class'=>'btn btn-success'));?>
                <button type="submit" class="btn btn-danger"><i class="icon-trash icon-white"></i> HAPUS</button>
                <?=anchor('pegawai/laporan/cetak', '<i class="icon-download-alt icon-white"></i> SAVE AS EXCEL', array('class'=>'btn btn-success'));?>
                <?=anchor('pegawai/cetak_pdf', '<i class="icon-download-alt icon-white"></i> SAVE AS PDF', array('class'=>'btn btn-success'));?>
            </div>
            <h4 class="widgettitle"><?=$title;?></h4>
            <table id="dyntable" class="table table-bordered table-condensed">
                <colgroup>
                    <col class="con0" style="align: center; width: 4%" />
                </colgroup>
                <thead>
                    <tr>
                      	<th class="nosort"><input type="checkbox" class="checkall" /></th>
                        <th>NO</th>
                        <th style="width:100px;">PHOTO</th>
                        <th>PEGAWAI</th>
                        <th style="width:25px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($query->result() as $row) { ?>
                    <tr class="gradeX">
                        <td class="aligncenter"><span class="center"><input type="checkbox" name="nik[]" value="<?=$row->nik;?>"/></span></td>
                        <td style="width:25px;"><?=$no;?></td>
                        <td>
                          <?php if ($row->photo != '') { ?>
                          <img src="<?=base_url();?>assets/photo/pegawai/<?=$row->photo;?>" alt="" class="pull-left">
                          <?php } ?>
                        </td>
                        <td>
                            <ul class="list-unordered">
                              <li>NIK : <?=$row->nik;?></li>
                              <li>Nama : <?=$row->nama;?></li>
                              <li>Username : <?=$row->username;?></li>
                              <li>Jenis Kelamin : <?=$row->jenis_kelamin;?></li>
                              <li>Tempat Lahir : <?=$row->tempat_lahir;?></li>
                              <li>Tanggal Lahir : <?=$row->tgl_lahir;?></li>
                              <li>Alamat : <?=$row->alamat;?></li>
                              <li>Telp : <?=$row->no_telp;?></li>
                              <li>Pendidikan : <?=$row->pendidikan;?></li>
                              <li>Tgl. Masuk Kerja : <?=$row->tgl_masuk_kerja;?></li>
                              <li>Gaji : <?=$row->gaji;?></li>
                              <li>Jabatan : <?=$row->jabatan;?></li>
                            </ul>
                        </td>
                        <td>
                            <div class="btn-group">
                              <?=anchor('pegawai/update/'.$row->nik, '<i class="icon-edit icon-white"></i>', array('class'=>'btn btn-primary'));?>
                              <a class="btn btn-danger" href="javascript:confirmation('<?=$row->nik;?>')"><i class="icon-trash icon-white"></i></a>
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