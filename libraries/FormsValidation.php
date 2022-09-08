<?php

class FormsValidation {
    function validateHomeFields($data){
        $errors = [];

        if (empty($data['homeName'])) {
            $errors['homeName'] = 'Field must be filled';
        }

        if (empty($data['city'])) {
            $errors['city'] = 'Field must be filled';
        }

        return $errors;
    }
}