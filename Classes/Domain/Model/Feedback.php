<?php
namespace In2code\Feedback\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

class Feedback extends AbstractEntity
{
    const TABLE_NAME = 'tx_feedback_domain_model_feedback';

    /**
     * @var string
     */
    protected $type = self::class;

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
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     * @lazy
     */
    protected $user = null;

    /**
     * @param string $url
     * @param string $comment
     * @param FrontendUser $user
     */
    public function __construct(
        $url = '',
        $comment = '',
        FrontendUser $user = null
    ) {
        $this->url = $url;
        $this->comment = $comment;
        $this->user = null;
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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return void
     */
    public function setType($type)
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
     * @return FrontendUser
     */
    public function getUser()
    {
        if ($this->user instanceof LazyLoadingProxy) {
            $this->user->_loadRealInstance();
        }
        return $this->user;
    }

    /**
     * @param FrontendUser $user
     * @return void
     */
    public function setUser(FrontendUser $user = null)
    {
        $this->user = $user;
    }
}
