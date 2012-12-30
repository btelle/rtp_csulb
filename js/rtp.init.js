/* 
 * rtp.init.js
 * 
 * RTP Javascript functions
 * 
 * @author Brandon Telle, Ibrahim Gokoglu
 */

var RTP = {

    currentX: 0,
    currentY: 0,
    dates: [new Date ('12/25/2011'), new Date ('12/26/2011'), new Date ('01/11/2012')],
    n: 0,
    
    // AJAX update the home page map
    updateMap: function(){
        var map_mid = 90;
        var map_empty = 80;

        $.ajax({
            url: "ajax.php?mode=map&location="+$('#location:selected').val()+"&space_type="+$('#space_type:selected').val()+"&campus_section="+$('#campus_section:selected').val(),
            success: function(data){
                // Parse JSON data
                var rows = $.parseJSON(data);

                for(row in rows)
                {
                    if(rows[row].Capacity > 0)  // Only process data that makes sense...
                    {
                        var percent = parseInt(parseFloat(rows[row].Occupied)/parseFloat(rows[row].Capacity)*100);
                        var symbol = "%";
                        if(rows[row].Closed){
                            percent = "Closed";
                            symbol = "";
                        }
                            

                        // Update the li contents
                        $("#"+rows[row].Classname).html("<h2>"+rows[row].Name+"</h2><span>"+percent+symbol+"</span>");

                        // Remove old filled-up style
                        $("#"+rows[row].Classname).removeClass("closed, full, mid, empty");

                        // Determine new filled-up style
                        if(percent == "Closed"){$("#"+rows[row].Classname+"").addClass("closed");}
                        else if(percent > map_mid){$("#"+rows[row].Classname+"").addClass("full");}
                        else if(percent > map_empty){$("#"+rows[row].Classname+"").addClass("mid");}
                        else {$("#"+rows[row].Classname+"").addClass("empty");}
                    }
                }
            }
        });
    },  // End updateMap

    // Show the lot detail box for lot identified in className
    showLotDetail: function(className){
        // Cursor location relative to the image
        var cursor_x = RTP.currentX - (($(document).width()-960)/2);
        var cursor_y = RTP.currentY - 246;   // lol magic numbers

        // Determine location of window
        var left_loc = (cursor_x+55)+"px";

        if(cursor_x > 700) // Cursor is far right, move the box to the left
            left_loc = (cursor_x - 55 - 175)+"px";

        var top_loc = (cursor_y+20)+"px";

        if(cursor_y > 700) // Cursor is near the bottom, move the box above it
            top_loc = (cursor_y - 200)+"px";

        // Get lot details via AJAX
        $.ajax({
            url: 'ajax.php?mode=details&lot='+className,
            success: function(data){
                // Parse JSON
                var details = $.parseJSON(data);

                var html = "<h2>"+details.Lot_Name+"</h2><p>Available Spaces: <p><ul>";

                for(type in details.Type_Data)
                {
                    html += "<li><strong>"+details.Type_Data[type].Available+"</strong> "+details.Type_Data[type].Name+"</li>";
                }

                html += "</ul>";

                $('#lotDetail').html(html);
                $('#lotDetail').css('display', 'block');
                $('#lotDetail').css('left', left_loc);
                $('#lotDetail').css('top',  top_loc);
            }
        });
    },

    // Hide the lot detail window
    hideLotDetail: function(){
        $("#lotDetail").css('display', 'none');
        $("#lotDetail").html('');
    },
    
    // Update the daily event area in event calendar
    updateEvents: function(date){
        load_div = "#calendar_load";
        var cur = '<h2>Events for '+date+'</h2><ul>';
         $.ajax({
            url: "ajax.php?mode=calendar&day="+date,
            success: function(data){
                var rows = $.parseJSON(data);
                var count = 0;

                for(row in rows)
                {
                    count++;
                    cur = cur+"<li><em>"+rows[row].description+"</em> near "+rows[row].lot+" from "+rows[row].start+" to "+rows[row].end+"</li>";
                }

                if(count <= 0)
                {
                    cur = cur+"<li>No events for that day</li>";
                }
                
                $(load_div).html(cur+'</ul>');
            }
        });
    },
    
    // Not sure what this does
    highlightDays: function(date){
        for (var i = 0; i < RTP.dates.length; i++) {
            if ((RTP.dates[i].getDate() == date.getDate()) &&
                (RTP.dates[i].getMonth() == date.getMonth()) &&
                (RTP.dates[i].getFullYear() == date.getFullYear())) {
                
                return [true, 'highlight', 'event'];
             }
             RTP.n++;
         }
         return [true, ''];
    }, 
    changeMonth: function(year, month, inst){
        $.ajax({
            url: "ajax.php?mode=cal_month&year="+year+"&month="+month,
            success: function(data){
                rows = $.parseJSON(data);
                var cur = '';
                for(row in rows){
                    
                    cur += '<tr>';
                    cur += '<td>'+rows[row].date+'</td>';
                    cur += '<td>'+rows[row].description+'</td>';
                    cur += '<td>'+rows[row].start_time+'</td>';
                    cur += '<td>'+rows[row].end_time+'</td>';
                    cur += '</tr>';
                }
                if(cur == '')
                    cur = '<tr><td colspan="4" style="text-align: center;"><strong>No events found!</strong></td></tr>'
                    
                $('#calendar_events tbody').html(cur);
            }
        });
    }
};