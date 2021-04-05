<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="<?= base_url('vendor/mazer/dist/') ?>assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">


                <?php
                $role_id = $this->session->userdata('role_id');
                $queryMenu = "SELECT `user_menu`.`id`, `menu` 
                             FROM `user_menu` JOIN `user_access_menu` 
                             ON `user_menu`.`id` = `menu_id` 
                             WHERE `role_id` = $role_id 
                             ORDER BY `user_access_menu`.`menu_id` ASC
                             ";
                $menu = $this->db->query($queryMenu)->result_array();

                ?>

                <!-- ini coba -->
                <!-- menu -->
                <?php foreach ($menu as $m) : ?>

                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span><?= $m['menu']; ?></span>
                        </a>
                        <ul class="submenu ">
                            <?php
                            $menuId = $m['id'];
                            $querySubMenu = "SELECT * 
                                         FROM `user_sub_menu` JOIN `user_menu`
                                         ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                         WHERE `user_sub_menu`.`menu_id` =  $menuId
                                         AND `user_sub_menu`.`is_active` = 1
                                            ";

                            $subMenu = $this->db->query($querySubMenu)->result_array();

                            foreach ($subMenu as $sm) : ?>
                                <li class="submenu-item " id="<?php echo $m['menu']; ?>" class="collapse">
                                    <a href="<?= base_url($sm['url']); ?>">
                                        <i class="<?= base_url($sm['icon']); ?>"></i>
                                        <span><?= ($sm['title']); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>

                <!-- ini coba -->

                <li class="sidebar-item  ">
                    <a href="<?= base_url('auth/logout'); ?>" class='sidebar-link'>
                        <i class="bi bi-arrow-up-square-fill"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>