{**
 * eventcalender/form.tpl
 *
 * event calender form template.
 *
 * @author Ibrahim Gokoglu
 *}
{include file="layout/std_header.tpl"}

<h1>Event Calendar</h1>

<div id="datepicker"></div>

<form id="searchForm" action="#" method="post">
    <input id="selectedDate" name='selectedDate' type="hidden" value="" />
</form>

<div id="calendar_load"></div>

{if $thisMonth}
<table id="calendar_events">
    <caption>This Month's Events</caption>
    <thead>
        <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Start Time</th>
            <th>End Time</th>
        </tr>    
    </thead>
    <tbody>
        {section loop=$thisMonth name=event}
        <tr>
            <td>{$thisMonth[event].date}</td>
            <td>{$thisMonth[event].description}</td>
            <td>{$thisMonth[event].start_time}</td>
            <td>{$thisMonth[event].end_time}</td>
        </tr>
        {/section}
    </tbody>
</table>
{/if}

<script src="js/jquery/jquery-ui-1.8.16.custom.min"></script>
<script src="js/calendar.js"></script>

{include file="layout/std_footer.tpl"}