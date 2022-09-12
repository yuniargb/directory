<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$menu = Globals::sidebarMenu();
                                               
?>
      <div class="main-sidebar sidebar-style-2 ">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#"><img src="<?= base_url('assets/'.Globals::layout('logo_1')) ?>" class="img-fluid" alt="<?= Globals::layout('title'); ?>" width="50"> <?= Globals::layout('title'); ?></a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url(); ?>dist/index">St</a>
          </div>
          <ul class="sidebar-menu">
            <?php foreach($menu as $m){?>
              <li class="menu-header"><?= $m['header'] ?></li>
                <?php foreach($m['list'] as $l){?>
                  <?php if($l['type'] == 'menu'){ ?>
                    <li class="<?= $this->uri->segment(1) == $l['link_name'] ? 'active' : ''; ?>">
                      <a class="nav-link" href="<?= $l['link'] ?>" <?= $l['link_name'] == 'acak_soal' ? 'target="_blank"' : ''?> >
                      <?= $l['icon'] ?> <span><?= $l['menu'] ?></span>
                      </a>
                    </li>
                  <?php }else{ ?>
                    <li class="dropdown <?= in_array($this->uri->segment(1), $l['link_name']) ? 'active' : ''; ?>">
                      <a href="#" class="nav-link has-dropdown"><?= $l['icon'] ?><span><?= $l['menu'] ?></span></a>
                      <ul class="dropdown-menu">
                        <?php foreach($l['link'] as $x){?>
                        <li class="<?= $this->uri->segment(1) == $x['link_name'] ? 'active' : ''; ?>">
                          <a class="nav-link" href="<?= $x['link'] ?>"><?= $x['menu'] ?></a>
                        </li>
                        <?php } ?>
                      </ul>
                    </li>
                  <?php } ?>
                <?php } ?>
            <?php } ?>
          </ul>
        </aside>
      </div>
