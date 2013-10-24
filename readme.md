Laravel 4 Calendar
---

Laravel 4 Calendar helper gives you a few different convenient methods for working with dates and calendars in Laravel 4.
At the heart of this is functionality which gets the current date based on the query string parameters `day`, `month`, and `year`.

Using Laravel 4 Calendar
---

In your `app/config/app.php` configuration file add `Rtablada\Calendar\CalendarServiceProvider` to your service providers and `'Calendar' => 'Rtablada\Calendar\CalendarFacade'`.

Now you can call `Calendar::getDateFromInput()` to get the current date plus any modifications that have been made using user input.

The functions
---

### getDateFromInput

This function can take a bunch of different formats to make modifications to what date is used before using the input bag to modify the returned Carbon instance.

When no parameters are passed, this function will use the current system date.
A Carbon instance can be passed to the function as the starting date.
If an array is passed, you can specify `day`, `month`, and `year` keys if a key is left out, the current system date's value for that key will be used.
Otherwise, the parameters can be passed as `getDateFromInput($day, $month, $year)` if any parameters are left out, then the current system date's value for that parameter will be used.

### yearLinks

This function will return a View object which will have links to pick years.

The `yearLinks` function accepts a few parameters
1. `selectedDate` - This value will be sent to the `getDateFromInput` function to show the current date, in case you want to overwrite the default other than what occurs in the user input.
2. `startYear` - Year to start the links created, if ommitted or null is passed, one year before the computed `selectedDate` is used.
3. `endYear` - Year to end the links created, if ommitted or null is passed, one year after the computed `selectedDate` is used.
4. `options` - See the options parameter section below.

### monthLinks and dayLinks

These functions return View objects which will have links to pick either months or days.

These functions accept two parameters
1. `selectedDate` - This value will be sent to the `getDateFromInput` function to show the current date, in case you want to overwrite the default other than what occurs in the user input.
2. `options` - See the options parameter section below.

The Options Parameter
---

The `options` parameter accepts a keyed array to allow you to dictate a few different display options, the keys currently available are:

1. `before_current`
2. `before_selected`
3. `after_current`
4. `after_selected`

If you set the value of a key to `hide`, then those options will be hidden. Otherwise, the value is used as an HTML class applied matched date links.
