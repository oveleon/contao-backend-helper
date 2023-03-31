<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_user']['fields']['article_info_style'] = [
    'default'                 => 'lightgrey',
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => ['lightgrey', 'lightgrey bold', 'highlight', 'highlight bold', 'none'],
    'eval'                    => ['tl_class'=>'w50'],
    'sql'                     => "varchar(255) NOT NULL default ''"
];

// Extend the default palettes
PaletteManipulator::create()
    ->addField(['article_info_style'], 'theme_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_user')
    ->applyToPalette('admin', 'tl_user')
    ->applyToPalette('login', 'tl_user')
    ->applyToPalette('group', 'tl_user')
    ->applyToPalette('custom', 'tl_user')
;
