<div class="rightpanel">
    <div class="maincontent">
        <div class="maincontentinner">
            <?=$alert;?>
            <div class="widget">
                <h4 class="widgettitle"><?=$title;?></h4>
                <div class="widgetcontent">
                <?=form_open($action, array('class'=>'stdform'));?>
                    <p>
                        <label>Password</label>
                        <span class="field">
                            <input type="password" name="password" class="input-xlarge">
                        </span>
                    </p>
                    <p>
                        <label>Confirm Password</label>
                        <span class="field">
                            <input type="password" name="c_password" class="input-xlarge">
                        </span>
                    </p>                    
                    <p class="stdformbutton">
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </p>
                </form>
                </div>
            </div>
            <?php $this->load->view('layout/copyright');?>
        </div>
    </div>
</div>

