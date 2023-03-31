<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Oveleon\ContaoBackendHelper\EventListener\DataContainer\DataContainerListener;

$GLOBALS['TL_DCA']['tl_article']['list']['label']['label_callback'] = [DataContainerListener::class,'invokeArticleList'];

// Add field
$GLOBALS['TL_DCA']['tl_article']['fields']['article_info'] = [
    'exclude'                 => true,
    'inputType'               => 'text',
    'search'                  => true,
    'eval'                    => array('tl_class'=>'clr'),
    'sql'                     => "text NULL"
];

// Extend the default palettes
PaletteManipulator::create()
    ->addField(['article_info'], 'title_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_article')
;
