<?php

declare(strict_types=1);

/*
 * This file is part of contao-garage/contao-modal-dialog.
 *
 * @author    Martin Schumann <martin.schumann@ontao-garage.de>
 * @license   MIT
 * @copyright Contao Garage 2026
 */

namespace ContaoGarage\ModalDialog;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ModalDialogBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
