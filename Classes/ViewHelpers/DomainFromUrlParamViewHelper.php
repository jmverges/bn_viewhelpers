<?php
namespace BusyNoggin\BnViewhelpers\ViewHelpers;

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

class DomainFromUrlParamViewHelper extends AbstractViewHelper implements CompilableInterface
{

    /**
     * Get a domain model based on URL param
     *
     * @param string $repositoryPath
     * @param string $urlParam
     * @param string $as
     * @param string $urlNamespace
     *
     * @return string
     */
    public function render($repositoryPath, $urlParam, $as, $urlNamespace = null)
    {
        return static::renderStatic(
            array(
                'repositoryPath' => $repositoryPath,
                'urlParam' => $urlParam,
                'urlNamespace' => $urlNamespace,
                'as' => $as
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
        if ($arguments['urlNamespace']) {
            $namespaceArray = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP($arguments['urlNamespace']);
            $uid = $namespaceArray[$arguments['urlParam']];
        } else {
            $uid = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP($arguments['urlParam']);
        }

        $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        $repository = $objectManager->get($arguments['repositoryPath']);
        $domain = $repository->findByUid($uid);

        if ($domain) {
            $templateVariableContainer = $renderingContext->getTemplateVariableContainer();
            $templateVariableContainer->add($arguments['as'], $domain);
        }

        $output = $renderChildrenClosure();

        if ($domain) {
            $templateVariableContainer->remove($arguments['as']);
        }

        return $output;
    }
}
