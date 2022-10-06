<?php

class FormsValidation 
{
    public static function validateHomeFields($data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Field must be filled';
        }

        if (empty($data['city'])) {
            $errors['city'] = 'Field must be filled';
        }

        return $errors;
    }
}