<?php
declare(strict_types = 1);

namespace LMS\Routes\Support;

/* * *************************************************************
 *
 *  Copyright notice
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
 * ************************************************************* */

use LMS\Routes\Support\Extbase\Response;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait Error
{
    /**
     * Build exception error message based on request type
     *
     * @api
     *
     * @param \Exception $exception
     *
     * @return string
     */
    public static function generateMessageFor(\Exception $exception): string
    {
        $message = $exception->getMessage();

        if ($message === '') {
            $message = class_basename($exception);
        }

        return self::buildErrorWith($message);
    }

    /**
     * @param string
     *
     * @return string
     */
    private static function buildErrorWith(string $message): string
    {
        if (Response::isJson()) {
            return json_encode(['error' => $message]);
        }

        return $message;
    }
}
