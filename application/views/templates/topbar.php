    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('assets/img/') . $user['image'] ?>"><?= $user['name']; ?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="<?= base_url('home'); ?>"><i class="fa fa-home pull-right"></i> Beranda</a></li>
                            <li><a href="<?= base_url('user'); ?>"><i class="fa fa-user pull-right"></i> Profil</a></li>
                            <li><a class="tombol-logout" href="<?= base_url('auth/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Logout</a></li>
                        </ul>
                    </li>


                </ul>
            </nav>
        </div>
    </div>
    <!-- /top navigation -->