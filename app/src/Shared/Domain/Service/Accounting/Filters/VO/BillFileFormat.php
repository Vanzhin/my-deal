<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting\Filters\VO;

enum BillFileFormat: string
{
    /*
     * PDF.
     */
    case PDF = 'pdf';

    /*
     * Doc.
     */
    case DOC = 'doc';

    /*
     * XLS.
     */
    case XSL = 'xls';
    /*
     * Zip.
     */
    case ZIP = 'zip';

    static function getAllValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}