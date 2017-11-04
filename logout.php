<?php
/**
 * Author: Jacob Mills
 * Date: 10/31/2017
 * Description: Navigation to this page should logout the current user and redirect to the login page.
 */


session_start();
session_unset();
header('location:/login');