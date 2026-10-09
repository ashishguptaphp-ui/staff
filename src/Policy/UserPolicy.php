<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use App\Model\Entity\User;

class UserPolicy
{
    /**
     * Can the user view dashboard?
     */
    public function canView(IdentityInterface $user, $resource)
    {
        // Basic example: allow everyone who is logged in
        return true;
    }
}
