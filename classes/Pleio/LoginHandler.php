<?php
namespace Pleio;
use Pleio\Exceptions\ShouldRegisterException as ShouldRegisterException;

class LoginHandler {
    protected $resourceOwner;

    public function __construct(ResourceOwner $resourceOwner) {
        $this->resourceOwner = $resourceOwner;
    }

    public function handleLogin() {
        $user = get_user_by_username($this->resourceOwner->getGuid());
        $allow_registration = elgg_get_config("allow_registration");

        if (!$user && $allow_registration) {
            $user = $this->createUser();
        } elseif (!$user && !$allow_registration) {
            if ($this->resourceOwner->isAdmin()) {
                $user = $this->createUser();
            } else {
                throw new ShouldRegisterException;
            }
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

            if ($user->isAdmin !== $this->resourceOwner->isAdmin()) {
                if ($this->resourceOwner->isAdmin()) {
                    $user->makeAdmin();
                }
            }

            $user->save();

            return true;
        } catch (\LoginException $e) {
            throw new ShouldRegisterException;
        }
    }

    public function requestAccess() {
        $link = get_db_link("write");
        $data = mysqli_real_escape_string($link, serialize($this->resourceOwner->toArray()));
        $time = time();

        insert_data("INSERT INTO pleio_request_access (guid, user, time_created) VALUES ({$this->resourceOwner->getGuid()}, '{$data}', {$time}) ON DUPLICATE KEY UPDATE time_created = {$time}");
    }

    public function createUser() {
        $guid = register_user(
            $this->resourceOwner->getGuid(),
            generate_random_cleartext_password(),
            $this->resourceOwner->getName(),
            $this->resourceOwner->getEmail()
        );

        return get_user($guid);
    }
}