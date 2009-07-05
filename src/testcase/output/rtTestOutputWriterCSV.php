<?php
/**
 * rtTestOutputWriterCSV
 *
 * Write minimal testoutput and status a CSV
 *
 * @category   Testing
 * @package    RUNTESTS
 * @author     Zoe Slattery <zoe@php.net>
 * @author     Stefan Priebsch <spriebsch@php.net>
 * @author     Georg Gradwohl <g2@php.net>
 * @copyright  2009 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link       http://qa.php.net/
 *
 */
class rtTestOutputWriterCSV extends rtTestOutputWriter
{

    public function __construct()
    {
        $this->type = 'csv';
    }


    public function createOutput()
    {
        foreach ($this->resultList as $testResult) {
            $outputString = $testResult->getName();
            $testStatus = $testResult->getStatus();
            foreach($testStatus->getTestStateNames() as $name) {
                if($testStatus->getValue($name)) {
                    $outputString .= " , ". strtoupper($name);

                }
            }
            $this->output .= $outputString."\n";
        }
    }

}
?>