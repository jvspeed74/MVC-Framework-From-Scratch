<?php
/**
 * Author : Abrar Sabel
 * Date : 4/17/24
 * File : ?{FILE_NAME}
 * Description :
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Interactive Calendar</title>
    <link rel="stylesheet" href="calstyle.css">
</head>
<body>
<div class="calendar-container">
    <header class="calendar-header">
        <p class="calendar-current-date"></p>
        <div class="calendar-navigation">
            <span id="calendar-prev" class="material-symbols-rounded"><</span>
            <span id="calendar-next" class="material-symbols-rounded">></span>
        </div>
    </header>
    <div class="calendar-body">
        <ul class="calendar-weekdays">
            <li>Sun</li>
            <li>Mon</li>
            <li>Tue</li>
            <li>Wed</li>
            <li>Thu</li>
            <li>Fri</li>
            <li>Sat</li>
        </ul>
        <ul class="calendar-dates"></ul>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="calendar.js"></script>

</body>
</html>

