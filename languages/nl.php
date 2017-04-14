<?php
$nl = array(
    "admin:users:access_requests" => "Aanvragen voor lidmaatschap",
    "admin:users:import" => "Importeer gebruikers",
    "pleio:site_permission" => "Toegangsniveau voor de site:",
    "pleio:not_configured" => "De Pleio login plugin is niet geconfigureerd.",
    "pleio:registration_disabled" => "Registratie is gedeactiveerd. Maak een account aan op Pleio.",
    "pleio:walled_garden" => "Welkom op %s",
    "pleio:walled_garden_description" => "Toegang tot deze site is gelimiteerd tot geautoriseerde gebruikers. Log in om toegang te krijgen of toegang aan te vragen.",
    "pleio:request_access" => "Toegang aanvragen",
    "pleio:request_access:description" => "Om toegang tot deze site te krijgen dient u toestemming te hebben van de beheerder. Vraag toestemming aan door op de knop hieronder te drukken.",
    "pleio:change_settings" => "Instellingen aanpassen",
    "pleio:change_settings:description" => "Om instellingen aan te passen, ga naar %s. Wanneer je de instellingen hebt aangepast, log opnieuw in om de wijzigingen door te voeren.",
    "pleio:access_requested" => "Toegang is aangevraagd",
    "pleio:could_not_find" => "Kan het toegangsverzoek niet vinden.",
    "pleio:access_requested:description" => "De toegang is aangevraagd. Je ontvangt een e-mail wanneer de toegang door de beheerder wordt toegewezen.",
    "pleio:no_requests" => "Er zijn momenteel geen aanvragen.",
    "pleio:approve" => "Goedkeuren",
    "pleio:decline" => "Afwijzen",
    "pleio:approved:subject" => "Je hebt nu toegang tot: %s",
    "pleio:approved:body" => "Beste gebruiker,

Je hebt nu toegang tot: %s. Ga naar %s om de site verder te ontdekken. Op de site gebeuren allerlei activiteiten waarvan je een melding in je eigen mailbox kunt ontvangen. Om je aan te melden ga naar deze link: %s. Hier kun je instellen welke meldingen je precies wilt ontvangen.",
    "pleio:declined:subject" => "Lidmaatschapsverzoek afgewezen voor: %s",
    "pleio:declined:body" => "Hallo daar,

Helaas heeft de site-beheerder van %s je lidmaatschapsverzoek afgewezen. Indien je denkt dat dit een vergissing is neem dan contact op met de site-beheerder.",
    "pleio:closed" => "Gesloten",
    "pleio:open" => "Open",
    "pleio:settings:idp" => "Wanneer SAML2 inloggen gebruikt wordt, vul hier de unieke ID van de SAML2 Identity Provider in",
    "pleio:settings:idp_name" => "Identity Provider weergavenaam",
    "pleio:settings:login_through" => "Inloggen via %s",
    "pleio:settings:login_credentials" => "Maak het ook mogelijk om in te loggen met gebruikersnaam en wachtwoord",
    "pleio:settings:walled_garden_description" => "Beschrijving op de loginpagina (bij een gesloten site)",
    "pleio:login_with_credentials" => "Of, log in met Pleio gebruikersnaam en wachtwoord",
    "pleio:is_banned" => "Helaas, je account is geblokkeerd. Neem contact op met de deelsitebeheerder.",
    "pleio:imported" => "%s gebruikers zijn aangemaakt, %s gebruikers zijn vernieuwd. Er was een probleem met het importeren van %s gebruikers.",
    "pleio:users_import:step1:description" => "Met deze functionaliteit kun je gebruikers importeren door middel van een CSV bestand. Kies het CSV bestand in de eerste stap. Het CSV bestand dient een kopregel te bevatten met de veldnamen. Zorg er verder voor dat de velden gescheiden zijn door een puntkomma ;. Het toegangsniveau van de site zal ingesteld worden op het standaard site toegangsniveau.",
    "pleio:users_import:step1:file" => "CSV-bestand",
    "pleio:continue" => "Ga naar de volgende stap",
    "pleio:users_import:step1:success" => "CSV-bestand succesvol ingelezen.",
    "pleio:users_import:step1:error" => "Er is een fout opgetreden tijdens het lezen van het CSV-bestand. Controleer het bestand en probeer het opnieuw.",
    "pleio:users_import:choose_field" => "Kies een veld",
    "pleio:users_import:source_field" => "Bronveld",
    "pleio:users_import:target_field" => "Doelveld",
    "pleio:users_import:step2:description" => "Link nu de bronvelden uit het CSV-bestand aan de doelvelden in dit platform. Wanneer je niet bestaande gebruikers zou willen aanmaken, zorg er dan voor dat er tenminste een voor- en achternaam en emailadres aanwezig is. Wanneer deze velden niet geselecteerd worden, zullen alleen reeds bestaande accounts vernieuwd worden. Het systeem controleert of een gebruiker reeds bestaat door eerst te kijken naar het guid veld, daarna naar de gebruikersnaam en daarna naar het e-mailadres.",
    "pleio:users_import:sample" => "voorbeeld",
    "profile:gender" => "Geslacht"
);

add_translation("nl", $nl);