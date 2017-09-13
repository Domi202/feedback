<?php
namespace In2code\Feedback\Domain\Service;

use In2code\Feedback\Domain\Model\Feedback;
use In2code\Feedback\Domain\Repository\FeedbackRepository;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Domain\Model\BackendUser;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\BackendUserRepository;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;

class FeedbackService implements SingletonInterface
{
    /**
     * @var FeedbackRepository
     */
    protected $feedbackRepository;

    /**
     * @var FrontendUserRepository
     */
    protected $frontendUserRepository;

    /**
     * @var BackendUserRepository
     */
    protected $backendUserRepository;

    /**
     * @param FeedbackRepository $feedbackRepository
     * @return void
     */
    public function injectFeedbackRepository(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * @param FrontendUserRepository $frontendUserRepository
     * @return void
     */
    public function injectFrontendUserRepository(FrontendUserRepository $frontendUserRepository)
    {
        $this->frontendUserRepository = $frontendUserRepository;
    }

    /**
     * @param BackendUserRepository $backendUserRepository
     * @return void
     */
    public function injectBackendUserRepository(BackendUserRepository $backendUserRepository)
    {
        $this->backendUserRepository = $backendUserRepository;
    }

    /**
     * @param int $pageUid
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function getFeedbackForPageUid(int $pageUid)
    {
        if ($pageUid === 0) {
            $query = $this->feedbackRepository->findAll()->getQuery();
            $query->getQuerySettings()->setRespectStoragePage(false);
            return $query->execute();
        }
        return $this->feedbackRepository->findByPid($pageUid);
    }

    /**
     * @param Feedback $feedback
     * @return void
     */
    public function add(Feedback $feedback)
    {
        if ($feUser = $this->getCurrentFrontendUser()) {
            $feedback->setFeUser($feUser);
        }
        if ($beUser = $this->getCurrentBackendUser()) {
            $feedback->setBeUser($beUser);
        }
        $this->feedbackRepository->add($feedback);
    }

    /**
     * @param Feedback $feedback
     * @return void
     */
    public function update(Feedback $feedback)
    {
        $this->feedbackRepository->update($feedback);
    }

    /**
     * @return FrontendUser|null
     */
    public function getCurrentFrontendUser()
    {
        if (isset($GLOBALS['TSFE'])
            && isset($GLOBALS['TSFE']->fe_user)
            && is_array($GLOBALS['TSFE']->fe_user->user['uid'])
            && MathUtility::canBeInterpretedAsInteger($GLOBALS['TSFE']->fe_user->user['uid'])
        ) {
            $userUid = (int) $GLOBALS['TSFE']->fe_user->user['uid'];
            if ($userUid > 0) {
                return $this->frontendUserRepository->findByUid($userUid);
            }
        }
        return null;
    }

    /**
     * @return BackendUser|null
     */
    public function getCurrentBackendUser()
    {
        if (isset($GLOBALS['BE_USER'])
            && is_array($GLOBALS['BE_USER']->user)
            && MathUtility::canBeInterpretedAsInteger($GLOBALS['BE_USER']->user['uid'])
        ) {
            $userUid = (int) $GLOBALS['BE_USER']->user['uid'];
            if ($userUid > 0) {
                return $this->backendUserRepository->findByUid($userUid);
            }
        }
        return null;
    }

    /**
     * @param int $pageUid
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function getFeedbackForPage(int $pageUid)
    {
        return $this->feedbackRepository->findByPid([$pageUid]);
    }
}
