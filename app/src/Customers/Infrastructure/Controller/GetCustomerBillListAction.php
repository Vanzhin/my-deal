<?php
declare(strict_types=1);


namespace App\Customers\Infrastructure\Controller;

use App\Customers\Application\UseCase\Query\GetPagedCustomerBills\GetPagedCustomerBillsQuery;
use App\Customers\Domain\Repository\CustomerRepositoryInterface;
use App\Customers\Infrastructure\Mapper\CustomerMapper;
use App\Shared\Application\Event\EventBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Application\Service\AccountingServiceInterface;
use App\Shared\Domain\Service\RequestHeadersService;
use App\Shared\Infrastructure\Exception\AppException;
use App\Shared\Infrastructure\Validation\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/customer/bill/list', methods: ['GET'])]
class GetCustomerBillListAction extends BaseController
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

    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->query->all();
        $errors = $this->validator->validate($data, $this->customerMapper->getValidationCollectionCustomerBillList());
        if ($errors) {
            throw new AppException(current($errors)->getFullMessage());
        }
        $filter = $this->customerMapper->buildCustomerBillFilterFromRequest($request, $this->kontragentId);
        $result = $this->queryBus->execute(new GetPagedCustomerBillsQuery($filter));

        return new JsonResponse($result);
    }

}