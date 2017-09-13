<?php
namespace In2code\Feedback\Validation\Validator;

use In2code\Feedback\Domain\Model\Answer;
use TYPO3\CMS\Extbase\Validation\Validator\GenericObjectValidator;
use TYPO3\CMS\Extbase\Validation\Validator\NotEmptyValidator;
use TYPO3\CMS\Extbase\Validation\Validator\StringValidator;
use TYPO3\CMS\Extbase\Validation\ValidatorResolver;

class AnswerValidator extends GenericObjectValidator
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
     * @param Answer $object
     * @return void
     */
    protected function isValid($object)
    {
        if (!($object instanceof Answer)) {
            throw new \RuntimeException('Object has to be of type ' . Answer::class);
        }

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
