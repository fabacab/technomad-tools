<?php
/**
 * Technomad.php
 *
 * @pacakge Technomad Tools
 *
 * @description Base class for Technomad Tools.
 */

require_once(dirname(__FILE__) . '/Location.php');

class Technomad {
    public static $user_id;  //!< For now, the Google Latitude User ID.

    /**
     * Constructor.
     */
    function Technomad ($user_id) {
        $this->user_id = (int) $user_id; // Cast to integer, for safety.
        $this->location = $this->fetchLocation($this->user_id);
    }

    function fetchLocation ($user_id) {
        return new TechnomadLocation($user_id);
    }
}
