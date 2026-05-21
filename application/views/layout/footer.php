<script type="text/javascript">
    jQuery(document).ready(function(){
        // dynamic table
        jQuery('#dyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
            "fnDrawCallback": function(oSettings) {
                jQuery.uniform.update();
            }
        });
		    // check all checkboxes in table
        jQuery('.checkall').click(function(){
        var parentTable = jQuery(this).parents('table');	
        var ch = parentTable.find('tbody input[type=checkbox]');
        if(jQuery(this).is(':checked')) {	
        //check all rows in table
        ch.each(function(){
        jQuery(this).attr('checked',true);
        jQuery(this).parent().addClass('checked');	//used for the custom checkbox style
        jQuery(this).parents('tr').addClass('selected'); // to highlight row as selected
        });	
        } else {	
        //uncheck all rows in table
        ch.each(function(){
        jQuery(this).attr('checked',false);
        jQuery(this).parent().removeClass('checked');	//used for the custom checkbox style
        jQuery(this).parents('tr').removeClass('selected');
        });	
        }
        });
    });
</script>
</div><!--mainwrapper-->
</body>
</html>