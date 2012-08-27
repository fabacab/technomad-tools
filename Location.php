<?php
/**
 * Location.php
 *
 * @package Technomad Tools
 *
 * @description Library for handling location-based services and requests.
 */

/**
 * Base class for a technomad's location. Handles storing current and past location.
 */
class TechnomadLocation extends Technomad {
    var $previous_city; //!< Human-readable name of city-level previous location.
    var $current_city;  //!< Human-readable name of city-level current location.
    var $latitude;      //!< Current latitude coordinate.
    var $longitude;     //!< Current longitude coordinate.
    var $last_updated;  //!< Time when lat/long was last updated.
    var $last_fetched;  //!< Time when lat/long was last fetched, in seconds passed since Unix epoch.

    /**
     * Constructor.
     */
    function TechnomadLocation ($user_id) {
        $data = $this->fetchGoogleLatitudeLocation($user_id);
        $this->current_city = $data['current_city'];
        $this->latitude     = $data['latitude'];
        $this->longitude    = $data['longitude'];
        $this->last_updated = $data['last_updated'];
        $this->last_fetched = time();
        // TODO: Did we move cities?
    }

    // Function to retrieve current lat/long coordinate.
    function fetchGoogleLatitudeLocation ($user_id) {
        $r = array();
        $google_latitude_data = json_decode(file_get_contents("https://www.google.com/latitude/apps/badge/api?user=$user_id&type=json"));
        $r['longitude']    = $google_latitude_data->features[0]->geometry->coordinates[0];
        $r['latitude']     = $google_latitude_data->features[0]->geometry->coordinates[1];
        $r['current_city'] = $google_latitude_data->features[0]->properties->reverseGeocode;
        $r['last_updated'] = $google_latitude_data->features[0]->properties->timeStamp;
        $r['raw']          = $google_latitude_data; // So that we have it all, if we need it.
        return $r;
    }

    // Function to initiate location updates on all known services.
    // TODO: Make this happen.
    function updateAllLocations () {
        //updateFacebookCurrentCity();
        //updateOkCupidCurrentCity();
    }

    // Updates Facebook's "current city" field for this user.
    function updateFacebookCurrentCity () {
    }

    // Updates OkCupid's
    function updateOkCupidCurrentCity () {
    }
}
