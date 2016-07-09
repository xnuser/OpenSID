<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Website Desa <?php echo unpenetration($desa['nama_desa']);?></title>
		<meta content="utf-8" http-equiv="encoding">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo base_url()?>favicon.ico" />
		<link type='text/css' href="<?php echo base_url()?>assets/front/css/first.css" rel='Stylesheet' />
		<?php if(is_file("desa/css/desa-web.css")): ?>
			<link type='text/css' href="<?php echo base_url()?>desa/css/desa-web.css" rel='Stylesheet' />
		<?php endif; ?>
		<link type='text/css' href="<?php echo base_url()?>assets/css/font-awesome.min.css" rel='Stylesheet' />
		<link type='text/css' href="<?php echo base_url()?>assets/css/ui-buttons.css" rel='Stylesheet' />
		<link type='text/css' href="<?php echo base_url()?>assets/front/css/colorbox.css" rel='Stylesheet' />
		<link href="<?php echo base_url()?>assets/css/restive.css" media="all" rel="stylesheet" type="text/css" />

		<script src="<?php echo base_url()?>assets/front/js/stscode.js"></script>
		<script src="<?php echo base_url()?>assets/front/js/jquery.js"></script>
		<script src="<?php echo base_url()?>assets/front/js/layout.js"></script>
		<script src="<?php echo base_url()?>assets/front/js/jquery.colorbox.js"></script>

		<!-- Install Restive.JS -->

		<script type="text/javascript" src="<?php echo base_url()?>assets/js/restive.js-master/restive.min.js"></script>

		<!-- Configure Restive.JS -->
		<script>
		    $( document ).ready(function() {
		        $('body').restive({
		            breakpoints: ['10000'],
		            classes: ['nb'],
		            turbo_classes: 'is_mobile=mobi,is_phone=phone,is_tablet=tablet,is_portrait=portrait,is_landscape=landscape'
		        });

				/**
				 * Sub Navbar Functionality
				 */
				var elem_body = $('body'),
				    elem_navbar_sub = $('#navbar-sub'),
				    elem_navbar_sub_children = $('#navbar-sub .navbar-sub-item'),
				    subnav_status,
					subnav_click_op,
					elem_nav_button_id,
					subnav_height;

				$('.nav-mob-button').on('click', function(e){
					e.preventDefault();

					//get the id attribute of the clicked item
					elem_nav_button_id = $(this).attr('id');

					//get the id of the last clicked button
					elem_nav_button_id_last = elem_body.data('nav_button_id_last_clicked');

					//check if submenu is active
					subnav_status = elem_body.data('subnav_status');

					//track the open/close state of sub navbar
					if (subnav_status == 'on'){
						switch(true)
						{
							case (elem_nav_button_id_last == elem_nav_button_id):
								//same nav button was clicked and sub navbar is active, then close sub navbar
								elem_navbar_sub.slideUp('fast', function(){
									$(this).hide();
								});
								elem_body.data('subnav_status', 'off');
								return;
								break;
						}
					}
					else {
						//open sub navbar
						elem_navbar_sub.slideDown('fast', function(){
							$(this).show();
						});
						elem_body.data('subnav_status', 'on');
					};

					//clear the sub navbar area
					elem_navbar_sub_children.hide();

					//fill sub navbar with relevant content
					switch(true)
					{
						case (elem_nav_button_id == 'nav-button-browse-atas'):
							if(elem_body.data('nav_button_browse_atas_is_clicked') != 'on'){
								$('#global-nav.top').children().appendTo('#navbar-sub-browse-atas ul');
							}
							subnav_height = ($('#navbar-sub-browse-atas').find('li').length * 1.4).toString() + "em";
							$('#navbar-sub-browse-atas').height(subnav_height);
							$('#navbar-sub-browse-atas').show();
							elem_body.data('nav_button_browse_atas_is_clicked', 'on');
							break;

						case (elem_nav_button_id == 'nav-button-browse-main'):
							if(elem_body.data('nav_button_browse_main_is_clicked') != 'on'){
								$('#global-nav.main').children().appendTo('#navbar-sub-browse-main ul');
							}
							subnav_height = ($('#navbar-sub-browse-main').find('li').length * 1.4).toString() + "em";
							$('#navbar-sub-browse-main').height(subnav_height);
							$('#navbar-sub-browse-main').show();
							elem_body.data('nav_button_browse_main_is_clicked', 'on');
							break;
					}

					//mark the id of the last button clicked
					elem_body.data('nav_button_id_last_clicked', elem_nav_button_id);
				});

		    });
		</script>

		<script>
			$(document).ready(function(){
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"fade"});
			});
		</script>
	</head>
	<body>
		<div id="maincontainer">
			<div id="topsection">
				<div class="innertube">
					<div id="header">
			      <div id="nav-atas" class="nav-mob">
			      	<ul>
			        	<li><a href="#" id="nav-button-browse-atas" class="nav-mob-button"><img class="nav-sprite icon-browse" src="/assets/images/transp.png" title="Menu Pemerintah Desa"></a></li>
			        </ul>
			      </div>
						<div id="divlogo">
							<div id="divlogo-img">
								<div class="intube">
									<a href="<?php echo site_url(); ?>first/">
									<img src="<?php echo LogoDesa($desa['logo']);?>" alt="<?php echo $desa['nama_desa']?>"/>
									</a>
								</div>
							</div>
							<div id="divlogo-txt">
								<div class="intube">
									<div id="siteTitle">
										<h1><?php echo unpenetration($desa['nama_desa'])?></h1>
										<h2>Kecamatan <?php echo unpenetration($desa['nama_kecamatan'])?><br />
										Kab/Kota <?php echo unpenetration($desa['nama_kabupaten'])?></h2>
										<h3><?php echo unpenetration($desa['alamat_kantor'])?></h3>
									</div>
								</div>
							</div>
						</div>
			      <div id="nav-main" class="nav-mob">
			      	<ul>
			        	<li><a href="#" id="nav-button-browse-main" class="nav-mob-button"><img class="nav-sprite icon-browse" src="/assets/images/transp.png" title="Menu Artikel"></a></li>
			        </ul>
			      </div>
						<div id="headercontent">
							<div id="menu_vert">
								<div id="menuwrapper">
									<?php $this->load->view('partials/menu.tpl.php');?>
								</div>
							</div>
							<div id="menu_vert2">
								<?php if(count($slide)>0){
									$this->load->view('layouts/slide.php');
								} ?>
							</div>
						</div>
						<div id="navbar-sub">
						    <div class="navbar-sub-item" id="navbar-sub-browse-atas"><ul></ul></div>
						    <div class="navbar-sub-item" id="navbar-sub-browse-main"><ul></ul></div>
						</div>
					</div>

					<?php if(count($teks_berjalan)>0){
						$this->load->view('layouts/teks_berjalan.php');
					} ?>

					<div id="mainmenu">
						<?php $this->load->view('partials/menu.left.php');?>
					</div>

				</div>
			</div>