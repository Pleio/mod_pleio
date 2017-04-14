<?php
$en = array(
    "admin:users:access_requests" => "Access requests",
    "admin:users:import" => "Import users",
    "pleio:site_permission" => "Permission of the site:",
    "pleio:not_configured" => "The Pleio login plugin is not configured.",
    "pleio:registration_disabled" => "Registration is disabled, create an account on Pleio.",
    "pleio:walled_garden" => "Welcome to %s",
    "pleio:walled_garden_description" => "Access to this site is restricted to users. Log in to access the site or request membership.",
    "pleio:request_access" => "Request access",
    "pleio:request_access:description" => "To enter this site, you must request access from the admin. Click the button to request access.",
    "pleio:change_settings" => "Change settings",
    "pleio:change_settings:description" => "To change your settings please go to %s. After you changed the settings, please login again to effectuate your settings.",
    "pleio:access_requested" => "Requested access",
    "pleio:could_not_find" => "Could not find access request.",
    "pleio:access_requested:description" => "Access is requested. You will receive an e-mail when the request is accepted.",
    "pleio:no_requests" => "Currently there are no requests.",
    "pleio:approve" => "Approve",
    "pleio:decline" => "Decline",
    "pleio:settings:notifications_for_access_request" => "Send all admins a notification when somebody requests access to the site",
    "pleio:admin:access_request:subject" => "New access request for %s",
    "pleio:admin:access_request:body" => "Hello %s,
        Somebody with the name %s has performed an access request to %s.
        To review the request please visit:

        %s",
    "pleio:approved:subject" => "You are now member of: %s",
    "pleio:approved:body" => "Hello there,

you are now member of: %s. Go to %s and login to get access.",
    "pleio:declined:subject" => "Membership request declined for: %s",
    "pleio:declined:body" => "Hello there,

Unfortunately the site administrator of %s decided to decline your membership request. Please contact the administrator if you think this is a mistake.",
    "pleio:closed" => "Closed",
    "pleio:open" => "Open",
    "pleio:settings:idp" => "When using SAML2 login, provide the unique ID of the SAML2 Identity Provider",
    "pleio:settings:idp_name" => "Identity Provider display name",
    "pleio:settings:login_through" => "Login through %s",
    "pleio:settings:login_credentials" => "Allow to login with credentials as well",
    "pleio:settings:walled_garden_description" => "Description on login page of closed site",
    "pleio:login_with_credentials" => "Or, login using credentials",
    "pleio:is_banned" => "Unfortunately, your account is banned. Please contact the site administrator.",
    "pleio:imported" => "Imported %s users, updated %s users and an error occured while importing for %s users.",
    "pleio:users_import:step1:description" => "This functionality allows you to import users using a CSV file. Please choose the CSV file in the first step. Make sure the first line of the CSV contains the field names and the fields are delimited by a semicolon ;. The permissionlevel of the fields will be set to the default site level.",
    "pleio:users_import:step2:description" => "Please link the source fields in the CSV file to the target fields in this platform. Make sure that users within the platform are ",
    "pleio:users_import:choose_field" => "Choose a field",
    "pleio:users_import:source_field" => "Source field",
    "pleio:users_import:target_field" => "Target field",
    "pleio:users_import:step1:file" => "CSV file",
    "pleio:users_import:step1:file" => "Continue to the next step",
    "pleio:users_import:step1:success" => "CSV is uploaded succesfully",
    "pleio:users_import:step1:error" => "There was an error while uploading the CSV file. Please check the file and try again.",
    "pleio:users_import:sample" => "sample",
    "profile:gender" => "Gender"
);

add_translation("en", $en);