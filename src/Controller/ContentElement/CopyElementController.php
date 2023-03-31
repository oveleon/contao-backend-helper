<?php

declare(strict_types=1);

namespace Oveleon\ContaoBackendHelper\Controller\ContentElement;

use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\ContentModel;
use Contao\System;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(CopyElementController::TYPE, category:'miscellaneous', template:'ce_copyElement')]
class CopyElementController extends AbstractContentElementController
{
    public const TYPE = 'copyElement';

    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
        $container = System::getContainer();

        if ($container->get('contao.routing.scope_matcher')->isFrontendRequest($request))
        {
            $token       = $container->get('contao.csrf.token_manager')->getDefaultTokenValue();
            $routePrefix = $container->getParameter('contao.backend.route_prefix');

            $template->href    = vsprintf('%s?do=article&id=%s&table=tl_content&act=paste&mode=copy&rt=%s', [
                ltrim($routePrefix, '/'), // Make relative
                $model->cteAlias,
                $token
            ]);

            if (!$model->linkTitle)
            {
                $translator          = $container->get('translator');
                $template->linkTitle = $translator->trans('CTE.copyElementID', [$model->cteAlias], 'contao_default');
            }

            if ($model->target)
            {
                $template->target = ' target="_blank"';
                $template->rel = ' rel="noreferrer noopener"';
            }
        }

        return $template->getResponse();
    }
}
