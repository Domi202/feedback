<?php
namespace In2code\Feedback\Domain\Service;

use In2code\Feedback\Domain\Model\Feedback;
use In2code\Feedback\Domain\Repository\FeedbackRepository;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
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
     * @param int $pageUid
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function getFeedbackForPageUid(int $pageUid)
    {
        return $this->feedbackRepository->findByPid($pageUid);
    }

    /**
     * @param Feedback $feedback
     * @return void
     */
    public function add(Feedback $feedback)
    {
        if ($user = $this->getCurrentFrontendUser()) {
            $feedback->setUser($user);
        }
        $this->feedbackRepository->add($feedback);
    }

    /**
     * @return FrontendUser|null
     */
    protected function getCurrentFrontendUser()
    {
        if (isset($GLOBALS['TSFE']->fe_user->user['uid'])) {
            $userUid = (int) $GLOBALS['TSFE']->fe_user->user['uid'];
            if ($userUid > 0) {
                return $this->frontendUserRepository->findByUid($userUid);
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
