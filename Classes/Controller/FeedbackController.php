<?php
namespace In2code\Feedback\Controller;

use In2code\Feedback\Domain\Model\Feedback;
use In2code\Feedback\Domain\Service\FeedbackService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class FeedbackController extends ActionController
{
    /**
     * @var FeedbackService
     */
    protected $feedbackService;

    /**
     * @param FeedbackService $feedbackService
     * @return void
     */
    public function injectFeedbackService(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $currentPid = $GLOBALS['TSFE']->id;
        $url = GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL');
        $this->view->assignMultiple([
            'feedback' => $this->feedbackService->getFeedbackForPageUid($currentPid),
            'url' => $url,
            'currentPid' => $currentPid,
        ]);
    }

    /**
     * @param Feedback $feedback
     * @return void
     *
     * @validate $feedback In2code.Feedback:Feedback
     */
    public function saveAction(Feedback $feedback)
    {
        $this->feedbackService->add($feedback);
        $this->redirect('index');
    }
}
