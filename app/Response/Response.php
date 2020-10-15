<?php


namespace RServices\Response;


use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

class Response
{

    public static function build()
    {
        return new self();
    }

    private $code;
    private $status;
    private $data;
    private $redirect;
    private $headers;
    private $messages;
    private $errors;
    private $transactionCode;

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code): Response
    {
        $this->code = $code;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus(string $status): Response
    {
        $this->status = $status;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): Response
    {
        $this->data = is_array($data) ? $data : [$data];
        return $this;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function setMessages($message): Response
    {
        $this->messages = is_array($message) ? $message : [$message];
        return $this;
    }

    public function addMessage($message, $type)
    {
        $this->messages[$type][] = $message;
        return $this;
    }

    public function getTransactionCode(): int
    {
        return $this->transactionCode;
    }

    public function setTransactionCode(int $transactionCode): Response
    {
        $this->transactionCode = $transactionCode;
        return $this;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): Response
    {
        $this->headers = $headers;
        return $this;
    }

    public function getRedirect()
    {
        return $this->redirect;
    }

    public function setRedirect($redirect): Response
    {
        $this->redirect = $redirect;
        return $this;
    }

    /**
     * @param mixed $errors
     */
    public function setErrors($errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function responseCode()
    {
        if ($code = $this->code)
            return $code;
        switch ($this->status ?: 'success') {
            case ResponseState::SUCCESS:
                $code = ResponseCode::HTTP_OK;
                break;
            case ResponseState::ERROR:
                $code = ResponseCode::HTTP_INTERNAL_SERVER_ERROR;
                break;
            case ResponseState::INVALID:
                $code = ResponseCode::HTTP_BAD_REQUEST;
                break;
            default:
                $code = ResponseCode::HTTP_INTERNAL_SERVER_ERROR;
        }
        return $code;
    }

    public function response()
    {
        \response()->json([
            'metadata' => [
                'transactionId' => $this->transactionCode,
                'time' => time(),
            ],
            'status' => $this->status ?: 'success',
            'data' => $this->data,
            'messages' => is_array($this->messages) ? $this->messages : ($this->messages ?: null),
            'redirect' => $this->redirect ?: null,
            'errors' => $this->errors,
        ], $this->responseCode(), $this->headers ?: [])->throwResponse();
    }

}

class ResponseState {

    public const SUCCESS = "success";
    public const ERROR = "error";
    public const INVALID = "validation";

}
