<?php
namespace In2code\Feedback\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class FeedbackType extends AbstractEntity
{
    const TABLE_NAME = 'tx_feedback_domain_model_feedbacktype';

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @param string $title
     */
    public function __construct(string $title = '')
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}
