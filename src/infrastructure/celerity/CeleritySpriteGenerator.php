<?php

final class CeleritySpriteGenerator {

  public function buildIconSheet() {
    $icons = $this->getDirectoryList('icons_1x');

    $colors = array(
      '',
      'grey',
      'white',
    );

    $scales = array(
      '1x'  => 1,
      '2x'  => 2,
    );

    $template = id(new PhutilSprite())
      ->setSourceSize(14, 14);

    $sprites = array();
    foreach ($colors as $color) {
      foreach ($icons as $icon) {
        $prefix = 'icons_';
        if (strlen($color)) {
          $prefix .= $color.'_';
        }

        $suffix = '';
        if (strlen($color)) {
          $suffix = '-'.$color;
        }

        $sprite = id(clone $template)
          ->setName('icons-'.$icon.$suffix);

        $tcss = array();
        $tcss[] = '.icons-'.$icon.$suffix;
        if ($color == 'white') {
          $tcss[] = '.device-desktop .phabricator-action-view:hover '.
            '.icons-'.$icon;
          $tcss[] = '.device-desktop .phui-list-sidenav '.
            '.phui-list-item-href:hover .icons-'.$icon;
        }

        $sprite->setTargetCSS(implode(', ', $tcss));

        foreach ($scales as $scale_key => $scale) {
          $path = $this->getPath($prefix.$scale_key.'/'.$icon.'.png');
          $sprite->setSourceFile($path, $scale);
        }
        $sprites[] = $sprite;
      }
    }

    $remarkup_icons = $this->getDirectoryList('remarkup_1x');
    foreach ($remarkup_icons as $icon) {
      $prefix = 'remarkup_';

      // Strip 'text_' from these file names.
      $class_name = substr($icon, 5);

      if ($class_name == 'fullscreen_off') {
        $tcss = '.remarkup-control-fullscreen-mode .remarkup-assist-fullscreen';
      } else {
        $tcss = '.remarkup-assist-'.$class_name;
      }

      $sprite = id(clone $template)
        ->setName('remarkup-assist-'.$icon)
        ->setTargetCSS($tcss);

      foreach ($scales as $scale_key => $scale) {
        $path = $this->getPath($prefix.$scale_key.'/'.$icon.'.png');
        $sprite->setSourceFile($path, $scale);
      }
      $sprites[] = $sprite;
    }

    $sheet = $this->buildSheet('icons', true);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }

  public function buildActionsSheet() {
    $icons = $this->getDirectoryList('actions_white_1x');

    $colors = array(
      'dark',
      'grey',
      'white',
    );

    $scales = array(
      '1x'  => 1,
      '2x'  => 2,
    );

    $template = id(new PhutilSprite())
      ->setSourceSize(24, 24);

    $sprites = array();
    foreach ($colors as $color) {
      foreach ($icons as $icon) {
        $prefix = 'actions_';
        if (strlen($color)) {
          $prefix .= $color.'_';
        }

        $suffix = '';
        if (strlen($color)) {
          $suffix = '-'.$color;
        }

        $sprite = id(clone $template)
          ->setName('actions-'.$icon.$suffix);

        $tcss = array();
        $tcss[] = '.actions-'.$icon.$suffix;
        if ($color == 'dark') {
          $tcss[] = '.device-desktop '.
            '.actions-'.$icon.'-grey.phui-icon-view:hover';
        }

        $sprite->setTargetCSS(implode(', ', $tcss));

        foreach ($scales as $scale_key => $scale) {
          $path = $this->getPath($prefix.$scale_key.'/'.$icon.'.png');
          $sprite->setSourceFile($path, $scale);
        }
        $sprites[] = $sprite;
      }
    }

    $sheet = $this->buildSheet('actions', true);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }

    public function buildMiniconsSheet() {
    $icons = $this->getDirectoryList('minicons_white_1x');

    $colors = array(
      'white',
      'dark',
    );

    $scales = array(
      '1x'  => 1,
      '2x'  => 2,
    );

    $template = id(new PhutilSprite())
      ->setSourceSize(16, 16);

    $sprites = array();
    foreach ($colors as $color) {
      foreach ($icons as $icon) {
        $prefix = 'minicons_';
        if (strlen($color)) {
          $prefix .= $color.'_';
        }

        $suffix = '';
        if (strlen($color)) {
          $suffix = '-'.$color;
        }

        $sprite = id(clone $template)
          ->setName('minicons-'.$icon.$suffix);

        $sprite->setTargetCSS('.minicons-'.$icon.$suffix);

        foreach ($scales as $scale_key => $scale) {
          $path = $this->getPath($prefix.$scale_key.'/'.$icon.'.png');
          $sprite->setSourceFile($path, $scale);
        }
        $sprites[] = $sprite;
      }
    }

    $sheet = $this->buildSheet('minicons', true);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }


  public function buildMenuSheet() {
    $sprites = array();

    $sources = array(
      'seen_read_all' => array(
        'x' => 18,
        'y' => 18,
        'css' =>
          '.alert-notifications .phabricator-main-menu-alert-icon',
      ),
      'seen_have_unread' => array(
        'x' => 18,
        'y' => 18,
        'css' =>
          '.alert-notifications:hover .phabricator-main-menu-alert-icon',
      ),
      'unseen_any' => array(
        'x' => 18,
        'y' => 18,
        'css' =>
          '.alert-notifications.alert-unread .phabricator-main-menu-alert-icon',
      ),
      'arrow-right' => array(
        'x' => 9,
        'y' => 31,
        'css' => '.phabricator-crumb-divider',
      ),
      'search' => array(
        'x' => 24,
        'y' => 24,
        'css' => '.menu-icon-search',
      ),
      'search_blue' => array(
        'x' => 24,
        'y' => 24,
        'css' => '.menu-icon-search-blue',
      ),
      'new' => array(
        'x' => 24,
        'y' => 24,
        'css' => '.menu-icon-new',
      ),
      'new_blue' => array(
        'x' => 24,
        'y' => 24,
        'css' => '.menu-icon-new-blue',
      ),
      'app' => array(
        'x' => 24,
        'y' => 24,
        'css' => '.menu-icon-app',
      ),
      'app_blue' => array(
        'x' => 24,
        'y' => 24,
        'css' => '.menu-icon-app-blue',
      ),
      'logo' => array(
        'x' => 149,
        'y' => 26,
        'css' => '.phabricator-main-menu-logo-image',
      ),
      'conf-off' => array(
        'x' => 18,
        'y' => 18,
        'css' =>
          '.alert-notifications .phabricator-main-menu-message-icon',
      ),
      'conf-hover' => array(
        'x' => 18,
        'y' => 18,
        'css' =>
          '.alert-notifications:hover .phabricator-main-menu-message-icon',
      ),
      'conf-unseen' => array(
        'x' => 18,
        'y' => 18,
        'css' =>
          '.alert-notifications.message-unread '.
          '.phabricator-main-menu-message-icon',
      ),
    );

    $scales = array(
      '1x' => 1,
      '2x' => 2,
    );

    $template = new PhutilSprite();
    foreach ($sources as $name => $spec) {
      $sprite = id(clone $template)
        ->setName($name)
        ->setSourceSize($spec['x'], $spec['y'])
        ->setTargetCSS($spec['css']);

      foreach ($scales as $scale_name => $scale) {
        $path = 'menu_'.$scale_name.'/'.$name.'.png';
        $path = $this->getPath($path);

        $sprite->setSourceFile($path, $scale);
      }
      $sprites[] = $sprite;
    }

    $sheet = $this->buildSheet('menu', true);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }

  public function buildTokenSheet() {
    $icons = $this->getDirectoryList('tokens_1x');
    $scales = array(
      '1x' => 1,
      '2x' => 2,
    );
    $template = id(new PhutilSprite())
      ->setSourceSize(16, 16);

    $sprites = array();
    $prefix = 'tokens_';
    foreach ($icons as $icon) {
      $sprite = id(clone $template)
        ->setName('tokens-'.$icon)
        ->setTargetCSS('.tokens-'.$icon);

      foreach ($scales as $scale_key => $scale) {
        $path = $this->getPath($prefix.$scale_key.'/'.$icon.'.png');
        $sprite->setSourceFile($path, $scale);
      }
      $sprites[] = $sprite;
    }

    $sheet = $this->buildSheet('tokens', true);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }

  public function buildProjectsSheet() {
    $icons = $this->getDirectoryList('projects_1x');
    $scales = array(
      '1x' => 1,
      '2x' => 2,
    );
    $template = id(new PhutilSprite())
      ->setSourceSize(50, 50);

    $sprites = array();
    $prefix = 'projects-';
    foreach ($icons as $icon) {
      $sprite = id(clone $template)
        ->setName($prefix.$icon)
        ->setTargetCSS('.'.$prefix.$icon);

      foreach ($scales as $scale_key => $scale) {
        $path = $this->getPath('projects_'.$scale_key.'/'.$icon.'.png');
        $sprite->setSourceFile($path, $scale);
      }
      $sprites[] = $sprite;
    }

    $sheet = $this->buildSheet('projects', true);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }

  public function buildPaymentsSheet() {
    $icons = $this->getDirectoryList('payments_2x');
    $scales = array(
      '2x' => 1,
    );
    $template = id(new PhutilSprite())
      ->setSourceSize(60, 32);

    $sprites = array();
    $prefix = 'payments_';
    foreach ($icons as $icon) {
      $sprite = id(clone $template)
        ->setName('payments-'.$icon)
        ->setTargetCSS('.payments-'.$icon);

      foreach ($scales as $scale_key => $scale) {
        $path = $this->getPath($prefix.$scale_key.'/'.$icon.'.png');
        $sprite->setSourceFile($path, $scale);
      }
      $sprites[] = $sprite;
    }

    $sheet = $this->buildSheet('payments', true);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }


  public function buildConpherenceSheet() {
    $name = 'conpherence';
    $icons = $this->getDirectoryList($name.'_1x');
    $scales = array(
      '1x' => 1,
      '2x' => 2,
    );
    $template = id(new PhutilSprite())
      ->setSourceSize(32, 32);

    $sprites = array();
    foreach ($icons as $icon) {
      $color = preg_match('/_on/', $icon) ? 'on' : 'off';

      $prefix = $name.'_';

      $sprite = id(clone $template)
        ->setName($prefix.$icon);

      $tcss = array();
      $tcss[] = '.'.$prefix.$icon;
      if ($color == 'on') {
        $class = str_replace('_on', '_off', $prefix.$icon);
        $tcss[] = '.device-desktop .'.$class.':hover ';
      }

      $sprite->setTargetCSS(implode(', ', $tcss));

      foreach ($scales as $scale_key => $scale) {
        $path = $this->getPath($prefix.$scale_key.'/'.$icon.'.png');
        $sprite->setSourceFile($path, $scale);
      }
      $sprites[] = $sprite;
    }

    $sheet = $this->buildSheet($name, true);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }

  public function buildDocsSheet() {
    $icons = $this->getDirectoryList('docs_1x');
    $scales = array(
      '1x' => 1,
      '2x' => 2,
    );
    $template = id(new PhutilSprite())
      ->setSourceSize(32, 32);

    $sprites = array();
    $prefix = 'docs_';
    foreach ($icons as $icon) {
      $sprite = id(clone $template)
        ->setName($prefix.$icon)
        ->setTargetCSS('.'.$prefix.$icon);

      foreach ($scales as $scale_key => $scale) {
        $path = $this->getPath($prefix.$scale_key.'/'.$icon.'.png');
        $sprite->setSourceFile($path, $scale);
      }
      $sprites[] = $sprite;
    }

    $sheet = $this->buildSheet('docs', true);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }

  public function buildLoginSheet() {
    $icons = $this->getDirectoryList('login_1x');
    $scales = array(
      '1x' => 1,
      '2x' => 2,
    );
    $template = id(new PhutilSprite())
      ->setSourceSize(34, 34);

    $sprites = array();
    $prefix = 'login_';
    foreach ($icons as $icon) {
      $sprite = id(clone $template)
        ->setName('login-'.$icon)
        ->setTargetCSS('.login-'.$icon);

      foreach ($scales as $scale_key => $scale) {
        $path = $this->getPath($prefix.$scale_key.'/'.$icon.'.png');
        $sprite->setSourceFile($path, $scale);
      }
      $sprites[] = $sprite;
    }

    $sheet = $this->buildSheet('login', true);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }

  public function buildStatusSheet() {
    $icons = $this->getDirectoryList('status_1x');
    $scales = array(
      '1x' => 1,
      '2x' => 2,
    );
    $template = id(new PhutilSprite())
      ->setSourceSize(14, 14);

    $sprites = array();
    $prefix = 'status_';
    $extra_css = array(
      'policy-custom-white' =>
        ', .dropdown-menu-item:hover .status-policy-custom',
      'policy-all-white' =>
        ', .dropdown-menu-item:hover .status-policy-all',
      'policy-unknown-white' =>
        ', .dropdown-menu-item:hover .status-policy-unknown',
      'policy-admin-white' =>
        ', .dropdown-menu-item:hover .status-policy-admin',
      'policy-public-white' =>
        ', .dropdown-menu-item:hover .status-policy-public',
      'policy-project-white' =>
        ', .dropdown-menu-item:hover .status-policy-project',
      'policy-noone-white' =>
        ', .dropdown-menu-item:hover .status-policy-noone',
    );

    foreach ($icons as $icon) {
      $sprite = id(clone $template)
        ->setName('status-'.$icon)
        ->setTargetCSS('.status-'.$icon.idx($extra_css, $icon));

      foreach ($scales as $scale_key => $scale) {
        $path = $this->getPath($prefix.$scale_key.'/'.$icon.'.png');
        $sprite->setSourceFile($path, $scale);
      }
      $sprites[] = $sprite;
    }

    $sheet = $this->buildSheet('status', true);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }

  public function buildGradientSheet() {
    $gradients = $this->getDirectoryList('gradients');

    $template = new PhutilSprite();

    $unusual_heights = array(
      'dark-menu-label' => 25,
      'breadcrumbs'     => 31,
      'menu-label'      => 24,
      'red-header'      => 70,
      'blue-header'     => 70,
      'green-header'    => 70,
      'yellow-header'   => 70,
      'grey-header'     => 70,
      'dark-grey-header' => 70,
      'lightblue-header' => 240,
    );

    $extra_css = array(
      'dark-menu-label' =>
        ', .phabricator-dark-menu .phui-list-item-type-label',
      'menu-label' =>
        ', .phabricator-side-menu .phui-list-item-type-label',
    );

    $sprites = array();
    foreach ($gradients as $gradient) {
      $path = $this->getPath('gradients/'.$gradient.'.png');
      $sprite = id(clone $template)
        ->setName('gradient-'.$gradient)
        ->setSourceFile($path)
        ->setTargetCSS('.gradient-'.$gradient.idx($extra_css, $gradient));

      $sprite->setSourceSize(4, idx($unusual_heights, $gradient, 26));

      $sprites[] = $sprite;
    }

    $sheet = $this->buildSheet(
      'gradient',
      false,
      PhutilSpriteSheet::TYPE_REPEAT_X,
      ', .phabricator-dark-menu .phui-list-item-type-label, '.
      '.phabricator-side-menu .phui-list-item-type-label');
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }

  public function buildMainHeaderSheet() {
    $gradients = $this->getDirectoryList('main_header');
    $template = new PhutilSprite();

    $sprites = array();
    foreach ($gradients as $gradient) {
      $path = $this->getPath('main_header/'.$gradient.'.png');
      $sprite = id(clone $template)
        ->setName('main-header-'.$gradient)
        ->setSourceFile($path)
        ->setTargetCSS('.main-header-'.$gradient);
      $sprite->setSourceSize(6, 44);
      $sprites[] = $sprite;
    }

    $sheet = $this->buildSheet('main-header',
      false,
      PhutilSpriteSheet::TYPE_REPEAT_X);

    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }


  public function buildAppsSheet() {
    return $this->buildAppsSheetVariant(1);
  }

  public function buildAppsLargeSheet() {
    return $this->buildAppsSheetVariant(2);
  }

  public function buildAppsXLargeSheet() {
    return $this->buildAppsSheetVariant(3);
  }

  private function buildAppsSheetVariant($variant) {

    if ($variant == 1) {
      $scales = array(
        '1x' => 1,
        '2x' => 2,
      );
      $variant_name = 'apps';
      $variant_short = '';
      $size_x = 14;
      $size_y = 14;

      $colors = array(
        'dark'  => 'dark',
        'white' => 'white',
      );
    } else if ($variant == 2) {
      $scales = array(
        '2x' => 1,
        '4x' => 2,
      );
      $variant_name = 'apps-large';
      $variant_short = '-large';
      $size_x = 28;
      $size_y = 28;

      $colors = array(
        'light' => 'lb',
        'dark'  => 'dark',
        'blue'  => 'blue',
        'white' => 'white',
      );
    } else {
      $scales = array(
        '4x' => 1,
      );
      $variant_name = 'apps-xlarge';
      $variant_short = '-xlarge';
      $size_x = 56;
      $size_y = 56;

      $colors = array(
        'dark'  => 'dark',
        /*

        TODO: These are available but not currently used.

        'blue'  => 'blue',
        'light' => 'lb',
        */
      );
    }


    $apps = $this->getDirectoryList('apps_dark_1x');

    $template = id(new PhutilSprite())
      ->setSourceSize($size_x, $size_y);

    $sprites = array();
    foreach ($apps as $app) {
      foreach ($colors as $color => $color_path) {

        $css = '.apps-'.$app.'-'.$color.$variant_short;
        if ($color == 'blue' && $variant_name == 'apps-large') {
          $css .= ', .phabricator-crumb-view:hover .apps-'.$app.'-dark-large';
        }

        if ($color == 'white' && $variant == 1) {
          $css .= ', .phui-list-item-href:hover .apps-'.$app.'-dark';
        }

        $sprite = id(clone $template)
          ->setName('apps-'.$app.'-'.$color.$variant_short)
          ->setTargetCSS($css);

        foreach ($scales as $scale_name => $scale) {
          $path = $this->getPath(
            'apps_'.$color_path.'_'.$scale_name.'/'.$app.'.png');
          $sprite->setSourceFile($path, $scale);
        }

        $sprites[] = $sprite;
      }
    }

    $sheet = $this->buildSheet($variant_name, count($scales) > 1);
    $sheet->setScales($scales);
    foreach ($sprites as $sprite) {
      $sheet->addSprite($sprite);
    }

    return $sheet;
  }


  private function getPath($to_path = null) {
    $root = dirname(phutil_get_library_root('phabricator'));
    return $root.'/resources/sprite/'.$to_path;
  }

  private function getDirectoryList($dir) {
    $path = $this->getPath($dir);

    $result = array();

    $images = Filesystem::listDirectory($path, $include_hidden = false);
    foreach ($images as $image) {
      if (!preg_match('/\.png$/', $image)) {
        throw new Exception(
          "Expected file '{$image}' in '{$path}' to be a sprite source ".
          "ending in '.png'.");
      }
      $result[] = substr($image, 0, -4);
    }

    return $result;
  }

  private function buildSheet(
    $name,
    $has_retina,
    $type = null,
    $extra_css = '') {

    $sheet = new PhutilSpriteSheet();

    $at = '@';

    switch ($type) {
      case PhutilSpriteSheet::TYPE_STANDARD:
      default:
        $type = PhutilSpriteSheet::TYPE_STANDARD;
        $repeat_rule = 'no-repeat';
        break;
      case PhutilSpriteSheet::TYPE_REPEAT_X:
        $repeat_rule = 'repeat-x';
        break;
      case PhutilSpriteSheet::TYPE_REPEAT_Y:
        $repeat_rule = 'repeat-y';
        break;
    }

    $retina_rules = null;
    if ($has_retina) {
      $retina_rules = <<<EOCSS
@media
only screen and (min-device-pixel-ratio: 1.5),
only screen and (-webkit-min-device-pixel-ratio: 1.5) {
  .sprite-{$name}{$extra_css} {
    background-image: url(/rsrc/image/sprite-{$name}-X2.png);
    background-size: {X}px {Y}px;
  }
}
EOCSS;
    }

    $sheet->setSheetType($type);
    $sheet->setCSSHeader(<<<EOCSS
/**
 * @provides sprite-{$name}-css
 * {$at}generated
 */

.sprite-{$name}{$extra_css} {
  background-image: url(/rsrc/image/sprite-{$name}.png);
  background-repeat: {$repeat_rule};
}

{$retina_rules}

EOCSS
);

    return $sheet;
  }
}


