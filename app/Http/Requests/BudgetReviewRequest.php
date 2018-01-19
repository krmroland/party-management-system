<?php

namespace App\Http\Requests;

class BudgetReviewRequest extends BudgetItemRequest
{
    protected $isReviewing = true;

    public function rules()
    {
        $rules = parent::rules();

        $rules['description'] = 'required';

        $rules['reviewed_at'] = 'required';

        return $rules;
    }

    /**
     * Hook into the after validation process.
     *
     * @param Illuminate\Validation\Validator $validator
     */
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateHasChanged($validator);
        });
    }

    /**
     * validate if the budget has changes.
     *
     * @param Illuminate\Validation\Validator $validator
     */
    protected function validateHasChanged($validator)
    {
        if ($this->noChanges()) {
            $validator->errors()->add('review', 'No review made to the budget');
        }
    }

    /**
     * assert that no changes have been made to the budget.
     *
     * @return bool
     */
    protected function noChanges()
    {
        $fields = array_filter($this->route('budget_item')->toArray());

        foreach ($fields as $key => $value) {
            if ($value != $this->{$key}) {
                return false;
                break;
            }
        }

        return true;
    }

    public function messages()
    {
        $messages = parent::messages();
        $messages['reviewed_at.required'] = 'Please specify a date when the review was made';

        return $messages;
    }
}
