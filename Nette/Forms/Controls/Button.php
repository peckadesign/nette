<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 */

namespace Nette\Forms\Controls;

use Nette;


/**
 * Push button control with no default behavior.
 *
 * @author     David Grudl
 */
class Button extends BaseControl
{

	/** @var string Name of the element to be generated for all buttons; typically input or button */
	public static $defaultButtonElementName = 'input';



	/**
	 * @param  string  caption
	 */
	public function __construct($caption = NULL)
	{
		parent::__construct($caption);
		if ($this->control->getName() !== self::$defaultButtonElementName) {
			$this->control->setName(self::$defaultButtonElementName);
		}
		$this->control->type = 'button';
	}


	/**
	 * Is button pressed?
	 * @return bool
	 */
	public function isFilled()
	{
		$value = $this->getValue();
		return $value !== NULL && $value !== array();
	}


	/**
	 * Bypasses label generation.
	 * @return void
	 */
	public function getLabel($caption = NULL)
	{
		return NULL;
	}


	/**
	 * Generates control's HTML element.
	 * @param  string
	 * @return Nette\Utils\Html
	 */
	public function getControl($caption = NULL)
	{
		$this->setOption('rendered', TRUE);
		$el = clone $this->control;
		$el->addAttributes(array(
			'name' => $this->getHtmlName(),
			'id' => $this->getHtmlId(),
			'disabled' => $this->isDisabled(),
		));


		$value = $this->translate($caption === NULL ? $this->caption : $caption);
		if ($el->getName() === 'button') {
			$el->setText($value);
		} else {
			$el->attrs['value'] = $value;
		}

		return $el;
	}

}
