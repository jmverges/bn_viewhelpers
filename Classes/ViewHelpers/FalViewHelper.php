<?php
namespace BusyNoggin\BnViewhelpers\ViewHelpers;

use FluidTYPO3\Vhs\Utility\ResourceUtility;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FalViewHelper extends \FluidTYPO3\Vhs\ViewHelpers\Content\Resources\FalViewHelper
{
    /**
     * @var \TYPO3\CMS\Core\Resource\ResourceFactory
     */
    protected $resourceFactory;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->resourceFactory = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\ResourceFactory');
    }

    /**
     * @param mixed $record
     * @return mixed
     */
    public function getResource($record)
    {
        return $record;
    }
}
