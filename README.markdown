# Technomad Tools - README

Technomad Tools is a PHP library that aims to provide a foundation for writing programs supporting technomad activities and technomadic individuals, themselves. It makes heavy use of location-based services. It is intended for application, plugin, and extension developers rather than end users.

## Getting started

To use Technomad Tools, include it in your project and instantiate a new `Technomad` object. Currently, the only supported capability is reading Google Latitude locations, so pass a Google Latitude Badge API user ID number:

    // Load Technomad library.
    require_once('technomad-tools/Technomad.php');

    // Instatiate a new Technomad object.
    $google_latitude_user_id = 12345;
    $technomad = new Technomad($google_latitude_user_id);

    // Print some basic information about the account you're using.
    print $technomad->location->current_city; // The human-readable name of the current city.
    print $technomad->location->last_updated; // The human-readable name of the current city.

[Patches welcome](https://github.com/meitar/technomad-tools/issues/new).

## Projects that use Technomad Tools

* None yet! Be the first!
