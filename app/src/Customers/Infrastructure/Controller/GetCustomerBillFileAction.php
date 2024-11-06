<?php
declare(strict_types=1);


namespace App\Customers\Infrastructure\Controller;

use App\Customers\Application\UseCase\Query\GetCustomerBillFile\GetCustomerBillFileQuery;
use App\Customers\Application\UseCase\Query\GetCustomerBillFile\GetCustomerBillFileQueryResult;
use App\Customers\Domain\Repository\CustomerRepositoryInterface;
use App\Customers\Infrastructure\Mapper\CustomerMapper;
use App\Shared\Application\Event\EventBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Application\Service\AccountingServiceInterface;
use App\Shared\Domain\Service\RequestHeadersService;
use App\Shared\Infrastructure\Exception\AppException;
use App\Shared\Infrastructure\Validation\Validator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/customer/bill/download', methods: ['POST'])]
class GetCustomerBillFileAction extends BaseController
{
    public function __construct(
        private readonly QueryBusInterface   $queryBus,
        private readonly Validator           $validator,
        private readonly CustomerMapper      $customerMapper,
        readonly RequestHeadersService       $headersService,
        readonly CustomerRepositoryInterface $customerRepository,
        readonly AccountingServiceInterface  $accountingService,
        readonly EventBusInterface           $eventBus
    )
    {
        parent::__construct($headersService, $customerRepository, $accountingService, $eventBus);
    }

    public function __invoke(Request $request): StreamedResponse
    {
        $data = $request->getPayload()->all();
        $errors = $this->validator->validate($data, $this->customerMapper->getValidationCollectionCustomerBillFile());
        if ($errors) {
            throw new AppException(current($errors)->getFullMessage());
        }
        $filter = $this->customerMapper->buildCustomerBillFileFilterFromRequest($request);
        /** @var GetCustomerBillFileQueryResult $result */
        $result = $this->queryBus->execute(new GetCustomerBillFileQuery($filter));
        $body = $result->responseFile->getFile();
        $response = new StreamedResponse(function () use ($body) {
            while (!$body->eof()) {
                echo $body->read(1024);
            }
        });

        $response->headers->set('Content-Type', $result->responseFile->getContentType());

        return $response;
        return new BinaryFileResponse(new \SplFileInfo($result->responseFile->getFile()));
    }

}