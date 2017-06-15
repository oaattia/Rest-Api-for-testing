<?php

namespace Oaattia\RoleBasedGameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @var int Status Code.
     */
    private $statusCode = Response::HTTP_OK;

    /**
     * Getter method to return stored status code.
     *
     * @return mixed
     */
    public function getStatusCode() : int
    {
        return $this->statusCode;
    }

    /**
     * Setter method to set status code.
     * It is returning current object
     * for chaining purposes.
     *
     * @param mixed $statusCode
     * @return ApiController.
     */
    public function setStatusCode(int $statusCode) : ApiController
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Function to return an unauthorized response.
     *
     * @param string $message
     * @return mixed
     */
    public function respondUnauthorizedError(string $message = 'Unauthorized!')
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

    /**
     * Function to return forbidden error response.
     * @param string $message
     * @return mixed
     */
    public function respondForbiddenError(string $message = 'Forbidden!')
    {
        return $this->setStatusCode(Response::HTTP_FORBIDDEN)->respondWithError($message);
    }

    /**
     * Function to return a Not Found response.
     *
     * @param string $message
     * @return mixed
     */
    public function respondNotFound(string $message = 'Not Found')
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * Function to return an internal error response.
     *
     * @param string $message
     * @return mixed
     */
    public function respondInternalError(string $message = 'Internal Error!')
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }


    /**
     * Function to return a service unavailable response.
     *
     * @param string $message
     * @return mixed
     */
    public function respondServiceUnavailable(string $message = "Service Unavailable!")
    {
        return $this->setStatusCode(Response::HTTP_SERVICE_UNAVAILABLE)->respondWithError($message);
    }


    /**
     * @param string $message
     * @param array $links
     *
     * @return mixed
     */
    public function respondCreated(array $links, string $message = "Successfully Created") : array
    {
        return $this->setStatusCode(Response::HTTP_CREATED)
            ->respond(
                ['message' => $message],
                $links
            );
    }



    /**
     * @param string $message
     * @param array $links
     *
     * @return mixed
     */
    public function respondOK(array $links, string $message = "Successfully OK") : array
    {
        return $this->setStatusCode(Response::HTTP_OK)
            ->respond(
                ['message' => $message],
                $links
            );
    }




    /**
     * Function to return a generic response.
     *
     * @param array $data
     * @param array $links
     * @return array response
     */
    private function respond(array $data, array $links) : array
    {
        $responseLinks = array_merge([
            "current" => "",
        ], $links);

        $response = [
            "code" => $this->getStatusCode(),
            "links" => $responseLinks,
        ];

        if (!key_exists('next', $links) || !key_exists('prev', $links)) {
            return $this->respondInternalError("You have to include both next and previous links");
        }

        if (key_exists('message', $data)) {
            $response = array_merge(
                $response,
                $data
            );
        } else {
            $response = array_merge(
                ['data' => $data ?? null],
                $response
            );
        }

        return $response;
    }

    /**
     * Function to return an error response.
     *
     * Shouldn't be called directly, but we should setStatus first for the error type
     *
     * @param string $message
     * @return mixed
     */
    private function respondWithError(string $message) : array
    {
        return [
            'error' => [
                'code' => $this->getStatusCode(),
                'message' => $message,
            ],
        ];
    }


}
