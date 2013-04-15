<?php
/**
 * Defines AbstractWriter class.
 *
 * @author Henrique Barcelos
 */
namespace GdWrapper\Io\Writer;

use GdWrapper\Resource\Resource;
use GdWrapper\Io\Preset;
use GdWrapper\Io\Exception;

/**
 * Defines an abstract implementation of a I/O device for resources.
 */
abstract class AbstractWriter implements Writer
{
	/**
	 * @var Resource The Resource object this object will work on.
	 */
	private $resource;

	/**
	 * Creates a new output "device".
	 *
	 * @param \GdWrapper\Resource\Resource $resource An image resource.
	 */
	public function __construct(Resource $resource)
	{
		$this->setResource($resource);
	}

	/**
	 * {@inheritdoc}
	 *
	 * @see \GdWrapper\Io\Writer::getResource()
	 */
	public function getResource()
	{
		return $this->resource;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @see \GdWrapper\Io\Writer::setResource()
	 */
	public function setResource(Resource $resource)
	{
		$this->resource = $resource;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @see \GdWrapper\Io\Writer\Writer::write()
	 */
	public function write(
		$path = null,
		$quality = Preset::IMAGE_QUALITY_MAX,
		$_ = null
	) {
		if ($path !== null) {
			$dirname = dirname(realpath($path));
			if(!is_writable($dirname)) {
				throw new Exception(
					"You do not have writing permissions in directory '" 
					. $dirname . "'"
				);
			}
		}
		
		$this->doWrite($path, $quality, $_);
	}
	
	/**
	 * Concrete implementors should implement this operation.
	 * This is method is executed at the end of 
	 * {@link \GdWrapper\Io\Writer\AbstractWriter::write()}
	 *
	 * @param string $path (optional) A path where to save the resource.
	 * @param int $quality (optional) The quality of generated image.
	 * 		Its value MUST be in a range from 0 to 100.
	 * @param mixed $_ (optional) Additional parameters passed to
	 * 		the concrete implementation method.
	 * 
	 * @return void
	 * 
	 * @throws Exception If can't write the contents on file system.
	 * 
	 * @see \GdWrapper\Io\Preset
	 */
	abstract protected function doWrite(
		$path = null,
		$quality = Preset::IMAGE_QUALITY_MAX,
		$_ = null
	);
}