<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use Cake\Http\ServerRequest;

class ServerRequestPolicy
{
    public function canAccess(IdentityInterface $user, ServerRequest $request)
    {
        // Example: Allow all authenticated users
        return true;
    }
}
