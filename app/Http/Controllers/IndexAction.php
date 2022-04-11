<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

class IndexAction extends Controller
{
    /** @var LoggerInterface */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function __invoke(
        Request $request
    ) {
        $this->logger
            ->driver('elasticsearch')
            ->info(
                'user.action',
                [
                    'uri' => $request->getUri(),
                    'referer' => $request->headers->get('referer', ''),
                    'user_id' => 1,
                    'query' => $request->query->all()
                ]
            );
        logs('elasticsearch')->info(
            'user.action',
            [
                'uri' => $request->getUri(),
                'referer' => $request->headers->get('referer', ''),
                'user_id' => 1,
                'query' => $request->query->all()
            ]
        );
    }
}
