<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting\VO;

readonly class Customer
{
    public function __construct(
        public int    $id,
        public string $tin
    )
    {
    }


    // "Id" => 32252155
    //      "Inn" => "6685091014"
    //      "Ogrn" => "1156658020200"
    //      "Okpo" => null
    //      "Kpp" => "668501001"
    //      "Name" => "ООО "АВТОВЕКТОР""
    //      "ShortName" => "ООО "АВТОВЕКТОР""
    //      "Type" => 2
    //      "Form" => 1
    //      "IsArchived" => false
    //      "LegalAddress" => "620007, СВЕРДЛОВСКАЯ ОБЛАСТЬ, ГОРОД ЕКАТЕРИНБУРГ Г.О., Г ЕКАТЕРИНБУРГ, СИБИРСКИЙ ТРАКТ 10 КМ, СТР. 7, КОРП. ЭТАЖ 2, ПОМЕЩ. 9"
    //      "ActualAddress" => "620007, СВЕРДЛОВСКАЯ ОБЛАСТЬ, ГОРОД ЕКАТЕРИНБУРГ Г.О., Г ЕКАТЕРИНБУРГ, СИБИРСКИЙ ТРАКТ 10 КМ, СТР. 7, КОРП. ЭТАЖ 2, ПОМЕЩ. 9"
    //      "RegistrationAddress" => null
    //      "TaxpayerNumber" => null
    //      "AdditionalRegNumber" => null
    //      "SubcontoId" => 172231449
    //      "Fio" => null
    //      "SignerFio" => "БРЫЗГАЛОВ АЛЕКСАНДР АНАТОЛЬЕВИЧ"
    //      "InFace" => "Директора Брызгалова Александра Анатольевича"
    //      "Position" => "Директор"
    //      "InReason" => ""
    //      "PersonalData" => ""
}