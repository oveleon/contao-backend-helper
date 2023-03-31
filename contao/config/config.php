<?php
use Contao\System;

$request = System::getContainer()->get('request_stack')->getCurrentRequest();

if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request))
{
    $GLOBALS['TL_CSS'][] = 'bundles/contaobackendhelper/backend/css/backend.css';
}
