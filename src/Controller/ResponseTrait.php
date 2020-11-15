<?php

namespace App\Controller;

use App\Model\Response\BaseResponseModel;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

trait ResponseTrait
{
    /**
     * @param BaseResponseModel $baseResponseModel
     * @return Response
     */
    private function apiResponse(BaseResponseModel $baseResponseModel)
    {
        return $this->handleView(
            (new View())
                ->setFormat('json')
                ->setStatusCode($baseResponseModel->getStatusCode())
                ->setData([
                    'success' => $baseResponseModel->isSuccess(),
                    'data' => $baseResponseModel->getData(),
                    'errors' => $baseResponseModel->getErrors()
                ])
        );
    }

    /**
     * @param array|object $data
     * @param int $statusCode
     * @return Response
     */
    public function successResponse($data, int $statusCode = Response::HTTP_OK)
    {
        return $this->apiResponse(
            new BaseResponseModel(
                true,
                $data,
                null,
                $statusCode
            )
        );
    }

    /**
     * @param ConstraintViolationListInterface $validationErrors
     * @return Response
     */
    public function validationErrorResponse(ConstraintViolationListInterface $validationErrors)
    {
        $errorCollection = new ArrayCollection();
        if ($validationErrors->count()){
            foreach ($validationErrors as $validationError){
                $errorCollection->set(
                    $validationError->getPropertyPath(),
                    $validationError->getMessage()
                );
            }
        }

        return $this->apiResponse(
            new BaseResponseModel(
                false,
                null,
                $errorCollection->toArray(),
                Response::HTTP_NOT_ACCEPTABLE
            )
        );
    }

    /**
     * @param $error
     * @param int $statusCode
     * @return Response
     */
    public function customErrorResponse($error, int $statusCode)
    {
        return $this->apiResponse(
            new BaseResponseModel(
                false,
                null,
                $error,
                $statusCode
            )
        );
    }

    /**
     * @param $error
     * @return Response
     */
    public function notFoundErrorResponse($error)
    {
        return $this->apiResponse(
            new BaseResponseModel(
                false,
                null,
                $error,
                Response::HTTP_NOT_FOUND
            )
        );
    }
}