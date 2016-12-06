<?php
namespace Pleio;

class LoginHandler {
    protected $resourceOwner;

    public function __construct(ResourceOwner $resourceOwner) {
        $this->resourceOwner = $resourceOwner;
    }

    public function handleLogin() {
        $user = get_user_by_username($this->resourceOwner->getUsername());
        if (!$user) {
            $user = $this->createUser();
        }

        if (!$user) {
            return false;
        }

        try {
            login($user);

            if ($user->name !== $this->resourceOwner->getName()) {
                $user->name = $this->resourceOwner->getName();
            }

            if ($user->email !== $this->resourceOwner->getEmail()) {
                $user->email = $this->resourceOwner->getEmail();
            }

            if ($user->language !== $this->resourceOwner->getLanguage()) {
                $user->language = $this->resourceOwner->getLanguage();
            }

            if ($user->iconUrl !== $this->resourceOwner->getIcon()) {
                $user->iconUrl = $this->resourceOwner->getIcon();
            }

            if ($user->isAdmin !== $this->resourceOwner->isAdmin()) {
                if ($this->resourceOwner->isAdmin()) {
                    $user->makeAdmin();
                } else {
                    $user->removeAdmin();
                }
            }

            return true;
        } catch (\LoginException $e) {
            return false;
        }
    }

    private function createUser() {
        try {
            $guid = register_user(
                $this->resourceOwner->getUsername(),
                generate_random_cleartext_password(),
                $this->resourceOwner->getName(),
                $this->resourceOwner->getEmail()
            );

            return get_user($guid);
        } catch (\RegistrationException $e) {
            return false;
        }
    }
}