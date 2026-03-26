<?php

declare(strict_types=1);

/*
 * This file is part of contao-garage/contao-modal-dialog.
 *
 * @author    Martin Schumann <martin.schumann@ontao-garage.de>
 * @license   LGPL-3.0-or-later
 * @copyright Contao Garage 2026
 */

$GLOBALS['TL_DCA']['tl_content']['fields']['addModalDialog'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => [
        'doNotCopy' => true,
        'submitOnChange' => true,
        'tl_class' => 'w50 m12',
    ],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['modalDialogText'] = [
    'exclude' => true,
    'search' => true,
    'inputType' => 'textarea',
    'eval' => [
        'mandatory' => true,
        'basicEntities' => true,
        'rte' => 'tinyMCE',
        'helpwizard' => true,
        'tl_class' => 'clr',
    ],
    'explanation' => 'insertTags',
    'sql' => "mediumtext NULL"
];