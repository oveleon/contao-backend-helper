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

$GLOBALS['TL_DCA']['tl_user']['fields']['article_info_placeholder'] = [
    'default'                 => ['id', 'tag', 'class'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'options'                 => ['id', 'tag', 'class'],
    'eval'                    => ['tl_class'=>'w50', 'multiple' => true],
    'sql'                     => 'TEXT NOT NULL default "a:3:{i:0;s:2:"id";i:1;s:3:"tag";i:2;s:5:"class";}"'
];

// Extend the default palettes
PaletteManipulator::create()
    ->addField(['article_info_style', 'article_info_placeholder'], 'theme_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_user')
    ->applyToPalette('admin', 'tl_user')
    ->applyToPalette('login', 'tl_user')
    ->applyToPalette('group', 'tl_user')
    ->applyToPalette('custom', 'tl_user')
;
