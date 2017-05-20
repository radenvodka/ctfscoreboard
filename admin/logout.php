<?php
/**
 * @Author: Eka Syahwan
 * @Date:   2017-04-19 18:40:00
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2017-04-19 18:41:27
 */
session_start();
session_destroy();
header("Location: login.php");