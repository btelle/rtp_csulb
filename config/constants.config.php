<?php
/**
 * constants.config.php
 * 
 * Defines site-wide constants.
 * 
 * @author Brandon Telle
 * Modified by Chethan G.  Added constant to restrict the Home page Menu's to 10
 */

/* Logging Level */
define('LOGGING_FINAL', 0); // display no non-fatal errors.
define('LOGGING_TEST', 1);  // display warnings.
define('LOGGING_DEBUG', 2); // display debug messages.

define('LOGGING_LEVEL', LOGGING_DEBUG);

/* Email Settings */
define('EMAIL_ADDR', 'rtpcsulb@gmail.com');
define('EMAIL_PASS', '[REDACTED]');
define('EMAIL_NAME', 'RTP at CSULB');

/* Recaptcha Keys */
define('RECAPTCHA_PUBKEY', '6LcOEcoSAAAAAIIg3JJH5xaAslQ_rKrpCaeG1CSW');
define('RECAPTCHA_PRIVKEY', '[REDACTED]');

/* Limit Menu Items */
define('LIMIT_MENU', 10);

/* SQL connections details */
define('SQL_HOST', '[REDACTED]');
define('SQL_USER', 'rtp');
define('SQL_PASS', '[REDACTED]');
define('SQL_DB', 'rtp');

?>
