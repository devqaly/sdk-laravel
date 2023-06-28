<?php

namespace Devqaly\DevqalyLaravel\Middlewares;

use Closure;
use Devqaly\DevqalyClient\DevqalyClient;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class DevqalyMiddleware
{
    const SESSION_ID_HEADER_NAME = 'x-devqaly-session-id';

    const SESSION_SECRET_TOKEN_HEADER_NAME = 'x-devqaly-session-secret-token';

    public function handle($request, Closure $next)
    {
        if (! $this->shouldRunMiddleware()) {
            return $next($request);
        }

        if (! $this->hasHeaders($request)) {
            return $next($request);
        }

        $sessionId = $request->header(self::SESSION_ID_HEADER_NAME);
        $sessionSecretToken = $request->header(self::SESSION_SECRET_TOKEN_HEADER_NAME);
        $client = new DevqalyClient(config('devqaly.api'), config('devqaly.source'));

        $eventsToReport = explode(',', config('devqaly.events'));

        if (in_array('databaseTransactions', $eventsToReport)) {
            $this->registerDatabaseTransactionListener($sessionSecretToken, $sessionId, $client);
        }

        if (in_array('logs', $eventsToReport)) {
            $this->registerLogsListener($sessionSecretToken, $sessionId, $client);
        }

        return $next($request);
    }

    private function registerLogsListener(
        string $sessionSecretToken,
        string $sessionId,
        DevqalyClient $client
    ): void {
        Event::listen(function (MessageLogged $messageLogged) use ($sessionId, $sessionSecretToken, $client) {
            $client->createLogEvent($sessionId, $sessionSecretToken, [
                'level' => $messageLogged->level,
                'log' => $messageLogged->message,
            ]);
        });
    }

    private function registerDatabaseTransactionListener(
        string $sessionSecretToken,
        string $sessionId,
        DevqalyClient $client
    ): void {
        DB::listen(function (QueryExecuted $query) use ($sessionSecretToken, $sessionId, $client) {
            $sql = $query->sql;
            $bindings = $query->bindings;
            $executionTimeInMilliseconds = $query->time;

            foreach ($bindings as $binding) {
                $value = is_numeric($binding) ? $binding : "'".$binding."'";
                $sql = preg_replace('/\?/', $value, $sql, 1);
            }

            $client->createDatabaseEventTransaction($sessionId, $sessionSecretToken, [
                'sql' => $sql,
                'executionTimeInMilliseconds' => $executionTimeInMilliseconds,
            ]);
        });
    }

    private function shouldRunMiddleware(): bool
    {
        $runAtEnvironments = explode(',', config('devqaly.runAtEnvironments'));
        $currentEnvironment = config('app.environment');

        return in_array($currentEnvironment, $runAtEnvironments);
    }

    private function hasHeaders($request): bool
    {
        return $request->hasHeader(self::SESSION_ID_HEADER_NAME)
            && $request->hasHeader(self::SESSION_SECRET_TOKEN_HEADER_NAME);
    }
}
