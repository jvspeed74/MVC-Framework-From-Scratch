<?php

/**
 * Class CourseIndexView
 *
 * Represents the view for the course index page.
 */
class CourseIndexView extends View {
    /**
     * Renders the course index view.
     *
     * This method renders the course index view, which includes a calendar
     * for displaying course dates and a container for course information.
     * It also includes necessary CSS and JavaScript files for styling and functionality.
     */
    public static function render(): void {
        parent::header("Courses");
        ?>
        <link href="<?= PUBLIC_URL ?>/css/calendar.css" rel="stylesheet"/>
        <div class="calendar-container">
            <header class="calendar-header">
                <p class="calendar-current-date"></p>
                <div class="calendar-navigation">
                    <span id="calendar-prev" class="material-symbols-rounded">&lt;</span>
                    <span id="calendar-next" class="material-symbols-rounded">&gt;</span>
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
        <script src="<?= PUBLIC_URL ?>/js/calendar.js"></script>
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
