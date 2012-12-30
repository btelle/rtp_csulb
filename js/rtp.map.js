/**
 * rtp.map.js
 * 
 * RTP map initialization
 * 
 * @author Brandon Telle
 */


$(document).ready(function(){
    // Start AJAX updating
    setInterval('RTP.updateMap()', 30000);

    // Set up hover boxes
    $(".home_lots li").hover(function(){ RTP.showLotDetail(this.id); }, function(){RTP.hideLotDetail(); });

    // Keep track of cursor position, for dynamic placement of hover box
    $(document).mousemove(function(e){
       RTP.currentX = e.pageX;
       RTP.currentY = e.pageY;
    });
});