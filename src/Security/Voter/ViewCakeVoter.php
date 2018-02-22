<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use App\Entity\Cake;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ViewCakeVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        if ($attribute !== 'VIEW') {
            return false;
        }

        if (!$subject instanceof Cake) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if ($user !== null) {
            return false;
        }

        if ($user->getEmail() === 'admin@mail.com') {
            return true;
        }

        return false;
    }
}
