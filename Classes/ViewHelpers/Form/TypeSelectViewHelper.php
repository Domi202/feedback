<?php
namespace In2code\Feedback\ViewHelpers\Form;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Dominique Kreemers <dominique.kreemers@in2code.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use In2code\Feedback\Domain\Repository\FeedbackTypeRepository;
use TYPO3\CMS\Fluid\ViewHelpers\Form\SelectViewHelper;

/**
 * TypeSelectViewHelper
 */
class TypeSelectViewHelper extends SelectViewHelper
{
    /**
     * @var FeedbackTypeRepository
     */
    protected $feedbackTypeRepository;

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
    public function initialize()
    {
        parent::initialize();
        $this->arguments['options'] = $this->feedbackTypeRepository->findAll();
        $this->arguments['optionLabelField'] = 'title';
    }
}
