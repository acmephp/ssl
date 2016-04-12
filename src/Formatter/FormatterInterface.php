<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl\Formatter;

use AcmePhp\Ssl\CertificateResponse;

/**
 * Format and combine certificates.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
interface FormatterInterface
{
    const SEPARATOR = "\n";

    /**
     * Format the given certificate response.
     *
     * @param CertificateResponse $certificateResponse
     *
     * @return string
     */
    public function format(CertificateResponse $certificateResponse);
}
