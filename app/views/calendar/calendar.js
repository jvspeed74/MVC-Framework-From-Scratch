let date=new Date();
let year=date.getFullYear();
let month=date.getMonth();

const day=document.querySelector(".calendar-dates");
const currdate=document.querySelector(".calendar-current-date");
const prenexIcons=document.querySelectorAll(".calendar-navigation span");

const months=[
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"];

//function to generate the calendar
const manipulate = () => {
    let dayone = new Date(year, month, 1).getDay();
    let lastdate = new Date(year, month + 1, 0).getDate();
    let dayend = new Date(year, month, lastdate).getDay();
    let monthlastdate = new Date(year, month, 0).getDate();
    let lit = "";

    //loop to add the last dates of the previous month
    for (let i = dayone; i > 0; i--) {
        lit += `<li class="inactive">${monthlastdate - i + 1}</li>`;
    }

    //loop to add the dates of the current month
    for (let i = 1; i <= lastdate; i++) {
        let isActive = (i === date.getDate() && month === date.getMonth() && year === date.getFullYear()) ? "active" : "clickable";
        lit += `<li class="${isActive}">${i}</li>`;
    }

    //loop to add the first dates of the next month
    for (let i = dayend; i < 6; i++) {
        lit += `<li class="inactive">${i - dayend + 1}</li>`;
    }

    currdate.innerText = `${months[month]} ${year}`;
    day.innerHTML = lit;

    //add event listener to clickable dates
    const clickableDates = document.querySelectorAll(".clickable");
    clickableDates.forEach(dateElement => {
        dateElement.addEventListener("click", function(event) {
            let clickedDate = dateElement.innerText;
            let monthString = (month + 1).toString().padStart(2, "0");
            let selectedDate = `${year}-${monthString}-${clickedDate}`;

            $.ajax({
                url: 'fetch_events.php',
                type: 'GET',
                data: { date: selectedDate },
                success: function(response) {
                    // Display events
                    alert(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
};

manipulate();


//attach a click event listener to each icon
prenexIcons.forEach(icon=> {
    icon.addEventListener("click", ()=> {
        month=icon.id==="calendar-prev" ? month - 1 : month + 1;
        if (month < 0 || month > 11) {
            date=new Date(year, month, new Date().getDate());
            year=date.getFullYear();
            month=date.getMonth();
        }
        else {
            date=new Date();
        }
        manipulate();
    });
});

//add event listener to calendar dates
day.addEventListener("click", function(event) {
    if (event.target.classList.contains("active")) {
        let clickedDate = event.target.innerText;
        let monthString = (month + 1).toString().padStart(2, "0");
        let selectedDate = `${year}-${monthString}-${clickedDate}`;

        $.ajax({
            url: 'fetch_events.php',
            type: 'GET',
            data: { date: selectedDate },
            success: function(response) {
                // Display events
                alert(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
});


