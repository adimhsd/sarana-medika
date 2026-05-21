<div class="rightpanel">
    <div class="maincontent">
        <div class="maincontentinner">
            <?=$alert;?>
            <div class="widget">
                <h4 class="widgettitle"><?=$title;?></h4>
                <div class="widgetcontent">
                <form id="form1" class="stdform" method="post" action="<?=$action;?>">
                    <p>
                        <label>No. Faktur</label>
                        <span class="field">
                            <input type="text" readonly name="no_faktur" value="<?=isset($no_faktur) ? $no_faktur : $query['no_faktur']?>" class="input-medium" required="true">
                        </span>
                    </p>
                    <p>
                        <label>Tanggal</label>
                        <span class="field">
                            <input type="date" name="tgl_faktur" class="input-medium" placeholder="mm/dd/yyyy" value="<?=(set_value('tgl_faktur')) ? set_value('tgl_faktur') : $query['tgl_faktur']?>">
                        </span>
                    </p>
                    <p>
                        <label>Customer</label>
                        <span class="field">
                            <?=form_dropdown('kd_customer', $q_customer, $query['kd_customer'], 'class="input-block-level"');?>
                        </span>
                    </p>                    
                    <p>
                        <label>Jatuh Tempo</label>
                        <span class="field">
                            <input type="date" name="tgl_jatuh_tempo" class="input-medium" placeholder="mm/dd/yyyy" value="<?=(set_value('tgl_jatuh_tempo')) ? set_value('tgl_jatuh_tempo') : $query['tgl_jatuh_tempo']?>">
                        </span>
                    </p>
                    <p>
                        <label>Kurir</label>
                        <span class="field">
                            <?=form_dropdown('nik_kurir', $q_kurir, $query['nik_kurir'], 'class="input-block-level"');?>
                        </span>
                    </p>  
                    <p class="stdformbutton">
                        <button type="submit" class="btn btn-primary">TRANSAKSI PENJUALAN</button>
                        <?=anchor('penjualan', 'KEMBALI', array('class' => 'btn'));?>
                    </p>
                </form>
                </div>
            </div>
            <?php $this->load->view('layout/copyright');?>
        </div>
    </div>
</div>

