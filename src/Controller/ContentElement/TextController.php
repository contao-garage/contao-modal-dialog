<?php

declare(strict_types=1);

/*
 * This file is part of contao-garage/contao-modal-dialog.
 *
 * @author    Martin Schumann <martin.schumann@ontao-garage.de>
 * @license   MIT
 * @copyright Contao Garage 2026
 */

namespace ContaoGarage\ModalDialog\Controller\ContentElement;

use Contao\CoreBundle\Controller\ContentElement\TextController as ContaoTextController;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class TextController extends ContaoTextController
{
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if (!$this->isBackendScope($request)) {
            $GLOBALS['TL_JAVASCRIPT'][] = $request->getScheme().'://'.$request->getHost().'/assets/contao-vue-js/vue/dist/vue.global.prod.js';
            $GLOBALS['TL_CSS'][] = 'bundles/modaldialog/css/modal-dialog.css|static';
        }
    }
}
