<?php
namspace Landmarx\AttributeBundle\Renderer;

use Landmarx\AttributeBundle\Interfaces\RendererInterface;

class AttributeRenderer implements RendererInterface
{
	/**
	 * Template
	 * @var String $template template
	 */
	protected $template;

	/**
	 * {@inheritdoc}
	 */
	public function render()
	{
		// render.
	}

	/**
	 * Set Template class
	 * @param String $template template class
	 */
	public function setTemplate($template)
	{
		$this->template = $template;

		return $this;
	}

	/**
	 * Get template class 
	 * @return String template class
	 */
	public function getTemplate()
	{
		return $this->template;
	}
}