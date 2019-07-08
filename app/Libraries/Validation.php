<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Libraries\Response;
use App\Exceptions\ValidationException;

class Validation
{
    private static $validateEachFunction;
    private static $ruler;

    public static function rulesOfFunction(array $ruler)
    {
        self::$ruler = $ruler;
        self::$validateEachFunction = true;
        return new self;
    }

    public static function rules(array $ruler)
    {
        self::$ruler = $ruler;
        self::$validateEachFunction = false;
        return new self;
    }

    public function validate(Request $request)
    {
        $rules = self::$ruler;
        if (self::$validateEachFunction) {
            $func = debug_backtrace()[1]['function'];
            $rules = self::$ruler[$func];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }
    }
}