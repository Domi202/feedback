<?php
namespace In2code\Feedback\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class FeedbackRepository extends Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = [
        'type' => QueryInterface::ORDER_ASCENDING,
        'crdate' => QueryInterface::ORDER_DESCENDING,
    ];

    /**
     * @return void
     */
    public function initializeObject()
    {
        $querySettings = $this->createQuery()->getQuerySettings();
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * @param int $pageUid
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByPid(int $pageUid)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('pid', $pageUid)
        );
        return $query->execute();
    }
}
