<!-- This is only visible to small devices -->
<?php
    $menu = getMenu();

    function collapsemenu($menu, $parent = 0, $level = 1, $pageurl)
    {
        foreach( $menu['tree'][$level][$parent] as $key )
        {
            $addclass = array();
            
            if( $menu['data'][$key]['link'] == $pageurl )
                $addclass[] = 'active';
            if( $menu['data'][$key]['count'] > 1 )
                $addclass[] = 'nav-parent';

            $class = (isset($addclass) ? "class = '". implode(' ', $addclass) ."'" : "");
            
            echo "<li ". $class .">";
            echo "<a href = ". base_url($menu['data'][$key]['link']) ."><i class='". $menu['data'][$key]['icon'] ."'></i><span>". $menu['data'][$key]['name'] ."</span></a>";
        
            if( $menu['data'][$key]['count'] > 1 )
            {
                echo '<ul class="children">';
                collapsemenu($menu, $key, ($menu['data'][$key]['level'] + 1), $pageurl);
                echo '</ul>';
            }
            
            echo "</li>";
        }
    }
?>
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <img alt="" src="<?php echo base_assets()?>themes/main/images/photos/loggeduser.png" class="media-object">
                <div class="media-body">
                    <h4><?= getNamaUser()?></h4>
                    <span>"Life is so..."</span>
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href="#"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href="#"><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
              <li><a href="<?= base_url($pageurl. '/logout')?>"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>
      
      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li <?php echo ($pageurl == 'adm/home') ? 'class="active"' : '' ?> ><a href="<?= base_url('adm/home')?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <?php collapsemenu($menu, 0, 1, $pageurl)?>
      </ul>

      <div class="infosummary">
        <h5 class="sidebartitle">Information Summary</h5>    
        <ul>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Daily Traffic</span>
                    <h4>630, 201</h4>
                </div>
                <div id="sidebar-chart" class="chart"></div>   
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Average Users</span>
                    <h4>1, 332, 801</h4>
                </div>
                <div id="sidebar-chart2" class="chart"></div>   
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Disk Usage</span>
                    <h4>82.2%</h4>
                </div>
                <div id="sidebar-chart3" class="chart"></div>   
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">CPU Usage</span>
                    <h4>140.05 - 32</h4>
                </div>
                <div id="sidebar-chart4" class="chart"></div>   
            </li>
            <li>
                <div class="datainfo">
                    <span class="text-muted">Memory Usage</span>
                    <h4>32.2%</h4>
                </div>
                <div id="sidebar-chart5" class="chart"></div>   
            </li>
        </ul>
      </div><!-- infosummary -->