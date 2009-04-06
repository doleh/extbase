<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Jochen Rau <jochen.rau@typoplanet.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Contract for a validator
 *
 * @package TYPO3
 * @subpackage extbase
 * @version $ID:$
 */
interface Tx_Extbase_Validation_Validator_ValidatorInterface {

	/**
	 * Checks if the given value is valid according to the validator.
	 *
	 * If at least one error occurred, the result is FALSE and any errors will
	 * be stored in the given errors object.
	 *
	 * Depending on the validator implementation, additional options may be passed
	 * in an array.
	 *
	 * @param mixed $value The value that should be validated
	 * @param Tx_Extbase_Validation_Errors $errors An Errors object which will contain any errors which occurred during validation
	 * @param array $validationOptions Not used
	 * @return boolean TRUE if the value is valid, FALSE if an error occured
	 */
	public function isValid($value, Tx_Extbase_Validation_Errors &$errors, array $validationOptions = array());
}

?>