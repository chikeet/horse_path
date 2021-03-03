<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\Utils;

use function is_string;
use function preg_match;

class UuidGenerator
{
    public const UUID4_PATTERN = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

	/**
	 * From https://stackoverflow.com/a/2040279
	 * @return string
	 */
	public static function generateUuid4() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			// 32 bits for "time_low"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

			// 16 bits for "time_mid"
			mt_rand( 0, 0xffff ),

			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand( 0, 0x0fff ) | 0x4000,

			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand( 0, 0x3fff ) | 0x8000,

			// 48 bits for "node"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}


    /**
     * Returns true if given value is a valid UUID4 string.
     * @param mixed $value
     * @return bool
     */
    public static function isValidUuid4($value): bool
	{
        if(!is_string($value)){
            return false;
        }
        return preg_match(self::UUID4_PATTERN, $value);
	}

}
