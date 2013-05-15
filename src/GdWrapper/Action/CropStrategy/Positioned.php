<?php
/**
 * Defines abstract class Positioned.
 *
 * @author Henrique Barcelos
 */
namespace GdWrapper\Action\CropStrategy;

use GdWrapper\Geometry\Position\Position;

/**
 * Defines positioned cropping strategies commons.
 */
abstract class Positioned implements Strategy
{
    /**
     * @var \GdWrapper\Geometry\Position\Position The position of the cropping
     */
    private $position;
    
	/**
	 * Creates a positioned cropping.
	 *
	 * @param Position $position The position of the cropping.
	 */
	protected function __construct(Position $position)
	{
		$this->setPosition($position);
	}
	
    /**
     * Obtains the position of the cropping.
     *
     * @return \GdWrapper\Geometry\Position\Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the position of the cropping.
     *
     * @param $position
     *
     * @return void
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}