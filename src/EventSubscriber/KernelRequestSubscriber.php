<?php

namespace Oveleon\ContaoBackendHelper\EventSubscriber;

use Contao\ArrayUtil;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class KernelRequestSubscriber implements EventSubscriberInterface
{
    protected $scopeMatcher;
    protected $security;

    public function __construct(ScopeMatcher $scopeMatcher, Security $security)
    {
        $this->scopeMatcher = $scopeMatcher;
        $this->security     = $security;
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => 'onKernelRequest'];
    }

    public function onKernelRequest(RequestEvent $e): void
    {
        $request = $e->getRequest();

        /*if ($this->scopeMatcher->isContaoRequest($request))
        {
            @var User $user
            $user = $this->security->getUser();

            if (null !== $user)
            {
                $GLOBALS['TL_CSS'][] = 'bundles/contaobackendhelper/frontend/css/backendhelper.css|static';
            }
        }*/

        if ($this->scopeMatcher->isBackendRequest($request))
        {
            $GLOBALS['TL_CSS'][] = 'bundles/contaobackendhelper/backend/css/backend.css|static';
        }
    }
}
