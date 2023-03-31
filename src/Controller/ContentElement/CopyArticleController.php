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

#[AsContentElement(CopyArticleController::TYPE, category:'miscellaneous', template:'ce_copyArticle')]
class CopyArticleController extends AbstractContentElementController
{
    public const TYPE = 'copyArticle';

    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
        $container = System::getContainer();

        if ($container->get('contao.routing.scope_matcher')->isFrontendRequest($request))
        {
            $token       = $container->get('contao.csrf.token_manager')->getDefaultTokenValue();
            $routePrefix = $container->getParameter('contao.backend.route_prefix');

            $template->href    = vsprintf('%s?do=article&act=paste&mode=copy&id=%s&rt=%s', [
                ltrim($routePrefix, '/'), // Make relative
                $model->articleAlias,
                $token
            ]);

            if (!$model->linkTitle)
            {
                $translator          = $container->get('translator');
                $template->linkTitle = $translator->trans('CTE.copyArticleID', [$model->articleAlias], 'contao_default');
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
