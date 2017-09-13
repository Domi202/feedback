<?php
namespace In2code\Feedback\Controller;

use In2code\Feedback\Domain\Service\FeedbackService;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

class BackendController extends ActionController
{
    /**
    * @var string
    */
    protected $defaultViewObjectName = BackendTemplateView::class;

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
     * @param ViewInterface $view
     */
    protected function initializeView(ViewInterface $view)
    {
        parent::initializeView($view);
        /** @var PageRenderer $pageRenderer */
        $view
            ->getModuleTemplate()
            ->getPageRenderer()
            ->addCssFile('EXT:feedback/Resources/Public/Css/feedback.css');
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $currentPid = GeneralUtility::_GET('id');
        $this->view->assignMultiple([
            'feedback' => $this->feedbackService->getFeedbackForPageUid($currentPid ? : 0),
        ]);
    }
}
