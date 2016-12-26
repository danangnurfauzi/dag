<!-- /section:basics/navbar.layout -->
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<ul class="nav nav-list">
					
					<li class="<?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : '' ?>">
						<a href="<?php echo site_url('member/dashboard') ?>">
							<i class="ri menu-icon fa fa-desktop"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
						<b class="arrow"></b>
					</li>
					
					<li class="<?php echo ($this->uri->segment(2) == 'profiles') ? 'active' : '' ?>">
						<a href="#" class="dropdown-toggle">
							<i class="ri menu-icon fa fa-user"></i>
							<span class="menu-text"> Profile </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						
						<ul class="submenu">
							<li class="<?php echo ( ($this->uri->segment(2) == 'profiles') && ($this->uri->segment(3) == null) ) ? "active" : "" ?>">
								<a href="<?php echo site_url('member/profiles') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Profile Saya
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php echo ($this->uri->segment(3) == 'updatePassword') ? "active" : "" ?>">
								<a href="<?php echo site_url('member/profiles/updatePassword') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Update Password
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li class="<?php echo ($this->uri->segment(2) == 'bomembership') ? 'active' : '' ?>">
						<a href="#" class="dropdown-toggle">
							<i class="ri menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">
								BO Membership
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php echo (($this->uri->segment(2) == 'bomembership') && ($this->uri->segment(3) == null)) ? 'active' : '' ?>">
								<a href="<?php echo site_url('member/bomembership') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Check Status Member
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php echo (($this->uri->segment(2) == 'bomembership') && ($this->uri->segment(3) == 'tukarPoint')) ? 'active' : '' ?>">
								<a href="<?php echo site_url('member/bomembership/tukarPoint') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Gunakan Point
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="<?php echo ($this->uri->segment(2) == 'stockManagement') ? 'active' : '' ?>">
						<a href="<?php echo site_url('member/stockManagement/dashboard') ?>">
							<i class="ri menu-icon fa fa-th"></i>
							<span class="menu-text"> Stock Management </span>
						</a>
						<b class="arrow"></b>
					</li>

					<li class="<?php echo ($this->uri->segment(2) == 'memberManagement') ? 'active' : '' ?>">
						<a href="<?php echo site_url('member/memberManagement/dashboard') ?>">
							<i class="ri menu-icon fa fa-user"></i>
							<span class="menu-text"> Member Management </span>
						</a>
						<b class="arrow"></b>
					</li>

					<li class="<?php echo ($this->uri->segment(2) == 'emailAction') ? 'active' : '' ?>">
						<a href="#" class="dropdown-toggle">
							<i class="ri menu-icon fa fa-envelope"></i>
							<span class="menu-text"> Email Action </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						
						<ul class="submenu">
							<li class="<?php echo ( ($this->uri->segment(2) == 'emailAction') ) ? "active" : "" ?>">
								<a href="<?php echo site_url('member/emailAction/dashboard') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Activation
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php echo ($this->uri->segment(3) == 'emailAction') ? "active" : "" ?>">
								<a href="<?php echo site_url('member/emailAction/dashboard') ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Log
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
			</div>