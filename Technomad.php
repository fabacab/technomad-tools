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
    var $services; //!< Array containing TechnomadService objects for each service added.

    /**
     * Constructor.
     */
    function Technomad ($user_id) {
        // Initialize.
        $this->services = array();
        $this->user_id = (int) $user_id; // Cast to integer, for safety.
        $this->location = $this->fetchLocation($this->user_id);
    }

    function fetchLocation ($user_id) {
        return new TechnomadLocation($user_id);
    }

    /**
     * Instantiate a subclass of the TechnomadService object.
     *
     * @param[in] string $name The name of the service to instantiate. Possible values are 'Facebook'.
     * @param[in] array $args Arguments to pass to the constructor of the TechnomadService subclass. (Optional.)
     */
    function addService ($name, $args = array()) {
        $cls = "Technomad{$name}Service";
        $this->services[$name] = new $cls($args);
    }
}

/**
 * Base class for the various services a technomad might use.
 *
 * Typically, this is not called directly. Instead, call a subclass.
 */
class TechnomadService {
    var $name; //!< The name of the service, such as "Facebook" or "OkCupid".

    function TechnomadService ($name) {
        $this->name = $name;
    }

}

class TechnomadFacebookService extends TechnomadService {
    var $api; //!< The Facebook SDK's "Facebook" object.

    function TechnomadFacebookService ($config) {
        require_once(dirname(__FILE__) . '/lib/facebook/src/facebook.php');
        parent::__construct(substr(get_class(), 9, -7)); // save service name, minus "Technomad" and "Service".
        $this->api = new Facebook($config);
    }

}
