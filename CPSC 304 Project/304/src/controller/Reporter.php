<?php

/**
 * Class Reporter
 * handles the user's cashier and logout process
 */
class Cashier 
{
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();	

    /**
    * 
    */
    public function printAllRows($tablename) { 
    echo '<div class="table-responsive"';
    echo "<table class="table table-hover">";
    echo "<thead>";
    echo "<tr><th> $tablename </th></tr>";
    echo "</thead>";
    echo "<tbody>";
    while (($row = oci_fetch_array($result, OCI_BOTH)) != false) {
    echo "<tr><td>" .  $row[0] . "</td><td>" . $row[1] . "</td></tr>";
}
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}

}
