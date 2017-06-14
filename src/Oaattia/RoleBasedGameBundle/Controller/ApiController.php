<?php

namespace Oaattia\RoleBasedGameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter method to set status code.
     * It is returning current object
     * for chaining purposes.
     *
     * @param mixed $statusCode
     * @return current object.
     */
    public function setStatusCode($statusCode)
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
    public function respondUnauthorizedError($message = 'Unauthorized!')
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

    /**
     * Function to return forbidden error response.
     * @param string $message
     * @return mixed
     */
    public function respondForbiddenError($message = 'Forbidden!')
    {
        return $this->setStatusCode(Response::HTTP_FORBIDDEN)->respondWithError($message);
    }

    /**
     * Function to return a Not Found response.
     *
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * Function to return an internal error response.
     *
     * @param string $message
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }


    /**
     * Function to return a service unavailable response.
     *
     * @param string $message
     * @return mixed
     */
    public function respondServiceUnavailable($message = "Service Unavailable!")
    {
        return $this->setStatusCode(Response::HTTP_SERVICE_UNAVAILABLE)->respondWithError($message);
    }


    /**
     * @param string $message
     * @param array $links
     *
     * @return mixed
     */
    public function respondCreated(string $message, array $links) : array
    {
        return $this->setStatusCode(Response::HTTP_CREATED)
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
    public function respond(array $data, array $links) : array
    {
        $responseLinks = array_merge([
            "current" => "",
        ], $links);

        $response = [
            "code" => $this->getStatusCode(),
            "links" => $responseLinks,
        ];

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
     * @param array $messages
     * @return mixed
     */
    public function respondWithError(array $messages)
    {
        return [
            'error' => [
                'code' => $this->getStatusCode(),
                'message' => $messages,
            ],
        ];
    }


}
