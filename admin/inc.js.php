<script>
var resizefunc = [];
</script>
<script src="<?php echo LIVE_URL; ?>assets/js/jquery.min.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/js/detect.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/js/fastclick.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/js/waves.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/js/wow.min.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/peity/jquery.peity.min.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/counterup/jquery.counterup.min.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/morris/morris.min.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/raphael/raphael-min.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/jquery-knob/jquery.knob.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/pages/jquery.dashboard.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/js/jquery.core.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/js/jquery.app.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo LIVE_URL; ?>assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo LIVE_URL; ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="<?php echo LIVE_URL; ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function() {
                $('#datatable').dataTable();
} );
</script>
<script type="text/javascript">
		jQuery(document).ready(function($) {
		$('.counter').counterUp({
			delay: 100,
			time: 1200
		});
			$(".knob").knob();
		});
</script>
<script>
			jQuery(document).ready(function() {
				jQuery('#timepicker').timepicker({
					defaultTIme : false
				});
				jQuery('#timepicker2').timepicker({
					showMeridian : false
				});
				jQuery('#timepicker3').timepicker({
					minuteStep : 15
				});
                jQuery('.datepicker').datepicker();
                jQuery('#datepicker-autoclose').datepicker({
                	autoclose: true,
                	todayHighlight: true
                });
				jQuery('#datepicker-autoclose1').datepicker({
                	autoclose: true,
                	todayHighlight: true
                });


				


                jQuery('#datepicker-inline').datepicker();


                jQuery('#datepicker-multiple-date').datepicker({


                    format: "yyyy-mm-dd",


					clearBtn: true,


					multidate: true,


					multidateSeparator: ","


                });


                jQuery('.date-range').datepicker({


                    toggleActive: true


                });


                


           


				$('#check-minutes').click(function(e){

 


				    e.stopPropagation();


				    $("#single-input").clockpicker('show')


				            .clockpicker('toggleView', 'minutes');


				});


				


				


 			});


		</script>
<script>


            jQuery(document).ready(function() {


                 $('#my_multi_select3').multiSelect({


                    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",


                    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",


                    afterInit: function (ms) {


                        var that = this,


                            $selectableSearch = that.$selectableUl.prev(),


                            $selectionSearch = that.$selectionUl.prev(),


                            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',


                            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';





                        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)


                            .on('keydown', function (e) {


                                if (e.which === 40) {


                                    that.$selectableUl.focus();


                                    return false;


                                }


                            });





                        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)


                            .on('keydown', function (e) {


                                if (e.which == 40) {


                                    that.$selectionUl.focus();


                                    return false;


                                }


                            });


                    },


                    afterSelect: function () {


                        this.qs1.cache();


                        this.qs2.cache();


                    },


                    afterDeselect: function () {


                        this.qs1.cache();


                        this.qs2.cache();


                    }


                });







                $(".select2").select2();


                


                $(".select2-limiting").select2({


				  maximumSelectionLength: 2
				});
	            });
        </script>