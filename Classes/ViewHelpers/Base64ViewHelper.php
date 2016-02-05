<?php
namespace BusyNoggin\BnViewhelpers\ViewHelpers;

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

class Base64ViewHelper extends AbstractViewHelper implements CompilableInterface
{
    /**
     * @var bool
     */
    protected $escapingInterceptorEnabled = false;

    /**
     * Counts the items of a given property.
     *
     * @param string $filename
     *
     * @return string
     */
    public function render($filename = null)
    {
        return static::renderStatic(
            array(
                'filename' => $filename
            ),
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    /**
     * @param array $arguments
     * @param callable $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     *
     * @return int
     * @throws Exception
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $filename = $arguments['filename'];
        if (!$filename) {
            $filename = $renderChildrenClosure();
        }

        if (!function_exists('finfo_file')) {
            $fileInfo = new \finfo();
            $mimeType = $fileInfo->file(PATH_site . $filename, FILEINFO_MIME_TYPE);
        } elseif (function_exists('mime_content_type')) {
            $mimeType = mime_content_type(PATH_site . $filename);
        }

        return 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents(PATH_site . $filename));
    }
}
