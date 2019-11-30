<?php 

namespace Pingu\Block\Traits;

use Illuminate\Http\Request;

trait ValidatesBlockOptionsRequest
{   
    /**
     * Default data for this block
     * 
     * @return array
     */
    public function getDefaultData(): array
    {
        return [];
    }

    /**
     * Validation messages for an options request
     * 
     * @return array
     */
    protected abstract function getOptionsValidationMessages(): array;

    /**
     * Validation rules for an options request
     * 
     * @return array
     */
    protected abstract function getOptionsValidationRules(): array();

    /**
     * @inheritDoc
     */
    public function validateOptionsRequest(Request $request): array
    {
        $rules = $this->getOptionsValidationRules();
        $messages = $this->getOptionsValidationMessages();
        $validator = \Validator::make($request->post(), $rules, $messages);
        $validator->validate();
        $validated = $validator->validated();
        return array_merge($this->getDefaultData(), $validated);
    }
}