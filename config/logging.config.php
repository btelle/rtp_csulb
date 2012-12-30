<?php
/**
 * logging.config.php
 * 
 * Contains logging class and set up.
 * 
 * @author Brandon Telle
 */

$log = new Logging();

class Logging
{
    private $log_file;
    
    /**
     * Constructor
     */
    function __construct()
    {
        $this->log_file = FILE_ROOT.'logs/'.date('Y-m-d').'.php';
        $this->init_log_file();
    }
    
    /**
     * Log an error message.
     * 
     * @param string $message error message to log
     * @param int $level debug level message should be reported at
     */
    function log($message, $level=LOGGING_DEBUG)
    {
        $final_message = "[".date('Y-m-d H:i:s')."] ".$message;

        if($level <= LOGGING_LEVEL)
            print($final_message."<br />");
        
        $fh = fopen($this->log_file, 'a');
        fwrite($fh, $final_message."\n");
        fclose($fh);
    }
    
    /**
     * Initializes log file with PHP die statement to prevent unauthorized
     * log access. 
     * 
     * @throws ErrorException if log file cannot be written to.
     */
    function init_log_file()
    {
        if(!file_exists($this->log_file))
        {
            $file = @fopen($this->log_file, 'w');

            if(!$file)
                throw new ErrorException("Could not open log file.", 1001, E_USER_ERROR);

            fwrite($file, "<?php die(); ?>\n");
            fclose($file);
        }
    }
    
    /**
     * Overrides the default log file.
     * 
     * @param type $log_file new log file
     */
    function set_log_file($log_file)
    {
        $this->log_file = $log_file;
        $this->init_log_file();
    }
}
?>
