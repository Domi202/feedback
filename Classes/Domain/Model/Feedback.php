<?php
namespace In2code\Feedback\Domain\Model;


use TYPO3\CMS\Extbase\Domain\Model\BackendUser;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Feedback extends AbstractEntity
{
    const TABLE_NAME = 'tx_feedback_domain_model_feedback';

    /**
     * @var \In2code\Feedback\Domain\Model\FeedbackType
     * @lazy
     */
    protected $type = null;

    /**
     * @var \DateTime
     */
    protected $crdate;

    /**
     * @var \DateTime
     */
    protected $tstamp;

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var string
     */
    protected $comment = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\In2code\Feedback\Domain\Model\Answer>
     */
    protected $answers = null;

    /**
     * @var string
     */
    protected $data = '';

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
     * @param string $url
     * @param string $comment
     * @param FrontendUser|null $feUser
     * @param BackendUser|null $beUser
     */
    public function __construct(
        $url = '',
        $comment = '',
        FrontendUser $feUser = null,
        BackendUser $beUser = null
    ) {
        $this->url = $url;
        $this->comment = $comment;
        $this->feUser = $feUser;
        $this->beUser = $beUser;
        $this->answers = new ObjectStorage();
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
     * @return FeedbackType
     */
    public function getType()
    {
        if ($this->type instanceof LazyLoadingProxy) {
            $this->type->_loadRealInstance();
        }
        return $this->type;
    }

    /**
     * @param FeedbackType $type
     * @return void
     */
    public function setType(FeedbackType $type = null)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
     * @return ObjectStorage
     */
    public function getAnswers(): ObjectStorage
    {
        return $this->answers;
    }

    /**
     * @param ObjectStorage $answers
     * @return void
     */
    public function setAnswers(ObjectStorage $answers)
    {
        foreach ($answers as $answer) {
            /** @var Answer $answer */
            $answer->setFeedback($this);
        }
        $this->answers = $answers;
    }

    /**
     * @param Answer $answer
     * @return void
     */
    public function addAnswer(Answer $answer)
    {
        $answer->setFeedback($this);
        $this->answers->attach($answer);
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return unserialize($this->data);
    }

    /**
     * @param string $data
     * @return void
     */
    public function setData(string $data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getUnserializedData()
    {
        return unserialize($this->data);
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
