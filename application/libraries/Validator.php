<?php

class Validator extends Laravel\Validator {
    
    /**
     * Validate that an attribute contains only alpha-numeric characters, dashes, underscores and spaces.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function validate_alpha_space($attribute, $value)
    {
        return preg_match('/^([-a-z0-9_ ])+$/i', $value);
    }

}
