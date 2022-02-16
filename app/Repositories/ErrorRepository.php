<?php

namespace App\Repositories;

use App\Models\Error;
use App\Models\Feed;
use App\Models\User;

class ErrorRepository
{
    protected Error $error;

    public function __construct(Error $error)
    {
        $this->error = $error;
    }

    public function report(int $type, string $exception, ?User $user = null, Feed $feed = null): void
    {
        $errorHash = $this->generateErrorHash($type, $exception, $user, $feed);
        $error = Error::where('uuid', '=', $errorHash)->first();

        if (!$error) {
            Error::create([
                'uuid' => $errorHash,
                'type' => $type,
                'user_id' => $user->id ?? null,
                'feed_id' => $feed->id ?? null,
                'exception' => utf8_encode($exception),
                'occurrences' => 1
            ]);

            return;
        }

        $error->update([
            'occurrences' => $error->occurrences + 1
        ]);
    }

    protected function generateErrorHash(... $data): string
    {
        return substr(md5(serialize($data)),0, 120);
    }
}
