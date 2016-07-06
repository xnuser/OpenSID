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
					elem_nav_button_id;

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
						case (elem_nav_button_id == 'nav-button-search'):
							if(elem_body.data('nav_button_search_is_clicked') != 'on'){
								$('#header-search').appendTo('#navbar-sub-search ul');
							}
							$('#navbar-sub-search').show();
							elem_body.data('nav_button_search_is_clicked', 'on');
							break;

						case (elem_nav_button_id == 'nav-button-browse'):
							if(elem_body.data('nav_button_browse_is_clicked') != 'on'){
								$('#global-nav').children().appendTo('#navbar-sub-browse ul');
							}

							// $('#navbar-sub-browse').style.height = '300px';
							$('#navbar-sub-browse').height('300px');
							$('#navbar-sub-browse').show();
							elem_body.data('nav_button_browse_is_clicked', 'on');
							break;

						case (elem_nav_button_id == 'nav-button-actions'):
							if(elem_body.data('nav_button_actions_is_clicked') != 'on'){
								$('#sign_up').appendTo('#navbar-sub-actions ul');
								$('#login').appendTo('#navbar-sub-actions ul');
								$('#header-actions-1').appendTo('#navbar-sub-actions ul');
								$('#header-actions-2').appendTo('#navbar-sub-actions ul');
							}
							$('#navbar-sub-actions').show();
							elem_body.data('nav_button_actions_is_clicked', 'on');
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
			        	<li><a href="#" id="nav-button-browse" class="nav-mob-button"><img class="nav-sprite icon-browse" src="/assets/images/transp.png"></a></li>
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
			        	<li><a href="#" id="nav-button-browse" class="nav-mob-button"><img class="nav-sprite icon-browse" src="/assets/images/transp.png"></a></li>
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
						    <div class="navbar-sub-item" id="navbar-sub-browse"><ul></ul></div>
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