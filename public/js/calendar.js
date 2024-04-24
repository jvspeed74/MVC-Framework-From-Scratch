// Define prenexIcons globally if necessary
const prenexIcons = document.querySelectorAll(".calendar-navigation span");

// Define day by selecting the appropriate element
const day = document.querySelector(".calendar-dates");

// Select the element with the class 'calendar-current-date'
const currdate = document.querySelector(".calendar-current-date");

// Declare and initialize year and month as global variables
let year = new Date().getFullYear();
let month = new Date().getMonth(); // Note: Months are zero-indexed, January is 0

// Define months globally
const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

// Function to fetch and render course information
const fetchAndRenderCourses = (selectedDate) => {
    $.ajax({
        url: '/I211-Team-Project/public/index.php/course/fetch/',
        type: 'GET',
        data: {date: selectedDate},
        success: function (response) {
            renderCourses(response);
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
};

// Function to render course information
const renderCourses = (courses) => {
    if (!Array.isArray(courses)) {
        console.error("Invalid or empty courses data received");
        return;
    }
    let courseInfoHTML = '';
    courses.forEach(course => {
        courseInfoHTML += `
            <div class="course">
                <h3>${course.title}</h3>
                <p>${course.description}</p>
                <p>Date: ${course.date}</p>
                <p>Time: ${course.startTime} - ${course.endTime}</p>
            </div>
        `;
    });
    const courseContainer = document.querySelector('.course-container');
    courseContainer.innerHTML = courseInfoHTML;
};

// Function to update current date display
const updateCurrentDateDisplay = () => {
    currdate.innerText = `${months[month]} ${year}`;
};

// Function to generate the calendar
const manipulate = () => {
    let date = new Date();
    let dayone = new Date(year, month, 1).getDay();
    let lastdate = new Date(year, month + 1, 0).getDate();
    let dayend = new Date(year, month, lastdate).getDay();
    let monthlastdate = new Date(year, month, 0).getDate();
    let lit = "";

    for (let i = dayone; i > 0; i--) {
        lit += `<li class="inactive">${monthlastdate - i + 1}</li>`;
    }

    for (let i = 1; i <= lastdate; i++) {
        let isActive = (i === date.getDate() && month === date.getMonth() && year === date.getFullYear()) ? "clickable" : "clickable";
        lit += `<li class="${isActive}">${i}</li>`;
    }

    for (let i = dayend; i < 6; i++) {
        lit += `<li class="inactive">${i - dayend + 1}</li>`;
    }

    day.innerHTML = lit;

    // Add event listener to clickable dates
    const clickableDates = document.querySelectorAll(".clickable");
    clickableDates.forEach(dateElement => {
        dateElement.addEventListener("click", function (event) {
            // Remove "active" class from previously selected date
            const activeDate = document.querySelector(".active");
            if (activeDate) {
                activeDate.classList.remove("active");
                activeDate.classList.add("clickable");
            }

            // Apply "active" class to the currently clicked date
            dateElement.classList.add("active");
            dateElement.classList.remove("clickable");

            let clickedDate = dateElement.innerText;
            let monthString = (month + 1).toString().padStart(2, "0");
            let selectedDate = `${year}-${monthString}-${clickedDate}`;
            fetchAndRenderCourses(selectedDate);
        });
    });

    updateCurrentDateDisplay();

    // Fetch and render courses for the current date
    let currentDateString = `${year}-${(month + 1).toString().padStart(2, "0")}-${date.getDate().toString().padStart(2, "0")}`;
    fetchAndRenderCourses(currentDateString);
};


// Attach a click event listener to each icon if prenexIcons is defined
if (prenexIcons) {
    prenexIcons.forEach(icon => {
        icon.addEventListener("click", () => {
            month = icon.id === "calendar-prev" ? month - 1 : month + 1;
            if (month < 0 || month > 11) {
                let date = new Date(year, month, new Date().getDate());
                year = date.getFullYear();
                month = date.getMonth();
            }
            manipulate();
        });
    });
}

// Add event listener to calendar dates
day.addEventListener("click", function (event) {
    if (event.target.classList.contains("active")) {
        let clickedDate = event.target.innerText;
        let monthString = (month + 1).toString().padStart(2, "0");
        let selectedDate = `${year}-${monthString}-${clickedDate}`;
        fetchAndRenderCourses(selectedDate);
    }
});

// Initial calendar generation
manipulate();
