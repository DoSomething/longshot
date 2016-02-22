<?php

class ArrayValidation extends Illuminate\Validation\Validator
{
    public function validateTextFieldArray($field, $values, $params)
    {
        $valid = true;
        foreach ($values as $key => $rec) {
            if (array_filter($rec)) {
                $rules = ['first_name' => 'required', 'last_name' => 'required', 'email' => 'required|email', 'phone' => 'required', 'relationship' => 'required'];
                $validator = Validator::make($rec, $rules);

                if ($validator->fails()) {
                    $valid = false;
                    break;
                }
            }
        }

        return $valid;
    }
}
