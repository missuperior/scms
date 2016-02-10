<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="#">Home</a>

                <span class="divider">
                    <i class="icon-angle-right arrow-icon"></i>
                </span>
            </li>
            <li class="active">Admission Dashboard</li>
        </ul><!--.breadcrumb-->

        <div class="nav-search" id="nav-search">
            <form class="form-search" />
            <span class="input-icon">
                <input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                <i class="icon-search nav-search-icon"></i>
            </span>
            </form>
        </div><!--#nav-search-->
    </div>

    <div class="page-content">
        <div class="page-header position-relative">
            <h1>
                Admission Dashboard
                <small>
                    <i class="icon-double-angle-right"></i>
                    overview &amp; stats
                </small>
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <div class="alert alert-block alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="icon-remove"></i>
                    </button>
                    <?php if($this->session->userdata('error')){ ?>
                    
                    <h4 style="color:red"><?php echo $this->session->userdata('error'); $this->session->unset_userdata('error');?></h4>
                    
                    <?php }else{ ?>
                    <i class="icon-ok green"></i>

                    Welcome to
                    <strong class="green">
                        SCMS
                        <small>(Superior Content Managment System)</small>
                    </strong>
                    ,
                    Powered By Superior Solutionz.
                    
                    <?php } 
                    
                    $inquiry_without_pros       = $inquiries - $inquiry_without_pros;
                    $pros_without_initial       = $prospectus - $pros_without_initial;
                    $initial_without_detail     = $initial - $initial_without_detail;
                    $forms_without_student      = $detailed - $forms_without_student;
                    
                    ?>
                    
                </div>

                <div class="space-6"></div>

                <div class="row-fluid">
                    <div class="span7 infobox-container">
                        <div class="infobox infobox-green  ">
                            <div class="infobox-icon">
                                <i class="icon-comments"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $inquiries; ?></span>
                                <div class="infobox-content">Inquiries</div>
                            </div>
                            
                        </div>

                        <div class="infobox infobox-blue  ">
                            <div class="infobox-icon">
                                <i class="icon-twitter"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $prospectus; ?></span>
                                <div class="infobox-content">Prospectus Sale</div>
                            </div>

                        </div>

                        <div class="infobox infobox-pink  ">
                            <div class="infobox-icon">
                                <i class="icon-shopping-cart"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $initial; ?></span>
                                <div class="infobox-content">Initial Forms</div>
                            </div>
                            
                        </div>

                        <div class="infobox infobox-red  ">
                            <div class="infobox-icon">
                                <i class="icon-beaker"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $detailed; ?></span>
                                <div class="infobox-content">Forms</div>
                            </div>
                        </div>

                        <div class="infobox infobox-orange2  ">
                            <div class="infobox-chart">
                                <span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $forms_without_student; ?></span>
                                <div class="infobox-content">Students</div>
                            </div>

                        </div>

                        <div class="infobox infobox-blue2  ">
                            <div class="infobox-progress">
                                <div class="easy-pie-chart percentage" data-percent="42" data-size="46">
                                    <span class="percent">42</span>
                                    %
                                </div>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-text">Progress</span>

                                <div class="infobox-content">
                                    <span class="bigger-110">~</span>
                                    58GB remaining
                                </div>
                            </div>
                        </div>

                        <div class="space-6"></div>

                        <div class="infobox infobox-green infobox-small infobox-dark">
                            <div class="infobox-progress">
                                <div class="easy-pie-chart percentage" data-percent="61" data-size="39">
                                    <span class="percent">61</span>
                                    %
                                </div>
                            </div>

                            <div class="infobox-data">
                                <div class="infobox-content">Admission</div>
                                <div class="infobox-content">Completion</div>
                            </div>
                        </div>

                        <div class="infobox infobox-blue infobox-small infobox-dark">
                            <div class="infobox-chart">
                                <span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
                            </div>

                            <div class="infobox-data">
                                <div class="infobox-content">Earnings</div>
                                <div class="infobox-content">$32,000</div>
                            </div>
                        </div>

                        <div class="infobox infobox-grey infobox-small infobox-dark">
                            <div class="infobox-icon">
                                <i class="icon-download-alt"></i>
                            </div>

                            <div class="infobox-data">
                                <div class="infobox-content">E-Forms</div>
                                <div class="infobox-content">1,205</div>
                            </div>
                        </div>
                    </div>

                    <div class="vspace"></div>

                    <div class="span5">
                        <div class="widget-box">
                            <div class="widget-header widget-header-flat widget-header-small">
                                <h5 style="color: whitesmoke">
                                    <i class="icon-signal"></i>
                                    Summary
                                </h5>

                                <div style="color: whitesmoke" class="widget-toolbar no-border">                                    
                                        <?php echo $campaign; ?>                                                       
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div id="piechart-placeholder"></div>

                                    <div class="hr hr8 hr-double"></div>

                                    <div class="clearfix">
                                        <div class="grid3">
                                            <span class="grey">
                                                <i class="icon-facebook-sign icon-2x blue"></i>
                                                &nbsp; likes
                                            </span>
                                            <h4 class="bigger pull-right" style="color:cadetblue">0,00</h4>
                                        </div>

                                        <div class="grid3">
                                            <span class="grey">
                                                <i class="icon-twitter-sign icon-2x purple"></i>
                                                &nbsp; tweets
                                            </span>
                                            <h4 class="bigger pull-right" style="color:cadetblue">0,00</h4>
                                        </div>

                                        <div class="grid3">
                                            <span class="grey">
                                                <i class="icon-pinterest-sign icon-2x red"></i>
                                                &nbsp; pins
                                            </span>
                                            <h4 class="bigger pull-right" style="color:cadetblue">0,00</h4>
                                        </div>
                                    </div>
                                </div><!--/widget-main-->
                            </div><!--/widget-body-->
                        </div><!--/widget-box-->
                    </div><!--/span-->
                </div><!--/row-->

               

                <!--PAGE CONTENT ENDS-->
            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->
    
    
                <script src="<?php echo base_url()?>assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.slimscroll.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.sparkline.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/flot/jquery.flot.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/flot/jquery.flot.resize.min.js"></script>

		<!--ace scripts-->

		<script src="<?php echo base_url()?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/ace.min.js"></script>
    

</div><!--/.main-content-->
	<script type="text/javascript">
			$(function() {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
				});
			
			
			
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'135px'});
			  var data = [
				{ label: "Inquiries",  data: <?php echo $inquiry_without_pros; ?>, color: "#68BC31"},
				{ label: "Prospectus",  data: <?php echo $pros_without_initial; ?>, color: "#2091CF"},
				{ label: "Initial Forms",  data: <?php echo $initial_without_detail; ?>, color: "#AF4E96"},
				{ label: "Complete Forms",  data: <?php echo $detailed; ?>, color: "#DA5430"},
				{ label: "Students",  data: <?php echo $forms_without_student; ?>, color: "#FEE074"}
                        
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			
			  var $tooltip = $("<div class='tooltip top in hide'><div class='tooltip-inner'></div></div>").appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
			
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').slimScroll({
					height: '300px'
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
				
			
			})
		</script>