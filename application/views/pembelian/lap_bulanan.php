<div class="rightpanel">
    <div class="maincontent">
        <div class="maincontentinner">
            <?=$alert;?>
            <div class="widget">
                <h4 class="widgettitle"><?=$title;?></h4>
                <div class="widgetcontent">
                <form id="form1" class="stdform" method="post" action="<?=$action;?>">
                    <p>
                        <label>Bulan</label>
                        <span class="field">
                            <?=form_dropdown('bulan', bulan(), '', 'class="input-block-level"');?>
                        </span>
                    </p>                    
                    <p>
                        <label>Tahun</label>
                        <span class="field">
                            <input type="text" maxlength="4" name="tahun" class="input-medium">
                        </span>
                    </p>
                    <p class="stdformbutton">
                        <button type="submit" name="excel" class="btn btn-primary">SAVE AS EXCEL</button>
                        <button type="submit" name="pdf" class="btn btn-primary">SAVE AS PDF</button>
                    </p>
                </form>
                </div>
            </div>
            <?php $this->load->view('layout/copyright');?>
        </div>
    </div>
</div>

