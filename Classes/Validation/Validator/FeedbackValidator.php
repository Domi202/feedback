<?php
namespace In2code\Feedback\Validation\Validator;

use In2code\Feedback\Domain\Model\Feedback;
use TYPO3\CMS\Extbase\Validation\Validator\GenericObjectValidator;
use TYPO3\CMS\Extbase\Validation\Validator\NotEmptyValidator;
use TYPO3\CMS\Extbase\Validation\Validator\StringValidator;
use TYPO3\CMS\Extbase\Validation\ValidatorResolver;

class FeedbackValidator extends GenericObjectValidator
{
    /**
     * @var ValidatorResolver
     */
    protected $validatorResolver;

    /**
     * @param ValidatorResolver $validatorResolver
     * @return void
     */
    public function injectValidatorResolver(ValidatorResolver $validatorResolver)
    {
        $this->validatorResolver = $validatorResolver;
    }

    /**
     * @param Feedback $object
     * @return void
     */
    protected function isValid($object)
    {
        $this->checkProperty(
            $object->getUrl(),
            [
                $this->validatorResolver->createValidator(NotEmptyValidator::class),
                $this->validatorResolver->createValidator(StringValidator::class)
            ],
            'url'
        );

        $this->checkProperty(
            $object->getComment(),
            [
                $this->validatorResolver->createValidator(NotEmptyValidator::class),
                $this->validatorResolver->createValidator(StringValidator::class)
            ],
            'comment'
        );
    }
}
