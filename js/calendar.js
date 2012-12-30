/**
 * calendar.js
 * 
 * Event calendar init JS
 * 
 * @author Ibrahim Gokoglu
 * 
 * Modified:    Brandon T   Split functions off into rtp.init.js
 */

$(document).ready(function() {
    $("#datepicker").datepicker({
            beforeShowDay: RTP.highlightDays, 
            onSelect: RTP.updateEvents, 
            onChangeMonthYear: RTP.changeMonth
        });
    
    var now = new Date();
    RTP.updateEvents(now.getMonth()+1+"/"+now.getDate()+"/"+now.getFullYear());
});
