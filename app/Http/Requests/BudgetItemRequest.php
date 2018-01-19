<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BudgetItemRequest extends FormRequest
{
    /**
     * if the budget is being reviewed.
     *
     * @var bool
     */
    protected $isReviewing = false;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', $this->uniqueRule()],
            'qty' => 'nullable|numeric',
            'unitCost' => 'nullable|numeric',
            'qtyUnits' => 'nullable',
            'total' => 'required|numeric',
            'isCovered' => 'nullable',
            'type' => 'required',
            'budget_category_id' => 'required|numeric|min:0',
        ];
    }

    public function uniqueRule()
    {
        $rule = Rule::unique('budget_items');
        if ($this->isUpdating() || $this->isReviewing) {
            $rule->ignore($this->route('budget_item')->id);
        }

        return $rule;
    }

    protected function isUpdating()
    {
        $method = $this->method();

        return 'PUT' === $method || 'PATCH' === $method;
    }

    public function messages()
    {
        return ['name.unique' => "{$this->name} already exits"];
    }
}
