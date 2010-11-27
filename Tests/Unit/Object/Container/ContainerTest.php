<?php
/***************************************************************
*  Copyright notice
*  (c) 2010 Daniel Pötzinger
*  (c) 2010 Bastian Waidelich <bastian@typo3.org>
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

require_once(t3lib_extMgm::extPath('extbase') . 'Tests/Unit/Object/Container/Fixtures/Testclasses.php');

/**
 * Testcase for class t3lib_object_Container.
 *
 * @author Daniel Pötzinger
 * @author Bastian Waidelich <bastian@typo3.org>
 * @package TYPO3
 * @subpackage t3lib
 */
class Tx_Extbase_Object_Container_ContainerTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	private $container;

	public function setUp() {
		$this->container = Tx_Extbase_Object_Container_Container::getContainer();

	}

	/**
	 * @test
	 */
	public function getInstanceReturnsInstanceOfSimpleClass() {
		$object = $this->container->getInstance('t3lib_object_tests_c');
		$this->assertType('t3lib_object_tests_c', $object);
	}

	/**
	 * @test
	 */
	public function getInstanceReturnsInstanceOfAClassWithDependency() {
		$object = $this->container->getInstance('t3lib_object_tests_b');
		$this->assertType('t3lib_object_tests_b', $object);
	}

	/**
	 * @test
	 */
	public function getInstanceReturnsInstanceOfAClassWithTwoLevelDependency() {
		$object = $this->container->getInstance('t3lib_object_tests_a');
		$this->assertType('t3lib_object_tests_a', $object);
	}

	/**
	 * @test
	 */
	public function getInstanceReturnsInstanceOfAClassWithTwoLevelMixedArrayDependency() {
		$object = $this->container->getInstance('t3lib_object_tests_amixed_array');
		$this->assertType('t3lib_object_tests_amixed_array', $object);
	}

	/**
	 * @test
	 */
	public function getInstanceReturnsInstanceOfAClassWithTwoLevelMixedStringDependency() {
		$object = $this->container->getInstance('t3lib_object_tests_amixed_string');
		$this->assertType('t3lib_object_tests_amixed_string', $object);
	}

	/**
	 * @test
	 */
	public function getInstancePassesGivenParameterToTheNewObject() {
		$mockObject = $this->getMock('t3lib_object_tests_c');

		$object = $this->container->getInstance('t3lib_object_tests_a', $mockObject);
		$this->assertType('t3lib_object_tests_a', $object);
		$this->assertSame($mockObject, $object->c);
	}

	/**
	 * @test
	 */
	public function getInstanceReturnsAFreshInstanceIfObjectIsNoSingleton() {
		$object1 = $this->container->getInstance('t3lib_object_tests_a');
		$object2 = $this->container->getInstance('t3lib_object_tests_a');

		$this->assertNotSame($object1, $object2);
	}

	/**
	 * @test
	 */
	public function getInstanceReturnsSameInstanceInstanceIfObjectIsSingleton() {
		$object1 = $this->container->getInstance('t3lib_object_tests_singleton');
		$object2 = $this->container->getInstance('t3lib_object_tests_singleton');

		$this->assertSame($object1, $object2);
	}

	/**
	 * @test
	 * @expectedException Exception
	 */
	public function getInstanceThrowsExceptionIfObjectContainsCyclicDependency() {
		$this->container->getInstance('t3lib_object_tests_cyclic1');

	}

	/**
	 * @test
	 * @expectedException Exception
	 */
	public function getInstanceThrowsExceptionIfClassWasNotFound() {
		$this->container->getInstance('nonextistingclass_bla');

	}

	/**
	 * @test
	 */
	public function test_canGetChildClass() {
		$object = $this->container->getInstance('t3lib_object_tests_b_child');
		$this->assertType('t3lib_object_tests_b_child', $object);
	}

	/**
	 * @test
	 */
	public function test_canInjectInterfaceInClass() {
		$this->container->registerImplementation('t3lib_object_tests_someinterface', 't3lib_object_tests_someimplementation');
		$object = $this->container->getInstance('t3lib_object_tests_needsinterface');
		$this->assertType('t3lib_object_tests_needsinterface', $object);
	}

	/**
	 * @test
	 */
	public function test_canBuildCyclicDependenciesWithSetter() {
		$object = $this->container->getInstance('t3lib_object_tests_resolveablecyclic1');
		$this->assertType('t3lib_object_tests_resolveablecyclic1', $object);
		$this->assertType('t3lib_object_tests_resolveablecyclic1', $object->o->o);
	}



}


?>
