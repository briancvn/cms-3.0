<?php

namespace CMS\Infrastructure\Extension\Http;

use CMS\Infrastructure\Service\TranslateService;
use CMS\Infrastructure\Extension\Exception\WarningException;
use CMS\Infrastructure\Extension\Exception\ValidationException;
use CMS\Infrastructure\Contract\ResponseDto;
use CMS\Infrastructure\Contract\ResponseErrorDto;
use CMS\Infrastructure\Contract\ResponseWarningDto;

class Response extends \Phalcon\Http\Response
{
    public function setErrorContent(\Exception $e, $debugMode = false)
    {
        $translateService = $this->getDi()->get(TranslateService::class);
        if (!$debugMode) {
            $content = new  ResponseDto([Error => new ResponseErrorDto($e)]);
            $this->setJsonContent($content);
            return;
        }

        if ($e instanceof WarningException) {
            $content = new  ResponseDto([Warning => new ResponseWarningDto([
                Message => $translateService->translate($e->getMessage(), EResource[2]),
                Code => $e->getCode()
            ])]);
            $this->setJsonContent($content);
            return;
        }

        if ($e instanceof ValidationException) {
            $content = new  ResponseDto([ValidationErrors => $e->getMessages()]);
            $this->setJsonContent($content);
            return;
        }

        $this->setContent(join('', [
            '<h2>500 Internal Server Error</h2>',
            $e->getMessage(),
            'Stack trace:',
            $e->getTraceAsString()
        ]));
    }

    public function setJsonContent($content, $jsonOptions = 0, $depth = 512)
    {
        parent::setJsonContent($content, $jsonOptions, $depth);

        $this->setContentType('application/json', 'UTF-8');
        $this->setHeader('E-Tag', md5($this->getContent()));
    }
}
