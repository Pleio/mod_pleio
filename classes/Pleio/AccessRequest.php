<?php
namespace Pleio;

class AccessRequest {
    public function __construct($data) {
        $this->id = (int) $data->id;
        $this->user = unserialize($data->user);
        $this->time_created = $data->time_created;
    }

    public function getURL() {
        return $this->user["url"];
    }

    public function getIconURL() {
        return $this->user["icon"];
    }

    public function getType() {
        return "accessRequest";
    }

    public function approve() {
        $resourceOwner = new ResourceOwner($this->user);
        $loginHandler = new LoginHandler($resourceOwner);
        
        try {
            $user = $loginHandler->createUser();
            if ($user) {
                $this->remove();
                return true;
            }
        } catch (\RegistrationException $e) {
            register_error($e->getMessage());
        }

        return false;
    }

    public function decline() {
        return $this->remove();
    }

    private function remove() {
        return delete_data("DELETE FROM pleio_request_access WHERE id = {$this->id}");
    }
}