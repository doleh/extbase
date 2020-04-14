<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace TYPO3\CMS\Extbase\Tests\Unit\Persistence\Fixture\Model;

/**
 * A model fixture used for testing the persistence manager
 */
class Entity3 extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Just a normal string
     *
     * @var string
     */
    public $someString;

    /**
     * @var int
     */
    public $someInteger;
}
