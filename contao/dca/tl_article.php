<?php
// Add label callback
use Oveleon\ContaoBackendHelper\BackendHelper;

$GLOBALS['TL_DCA']['tl_article']['list']['label']['label_callback'] = [
    BackendHelper::class,
    'invokeArticleList'
];

// Add field
$GLOBALS['TL_DCA']['tl_article']['fields']['article_info'] = [
    'exclude'                 => true,
    'inputType'               => 'text',
    'search'                  => true,
    'eval'                    => array('tl_class'=>'clr'),
    'sql'                     => "text NULL"
];

// Extend the default palettes
Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addField(['article_info'], 'title_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_article');
