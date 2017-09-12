<?php
namespace In2code\Feedback\Controller;

use In2code\Feedback\Domain\Model\Comment;
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
            'data' => serialize([
                '_POST' => GeneralUtility::_POST(),
                '_GET' => GeneralUtility::_GET(),
                'env' => GeneralUtility::getIndpEnv('_ARRAY'),
            ]),
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

    /**
     * @param Comment $comment
     * @return void
     *
     * @validate $comment In2code.Feedback:Comment
     */
    public function answerAction(Comment $comment)
    {
        if ($feUser = $this->feedbackService->getCurrentFrontendUser()) {
            $comment->setFeUser($feUser);
        }
        if ($beUser = $this->feedbackService->getCurrentBackendUser()) {
            $comment->setBeUser($beUser);
        }

        $feedback = $comment->getFeedback();
        $feedback->addAnswer($comment);

        $this->feedbackService->update($comment->getFeedback());
        $this->redirect('index');
    }
}
