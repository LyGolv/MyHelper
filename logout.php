<?php
    session_start();

    session_destroy();

    session_abort();

    header("Location: sign_in-up.php");

