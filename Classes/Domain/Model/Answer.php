<?php
namespace In2code\Feedback\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\BackendUser;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

class Answer extends AbstractEntity
{
    const TABLE_NAME = 'tx_feedback_domain_model_answer';

    /**
     * @var \DateTime
     */
    protected $crdate;

    /**
     * @var \DateTime
     */
    protected $tstamp;

    /**
     * @var \In2code\Feedback\Domain\Model\Feedback
     * @lazy
     */
    protected $feedback = null;

    /**
     * @var string
     */
    protected $comment = '';

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     * @lazy
     */
    protected $feUser = null;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\BackendUser
     * @lazy
     */
    protected $beUser = null;

    /**
     * @param string $comment
     * @param Feedback $feedback
     * @param FrontendUser $feUser
     * @param BackendUser $beUser
     */
    public function __construct(
        $comment = '',
        Feedback $feedback = null,
        FrontendUser $feUser = null,
        BackendUser $beUser = null
    ) {
        $this->comment = $comment;
        $this->feedback = $feedback;
        $this->feUser = $feUser;
        $this->beUser = $beUser;
    }

    /**
     * @return \DateTime
     */
    public function getCrdate()
    {
        return $this->crdate;
    }

    /**
     * @return \DateTime
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * @return Feedback
     */
    public function getFeedback(): Feedback
    {
        return $this->feedback;
    }

    /**
     * @param Feedback $feedback
     * @return void
     */
    public function setFeedback(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return void
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return FrontendUser
     */
    public function getFeUser()
    {
        if ($this->feUser instanceof LazyLoadingProxy) {
            $this->feUser->_loadRealInstance();
        }
        return $this->feUser;
    }

    /**
     * @param FrontendUser $feUser
     * @return void
     */
    public function setFeUser(FrontendUser $feUser = null)
    {
        $this->feUser = $feUser;
    }

    /**
     * @return BackendUser
     */
    public function getBeUser()
    {
        if ($this->beUser instanceof LazyLoadingProxy) {
            $this->beUser->_loadRealInstance();
        }
        return $this->beUser;
    }

    /**
     * @param BackendUser $beUser
     * @return void
     */
    public function setBeUser(BackendUser $beUser)
    {
        $this->beUser = $beUser;
    }
}
