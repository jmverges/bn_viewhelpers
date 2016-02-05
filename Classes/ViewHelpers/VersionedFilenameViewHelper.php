<?php
namespace BusyNoggin\BnViewhelpers\ViewHelpers;

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

class VersionedFilenameViewHelper extends AbstractViewHelper implements CompilableInterface
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
    public function render($filename)
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

        $versionedFilename = \TYPO3\CMS\Core\Utility\GeneralUtility::createVersionNumberedFilename($filename);
        return $versionedFilename;
    }
}
