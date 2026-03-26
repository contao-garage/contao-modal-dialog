<?php

declare(strict_types=1);

/*
 * This file is part of contao-garage/contao-modal-dialog.
 *
 * @author    Martin Schumann <martin.schumann@ontao-garage.de>
 * @license   LGPL-3.0-or-later
 * @copyright Contao Garage 2026
 */

namespace ContaoGarage\ModalDialog\EventListener;

use Contao\ContentModel;
use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\DataContainer;
use Contao\Message;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContentLoadConfigListener
{
    private $request;

    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly TranslatorInterface $translator,
        private readonly string $projectDir,
    ) {
        $this->request = $this->requestStack->getCurrentRequest();
    }

    public function onLoadConfig(DataContainer|null $dc = null): void
    {
        $palettes = ['text'];

        if ($dc) {
            $model = ContentModel::findById($dc->id);

            if (
                'edit' === $this->request->query->get('act')
                // && 'POST' !== $this->request->getMethod()
                && null !== $model
                && \in_array($model->type, $palettes, true)
            ) {
                // Display a note that template legacy mode is not supported
                if ('GET' === $this->request->getMethod()) {
                    Message::addInfo(\sprintf(
                        $this->translator->trans('message.unsupportedLegacyMode', [], 'ModalDialogBundle'),
                        $this->translator->trans("CTE.{$model->type}.0", [], 'contao_default'),
                        $this->translator->trans('name', [], 'ModalDialogBundle'),
                    ));
                }

                // Add fields to palettes
                $GLOBALS['TL_DCA'][$dc->table]['palettes']['__selector__'][] = 'addModalDialog';
                $GLOBALS['TL_DCA'][$dc->table]['subpalettes']['addModalDialog'] = 'modalDialogText';

                $manipulator = PaletteManipulator::create()
                    ->addLegend('dialog_legend', 'type_legend', PaletteManipulator::POSITION_AFTER)
                    ->addField('addModalDialog', 'dialog_legend', PaletteManipulator::POSITION_APPEND)
                ;

                foreach ($palettes as $palette) {
                    $manipulator->applyToPalette($palette, $dc->table);
                }
            }
        }
    }
}
