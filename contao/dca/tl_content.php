<?php

use Oveleon\ContaoBackendHelper\Controller\ContentElement\CopyElementController;

$GLOBALS['TL_DCA']['tl_content']['palettes'][CopyElementController::TYPE] =
    '{type_legend},type;{include_legend},cteAlias;{link_legend},target,linkTitle,titleText;{protected_legend:hide},protected;{expert_legend:hide},cssID;{invisible_legend:hide},invisible,start,stop'
;
