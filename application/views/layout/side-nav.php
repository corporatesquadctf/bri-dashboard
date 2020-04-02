<style type="text/css">
.glyphicon-chevron-down:before, .glyphicon-chevron-up:before {
    content: "\e114";
}
</style>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <?php
                            if($this->session->SEGMENT_ID == 1) {
                        ?> 
                            <a class="site_title" href="<?= base_url('Home') ?>">
                        <?php       
                            } else {
                        ?>
                            <a class="site_title">
                        <?php       
                            }
                        ?>
                            <img src="<?= base_url(); ?>assets/images/bank-bri-logo.png" style="width: 60%;"/>
                        </a>
                    </div>

                    <div class="clearfix"></div>

                    <br />
                    <?php $access = $_SESSION['ACCESS'];?>
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                        <?php if ($access['ADMIN'] || $access['MASTER'] || $access['WORKFLOW'] || $access['LOG']) : ?>
                                <h3>
                                    <?php if($this->session->ROLE_ID == USER_ROLE_RM_MENENGAH) echo "Management Data";
                                        else echo "Admin Area" 
                                    ?>                                    
                                </h3>
                                <div class="menu_section_border"></div>
                                <ul class="nav side-menu">
                                    <?php if ($access['ADMIN']) : ?>
                                        <li>
                                            <a onclick="toggleChevron(this)" >
                                                <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">group</i> User Management <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                            </a>
                                            <ul class="nav child_menu">
                                                <?php foreach ($access['ADMIN'] as $acc) : ?>
                                                    <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>                                
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($access['MASTER']) : ?>
                                        <li>
                                            <a onclick="toggleChevron(this)" >
                                                <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">file_copy</i> Master Data <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                            </a>
                                            <ul class="nav child_menu">
                                                <?php foreach ($access['MASTER'] as $acc) : ?>
                                                    <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>            
                                        </li>
                                    <?php endif; ?>  

                                    <?php if ($access['WORKFLOW']) : ?>
                                        <li>
                                            <a onclick="toggleChevron(this)" >
                                                <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">settings_applications</i> Workflow <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                            </a>
                                            <ul class="nav child_menu">
                                                <?php foreach ($access['WORKFLOW'] as $acc) : ?>
                                                    <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>  
                                    <?php if ($access['LOG']) : ?>
                                        <li>
                                            <a onclick="toggleChevron(this)" >
                                                <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">switch_camera</i> Log <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                            </a>
                                            <ul class="nav child_menu">
                                                <?php foreach ($access['LOG'] as $acc) : ?>
                                                    <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>  
                                    <?php if ($access['UTILITY']) : ?>
                                        <li>
                                            <a onclick="toggleChevron(this)" >
                                                <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">switch_camera</i> Utility <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                            </a>
                                            <ul class="nav child_menu">
                                                <?php foreach ($access['UTILITY'] as $acc) : ?>
                                                    <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>  
                                </ul>
                            <?php endif; ?>
                            <br />
                        <?php if ($access['PERFORMANCE'] || $access['REPORT'] || $access['PIPELINE'] || $access['DISPOSISI'] || $access['TASK'] || $access['MONITORING'] || $access['APPROVAL'] || $access["KAJIAN EKONOMI MAKRO"] || $access["ACCOUNT PLANNING MENENGAH"] || $access["FTP"] || $access["DELEGATE"]): ?>
                            <h3>My Menu</h3>
                            <div class="menu_section_border"></div>
                            <ul class="nav side-menu">
                                <?php if ($access['PERFORMANCE']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">whatshot</i> Performance <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['PERFORMANCE'] as $acc) :
                                                 ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>                                       
                                            <?php endforeach; ?> 
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if ($access['KAJIAN EKONOMI MAKRO']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">folder_open</i> Kajian Ekonomi Makro <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['KAJIAN EKONOMI MAKRO'] as $acc) : ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if ($access['FTP']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">whatshot</i> FTP <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['FTP'] as $acc) : ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if ($access['TASK']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">assignment</i> Task List <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['TASK'] as $acc) : ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                            <?php endforeach; ?>
                                        </ul> 
                                    </li>
                                <?php endif; ?>
                                <?php if ($access['MONITORING']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">cast_connected</i>  Monitoring <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['MONITORING'] as $acc) : ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if ($access['APPROVAL']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">event_available</i> Approval <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['APPROVAL'] as $acc) :
                                                 ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>                                       
                                            <?php endforeach; ?> 
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if ($access['REPORT']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">insert_chart</i> Report <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['REPORT'] as $acc) : ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                            <?php endforeach; ?>
                                        </ul> 
                                    </li>
                                <?php endif; ?>
                                <?php if ($access['DELEGATE']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">assignment</i> Delegate <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['DELEGATE'] as $acc) : ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                            <?php endforeach; ?>
                                        </ul> 
                                    </li>
                                <?php endif; ?>
                                <?php if ($access['DISPOSISI']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">assignment</i> Disposisi <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['DISPOSISI'] as $acc) : ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                            <?php endforeach; ?>
                                        </ul> 
                                    </li>
                                <?php endif; ?>
                                <?php if ($access['PIPELINE']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">table_chart</i> Pipeline <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['PIPELINE'] as $acc) : ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if ($access['PORTOFOLIO']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">folder_open</i> Portofolio <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['PORTOFOLIO'] as $acc) : ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if ($access['ACCOUNT PLANNING MENENGAH']) : ?>
                                    <li>
                                        <a onclick="toggleChevron(this)" >
                                            <i class="material-icons" style="vertical-align: middle; padding-right: 10px;">assignment</i> Account Planning <span class="glyphicon glyphicon-chevron-down kanan"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <?php foreach ($access['ACCOUNT PLANNING MENENGAH'] as $acc) : ?>
                                                <li><a href="<?= base_url($acc->ModulePath) ?>"><?= $acc->ModuleName ?></a></li>
                                            <?php endforeach; ?>
                                        </ul> 
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <script type="text/javascript">
                window.toggleChevron = function (button) {
                    //$(button).find('span').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
                }
            </script>