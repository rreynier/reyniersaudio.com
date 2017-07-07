<?php
function outputResult($result,$action,$item) {
    if ( $result > 0 ) {
        echo "<span class='success'>$result $item(s) were $action</span>";
    }
    else {
        echo "<span class='failure'>$result $item(s) were $action</span>";
    }
}

?>
