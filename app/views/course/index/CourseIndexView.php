<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/20/24
 * File: CourseIndexView.php
 * Description:
 * todo Calendar and Course Info should be side by side not in a column
 * todo There should be a default popup when no classes are scheduled. Right now nothing is shown.
 */
class CourseIndexView extends View {
    public static function render(): void {
        parent::header("Courses");
        ?>
        <link href="/I211-Team-Project/public/css/calstyle.css" rel="stylesheet"/>
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

        <!-- Container for course information -->
        <div class="course-container"></div>

        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Include optimized calendar.js script -->
        <script src="/I211-Team-Project/public/js/calendar.js"></script>
        <script>
            // Call manipulate() function after the document is ready to initialize the calendar
            $(document).ready(function () {
                manipulate();
            });
        </script>
        <?php
    }
}

?>
