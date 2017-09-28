<?php
namespace In2code\Feedback\Controller;

use In2code\Feedback\Domain\Model\Answer;
use In2code\Feedback\Domain\Model\Feedback;
use In2code\Feedback\Domain\Repository\FeedbackTypeRepository;
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
     * @var FeedbackTypeRepository
     */
    protected $feedbackTypeRepository;

    /**
     * @param FeedbackService $feedbackService
     * @return void
     */
    public function injectFeedbackService(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    /**
     * @param FeedbackTypeRepository $feedbackTypeRepository
     * @return void
     */
    public function injectFeedbackTypeRepository(FeedbackTypeRepository $feedbackTypeRepository)
    {
        $this->feedbackTypeRepository = $feedbackTypeRepository;
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $currentPid = $GLOBALS['TSFE']->id;
        $url = GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL');
        $feedback = $this->feedbackService->getFeedbackForPageUid($currentPid);
        $this->view->assignMultiple([
            'feedback' => $feedback,
            'feedbackTypeCount' => $this->feedbackService->getTypeCount($feedback),
            'feedbackTypes' => $this->feedbackTypeRepository->findAll(),
            'url' => $url,
            'currentPid' => $currentPid,
            'hasValidationErrors' => $this->request->getOriginalRequestMappingResults()->hasErrors(),
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
     * @param Answer $answer
     * @return void
     *
     * @validate $answer In2code.Feedback:Answer
     */
    public function answerAction(Answer $answer)
    {
        if ($feUser = $this->feedbackService->getCurrentFrontendUser()) {
            $answer->setFeUser($feUser);
        }
        if ($beUser = $this->feedbackService->getCurrentBackendUser()) {
            $answer->setBeUser($beUser);
        }

        $feedback = $answer->getFeedback();
        $feedback->addAnswer($answer);

        $this->feedbackService->update($answer->getFeedback());
        $this->redirect('index');
    }
}
